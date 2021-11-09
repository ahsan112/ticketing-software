<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class TicketTask extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'target_date', 'owner_id', 'completed', 'completed_at'];

    protected $casts = [
        'target_date' => 'date',
        'completed_at' => 'date'
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function completed(): bool
    {
        return $this->completed == true;
    }

    public function complete(): void
    {
        $this->update([
            'completed' => true, 
            'completed_at' => Carbon::now()
        ]);
    }
}
