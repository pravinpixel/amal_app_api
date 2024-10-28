<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicDetail extends Model
{
    protected $fillable = [
        'studentId',
        'pursuing',
        'level',
        'institutionName',
        'course'
    ];
}
