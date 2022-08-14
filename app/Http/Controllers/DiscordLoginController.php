<?php

namespace App\Http\Controllers;

use App\Discord\Profile;
use App\Enum\DiscordPermissionEnum;
use App\Models\User;
use App\Repository\Interfaces\UserRepositoryInterface;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\OAuth2\Client\Token\AccessToken;
use Wohali\OAuth2\Client\Provider\Discord;

class DiscordLoginController extends Controller
{
    private Discord                 $provider;
    private UserRepositoryInterface $user_repository;

    /**
     * DiscordLoginController constructor.
     * @param  Discord  $provider
     * @param  UserRepositoryInterface  $repository
     */
    public function __construct(Discord $provider,UserRepositoryInterface $repository)
    {
        $this->provider = $provider;
        $this->user_repository = $repository;
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            "code" => "required|string",
            "state" => "required|string"
        ]);

        if($request->query("state") !== $request->session()->get("oauthToken"))
            return abort(403,"State has changed.");

        $this->attemptLogin($request);

        return redirect("/");
    }

    public function attemptLogin(Request $request) : bool
    {
        // Authenticate with OAuth2.
        $access_token = $this->provider->getAccessToken("authorization_code",["code" => $request->query("code")]);

        /** @var \Wohali\OAuth2\Client\Provider\DiscordResourceOwner $resource_owner */
        $resource_owner = $this->provider->getResourceOwner($access_token);

        // Log in or create the user from Discord.
        $user = $this->user_repository->findFromDiscordUser($resource_owner);

        if(null === $user)
            $user = $this->registerUser($resource_owner,$access_token);

        // Write permissions to the session.
        $permission_controller = new GuildPermissionController($this->provider,new Client());
        $permission_controller->setUser($user,$access_token);
        $permission_controller->cachePrivileges();

        Auth::login($user, true);

        return true;
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->intended("/");
    }

    private function registerUser(\Wohali\OAuth2\Client\Provider\DiscordResourceOwner $resource_owner,AccessToken $token) : User
    {
        $guild_id = env("DISCORD_GUILD_ID");
        $client = new Client();

        // Check if the user is in the guild.
        $guilds_request = $this->provider->getAuthenticatedRequest
        (
            "GET",
            "https://discord.com/api/v10/users/@me/guilds",
            $token
        );
        $guilds_request = $client->sendRequest($guilds_request);

        $permissions = null;
        $my_guilds = json_decode((string)$guilds_request->getBody(),true);

        foreach($my_guilds as $guild)
        {
            if($guild['id'] === $guild_id)
                $permissions = $guild['permissions'];
        }

        if(null === $permissions)
            abort(403,"You are not in the guild.");
        elseif(!((int)$permissions & DiscordPermissionEnum::MANAGE_WEBHOOKS->value))
            abort(403,"This site is in beta - admin only for now.");

        $request = $this->provider->getAuthenticatedRequest
        (
            "GET",
            "https://discord.com/api/v10/users/@me/guilds/{$guild_id}/member",
            $token
        );

        sleep(4);
        $profile_request = $client->sendRequest($request);

        $my_profile = json_decode((string)$profile_request->getBody(),true);
        $my_profile = Profile::createFromDiscordResponse($my_profile);

        return $this->user_repository->createFromDiscordUser($permissions,$resource_owner,$my_profile,$token);
    }
}
