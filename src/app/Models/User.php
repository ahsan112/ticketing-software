<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(): string
    {
        return $this->role;
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'created_by_id');
    }

    public function tasks(): Collection
    {
        $tasks = TicketTask::latest()->where('owner_id', $this->id)->get();

        return $tasks;
    }

    public function isManager(): bool
    {
        return $this->role == 'manager';
    }

    public function isDeveloper(): bool
    {
        return $this->role == 'developer';
    }

    public function isAdmin(): bool
    {
        return $this->role == 'admin';
    }
}
