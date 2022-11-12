<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function welcome() {
        return view('welcome');
    }

    public function register_view() {
        return view('auth.register');
    }

    public function register(RegisterRequest $request) {
        $avatar = "";

        if($request->file('avatar')) {
            $ext = $request->file('avatar')->extension();
            $avatar = time() . '.' . $ext;
            $request->file('avatar')->move(public_path('assets/uploads/avatars'), $avatar);
        }

        $data = [
            'name' => $request['name'],
            'avatar' => $avatar,
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ];

        $register = User::create($data);

        if($register) {
            return redirect()
                ->route('login_view')
                ->with('success', 'Account added successfully');
        }
    }
}
