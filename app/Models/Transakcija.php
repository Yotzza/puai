<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transakcija extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'zaposleni_id',
        'roba_id',
        'kolicina',
        'datum',
        'tip',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'datum' => 'date',
    ];

    public function zaposleni()
    {
        return $this->belongsTo(
            Zaposleni::class,
            'zaposleni_id',
            'zaposleni_id'
        );
    }

    public function roba()
    {
        return $this->belongsTo(Roba::class, 'roba_id', 'roba_id');
    }
}
