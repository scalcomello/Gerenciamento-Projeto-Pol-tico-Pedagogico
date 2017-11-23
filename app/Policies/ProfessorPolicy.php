<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;


class AdminPolicy
{
    use HandlesAuthorization;

    public function isprofessor(User $user ){

        return $user->perfil == 3;
    }
}
