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

    public function charactersNotInEvent(EventOccurrence $occurrence)
    {
        $groups = EventGroup::query()->select(['id'])->where("event_occurrence_id", "=", $occurrence->id);
        $members = EventGroupMember::query()->select(['character_id'])->whereIn("event_group_id", $groups);

        return Character::query()
            ->where("user_id", "=", $this->id)
            ->whereNotIn('id', $members)
            ->get();
    }

    public function getOccupiedCharacter(EventOccurrence $occurrence, ?string $ignore_character_id = null)
    {
        $occurrences = EventOccurrence::select(['id'])->where('scheduled_datetime','=',$occurrence->scheduled_datetime);
        $groups = EventGroup::select(['id'])->whereIn('event_occurrence_id',$occurrences);
        $members = EventGroupMember::select(['character_id'])->whereIn('event_group_id',$groups);

        $q = Character::query()->where("user_id", "=", $this->id);

        if($ignore_character_id)
            $q->whereNot("id","=",$ignore_character_id);

        return $q->whereIn('id', $members)->get()->first();
    }

    public function isOccupied(EventOccurrence $occurrence)
    {
        $occurrences = EventOccurrence::select(['id'])->where('scheduled_datetime','=',$occurrence->scheduled_datetime);
        $groups = EventGroup::select(['id'])->whereIn('event_occurrence_id',$occurrences);
        $members = EventGroupMember::select(['character_id'])->whereIn('event_group_id',$groups);

        $q = Character::query()->where("user_id", "=", $this->id);

        return $q->whereIn('id', $members)->exists();
    }

    public function getProfileAttribute(): Profile
    {
        return Profile::fromJson(json_decode($this->discord_profile, true));
    }

    public function isSignedUp(EventOccurrence $occurrence): bool
    {
        return $this->signups()->where("event_occurrence_id", "=", $occurrence->id)->get()->count() !== 0;
    }

    public function signups()
    {
        return $this->hasMany(EventSignup::class);
    }

}
