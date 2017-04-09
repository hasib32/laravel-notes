<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Policy Filter
     *
     * @param $user
     * @param $ability
     * @return bool
     */
    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the user.
     *
     * @param  \App\Models\User  $currentUser
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function show(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }

    /**
     * Determine whether the user can update the user.
     *
     * @param  \App\Models\User  $currentUser
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param  \App\Models\User  $currentUser
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function delete(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }
}
