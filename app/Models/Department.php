<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    /** @use HasFactory<\Database\Factories\DepartmentFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function PcAssignments()
    {
        return $this->hasMany(PcAssignment::class);
    }

    public function campus(){
        return $this->belongsTo(Campus::class);
    }

    public function accessPoints()
    {
        return $this->hasMany(AccessPointAssignment::class);
    }
}
