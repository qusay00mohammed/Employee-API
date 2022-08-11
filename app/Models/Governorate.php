<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'city_id'
    ];

    /**
     * relation address
     * Governorate belongsTo one cities
     */
    public function city()
    {
        return $this->belongsTo('App/City', 'city_id', 'id');
    }

    /**
     * relation address
     * BelongsTo Employee
     * Employee has one governorate just
     */
    public function employee()
    {
        return $this->belongsTo('App/Employee', 'id', 'governorate_id');
    }
}
