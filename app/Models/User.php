<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];



    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function entities(): HasMany
    {
        return $this->hasMany(Entity::class, 'created_by');
    }




    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_user', 'user_id', 'project_id')
            ->select(['projects.id', 'projects.name'])
            ->withTimestamps();
    }

    public function assignedProject(): ?Project
{
    return $this->belongsToMany(Project::class, 'project_user', 'user_id', 'project_id')
        ->select(['projects.id', 'projects.name'])
        ->withTimestamps()
        ->first();
}

    public function responsibleExpenses()
    {
        return $this->hasMany(Expense::class, 'responsible_id');
    }

    public function scopeForProject($query, $projectId)
    {
        return $query->whereHas('projects', function ($query) use ($projectId) {
            $query->where('projects.id', $projectId);
        });
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
