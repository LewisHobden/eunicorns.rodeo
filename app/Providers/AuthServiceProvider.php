<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Enum\DiscordPermissionEnum;
use App\Models\Character;
use App\Models\User;
use App\Repository\Interfaces\UserRepositoryInterface;
use App\Repository\UserRepository;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    public $bindings = [
        UserRepositoryInterface::class => UserRepository::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update-character', function (User $user, Character $character) {
            return $user->id === $character->user_id;
        });

        Gate::define('manage-discord', function (User $user) {
            $perms = $user->discord_permissions;

            return (bool)($perms & DiscordPermissionEnum::MANAGE_WEBHOOKS->value);
        });

        $this->app->bind(UserRepository::class,function($app) {
            return new UserRepository(new User());
        });
    }
}
