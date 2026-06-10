<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm() {
        return view('admin.login');
    }

    public function login(LoginRequest $request) {
        $validatedData = $request->validated();

        $user = User::where('email', $validatedData['email'])->first();

        if (!$user || !Hash::check($validatedData['password'], $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'The provided credentials do not match our records.',
            ]);
        }

        Auth::login($user);
        $request->session()->regenerate();

        return response()->json([
            'status' => 'success',
            'message' => 'Login successful.',
            'url' => route('admin.dashboard')
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
