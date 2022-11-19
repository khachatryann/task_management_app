<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tasks_status = DB::table('tasks_status')->get();


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
            ->paginate(2);


        return view('dash.tasks.index', compact('tasks', 'tasks_status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::get()->where('role_id', '=', '1');

        return view('dash.tasks.create', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        $data = [
            'name' => $request['name'],
            'created_by' => Auth::user()->id,
            'status_id' => 2,
            'assign_to' => $request['assign_to'],
            'description' => $request['description']
        ];

        if (Task::create($data)) {
            return redirect()
                ->route('tasks.index')
                ->with('success', 'Task successfully created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $one_task = Task::select(
            'tasks.id',
            'tasks.name',
            'tasks.created_at',
            'tasks.updated_at',
            'tasks.description',
            'tasks_status.status AS status_id',
            'first_us.name AS created_by',
            'second_us.name AS assign_to')
            ->join('users AS first_us', 'tasks.created_by', '=', 'first_us.id')
            ->join('users AS second_us', 'tasks.assign_to', '=', 'second_us.id')
            ->join('tasks_status', 'tasks.status_id', '=', 'tasks_status.id')
            ->where('tasks.id', '=', $task['id'])
            ->get();

        $one_task = json_decode($one_task, true)[0];
        return view('dash.tasks.show', ['one_task' => $one_task]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {

        $users = User::get()->where('role_id', '=', '1');

        $one_task = Task::select(
            'tasks.id',
            'tasks.name',
            'tasks.created_at',
            'tasks.updated_at',
            'tasks.description',
            'tasks_status.status AS status_id',
            'first_us.name AS created_by',
            'second_us.name AS assign_to')
            ->join('users AS first_us', 'tasks.created_by', '=', 'first_us.id')
            ->join('users AS second_us', 'tasks.assign_to', '=', 'second_us.id')
            ->join('tasks_status', 'tasks.status_id', '=', 'tasks_status.id')
            ->where('tasks.id', '=', $task['id'])
            ->get();

        $one_task = json_decode($one_task, true)[0];
        return view('dash.tasks.edit', ['task' => $one_task], ['users' => $users]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, Task $task)
    {
        $data = [
            'name' => $request['name'],
            'assign_to' => $request['assign_to'],
            'description' => $request['description']
        ];

        $update = $task->update($data);
        if ($update) {
            return redirect()->route('tasks.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $delete = $task->delete();

        if ($delete) {
            return redirect()
                ->route('tasks.index')
                ->with('delete', 'Task deleted');
        }
    }


    //API
    public function api_index()
    {

        return Task::select(
            'tasks.id',
            'tasks.name',
            'tasks.description',
            'tasks_status.status AS status_id',
            'first_us.name AS created_by',
            'second_us.name AS assign_to')
            ->join('users AS first_us', 'tasks.created_by', '=', 'first_us.id')
            ->join('users AS second_us', 'tasks.assign_to', '=', 'second_us.id')
            ->join('tasks_status', 'tasks.status_id', '=', 'tasks_status.id')
            ->get();
    }


    //Programmer tasks
    public function prg_tasks()
    {

        $tasks_status = DB::table('tasks_status')->get();


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
            ->get();


        return view('dash.tasks.programmer_tasks.index', compact('tasks', 'tasks_status'));
    }

}
