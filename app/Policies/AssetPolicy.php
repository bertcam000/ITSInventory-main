<?php

namespace App\Policies;

use App\Models\Asset;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AssetPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function view(User $user, Asset $asset)
    {
        return $user->role === 'staff' || $user->role === 'admin';
    }

    // Can the user delete an asset?
    public function delete(User $user, Asset $asset)
    {
        return $user->role === 'admin'; 
    }

    // Can the user assign the asset?
    public function assign(User $user, Asset $asset)
    {
        return $user->role === 'staff' || $user->role === 'admin';
    }
}
