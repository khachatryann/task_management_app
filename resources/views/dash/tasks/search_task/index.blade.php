@extends('layouts.app')
@section('title')
    Search Task
@endsection
@section('content')
    <x-nav-bar />
    <div class="container">

        <a href="{{ route('tasks.index') }}" class="btn btn-secondary mt-2">Back</a>

        @foreach($tasks as $task)
            @if(Auth::user()->role_id == 2 && Auth::user()->name == $task['created_by'])
                <div class="card mt-2" style="width: 18rem;">
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
                <div class="card mt-2" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $task['name'] }}</h5>
                        <p class="card-text">{{ $task['description'] }}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Assigned to` {{ $task['assign_to'] }}</li>

{{--                                                    <li class="list-group-item">Status` {{ $task['status_id'] }}</li>--}}
                        <li class="list-group-item">
                            <select class="form-select" aria-label="Default select example">
                                <option value="{{ $task['id'] }}">One</option>
                            </select>
                        </li>
                    </ul>
                    <div class="card-body">
                        <a href="{{ route('tasks.show', $task) }}" class="card-link">All Info</a>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endsection
