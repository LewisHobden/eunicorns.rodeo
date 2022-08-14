<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Discord\Profile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'discord_user_id',
        'discord_tokens',
        'discord_permissions',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function characters()
    {
        return $this->hasMany(Character::class);
    }

    public function getProfileAttribute() : Profile
    {
        return Profile::fromJson(json_decode($this->discord_profile,true));
    }

    public function isSignedUp(EventOccurrence $occurrence) : bool
    {
        return $this->signups()->where("event_occurrence_id","=",$occurrence->id)->get()->count() !== 0;
    }

    public function signups()
    {
        return $this->hasMany(EventSignup::class);
    }

}
