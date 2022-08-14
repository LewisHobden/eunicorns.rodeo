<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSignup extends Model
{
    use HasFactory;

    public function eventOccurrence()
    {
        return $this->belongsTo("event_occurrence");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
