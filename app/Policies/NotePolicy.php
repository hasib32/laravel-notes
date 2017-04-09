<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Note;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotePolicy
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
     * Determine whether the user can view the note.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Note  $note
     * @return mixed
     */
    public function show(User $user, Note $note)
    {
        return $user->id === $note->userId;
    }

    /**
     * Determine whether the user can update the note.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Note  $note
     * @return mixed
     */
    public function update(User $user, Note $note)
    {
        return $user->id === $note->userId;
    }

    /**
     * Determine whether the user can delete the note.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Note  $note
     * @return mixed
     */
    public function delete(User $user, Note $note)
    {
        return $user->id === $note->userId;
    }
}
