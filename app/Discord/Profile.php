<?php

namespace App\Discord;

class Profile implements \JsonSerializable
{
    public string $display_name;
    public string $avatar;

    public static function createFromDiscordResponse(array $response) : Profile
    {
        $me = new self();

        $me->display_name = $response['nick'] ?? $response['user']['username'];
        $me->avatar = $response['avatar'] ?? $response['user']['avatar'];

        return $me;
    }

    public static function fromJson(array $deserialised) : Profile
    {
        $me = new self();

        $me->avatar = $deserialised['avatar'];
        $me->display_name = $deserialised['display_name'];

        return $me;
    }

    public function jsonSerialize() : mixed
    {
        return [
            "avatar" => $this->avatar,
            "display_name" => $this->display_name,
        ];
    }
}
