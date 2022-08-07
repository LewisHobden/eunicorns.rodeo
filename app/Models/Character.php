<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    public $fillable = [
        "user_id",
        "in_game_name",
        "class",
        "item_level",
    ];

    public static function fromRequest(\App\Http\Requests\StoreCharacterRequest $request) : Character
    {
        $new = new self();

        $new->fill([
            "user_id"      => $request->user()->id,
            "in_game_name" => $request->get("in_game_name"),
            "class"        => $request->get("class"),
            "item_level"   => $request->get("item_level"),
        ]);

        $new->save();

        return $new;
    }
}