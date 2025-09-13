<?php

namespace App\Http\Controllers;

use App\Http\Requests\ZaposleniStoreRequest;
use App\Http\Requests\ZaposleniUpdateRequest;
use App\Models\Zaposleni;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ZaposleniController extends Controller
{
    public function index(Request $request): View
    {
        $zaposlenis = Zaposleni::all();

        return view('zaposleni.index', [
            'zaposlenis' => $zaposlenis,
        ]);
    }

    public function create(Request $request): View
    {
        return view('zaposleni.create');
    }

    public function store(ZaposleniStoreRequest $request): RedirectResponse
    {
        $zaposleni = Zaposleni::create($request->validated());

        $request->session()->flash('zaposleni.id', $zaposleni->id);

        return redirect()->route('zaposlenis.index');
    }

    public function show(Request $request, Zaposleni $zaposleni): View
    {
        return view('zaposleni.show', [
            'zaposleni' => $zaposleni,
        ]);
    }

    public function edit(Request $request, Zaposleni $zaposleni): View
    {
        return view('zaposleni.edit', [
            'zaposleni' => $zaposleni,
        ]);
    }

    public function update(ZaposleniUpdateRequest $request, Zaposleni $zaposleni): RedirectResponse
    {
        $zaposleni->update($request->validated());

        $request->session()->flash('zaposleni.id', $zaposleni->id);

        return redirect()->route('zaposlenis.index');
    }

    public function destroy(Request $request, Zaposleni $zaposleni): RedirectResponse
    {
        $zaposleni->delete();

        return redirect()->route('zaposlenis.index');
    }
}
