<?php

namespace App\Models;

use App\Enum\EventTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
      "player_limit",
      "scheduled_date",
      "event_title",
      "event_type",
      "is_signup_open",
      "item_level",
    ];

    protected $casts = [
        "event_type" => EventTypeEnum::class
    ];

    public function occurrences()
    {
        return $this->hasMany(EventOccurrence::class);
    }
}
