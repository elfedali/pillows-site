<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationStoreRequest;
use App\Http\Requests\ReservationUpdateRequest;
use App\Http\Resources\ReservationCollection;
use App\Http\Resources\ReservationResource;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReservationController extends Controller
{
    public function index(Request $request): ReservationCollection
    {
        $reservations = Reservation::all();

        return new ReservationCollection($reservations);
    }

    public function store(ReservationStoreRequest $request): ReservationResource
    {
        $reservation = Reservation::create($request->validated());

        return new ReservationResource($reservation);
    }

    public function show(Request $request, Reservation $reservation): ReservationResource
    {
        return new ReservationResource($reservation);
    }

    public function update(ReservationUpdateRequest $request, Reservation $reservation): ReservationResource
    {
        $reservation->update($request->validated());

        return new ReservationResource($reservation);
    }

    public function destroy(Request $request, Reservation $reservation): Response
    {
        $reservation->delete();

        return response()->noContent();
    }
}
