<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactStoreRequest;
use App\Http\Requests\ContactUpdateRequest;
use App\Http\Resources\ContactCollection;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContactController extends Controller
{
    public function index(Request $request): ContactCollection
    {
        $contacts = Contact::all();

        return new ContactCollection($contacts);
    }

    public function store(ContactStoreRequest $request): ContactResource
    {
        $contact = Contact::create($request->validated());

        return new ContactResource($contact);
    }

    public function show(Request $request, Contact $contact): ContactResource
    {
        return new ContactResource($contact);
    }

    public function update(ContactUpdateRequest $request, Contact $contact): ContactResource
    {
        $contact->update($request->validated());

        return new ContactResource($contact);
    }

    public function destroy(Request $request, Contact $contact): Response
    {
        $contact->delete();

        return response()->noContent();
    }
}
