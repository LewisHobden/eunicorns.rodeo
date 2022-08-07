<?php

namespace App\Repository\Interfaces;

use App\Models\User;
use League\OAuth2\Client\Token\AccessToken;
use Wohali\OAuth2\Client\Provider\DiscordResourceOwner;

interface UserRepositoryInterface
{
    public function createFromDiscordUser(int $permissions,DiscordResourceOwner $resource_owner,\App\Discord\Profile $my_profile,AccessToken $token);

    public function findFromDiscordUser(DiscordResourceOwner $discord) : ?User;
}
