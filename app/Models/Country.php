<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];


    /**
     * relation address
     * Country has many cities
     */
    public function cities()
    {
        return $this->hasMany('App/City', 'country_id', 'id');
    }

    /**
     * relation address
     * BelongsTo Employee
     * Employee has one country just
     */
    public function employee()
    {
        return $this->belongsTo('App/Employee', 'employee_id', 'id');
    }
}
