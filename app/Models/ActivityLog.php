<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'module',
        'moduleId',
        'doneBy',
        'event',
        'oldValue',
        'newValue',
        'message'
    ];

    protected $casts = [
        'oldValue' => 'array',
        'newValue' => 'array',
    ];
}
