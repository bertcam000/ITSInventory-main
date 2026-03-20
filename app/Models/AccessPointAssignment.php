<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessPointAssignment extends Model
{
    protected $fillable = [
        'asset_tag',
        'asset_id',
        'department_id'
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function location(){
        return $this->belongsTo(Location::class);
    }
}
