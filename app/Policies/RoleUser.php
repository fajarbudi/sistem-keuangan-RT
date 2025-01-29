<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class RoleUser
{
    public function admin(User $user): bool
    {
        return $user->user_role === 'superAdmin' || $user->user_role === 'ketua';
    }

    public function warga(User $user): bool
    {
        return $user->user_role === 'warga';
    }
}
