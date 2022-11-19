<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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

        $tasks = Task::select(
            'tasks.id',
            'users.name as created_by')
            ->join('users', 'tasks.created_by', '=', 'users.id')
            ->get();

        return view('dash.index', compact('users', 'tasks'));
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
