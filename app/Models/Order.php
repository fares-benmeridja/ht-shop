<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['address', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('quantity');
    }

    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }

    public function scopeLoadProducts()
    {
        return $this->load(['products' => function($query){
            $query->with(['images', 'user']);
        }]);
    }

}
