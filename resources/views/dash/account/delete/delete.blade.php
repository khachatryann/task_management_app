@extends('layouts.app')
@section('title')
    Remove Account
@endsection
@section('content')
    <div class="col-md-8">
    <div class="card">
        <h4 class="card-header">ATTENTION!!</h4>
        <div class="card-body">
            <h5 class="card-title">Dear {{ Auth::user()->name }}</h5>
            <p class="card-text">If you delete your Account you cant reestablish it...</p>
            <a href="{{ route('delete', Auth::user()->id) }}" class="btn btn-danger mt-3">Delete my Account</a>
            <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Go Back</a>
        </div>
    </div>
    </div>

    <style>
        .col-md-8 {
            position: absolute;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -50%)
        }

        .card {
            height: 300px;
            border: 1px solid #c51e13;
        }

        .card-header {
            color: #a60505;
        }

        .card-text {
            font-size: 18px;
        }
    </style>
@endsection
