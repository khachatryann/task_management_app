<?php

namespace App\Http\Controllers\Task\Task_Search;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request) {

        $search = $request->input('search');

        $tasks = Task::select(
            'tasks.id',
            'tasks.name',
            'tasks.description',
            'tasks_status.status AS status_id',
            'first_us.name AS created_by',
            'second_us.name AS assign_to')
            ->join('users AS first_us', 'tasks.created_by', '=', 'first_us.id')
            ->join('users AS second_us', 'tasks.assign_to', '=', 'second_us.id')
            ->join('tasks_status', 'tasks.status_id', '=', 'tasks_status.id')
            ->where('tasks.name', 'LIKE', "{$search}%")
            ->get();


        return view('dash.tasks.search_task.index', compact('tasks'));
    }
}
