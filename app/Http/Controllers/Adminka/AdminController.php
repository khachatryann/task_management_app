<?php

namespace App\Http\Controllers\Adminka;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function delete_user($id) {

        $user = User::find($id);
        $delete = $user->delete();

        if($delete) {
            return redirect()
                ->route('home')
                ->with('success', 'User successfully removed');
        }
    }

    public function search_user(Request $request) {
        $search = $request->input('search');

        $users = User::select(
            'users.id',
            'users.name',
            'users.email',
            'roles.name as role_id')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->where('users.name', 'LIKE', "%{$search}%")
            ->get();

        return view('dash.account.search_user.index', ['users' => $users]);
    }
}
