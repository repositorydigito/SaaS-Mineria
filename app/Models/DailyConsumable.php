<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyConsumable extends Model
{
    protected $fillable = [
        'project_id',
        'consumable_type_id',
        'date',
        'quantity',
        'details',
        'created_by'
    ];

    protected $casts = [
        'date' => 'date',
        'quantity' => 'decimal:2'
    ];

    public function consumableType(): BelongsTo
    {
        return $this->belongsTo(ConsumableType::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
