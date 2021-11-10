<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketApproval extends Model
{
    use HasFactory;

    protected $fillable = ['owner_id', 'ticket_id', 'approved', 'approved_at'];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function approve(): void
    {
        $this->update([
            'approved' => true,
            'approved_at' => Carbon::now()
        ]);
    }

    public function approved(): bool
    {
        return $this->approved == true;
    }
}
