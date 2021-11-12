<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
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
        'role'
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
    public function activity()
    {
        $ticketIds = $this->tickets()->pluck('id');
        $period = CarbonPeriod::create(Carbon::now()->subDays(2), Carbon::now());

        $activities = Activity::whereBetween('created_at', [$period->getStartDate(), $period->getEndDate()])
                ->whereIn('ticket_id', $ticketIds)
                ->orderBy('created_at', 'desc')
                ->get();

        $userActivity = [];
        foreach ($period as $date) {
            $activity = [$date->format('D-d, M') => $activities->whereBetween('created_at', [$date->format('Y-m-d') . ' 00:00:00', $date->format('Y-m-d') .' 23:59:59'])];
            $userActivity = $activity + $userActivity;
        }

        return $userActivity;
    }
}
