<?php

namespace App\Policies;

use App\User;
use App\Pourcentage;

use Illuminate\Auth\Access\HandlesAuthorization;

class PourcentagePolicy
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

    public function desactiver(User $user, Pourcentage $pourcentage)
    {
        return $pourcentage->statut == 'activé';
    }

    public function activer(User $user, Pourcentage $pourcentage)
    {
        return $pourcentage->statut == 'desactivé';
    }
}
