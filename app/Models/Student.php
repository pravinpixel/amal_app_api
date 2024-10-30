<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Casts\Attribute;

use Illuminate\Database\Eloquent\Model;

class Student extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, SoftDeletes;
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    protected $fillable = [
        'motherName',
        'leaveOfClass',
        'fatherName',
        'regNo',
        'adminNo',
        'year',
        'tcslno',
        'name',
        'email',
        'gender',
        'phoneNumber',
        'dob',
        'image',
        'otp',
        'otpVerified',
        'status',
        'deleted',
    ];

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ($value == NUll) ? NUll : config('app.image_url') . $value,
        );
    }

    public function academic()
    {
        return $this->hasMany(AcademicDetail::class, 'studentId', 'id');
    }

    public function professional()
    {
        return $this->hasMany(ProfessionalDetail::class, 'studentId', 'id');
    }

    public function demographic()
    {
        return $this->hasOne(DemographicDetail::class, 'studentId', 'id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'studentId', 'id');
    }
}




