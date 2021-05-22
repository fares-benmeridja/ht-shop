<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    const UNIT_PRICE = 'DZA';

    protected $fillable = ['slug', 'user_id', 'title', 'description', 'online', 'price', 'quantity', 'category_id'];

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)
            ->withPivot('quantity');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeLoadCategory()
    {
        return $this->load(['category' => function($query){
            $query->select(['name', 'slug', 'id']);
        }]);
    }

    public function scopeWithCategory()
    {
        return $this->with(['category' => function($query){
            $query->select(['name', 'slug', 'id']);
        }]);
    }

    public function scopePublished()
    {
        return $this->whereRaw("online = 1 AND quantity > 0");
    }

    public function scopeLoadUser()
    {
        return $this->load(['user' => function($q){
            $q->select('id', 'first_name', 'last_name');
        }]);
    }

    public function getFirstImageAttribute()
    {
        return $this->images->first()->code;
    }

    public function getFormatedPriceAttribute()
    {
        return number_format($this->price, 0, ',', ' ') .' '.self::UNIT_PRICE;
    }

    public function getLimitedTitleAttribute()
    {
        return Str::limit($this->title, 10);
    }

}
