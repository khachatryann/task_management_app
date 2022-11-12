@extends('layouts.app')
@section('title')
    Edit
@endsection
@section('content')
    @if(Auth::user()->name == $task['created_by'])
    <div class="container">
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary mt-2">Back</a>
        <h2>Edit Task</h2>
        <div class="col-md-5">
            <form action="{{ route('tasks.update', $task['id']) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control {{ ($errors->has('name')) ? 'is-invalid' : '' }}" value="{{ $task['name'] }}" name="name" id="name" placeholder="Task 1">
                    <span class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </span>
                </div>

                <div class="form-floating mt-3">
                    <select class="form-select" name="assign_to" id="assign_to">
                        @foreach($users as $user)
                            <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                        @endforeach
                    </select>
                    <label for="assign_to" class="form-label">Assign To</label>
                </div>


                <div class="form-floating mt-3">
                    <textarea class="form-control {{ ($errors->has('description')) ? 'is-invalid' : '' }}"  placeholder="Leave a comment here" name="description" id="description" style="height: 150px">{{ $task['description'] }}</textarea>
                    <label for="description">Description</label>
                    <span class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </span>
                </div>

                <button class="btn btn-outline-success mt-3">Send</button>
            </form>
        </div>
    </div>
    @else
        {{ abort(500, 'Something went wrong') }}
    @endif
@endsection
