<?php

namespace App\Http\Controllers;

use App\Models\Roba;
use Illuminate\View\View;
use App\Models\Zaposleni;
use App\Models\Transakcija;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TransakcijaStoreRequest;
use App\Http\Requests\TransakcijaUpdateRequest;

class TransakcijaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Transakcija::class);

        $search = $request->get('search', '');

        $transakcijas = Transakcija::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.transakcijas.index',
            compact('transakcijas', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Transakcija::class);

        $zaposlenis = Zaposleni::pluck('ime', 'zaposleni_id');
        $robas = Roba::pluck('naziv', 'roba_id');

        return view('app.transakcijas.create', compact('zaposlenis', 'robas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransakcijaStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Transakcija::class);

        $validated = $request->validated();

        $transakcija = Transakcija::create($validated);

        return redirect()
            ->route('transakcijas.edit', $transakcija)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Transakcija $transakcija): View
    {
        $this->authorize('view', $transakcija);

        return view('app.transakcijas.show', compact('transakcija'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Transakcija $transakcija): View
    {
        $this->authorize('update', $transakcija);

        $zaposlenis = Zaposleni::pluck('ime', 'zaposleni_id');
        $robas = Roba::pluck('naziv', 'roba_id');

        return view(
            'app.transakcijas.edit',
            compact('transakcija', 'zaposlenis', 'robas')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        TransakcijaUpdateRequest $request,
        Transakcija $transakcija
    ): RedirectResponse {
        $this->authorize('update', $transakcija);

        $validated = $request->validated();

        $transakcija->update($validated);

        return redirect()
            ->route('transakcijas.edit', $transakcija)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Transakcija $transakcija
    ): RedirectResponse {
        $this->authorize('delete', $transakcija);

        $transakcija->delete();

        return redirect()
            ->route('transakcijas.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
