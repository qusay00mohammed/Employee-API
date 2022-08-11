<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JopTitle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    // jobTitle has many employee
    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_jop_title', 'jopTitle_id', 'employee_id', 'id', 'id');
    }
}
