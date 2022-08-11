<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'country_id'
    ];

    /**
     * relation address
     * cities belongsTo one contry
     */
    public function country()
    {
        return $this->belongsTo('App/Country', 'country_id', 'id');
    }

    /**
     * relation address
     * Cities has many governorates
     */
    public function governorates()
    {
        return $this->hasMany('App/Governorate', 'city_id', 'id');
    }

    /**
     * relation address
     * BelongsTo Employee
     * Employee has one cities just
     */
    public function employee()
    {
        return $this->belongsTo('App/Employee', 'id', 'city_id');
    }
}
