<?php

namespace App\Http\Controllers\Api;

use App\Models\Zaposleni;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\IzvestajResource;
use App\Http\Resources\IzvestajCollection;

class ZaposleniIzvestajsController extends Controller
{
    public function index(
        Request $request,
        Zaposleni $zaposleni
    ): IzvestajCollection {
        $this->authorize('view', $zaposleni);

        $search = $request->get('search', '');

        $izvestajs = $zaposleni
            ->izvestajs()
            ->search($search)
            ->latest()
            ->paginate();

        return new IzvestajCollection($izvestajs);
    }

    public function store(
        Request $request,
        Zaposleni $zaposleni
    ): IzvestajResource {
        $this->authorize('create', Izvestaj::class);

        $validated = $request->validate([
            'opis' => ['required', 'max:255', 'string'],
            'datum' => ['required', 'date'],
            'tip' => ['required', 'max:255', 'string'],
        ]);

        $izvestaj = $zaposleni->izvestajs()->create($validated);

        return new IzvestajResource($izvestaj);
    }
}
