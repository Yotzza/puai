<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Roba extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['naziv', 'sifra', 'opis', 'kolicina', 'lokacija'];

    protected $searchableFields = ['*'];

    public function transakcijas()
    {
        return $this->hasMany(Transakcija::class, 'roba_id', 'roba_id');
    }
}
