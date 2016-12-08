<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TopicPolicy
{
    use HandlesAuthorization;

    public function create() {
        return json_decode(auth()->user()->group->permissions)->topic->create;
    }
}
