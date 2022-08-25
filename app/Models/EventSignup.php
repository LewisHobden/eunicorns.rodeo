<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSignup extends Model
{
    use HasFactory;

    public function occurrence()
    {
        return $this->belongsTo(EventOccurrence::class, 'event_occurrence_id');
    }

    public function eligibleCharacters(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->user->characters->where(
                'item_level',
                '>=',
                $this->occurrence->event->item_level
            )
            ->sortByDesc('item_level')
        );
    }

    public function otherSignups(): Attribute
    {
        if(null === $this->occurrence)
            return Attribute::make(get: fn() => null);

        $occurrences = EventOccurrence::query()
            ->select(['id'])
            ->where('event_id', '=', $this->occurrence->event_id)
            ->where('id', '!=', $this->occurrence->id)
            ->get()
            ->map(fn(EventOccurrence $occurrence) => $occurrence->id);

        return Attribute::make(get: fn() => $this->user->signups->whereIn('event_occurrence_id', $occurrences));
    }

    public function otherSignupDates()
    {
        return $this->other_signups->map(
            fn(EventSignup $signup) => $signup->occurrence->scheduled_datetime->format("l jS \a\\t H:i")
        )
            ->toArray();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
