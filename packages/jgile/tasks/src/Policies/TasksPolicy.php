<?php

namespace Jgile\Tasks\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Jgile\Tasks\Models\Tasks;

class TasksPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can list the Tasks.
     *
     * @param  \App\User  $user
     *
     * @return mixed
     */
    public function list(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the Tasks.
     *
     * @param  \App\User  $user
     * @param  \Jgile\Tasks\Models\Tasks  $tasks
     *
     * @return mixed
     */
    public function view(User $user, Tasks $tasks)
    {
        return true;
    }

    /**
     * Determine whether the user can create Tasks.
     *
     * @param  \App\User  $user
     *
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the Tasks.
     *
     * @param  \App\User  $user
     * @param  \Jgile\Tasks\Models\Tasks  $tasks
     *
     * @return mixed
     */
    public function update(User $user, Tasks $tasks)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the Tasks.
     *
     * @param  \App\User  $user
     * @param  \Jgile\Tasks\Models\Tasks  $tasks
     *
     * @return mixed
     */
    public function delete(User $user, Tasks $tasks)
    {
        return true;
    }
}
