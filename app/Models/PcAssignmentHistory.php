<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PcAssignmentHistory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'assigned_at' => 'datetime',
        'unassigned_at' => 'datetime',
    ];

    public function assignment()
    {
        return $this->belongsTo(PcAssignment::class, 'pc_assignment_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function systemUnit()
    {
        return $this->belongsTo(Asset::class, 'system_unit_id');
    }

    public function monitor()
    {
        return $this->belongsTo(Asset::class, 'monitor_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
