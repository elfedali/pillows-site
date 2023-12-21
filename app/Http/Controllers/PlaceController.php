<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaceStoreRequest;
use App\Http\Requests\PlaceUpdateRequest;
use App\Http\Resources\PlaceCollection;
use App\Http\Resources\PlaceResource;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PlaceController extends Controller
{
    public function index(Request $request): PlaceCollection
    {
        $places = Place::all();

        return new PlaceCollection($places);
    }

    public function store(PlaceStoreRequest $request): PlaceResource
    {
        $place = Place::create($request->validated());

        return new PlaceResource($place);
    }

    public function show(Request $request, Place $place): PlaceResource
    {
        return new PlaceResource($place);
    }

    public function update(PlaceUpdateRequest $request, Place $place): PlaceResource
    {
        $place->update($request->validated());

        return new PlaceResource($place);
    }

    public function destroy(Request $request, Place $place): Response
    {
        $place->delete();

        return response()->noContent();
    }
}
