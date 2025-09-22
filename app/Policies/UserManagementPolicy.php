<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserManagementPolicy
{
    /**
     * Determine if the user can manage users (super only).
     */
    public function manageUsers(User $user): bool
    {
    Log::info('Policy check: manageUsers', ['email' => $user->email, 'role' => $user->role]);
        return $user->role === 'super';
    }
}
