<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function home() {

        $users = User::select(
            'users.id',
            'users.name',
            'users.email',
            'roles.name as role_id')
        ->join('roles', 'users.role_id', '=', 'roles.id')
        ->get();

        return view('dash.index', compact('users'));
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login_view');
    }

    public function delete_view() {
        return view('dash.account.delete.delete');
    }

    public function delete($id) {
        $user  = User::find($id);
        $delete = $user->delete();

        if($delete) {
            return redirect()
                ->route('register_view')
                ->with('success', 'Account successfully deleted');
        }
    }

    public function profile_view() {
        return view('dash.account.show');
    }
}
