<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhoneStoreRequest;
use App\Http\Requests\PhoneUpdateRequest;
use App\Http\Resources\PhoneCollection;
use App\Http\Resources\PhoneResource;
use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PhoneController extends Controller
{
    public function index(Request $request): PhoneCollection
    {
        $phones = Phone::all();

        return new PhoneCollection($phones);
    }

    public function store(PhoneStoreRequest $request): PhoneResource
    {
        $phone = Phone::create($request->validated());

        return new PhoneResource($phone);
    }

    public function show(Request $request, Phone $phone): PhoneResource
    {
        return new PhoneResource($phone);
    }

    public function update(PhoneUpdateRequest $request, Phone $phone): PhoneResource
    {
        $phone->update($request->validated());

        return new PhoneResource($phone);
    }

    public function destroy(Request $request, Phone $phone): Response
    {
        $phone->delete();

        return response()->noContent();
    }
}
