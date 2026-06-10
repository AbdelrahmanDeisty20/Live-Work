<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ContactStoreRequest;
use App\Services\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function contact(ContactStoreRequest $request)
    {
        $validated = $request->validated();

        $contact = $this->contactService->createContact($validated);

        return response()->json([
            'success' => true,
            'message' => 'Contact created successfully',
            'data' => $contact,
        ]);
    }
}
