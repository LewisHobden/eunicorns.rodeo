<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
      "player_limit",
      "scheduled_date",
      "event_title",
      "is_signup_open",
      "item_level",
    ];

    protected $casts = [
        "scheduled_date" => "date"
    ];
}
