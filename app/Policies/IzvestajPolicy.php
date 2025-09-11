<?php

namespace App\Policies;

use App\Models\Izvestaj;
use App\Models\Zaposleni;
use Illuminate\Auth\Access\HandlesAuthorization;

class IzvestajPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the izvestaj can view any models.
     */
    public function viewAny(Zaposleni $zaposleni): bool
    {
        return true;
    }

    /**
     * Determine whether the izvestaj can view the model.
     */
    public function view(Zaposleni $zaposleni, Izvestaj $model): bool
    {
        return true;
    }

    /**
     * Determine whether the izvestaj can create models.
     */
    public function create(Zaposleni $zaposleni): bool
    {
        return true;
    }

    /**
     * Determine whether the izvestaj can update the model.
     */
    public function update(Zaposleni $zaposleni, Izvestaj $model): bool
    {
        return true;
    }

    /**
     * Determine whether the izvestaj can delete the model.
     */
    public function delete(Zaposleni $zaposleni, Izvestaj $model): bool
    {
        return true;
    }

    /**
     * Determine whether the zaposleni can delete multiple instances of the model.
     */
    public function deleteAny(Zaposleni $zaposleni): bool
    {
        return true;
    }

    /**
     * Determine whether the izvestaj can restore the model.
     */
    public function restore(Zaposleni $zaposleni, Izvestaj $model): bool
    {
        return false;
    }

    /**
     * Determine whether the izvestaj can permanently delete the model.
     */
    public function forceDelete(Zaposleni $zaposleni, Izvestaj $model): bool
    {
        return false;
    }
}
