<?php

namespace App\Policies;

use App\Models\Petani;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PetaniPolicy
{
    use HandlesAuthorization;

    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Petani $petani): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, Petani $petani): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, Petani $petani): bool
    {
        return $user->isAdmin();
    }
}
