<?php

namespace App\Http\Controllers\Api;

use App\Models\Roba;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransakcijaResource;
use App\Http\Resources\TransakcijaCollection;

class RobaTransakcijasController extends Controller
{
    public function index(Request $request, Roba $roba): TransakcijaCollection
    {
        $this->authorize('view', $roba);

        $search = $request->get('search', '');

        $transakcijas = $roba
            ->transakcijas()
            ->search($search)
            ->latest()
            ->paginate();

        return new TransakcijaCollection($transakcijas);
    }

    public function store(Request $request, Roba $roba): TransakcijaResource
    {
        $this->authorize('create', Transakcija::class);

        $validated = $request->validate([
            'zaposleni_id' => ['required', 'exists:zaposlenis,zaposleni_id'],
            'kolicina' => ['required', 'numeric'],
            'datum' => ['required', 'date'],
            'tip' => ['required', 'max:255', 'string'],
        ]);

        $transakcija = $roba->transakcijas()->create($validated);

        return new TransakcijaResource($transakcija);
    }
}
