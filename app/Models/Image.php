<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    protected $keyType = 'string';
    protected $primaryKey = 'code';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
