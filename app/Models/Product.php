<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    private const UNIT_PRICE = 'DZA';

    private array $configCategories = [
        'Processor',
        'Graphic card',
        'RAM',
        'Motherboard',
        'Power supply unit',
        'SSD',
        'HDD',
        'Boitier',
        'Network card',
    ];

    protected $fillable = ['slug', 'user_id', 'title', 'description', 'online', 'price', 'qty_available', 'category_id'];

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships methods
    |--------------------------------------------------------------------------
    |
    |
    */

    public function orders()
    {
        return $this->belongsToMany(Order::class)
            ->withPivot('quantity');
    }

    public function compatibles()
    {
        return $this->belongsToMany(Product::class, 'pc_configs', 'compatible_with', 'product_id');
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


    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    |
    |
    */
    public function scopeLoadCategory()
    {
        return $this->load(['category' => function($query){
            $query->select(['name', 'slug', 'id', 'image']);
        }]);
    }

    public function scopeWithCategory($q)
    {
        return $q->with(['category' => function($query){
            $query->select(['name', 'slug', 'id', 'image']);
        }]);
    }

    public function scopePublished($q)
    {
        return $q->whereRaw("online = 1 AND qty_available > 0");
    }

    public function scopeLoadUser()
    {
        return $this->load(['user' => function($q){
            $q->select('id', 'first_name', 'last_name');
        }]);
    }

    public function scopeLoadCompatibles()
    {
        return $this->load('compatibles');
    }

    public function scopeConfig($q, array $categories = [])
    {
        if (! $categories)
            $categories = $this->configCategories;

        $queryTable = collect([]);
        foreach ($categories as $category)
            $queryTable->push(DB::table('categories')->where('name', "$category")->pluck('id')->first());

        return $q->whereIn('category_id', $queryTable);
    }


    /*
    |--------------------------------------------------------------------------
    | Geters
    |--------------------------------------------------------------------------
    |
    |
    */

    public function getFirstImageAttribute()
    {
        return $this->images->first()->code ?? null;
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
