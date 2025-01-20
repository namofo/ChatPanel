<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Role extends SpatieRole
{
    protected $fillable = ['name', 'guard_name', 'team_id'];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($role) {
            if (!$role->team_id && auth()->check()) {
                $role->team_id = auth()->user()->team_id;
            }
        });
    }
}
