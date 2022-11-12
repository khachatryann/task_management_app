@extends('layouts.app')
@section('title')
    Home
@endsection
@section('content')
    <x-nav-bar />

    @if(Auth::user()->role_id == 3)
        <div class="container">
            <h1 style="color: #315181">Admin Panel</h1>
            <h2 style="color: #46165b">Registered Users` {{ count($users ) }}</h2>
            @if(session('success'))
                <div class="alert alert-danger w-50 mt-2">{{ session('success') }}</div>
            @endif
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Created Tasks</th>
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
                    <td></td>
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
    @endif
@endsection

