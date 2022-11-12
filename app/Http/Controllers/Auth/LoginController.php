<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login_view() {
        return view('auth.login');
    }

    public function login(LoginRequest $request) {
        $data = [
          'email' => $request['email'],
          'password' => $request['password']
        ];

        if(Auth::attempt($data)) {
            return redirect()->route('home');
        } else {
            return back()->with('fail', 'Incorrect Login or Password');
        }
    }
}
