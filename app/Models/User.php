<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    private const MAIN_ADMIN = 'main admin';
    private const SELLER_ADMIN = 'seller';
    private const EDITOR_ADMIN = 'editor';
    private const PHONE_PREFIX = "+213 ";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [ 'password_confirmation' ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Set password hash.
     *
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function setPhoneAttribute($value)
    {
        $value = str_replace('.','', $value);
        $value = str_replace(' ','', $value);

        $this->attributes['phone'] = strlen($value) % 2 === 1
            ? self::PHONE_PREFIX.wordwrap($value, 3, ' ', true)     // +213 775 734 657
            : self::PHONE_PREFIX.wordwrap($value, 2, ' ', true);    // +213 31 34 53 78
    }

    public function getPhoneNativeAttribute()
    {
        return str_replace(' ', '', str_replace(self::PHONE_PREFIX, "", $this->phone));
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getIsAdminAttribute()
    {
        if ($this->role_id !== null)
            return $this->role->name;

        return false;
    }

    public function getIsMainAdminAttribute()
    {
        $response = $this->is_admin;
        if (! $response)
            return false;

        return $response === self::MAIN_ADMIN;
    }

    public function getIsSellerAdminAttribute()
    {
        $response = $this->is_admin;
        if (! $response)
            return false;

        return $response === self::SELLER_ADMIN;
    }

    public function getIsEditorAdminAttribute()
    {
        $response = $this->is_admin;
        if (! $response)
            return false;

        return $response === self::EDITOR_ADMIN;
    }

    public function getIsUserAttribute()
    {
        return $this->role_id === null;
    }

    public function getFullNameAttribute()
    {
        return "$this->first_name $this->last_name";
    }

    public function getWilayaAttribute()
    {
        return $this->commune->daira->wilaya->name;
    }

    public function getWilayaIdAttribute()
    {
        return $this->commune->daira->wilaya->id;
    }
    public function getDairaAttribute()
    {
        return $this->commune->daira->name;
    }

    public function getDairaIdAttribute()
    {
        return $this->commune->daira->id;
    }

    public function scopeAdmin($q)
    {
        return $q->where('role_id', '<>', null)->where('id', '<>',Auth::user()->id);
    }

    public function scopeCommuneWilaya()
    {
        return $this->load(['commune' => function($query){
            $query->with(['daira' => function($query){
                $query->with('wilaya');
            }]);
        }]);
    }

    public function scopeCommuneWithWilaya($q)
    {
        return $q->with(['commune' => function($query){
            $query->with(['daira' => function($query){
                $query->with('wilaya');
            }]);
        }]);
    }

    public function getShortAddressAttribute()
    {
        return Str::words($this->address, 5);
    }
}
