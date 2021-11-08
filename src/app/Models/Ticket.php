<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'ticket_type_id', 'status_id', 'priority_id', 'updated_by_id', 'target_date', 'owner_id'];
    
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

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
