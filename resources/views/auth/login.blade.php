@extends('layouts.app')
@section('title')
    Log In
@endsection
@section('content')
    <div class="container">
        <div class="col-md-4">
            <h1>Log In</h1>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @elseif(session('fail'))
                <div class="alert alert-danger">{{ session('fail') }}</div>
            @endif
                <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control {{ ($errors->has('email')) ? 'is-invalid' : '' }}" name="email" id="email" placeholder="example@gmail.com">
                    <span class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </span>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control {{ ($errors->has('password')) ? 'is-invalid' : '' }}" name="password" id="password" placeholder="At least 8 characters">
                    <span class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </span>
                </div>

                    <div class="form-group mb-3">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" value="1">
                        <label for="remember">Remember me</label>
                    </div>

                <button class="btn btn-success">Send</button>
                <a href="{{ route('register_view') }}">Don't have an Account?</a>
            </form>
        </div>
    </div>
@endsection
