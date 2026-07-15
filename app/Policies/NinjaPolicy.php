<?php

namespace App\Policies;

use App\Models\Ninja;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NinjaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    // Default policy 1
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    // Default policy 2
    public function view(User $user, Ninja $ninja): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    // Default policy 3
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Ninja $ninja): bool
    {
        // My policy - Update only if the user is the owner of the Ninja model
            // 2. Object: $user
            // 3. Method: hasRole()
            // 4. Argument: 'editor'
            // 5. Logical OR: || is owner of the Ninja post
        return $user->hasRole('editor') || $user->id === $ninja->user_id;
        //return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Ninja $ninja): bool
    {
        // My policy - Delete only if the user is the owner of the Ninja model
        return $user->hasRole('editor') || $user->id === $ninja->user_id;
        //return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Ninja $ninja): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Ninja $ninja): bool
    {
        return false;
    }
}
