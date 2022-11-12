@extends('layouts.app')
@section('title')
    {{ $one_task['name'] }}
@endsection
@section('content')
    @if(Auth::user()->name == $one_task['created_by'])
    <div class="container">
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary mt-2">Back</a>
        <div class="card mt-3" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">{{ $one_task['name'] }}</h5>
                <p class="card-text">{{ $one_task['description'] }}</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Created By` {{ $one_task['created_by'] }}</li>
                <li class="list-group-item">Assigned To` {{ $one_task['assign_to'] }}</li>
                <li class="list-group-item">Status` {{ $one_task['status_id'] }}</li>
                <li class="list-group-item">Created At` {{ $one_task['created_at']}}
                <li class="list-group-item">Updated At` {{ $one_task['updated_at']}}<?= "\n" ?> </li>
            </ul>
            <div class="card-body" style="display: flex; justify-content: space-evenly  ">
                <a href="{{ route('tasks.edit', $one_task['id']) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('tasks.destroy', $one_task['id']) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger ml-4">Delete</button>
                </form>
            </div>
        </div>
        @elseif(Auth::user()->role_id == 1)
            <div class="container">
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary mt-2">Back</a>
                <div class="card mt-3" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $one_task['name'] }}</h5>
                        <p class="card-text">{{ $one_task['description'] }}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Created By Manager` {{ $one_task['created_by'] }}</li>
                        <li class="list-group-item">Assigned To` {{ $one_task['assign_to'] }}</li>
                        <li class="list-group-item">Status` {{ $one_task['status_id'] }}</li>
                        <li class="list-group-item">Created At` {{ $one_task['created_at']}}
                        <li class="list-group-item">Updated At` {{ $one_task['updated_at']}}<?= "\n" ?> </li>
                    </ul>
                </div>
            @else
            {{ abort(500, 'Something went wrong') }}
        @endif
    </div>
@endsection
