<?php

namespace App\Http\Controllers\Api;

use App\Models\Zaposleni;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransakcijaResource;
use App\Http\Resources\TransakcijaCollection;

class ZaposleniTransakcijasController extends Controller
{
    public function index(
        Request $request,
        Zaposleni $zaposleni
    ): TransakcijaCollection {
        $this->authorize('view', $zaposleni);

        $search = $request->get('search', '');

        $transakcijas = $zaposleni
            ->transakcijas()
            ->search($search)
            ->latest()
            ->paginate();

        return new TransakcijaCollection($transakcijas);
    }

    public function store(
        Request $request,
        Zaposleni $zaposleni
    ): TransakcijaResource {
        $this->authorize('create', Transakcija::class);

        $validated = $request->validate([
            'roba_id' => ['required', 'exists:robas,roba_id'],
            'kolicina' => ['required', 'numeric'],
            'datum' => ['required', 'date'],
            'tip' => ['required', 'max:255', 'string'],
        ]);

        $transakcija = $zaposleni->transakcijas()->create($validated);

        return new TransakcijaResource($transakcija);
    }
}
