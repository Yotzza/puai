<?php

namespace App\Policies;

use App\Models\Roba;
use App\Models\Zaposleni;
use Illuminate\Auth\Access\HandlesAuthorization;

class RobaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the roba can view any models.
     */
    public function viewAny(Zaposleni $zaposleni): bool
    {
        return true;
    }

    /**
     * Determine whether the roba can view the model.
     */
    public function view(Zaposleni $zaposleni, Roba $model): bool
    {
        return true;
    }

    /**
     * Determine whether the roba can create models.
     */
    public function create(Zaposleni $zaposleni): bool
    {
        return true;
    }

    /**
     * Determine whether the roba can update the model.
     */
    public function update(Zaposleni $zaposleni, Roba $model): bool
    {
        return true;
    }

    /**
     * Determine whether the roba can delete the model.
     */
    public function delete(Zaposleni $zaposleni, Roba $model): bool
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
     * Determine whether the roba can restore the model.
     */
    public function restore(Zaposleni $zaposleni, Roba $model): bool
    {
        return false;
    }

    /**
     * Determine whether the roba can permanently delete the model.
     */
    public function forceDelete(Zaposleni $zaposleni, Roba $model): bool
    {
        return false;
    }
}
