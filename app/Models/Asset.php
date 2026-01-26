<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    /** @use HasFactory<\Database\Factories\AssetFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function systemUnitSpec()
    {
        return $this->hasOne(SystemUnitSpec::class);
    }

    public function monitorSpec()
    {
        return $this->hasOne(MonitorSpec::class);
    }

    public function systemUnitAssignments(){
        return $this->hasMany(PcAssignment::class, 'system_unit_id');
    }

    public function monitorAssignments(){
        return $this->hasMany(PcAssignment::class, 'monitor_id');
    }
}
