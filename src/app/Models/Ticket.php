<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Ticket extends Model
{
    use HasFactory;

    public $old = [];
    
    protected $fillable = [
        'title', 
        'description', 
        'ticket_type_id', 
        'status_id', 
        'priority_id', 
        'updated_by_id', 
        'target_date', 
        'owner_id', 
        'department_id', 
        'accepted', 
        'completed', 
        'completed_at'
    ];
    
    protected $casts = [
        'target_date' => 'date'
    ];

    public function scopeWithOutRejected(Builder $query): Builder
    {
        return $query->where('accepted', true)
                    ->orWhere('accepted', NULL);
    }
    
    public function scopeWithOutCompleted(Builder $query): Builder
    {
        return $query->where('completed', NULL);
    }

    public function scopeWithCompleted(Builder $query): Builder 
    {
        return $query->where('completed', true);
    }

    public function scopeWithRejected(Builder $query): Builder 
    {
        return $query->where('accepted', 0);
    }

    public function scopeFilter(Builder $query, array $filters)
    {
        $query->when($filters['view'] == 'open', fn($query) => 
            $query->withOutRejected()->withoutCompleted()
        );

        $query->when($filters['view'] == 'completed', fn($query) => 
            $query->withCompleted()
        );

        $query->when($filters['view'] == 'rejected', fn($query) => 
            $query->withRejected()
        );

        $query->when($filters['owner_id'] ?? false, fn($query, $user) => 
            $query->where('created_by_id', $user)
        );

    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(TicketStatus::class);
    }

    public function priority(): BelongsTo
    {
        return $this->belongsTo(TicketPriority::class, 'priority_id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(TicketType::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(TicketDocument::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(TicketTask::class);
    }

    public function approvers(): HasMany
    {
        return $this->hasMany(TicketApproval::class);
    }

    public function activity(): HasMany
    {
        return $this->hasMany(Activity::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function accept(): void
    {
        $this->update(['accepted' => 1]);
    }

    public function reject(): void
    {
        $this->update(['accepted' => 0]);
    }

    public function rejected(): bool
    {
        return $this->accepted === 0;
    }

    public function approved(): bool
    {
        if ($this->approvers->isEmpty()) {
            return false;
        }

        if ($this->approvers()->whereNull('approved')->count() != 0) {
            return false;
        }

        return true;
    }

    public function complete()
    {
        $this->update([
            'completed' => true,
            'completed_at' => Carbon::now()
        ]);
    }

    public function completed(): bool
    {
        return $this->completed == true;
    }
}
