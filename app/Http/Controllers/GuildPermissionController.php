<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use League\OAuth2\Client\Token\AccessTokenInterface;
use Wohali\OAuth2\Client\Provider\Discord;

class GuildPermissionController extends Controller
{
    const API_BASE_URL = 'https://discordapp.com/api/v6/';
    const PERMISSION_ENDPOINT = "users/@me/guilds";

    private Client $client;
    private AccessTokenInterface $access_token;
    private Discord $provider;

    private User $user;

    public function __construct(Discord $provider,Client $client)
    {
        $this->client = $client;
        $this->provider = $provider;
    }

    /**
     * Loads server privileges from Discord and loads them into the database as a cache.
     */
    public function cachePrivileges()
    {
        $endpoint = self::API_BASE_URL . self::PERMISSION_ENDPOINT;
        $request = $this->provider->getAuthenticatedRequest("GET",$endpoint,$this->access_token);

        $response = $this->client->send($request);
        $guilds = json_decode((string)$response->getBody());

        foreach($guilds as $guild) {
            if($guild->id === env("DISCORD_GUILD_ID")) {
                session(["guild_permissions" => $guild->permissions]);

                return null;
            }
        }

        return abort(401);
    }

    /**
     * @param User $user
     * @param \League\OAuth2\Client\Token\AccessTokenInterface $access_token
     * @return $this
     */
    public function setUser(User $user,AccessTokenInterface $access_token): self
    {
        $this->user = $user;
        $this->access_token = $access_token;

        return $this;
    }
}
