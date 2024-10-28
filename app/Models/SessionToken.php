<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionToken extends Model
{
    protected $fillable = [
        'token',
        'expiry',
    ];
}
