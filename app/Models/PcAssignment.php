<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PcAssignment extends Model
{
    /** @use HasFactory<\Database\Factories\PcAssignmentFactory> */
    use HasFactory;
    protected $guarded = ['id'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function systemUnit(){
        return $this->belongsTo(Asset::class, 'system_unit_id');
    }

    public function monitor(){
        return $this->belongsTo(Asset::class, 'monitor_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function histories()
    {
        return $this->hasMany(PcAssignmentHistory::class, 'pc_assignment_id');
    }
}
