<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $appends = [
        'company_name',
        'department_name'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function getCompanyNameAttribute()
    {
        return $this->company->name;
    }

    public function getDepartmentNameAttribute()
    {
        return $this->department->name;
    }
}
