<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(User $user)
    {
        return $user->can_create == 1;
    }

    /*public function update(User $user)
    {
        return $user->can_create == 1;
    }

    public function delete(User $user)
    {
        return $user->can_create == 1;
    }*/
}
