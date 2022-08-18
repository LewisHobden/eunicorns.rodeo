<?php

namespace App\Models;

use App\Enum\CharacterClassEnum;

class SignupModel implements \JsonSerializable
{
    private string $character_name;
    private string $character_id;
    private CharacterClassEnum $class;
    private int $item_level;

    public static function fromCharacter(Character $character)
    {
        $s = new static();
        $s->character_id = $character->id;
        $s->class = $character->class;
        $s->item_level = $character->item_level;
        $s->character_name = $character->in_game_name;

        return $s;
    }

    public static function fromCharacters($characters)
    {
        $ret = [];

        foreach ($characters as $character) {
            $ret[] = self::fromCharacter($character);
        }

        return $ret;
    }


    public function jsonSerialize(): mixed
    {
        return [
           "character_name" => $this->character_name,
           "character_id" => $this->character_id,
           "class" => $this->class->toFriendly(),
           "item_level" => $this->item_level
        ];
    }
}
