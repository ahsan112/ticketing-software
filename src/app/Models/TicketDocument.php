<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class TicketDocument extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'file', 'created_by_id'];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function activity(): MorphOne
    {
        return $this->morphOne(Activity::class, 'subject');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
