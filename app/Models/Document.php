<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'studentId',
        'document',
    ];
    protected function document(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ($value == NUll) ? NUll : config('app.image_url') . $value,
        );
    }
}
