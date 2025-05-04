<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;

class Employee extends Model
{
    protected $table = 'Employees';
    protected $fillable = ['name', 'email', 'department_id'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}