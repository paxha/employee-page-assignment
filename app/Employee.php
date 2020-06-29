<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'department_id', 'name', 'father_name', 'phone', 'address',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function shifts()
    {
        return $this->belongsToMany(Shift::class)->withTimestamps();
    }
}
