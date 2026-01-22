<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemUnit extends Model
{
    /** @use HasFactory<\Database\Factories\SystemUnitFactory> */
    use HasFactory;

    protected $guarded = ['id'];
}
