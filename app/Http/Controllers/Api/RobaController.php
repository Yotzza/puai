<?php

namespace App\Http\Controllers\Api;

use App\Models\Roba;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\RobaResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\RobaCollection;
use App\Http\Requests\RobaStoreRequest;
use App\Http\Requests\RobaUpdateRequest;

class RobaController extends Controller
{
    public function index(Request $request): RobaCollection
    {
        $this->authorize('view-any', Roba::class);

        $search = $request->get('search', '');

        $robas = Roba::search($search)
            ->latest()
            ->paginate();

        return new RobaCollection($robas);
    }

    public function store(RobaStoreRequest $request): RobaResource
    {
        $this->authorize('create', Roba::class);

        $validated = $request->validated();

        $roba = Roba::create($validated);

        return new RobaResource($roba);
    }

    public function show(Request $request, Roba $roba): RobaResource
    {
        $this->authorize('view', $roba);

        return new RobaResource($roba);
    }

    public function update(RobaUpdateRequest $request, Roba $roba): RobaResource
    {
        $this->authorize('update', $roba);

        $validated = $request->validated();

        $roba->update($validated);

        return new RobaResource($roba);
    }

    public function destroy(Request $request, Roba $roba): Response
    {
        $this->authorize('delete', $roba);

        $roba->delete();

        return response()->noContent();
    }
}
