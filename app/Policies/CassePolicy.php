<?php

namespace App\Policies;

use App\User;
use App\Casse;
use Illuminate\Auth\Access\HandlesAuthorization;

class CassePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function annuler(User $user, Casse $casse)
    {
        return $casse->statut == 'cassé';
    }
}
