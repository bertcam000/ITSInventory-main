<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stock extends Model
{
    protected $guarded = ['id'];

    public function histories(): HasMany
    {
        return $this->hasMany(StockHistory::class)->latest();
    }


    public function updateStockStatus(): void
    {
        if ($this->quantity <= 0) {
            $this->status = 'out_of_stock';
        } elseif ($this->quantity <= $this->minimum_stock) {
            $this->status = 'low_stock';
        } else {
            $this->status = 'in_stock';
        }
    }
    
}
