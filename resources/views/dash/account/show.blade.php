@extends('layouts.app')
@section('title')
    {{ Auth::user()->name }}
@endsection
@section('content')
    <x-nav-bar />
    <div class="container">

        <div class="img__container mt-3">
           <hr>
            <div class="border" style="padding: 8px; border-radius: 5px";>
            @if(empty(Auth::user()->avatar))
           <img
               src="{{ asset('assets/uploads/avatars/default/default.png')}}"
               class="img-thumbnail"
               alt="{{ Auth::user()->name . ' ' . 'avatar' }}"
               style="width: 320px; height: 320px;"
           >
            @else
                <img
                    src="{{ asset('assets/uploads/avatars/' . Auth::user()->avatar)}}"
                    class="img-thumbnail"
                    alt="{{ Auth::user()->name . ' ' . 'avatar' }}"
                    style="width: 320px; height: 320px;"
                >
            @endif
                <div style="position: absolute; top: 33%; left: 55%; transform: translate(-50%, -50%)">
                    <ul class="profile__info">
                        <li><h1>{{ Auth::user()->name }}</h1></li>
                        <li><h3>{{ Auth::user()->email }}</h3></li>
                    @if(Auth::user()->role_id == 1)
                            <li><p style="color: #565e6b; display: flex; justify-content: center">Programmer</p></li>
                        @elseif(Auth::user()->role_id == 2)
                            <li><p style="color: #565e6b; display: flex; justify-content: center">Manager</p></li>
                        @elseif(Auth::user()->role_id == 3)
                            <li><p style="color: #565e6b; display: flex; justify-content: center">Admin</p></li>
                        @endif
                    </ul>
                </div>
        </div>
        </div>

    </div>

    <style>
        .profile__info {list-style-type: none; font-size: 19px}
    </style>
@endsection


