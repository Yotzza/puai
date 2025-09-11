<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use App\Models\Scopes\Searchable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Zaposleni extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    use Searchable;
    use HasApiTokens;

    protected $fillable = ['ime', 'username', 'password'];

    protected $searchableFields = ['*'];

    protected $hidden = ['password', 'uloga'];

    public function izvestajs()
    {
        return $this->hasMany(Izvestaj::class, 'zaposleni_id', 'zaposleni_id');
    }

    public function transakcijas()
    {
        return $this->hasMany(
            Transakcija::class,
            'zaposleni_id',
            'zaposleni_id'
        );
    }

    public function isSuperAdmin(): bool
    {
        return in_array($this->email, config('auth.super_admins'));
    }
}
