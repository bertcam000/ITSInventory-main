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

    public function currentPcAssignment()
    {
        return PcAssignment::query()
            ->where('system_unit_id', $this->id)
            ->orWhere('monitor_id', $this->id)
            ->latest('id'); 
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function accessPointAssignment()
    {
        return $this->hasOne(AccessPointAssignment::class);
    }
}
