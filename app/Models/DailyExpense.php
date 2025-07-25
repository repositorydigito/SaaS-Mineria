<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyExpense extends Model
{
    protected $fillable = [
        'project_id',
        'date',
        'total_amount',
        'details',
        'created_by'
    ];

    protected $casts = [
        'date' => 'date',
        'total_amount' => 'decimal:2'
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
