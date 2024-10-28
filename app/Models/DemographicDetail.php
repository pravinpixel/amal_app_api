<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemographicDetail extends Model
{
    protected $fillable = [
        'studentId',
        'residingInIndia',
        'addressLine1',
        'addressLine2',
        'countryId',
        'postalcode',
    ];
}
