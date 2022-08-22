<?php

namespace App\Models;

use App\Enum\CharacterClassEnum;

class SignupModel implements \JsonSerializable
{
    private EventOccurrence $occurrence;

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

    public static function fromCharacters($characters, ?EventOccurrence $occurrence = null)
    {
        $ret = [];

        foreach ($characters as $character) {
            $character = self::fromCharacter($character);

            if($occurrence)
                $character->setOccurrence($occurrence);

            $ret[] = $character;
        }

        return $ret;
    }

    private function getCharacterModel()
    {
        return Character::query()->where("id","=",$this->character_id)->get()->first();
    }

    private function getPosition()
    {
        if(!isset($this->occurrence))
            return null;
    }

    private function getWarnings()
    {
        $warnings = [];

        if(!isset($this->occurrence)) {
            return $warnings;
        }

        $character = $this->getCharacterModel();
        $occupied_characters = $character->user->getCharactersOccupied($this->occurrence,$this->character_id);

        foreach ($occupied_characters as $occupied_character) {
            $warnings[] = "{$occupied_character->in_game_name} is already in an event at this time.";
        }

        return $warnings;
    }

    public function jsonSerialize(): mixed
    {
        return [
           "character_name" => $this->character_name,
           "character_id" => $this->character_id,
           "class" => $this->class->toFriendly(),
           "item_level" => $this->item_level,
           "position" => $this->getPosition(),
           "warnings" => $this->getWarnings(),
           "class_icon" => file_get_contents(public_path("images/class-icons/{$this->class->value}.svg"))
        ];
    }

    /**
     * @param \App\Models\EventOccurrence $occurrence
     * @return SignupModel
     */
    public function setOccurrence(EventOccurrence $occurrence): SignupModel
    {
        $this->occurrence = $occurrence;

        return $this;
    }
}
