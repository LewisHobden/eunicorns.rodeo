<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventGroup extends Model
{
    use HasFactory;

    public function members()
    {
        return $this->hasMany(EventGroupMember::class);
    }

    public function slots()
    {
        $ret = [];
        $slots = 8;

        foreach ($this->members as $member) {
            $ret[] = $member;

            $slots -= 1;
        }

        foreach (range(1,$slots) as $slot) {
            $ret[] = null;
        }

        return $ret;
    }
}
