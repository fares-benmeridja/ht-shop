<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'object', 'message'];


    public function getShortMessageAttribute()
    {
        return Str::words($this->message, 5);
    }


}
