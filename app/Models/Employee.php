<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'number',
        'birthday',
        'date_hiring',
        'status',
        'gender',
        'image',
        'country_id',
        'city_id',
        'governorate_id',
    ];


    // Employee has many contracts
    public function contracts()
    {
        return $this->belongsToMany(Contract::class, 'employee_contract');
    }

    // Employee has many jobTitle
    public function jopTitles()
    {
        return $this->belongsToMany(JopTitle::class, 'employee_jop_title', 'employee_id', 'jopTitle_id', 'id', 'id');
    }


    // Relation address
    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    public function governorate()
    {
        return $this->hasOne(Governorate::class, 'id', 'governorate_id');
    }
}
