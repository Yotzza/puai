<?php

namespace App\Policies;

use App\Models\Zaposleni;
use App\Models\Transakcija;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransakcijaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the transakcija can view any models.
     */
    public function viewAny(Zaposleni $zaposleni): bool
    {
        return true;
    }

    /**
     * Determine whether the transakcija can view the model.
     */
    public function view(Zaposleni $zaposleni, Transakcija $model): bool
    {
        return true;
    }

    /**
     * Determine whether the transakcija can create models.
     */
    public function create(Zaposleni $zaposleni): bool
    {
        return true;
    }

    /**
     * Determine whether the transakcija can update the model.
     */
    public function update(Zaposleni $zaposleni, Transakcija $model): bool
    {
        return true;
    }

    /**
     * Determine whether the transakcija can delete the model.
     */
    public function delete(Zaposleni $zaposleni, Transakcija $model): bool
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
     * Determine whether the transakcija can restore the model.
     */
    public function restore(Zaposleni $zaposleni, Transakcija $model): bool
    {
        return false;
    }

    /**
     * Determine whether the transakcija can permanently delete the model.
     */
    public function forceDelete(Zaposleni $zaposleni, Transakcija $model): bool
    {
        return false;
    }
}
