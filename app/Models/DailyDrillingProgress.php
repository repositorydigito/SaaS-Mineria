<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyDrillingProgress extends Model
{
    protected $table = 'daily_drilling_progress';

    protected $fillable = [
        'project_id',
        'date',
        'drills_count',
        'meters_per_drill',
        'details',
        'created_by'
    ];

    protected $casts = [
        'date' => 'date',
        'drills_count' => 'integer',
        'meters_per_drill' => 'decimal:2',
        'total_meters' => 'decimal:2',
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
