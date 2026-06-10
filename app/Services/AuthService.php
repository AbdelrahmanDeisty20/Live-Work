<?php
namespace App\Services;

use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class AuthService {
    public function login(array $data) {
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return false;
        }

        Auth::login($user);
        

        return true;
    }
}
