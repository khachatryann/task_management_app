@extends('layouts.app')
@section('title')
    Assigned tasks
@endsection
@section('content')
    <x-nav-bar />
    <div class="container mt-2">

        <h2>All my Tasks</h2>

        <div class="card__container mt-3" style="display: flex">
        @foreach($tasks as $task)
            @if(Auth::user()->role_id == 1 && Auth::user()->name == $task['assign_to'])
                <div class="card mt-2" style="width: 18rem; margin-left: 35px">
                    <div class="card-body">
                        <h5 class="card-title">{{ $task['name'] }}</h5>
                        <p class="card-text">{{ $task['description'] }}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Assigned to` Me</li>

                        @if(Auth::user()->role_id == 1)
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
