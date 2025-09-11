<?php

namespace App\Http\Controllers;

use App\Models\Izvestaj;
use Illuminate\View\View;
use App\Models\Zaposleni;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\IzvestajStoreRequest;
use App\Http\Requests\IzvestajUpdateRequest;

class IzvestajController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Izvestaj::class);

        $search = $request->get('search', '');

        $izvestajs = Izvestaj::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.izvestajs.index', compact('izvestajs', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Izvestaj::class);

        $zaposlenis = Zaposleni::pluck('ime', 'zaposleni_id');

        return view('app.izvestajs.create', compact('zaposlenis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IzvestajStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Izvestaj::class);

        $validated = $request->validated();

        $izvestaj = Izvestaj::create($validated);

        return redirect()
            ->route('izvestajs.edit', $izvestaj)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Izvestaj $izvestaj): View
    {
        $this->authorize('view', $izvestaj);

        return view('app.izvestajs.show', compact('izvestaj'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Izvestaj $izvestaj): View
    {
        $this->authorize('update', $izvestaj);

        $zaposlenis = Zaposleni::pluck('ime', 'zaposleni_id');

        return view('app.izvestajs.edit', compact('izvestaj', 'zaposlenis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        IzvestajUpdateRequest $request,
        Izvestaj $izvestaj
    ): RedirectResponse {
        $this->authorize('update', $izvestaj);

        $validated = $request->validated();

        $izvestaj->update($validated);

        return redirect()
            ->route('izvestajs.edit', $izvestaj)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Izvestaj $izvestaj
    ): RedirectResponse {
        $this->authorize('delete', $izvestaj);

        $izvestaj->delete();

        return redirect()
            ->route('izvestajs.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
