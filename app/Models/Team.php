<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'slug'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function roles(): HasMany
    {
        return $this->hasMany(Role::class);
    }

    public function apikeys(): HasMany
    {
        return $this->hasMany(Apikey::class);
    }

    public function chatbots(): HasMany
    {
        return $this->hasMany(Chatbot::class);
    }

    public function chatias(): HasMany
    {
        return $this->hasMany(Chatia::class);
    }   

    public function clossesessions(): HasMany
    {
        return $this->hasMany(Clossesession::class);
    }   
    
    public function generateqrs(): HasMany
    {
        return $this->hasMany(Generateqr::class);
    } 

    public function flows(): HasMany
    {
        return $this->hasMany(Flow::class);
    }

    public function prompts(): HasMany
    {
        return $this->hasMany(Prompt::class);
    }

    public function welcomes(): HasMany
    {
        return $this->hasMany(Welcome::class);
    }
}
