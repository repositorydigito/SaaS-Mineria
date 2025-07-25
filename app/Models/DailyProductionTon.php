<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyProductionTon extends Model
{
    protected $table = 'daily_production_tons';

    protected $fillable = [
        'project_id',
        'date',
        'dump_trucks',
        'tons',
        'details',
        'created_by'
    ];

    protected $casts = [
        'date' => 'date',
        'dump_trucks' => 'integer',
        'tons' => 'decimal:2',
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
