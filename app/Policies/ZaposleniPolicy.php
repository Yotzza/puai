<?php

namespace App\Policies;

use App\Models\Zaposleni;
use Illuminate\Auth\Access\HandlesAuthorization;

class ZaposleniPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the zaposleni can view any models.
     */
    public function viewAny(Zaposleni $zaposleni): bool
    {
        return $zaposleni->isSuperAdmin();
    }

    /**
     * Determine whether the zaposleni can view the model.
     */
    public function view(Zaposleni $zaposleni, Zaposleni $model): bool
    {
        return $zaposleni->isSuperAdmin();
    }

    /**
     * Determine whether the zaposleni can create models.
     */
    public function create(Zaposleni $zaposleni): bool
    {
        return $zaposleni->isSuperAdmin();
    }

    /**
     * Determine whether the zaposleni can update the model.
     */
    public function update(Zaposleni $zaposleni, Zaposleni $model): bool
    {
        return $zaposleni->isSuperAdmin();
    }

    /**
     * Determine whether the zaposleni can delete the model.
     */
    public function delete(Zaposleni $zaposleni, Zaposleni $model): bool
    {
        return $zaposleni->isSuperAdmin();
    }

    /**
     * Determine whether the zaposleni can delete multiple instances of the model.
     */
    public function deleteAny(Zaposleni $zaposleni): bool
    {
        return $zaposleni->isSuperAdmin();
    }

    /**
     * Determine whether the zaposleni can restore the model.
     */
    public function restore(Zaposleni $zaposleni, Zaposleni $model): bool
    {
        return false;
    }

    /**
     * Determine whether the zaposleni can permanently delete the model.
     */
    public function forceDelete(Zaposleni $zaposleni, Zaposleni $model): bool
    {
        return false;
    }
}
