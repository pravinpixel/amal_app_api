<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessionalDetail extends Model
{
    protected $fillable = [
        'studentId',
        'type',
        'organisation',
        'designation',
        'experience'
    ];
}
