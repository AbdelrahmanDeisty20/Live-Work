<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Secure transmission envelope deleted successfully.'
            ]);
        }

        return redirect()->back()->with('success', 'Secure transmission envelope deleted successfully.');
    }
}
