@extends('layouts.app')
@section('title')
    Welcome
@endsection
@section('content')
    <div class="container" style="display: flex; justify-content: space-between; padding: 10px">
        <h1>Welcome to the App</h1>
        <div>
            <a href="{{ route('register_view') }}" class="btn btn-link">Sign Up</a>
            <a href="{{ route('login_view') }}" class="btn btn-link">Log In</a>
        </div>
    </div>
@endsection
