<?php

namespace App\Http\Controllers\Api;

use App\Models\Transakcija;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransakcijaResource;
use App\Http\Resources\TransakcijaCollection;
use App\Http\Requests\TransakcijaStoreRequest;
use App\Http\Requests\TransakcijaUpdateRequest;

class TransakcijaController extends Controller
{
    public function index(Request $request): TransakcijaCollection
    {
        $this->authorize('view-any', Transakcija::class);

        $search = $request->get('search', '');

        $transakcijas = Transakcija::search($search)
            ->latest()
            ->paginate();

        return new TransakcijaCollection($transakcijas);
    }

    public function store(TransakcijaStoreRequest $request): TransakcijaResource
    {
        $this->authorize('create', Transakcija::class);

        $validated = $request->validated();

        $transakcija = Transakcija::create($validated);

        return new TransakcijaResource($transakcija);
    }

    public function show(
        Request $request,
        Transakcija $transakcija
    ): TransakcijaResource {
        $this->authorize('view', $transakcija);

        return new TransakcijaResource($transakcija);
    }

    public function update(
        TransakcijaUpdateRequest $request,
        Transakcija $transakcija
    ): TransakcijaResource {
        $this->authorize('update', $transakcija);

        $validated = $request->validated();

        $transakcija->update($validated);

        return new TransakcijaResource($transakcija);
    }

    public function destroy(
        Request $request,
        Transakcija $transakcija
    ): Response {
        $this->authorize('delete', $transakcija);

        $transakcija->delete();

        return response()->noContent();
    }
}
