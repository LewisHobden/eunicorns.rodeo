<?php

namespace App\Repository;

use App\Models\User;
use App\Repository\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Redis;
use League\OAuth2\Client\Token\AccessToken;
use Wohali\OAuth2\Client\Provider\DiscordResourceOwner;

class UserRepository implements UserRepositoryInterface
{
    private User $user;

    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param DiscordResourceOwner $discord
     * @return \App\Models\User|null
     */
    public function findFromDiscordUser(DiscordResourceOwner $discord): ?User
    {
        return $this->user->where("discord_user_id",$discord->getId())->first();
    }

    public function createFromDiscordUser(int $permissions,DiscordResourceOwner $resource_owner,\App\Discord\Profile $my_profile,AccessToken $token)
    {
        $discord_tokens = encrypt(json_encode($token));

        $this->user->fill([
            "name" => $resource_owner->getUsername(),
            "discord_user_id" => $resource_owner->getId(),
            "discord_tokens" => $discord_tokens,
            "discord_permissions" => $permissions
        ]);

        $this->user->discord_profile = json_encode($my_profile);

        $this->user->save();

        return $this->user;
    }
}
