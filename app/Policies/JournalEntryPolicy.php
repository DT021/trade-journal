<?php

namespace App\Policies;

use App\JournalEntry;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class JournalEntryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any journal entries.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the journal entry.
     *
     * @param  \App\User  $user
     * @param  \App\JournalEntry  $journalEntry
     * @return mixed
     */
    public function view(User $user, JournalEntry $journalEntry)
    {
        //
    }

    /**
     * Determine whether the user can create journal entries.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can edit/update the journal entry.
     *
     * @param  \App\User  $user
     * @param  \App\JournalEntry  $journalEntry
     * @return mixed
     */
    public function update(User $user, JournalEntry $journalEntry)
    {
        return $user->id === $journalEntry->user_id;
    }

    /**
     * Determine whether the user can delete the journal entry.
     *
     * @param  \App\User  $user
     * @param  \App\JournalEntry  $journalEntry
     * @return mixed
     */
    public function delete(User $user, JournalEntry $journalEntry)
    {
        return $user->id === $journalEntry->user_id;
    }

    /**
     * Determine whether the user can restore the journal entry.
     *
     * @param  \App\User  $user
     * @param  \App\JournalEntry  $journalEntry
     * @return mixed
     */
    public function restore(User $user, JournalEntry $journalEntry)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the journal entry.
     *
     * @param  \App\User  $user
     * @param  \App\JournalEntry  $journalEntry
     * @return mixed
     */
    public function forceDelete(User $user, JournalEntry $journalEntry)
    {
        //
    }
}
