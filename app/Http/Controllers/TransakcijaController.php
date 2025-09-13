<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransakcijaStoreRequest;
use App\Http\Requests\TransakcijaUpdateRequest;
use App\Models\Transakcija;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TransakcijaController extends Controller
{
    public function index(Request $request): View
    {
        $transakcijas = Transakcija::all();

        return view('transakcija.index', [
            'transakcijas' => $transakcijas,
        ]);
    }

    public function create(Request $request): View
    {
        return view('transakcija.create');
    }

    public function store(TransakcijaStoreRequest $request): RedirectResponse
    {
        $transakcija = Transakcija::create($request->validated());

        $request->session()->flash('transakcija.id', $transakcija->id);

        return redirect()->route('transakcijas.index');
    }

    public function show(Request $request, Transakcija $transakcija): View
    {
        return view('transakcija.show', [
            'transakcija' => $transakcija,
        ]);
    }

    public function edit(Request $request, Transakcija $transakcija): View
    {
        return view('transakcija.edit', [
            'transakcija' => $transakcija,
        ]);
    }

    public function update(TransakcijaUpdateRequest $request, Transakcija $transakcija): RedirectResponse
    {
        $transakcija->update($request->validated());

        $request->session()->flash('transakcija.id', $transakcija->id);

        return redirect()->route('transakcijas.index');
    }

    public function destroy(Request $request, Transakcija $transakcija): RedirectResponse
    {
        $transakcija->delete();

        return redirect()->route('transakcijas.index');
    }
}
