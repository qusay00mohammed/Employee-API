<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    // Contract has many employee
    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_contract');
    }
}
