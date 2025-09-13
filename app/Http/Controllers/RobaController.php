<?php

namespace App\Http\Controllers;

use App\Http\Requests\RobaStoreRequest;
use App\Http\Requests\RobaUpdateRequest;
use App\Models\Roba;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RobaController extends Controller
{
    public function index(Request $request): View
    {
        $robas = Roba::all();

        return view('roba.index', [
            'robas' => $robas,
        ]);
    }

    public function create(Request $request): View
    {
        return view('roba.create');
    }

    public function store(RobaStoreRequest $request): RedirectResponse
    {
        $roba = Roba::create($request->validated());

        $request->session()->flash('roba.id', $roba->id);

        return redirect()->route('robas.index');
    }

    public function show(Request $request, Roba $roba): View
    {
        return view('roba.show', [
            'roba' => $roba,
        ]);
    }

    public function edit(Request $request, Roba $roba): View
    {
        return view('roba.edit', [
            'roba' => $roba,
        ]);
    }

    public function update(RobaUpdateRequest $request, Roba $roba): RedirectResponse
    {
        $roba->update($request->validated());

        $request->session()->flash('roba.id', $roba->id);

        return redirect()->route('robas.index');
    }

    public function destroy(Request $request, Roba $roba): RedirectResponse
    {
        $roba->delete();

        return redirect()->route('robas.index');
    }
}
