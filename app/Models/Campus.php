<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    /** @use HasFactory<\Database\Factories\CampusFactory> */
    use HasFactory;
    protected $guarded = ['id'];

    public function department(){
        return $this->hasMany(Department::class);
    }

    public function location(){
        return $this->hasMany(Location::class);
    }
}
