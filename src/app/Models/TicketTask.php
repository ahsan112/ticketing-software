<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class TicketTask extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'target_date', 'owner_id'];

    protected $casts = [
        'target_date' => 'date'
    ];

    public function owner()
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
}
