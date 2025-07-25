<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ConsumableType extends Model
{
    protected $fillable = [
        'name',
        'unit'
    ];

    public function dailyConsumables(): HasMany
    {
        return $this->hasMany(DailyConsumable::class);
    }
}
