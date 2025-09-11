<?php

namespace App\Http\Controllers\Api;

use App\Models\Izvestaj;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\IzvestajResource;
use App\Http\Resources\IzvestajCollection;
use App\Http\Requests\IzvestajStoreRequest;
use App\Http\Requests\IzvestajUpdateRequest;

class IzvestajController extends Controller
{
    public function index(Request $request): IzvestajCollection
    {
        $this->authorize('view-any', Izvestaj::class);

        $search = $request->get('search', '');

        $izvestajs = Izvestaj::search($search)
            ->latest()
            ->paginate();

        return new IzvestajCollection($izvestajs);
    }

    public function store(IzvestajStoreRequest $request): IzvestajResource
    {
        $this->authorize('create', Izvestaj::class);

        $validated = $request->validated();

        $izvestaj = Izvestaj::create($validated);

        return new IzvestajResource($izvestaj);
    }

    public function show(Request $request, Izvestaj $izvestaj): IzvestajResource
    {
        $this->authorize('view', $izvestaj);

        return new IzvestajResource($izvestaj);
    }

    public function update(
        IzvestajUpdateRequest $request,
        Izvestaj $izvestaj
    ): IzvestajResource {
        $this->authorize('update', $izvestaj);

        $validated = $request->validated();

        $izvestaj->update($validated);

        return new IzvestajResource($izvestaj);
    }

    public function destroy(Request $request, Izvestaj $izvestaj): Response
    {
        $this->authorize('delete', $izvestaj);

        $izvestaj->delete();

        return response()->noContent();
    }
}
