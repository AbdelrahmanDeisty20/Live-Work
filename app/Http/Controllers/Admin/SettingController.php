<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function update(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'avaliable_time' => 'required|string|max:100',
        ]);

        $setting = Setting::first();
        if ($setting) {
            $setting->update($data);
        } else {
            Setting::create($data);
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'System settings updated successfully.'
            ]);
        }

        return redirect()->back()->with('success', 'System settings updated successfully.');
    }
}
