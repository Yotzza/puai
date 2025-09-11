<?php

namespace App\Http\Controllers;

use App\Models\Roba;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\RobaStoreRequest;
use App\Http\Requests\RobaUpdateRequest;

class RobaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Roba::class);

        $search = $request->get('search', '');

        $robas = Roba::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.robas.index', compact('robas', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Roba::class);

        return view('app.robas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RobaStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Roba::class);

        $validated = $request->validated();

        $roba = Roba::create($validated);

        return redirect()
            ->route('robas.edit', $roba)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Roba $roba): View
    {
        $this->authorize('view', $roba);

        return view('app.robas.show', compact('roba'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Roba $roba): View
    {
        $this->authorize('update', $roba);

        return view('app.robas.edit', compact('roba'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        RobaUpdateRequest $request,
        Roba $roba
    ): RedirectResponse {
        $this->authorize('update', $roba);

        $validated = $request->validated();

        $roba->update($validated);

        return redirect()
            ->route('robas.edit', $roba)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Roba $roba): RedirectResponse
    {
        $this->authorize('delete', $roba);

        $roba->delete();

        return redirect()
            ->route('robas.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
