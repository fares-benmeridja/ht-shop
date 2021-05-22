<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'email', 'object', 'message'];

    public function getFullNameAttribute()
    {
        return "$this->first_name $this->last_name";
    }

    public function getShortMessageAttribute()
    {
        return Str::words($this->message, 5);
    }


}
