<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyFuelConsumption extends Model
{
    protected $fillable = [
        'project_id',
        'date',
        'gallons',
        'details',
        'created_by'
    ];

    protected $casts = [
        'date' => 'date',
        'gallons' => 'decimal:2',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
