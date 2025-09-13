<?php

namespace App\Http\Controllers;

use App\Http\Requests\PocetnaStoreRequest;
use App\Http\Requests\PocetnaUpdateRequest;
use App\Models\Pocetna;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PocetnaController extends Controller
{
    public function index(Request $request): View
    {
        $pocetnas = Pocetna::all();

        return view('pocetna.index', [
            'pocetnas' => $pocetnas,
        ]);
    }

    public function create(Request $request): View
    {
        return view('pocetna.create');
    }

    public function store(PocetnaStoreRequest $request): RedirectResponse
    {
        $pocetna = Pocetna::create($request->validated());

        $request->session()->flash('pocetna.id', $pocetna->id);

        return redirect()->route('pocetnas.index');
    }

    public function show(Request $request, Pocetna $pocetna): View
    {
        return view('pocetna.show', [
            'pocetna' => $pocetna,
        ]);
    }

    public function edit(Request $request, Pocetna $pocetna): View
    {
        return view('pocetna.edit', [
            'pocetna' => $pocetna,
        ]);
    }

    public function update(PocetnaUpdateRequest $request, Pocetna $pocetna): RedirectResponse
    {
        $pocetna->update($request->validated());

        $request->session()->flash('pocetna.id', $pocetna->id);

        return redirect()->route('pocetnas.index');
    }

    public function destroy(Request $request, Pocetna $pocetna): RedirectResponse
    {
        $pocetna->delete();

        return redirect()->route('pocetnas.index');
    }
}
