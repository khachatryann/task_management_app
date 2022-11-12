@extends('layouts.app')
@section('title')
    Search User
@endsection
@section('content')
    <div class="container">
        <a href="{{ route('home') }}" class="btn btn-secondary mt-2">Back</a>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Options</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role_id }}</td>
                    @if($user->role_id == 'Admin')
                        <td></td>
                    @else
                        <td>
                            <a href="{{ route('delete_user', $user->id) }}" class="btn btn-danger">Delete</a>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
