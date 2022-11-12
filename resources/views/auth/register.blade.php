@extends('layouts.app')
@section('title')
    Sign Up
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h1 class="mt-2">Sign Up</h1>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form action="{{ route('register') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control {{ ($errors->has('name')) ? 'is-invalid' : '' }}" name="name" id="name" placeholder="John">
                        <span class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </span>
                    </div>

                    <div class="mb-3">
                        <label for="avatar" class="form-label">Avatar</label>
                        <input type="file" class="form-control {{ ($errors->has('avatar')) ? 'is-invalid' : '' }}" name="avatar" id="avatar">
                        <span class="invalid-feedback">
                            {{ $errors->first('avatar') }}
                        </span>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control {{ ($errors->has('email')) ?'is-invalid' : '' }}" name="email" id="email" placeholder="example@gmail.com">
                        <span class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </span>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control {{ ($errors->has("password")) ? 'is-invalid' : '' }}" name="password" id="password" placeholder="At least 8 characters">
                        <span class="invalid-feedback">
                            {{ $errors->first("password") }}
                        </span>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirm" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control {{ $errors->has("password") ? 'is-invalid' : '' }}" name="password_confirmation" id="password">
                    </div>

                    <button class="btn btn-primary">Send</button>
                    <a href="{{ route('login_view') }}" class="btn btn-link">Already have an Account?</a>
                </form>
            </div>
        </div>
    </div>
@endsection
