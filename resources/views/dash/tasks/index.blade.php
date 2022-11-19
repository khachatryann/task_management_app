@extends('layouts.app')
@section('title')
    Home
@endsection
@section('content')
    <x-nav-bar />

    <div class="container">

        @if(Auth::user()->role_id == 2)

            @if(session('success'))
                <div class="alert alert-success mt-2">{{ session('success') }}</div>
            @elseif(session('delete'))
                <div class="alert alert-danger mt-2">{{ session('delete') }}</div>
            @endif
        @endif

        @if(Auth::user()->role_id == 1)
            <a href="{{ route('programmer_tasks') }}" class="btn btn-link">Show only my tasks</a>
        @endif

        <div class="pagination mt-2">
            {{ $tasks->links('vendor.pagination.custom') }}
        </div>

        <div class="card__container" style="display: flex;">

        @foreach($tasks as $task)
            @if(Auth::user()->role_id == 2 && Auth::user()->name == $task['created_by'])
    <div class="card mt-2" style="width: 18rem; margin-left: 35px">
        <div class="card-body">
            <h5 class="card-title">{{ $task['name'] }}</h5>
            <p class="card-text">{{ $task['description'] }}</p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Created By` {{ $task['created_by'] }}</li>
            <li class="list-group-item">Assigned to` {{ $task['assign_to'] }}</li>

            <li class="list-group-item">Status` {{ $task['status_id'] }}</li>
        </ul>
        <div class="card-body">
            <a href="{{ route('tasks.show', $task) }}" class="card-link">All Info</a>
        </div>
    </div>

        @elseif(Auth::user()->role_id == 1)
                <div class="card mt-2" style="width: 18rem; margin-left: 35px">
                        <div class="card-body">
                            <h5 class="card-title">{{ $task['name'] }}</h5>
                            <p class="card-text">{{ $task['description'] }}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Assigned to` {{ $task['assign_to'] }}</li>

                            @if(Auth::user()->role_id == 1 && Auth::user()->name == $task['assign_to'])
                            <li class="list-group-item">
                                <select class="form-select" aria-label="Default select example">
                                    @foreach($tasks_status as $ts)
                                    <option value="{{ $ts->id }}">{{ $ts->status }}</option>
                                    @endforeach
                                </select>
                            </li>
                        </ul>
                        @else
                            <li class="list-group-item">Status` {{ $task['status_id'] }}</li>
                        @endif
                        <div class="card-body">
                            <a href="{{ route('tasks.show', $task) }}" class="card-link">All Info</a>
                        </div>
                    </div>
        @endif
        @endforeach
        </div>
    </div>
@endsection
