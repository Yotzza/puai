<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Izvestaj extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['zaposleni_id', 'opis', 'datum', 'tip'];

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
}
