<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventOccurrence extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $casts = [
        'scheduled_datetime' => 'datetime'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function signups()
    {
        return $this->hasMany(EventSignup::class);
    }
}
