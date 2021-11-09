<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'ticket_type_id', 'status_id', 'priority_id', 'updated_by_id', 'target_date', 'owner_id', 'department_id', 'accepted'];
    
    public function scopeWithOutRejected(Builder $query): Builder
    {
        return $query->where('accepted', true)
                    ->orWhere('accepted', NULL);
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
}
