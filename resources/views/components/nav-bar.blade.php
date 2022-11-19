<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #2f6fe3">
                        @if(empty(Auth::user()->avatar))
                            <img src="{{ asset('assets/uploads/avatars/default/default.png' . Auth::user()->avatar) }}" style="width: 50px; height: 50px; border-radius: 50%">
                            {{ Auth::user()->name }}
                        @else
                            <img src="{{ asset('assets/uploads/avatars/' . Auth::user()->avatar) }}" style="width: 50px; height: 50px; border-radius: 50%">
                            {{ Auth::user()->name }}
                        @endif
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                        @if(Auth::user()->role_id == 1)
                            <li><p style="color: #565e6b; display: flex; justify-content: center">Programmer</p></li>
                        @elseif(Auth::user()->role_id == 2)
                            <li><p style="color: #565e6b; display: flex; justify-content: center">Manager</p></li>
                        @elseif(Auth::user()->role_id == 3)
                            <li><p style="color: #565e6b; display: flex; justify-content: center">Admin</p></li>
                        @endif
                        <li><a class="dropdown-item {{ (Request::is('profile') ? 'active' : '') }}" href="{{ route('profile_view') }}">My Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Log Out</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('delete_view') }}" style="background: red; color: white">Delete Account</a></li>
                    </ul>
                </li>
                <li class="nav-item" style="margin-top: 6%; margin-left: 10px">
                    <a class="nav-link {{ (Request::is("home") ? 'active' : '') }}" href="{{ route('home') }}">Home</a>
                </li>
                @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                <li class="nav-item" style="margin-top: 6%; margin-left: 10px">
                    <a class="nav-link {{ (Request::is("tasks") ? 'active' : '') }}" href="{{ route('tasks.index') }}">Tasks</a>
                </li>

                @if(\Illuminate\Support\Facades\Auth::user()->role_id == 1)
                <li class="nav-item" style="margin-top: 6%; margin-left: 10px">
                    <a class="nav-link {{ (Request::is("selected/tasks") ? 'active' : '') }}" href="{{ route('programmer_tasks') }}">Assigned to me</a>
                </li>
                @endif
            </ul>

            <form class="d-flex" method="get" action="{{ route('task_search') }}">
                <input class="form-control me-2" type="search" placeholder="Search Task" aria-label="Search" name="search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            @else
            </div>
                <form class="d-flex" method="get" action="{{ route('user_search') }}">
                    <input class="form-control me-2" type="search" placeholder="Search User" aria-label="Search" name="search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            @endif

        </div>
    </div>
</nav>
