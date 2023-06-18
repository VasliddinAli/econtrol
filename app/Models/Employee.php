<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function purpose()
    {
        return $this->belongsTo(Purpose::class, 'purpose_id');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    public function device()
    {
        return $this->belongsTo(Device::class, 'device_id');
    }
}
