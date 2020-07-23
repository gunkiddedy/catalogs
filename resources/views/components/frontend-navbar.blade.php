<nav class="navbar navbar-expand-lg navbar-light shadow-sm bg-white fixed-top">
    <div class="container-fluid bg-white justify-content-between">
        
        <button class="navbar-toggler" type="button" onclick="openNav()">
            <span class="fa fa-filter" style="font-size:30px;cursor:pointer" >
            </span>
        </button>

        <div id="mySidenav" class="sidenav show-filter">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <ul class="navbar-nav ml-auto">
                {{-- link menu for this catalogs --}}
                <li class="nav-item">
                    <a 
                        class="nav-link {{ request()->is(['/', 'products']) ? 'active' : ''}}" 
                        href="/products">Home
                    </a>
                </li>
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('login') ? 'active' : ''}}" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('register') ? 'active' : ''}}" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a href="/profile/{{ Auth::id() }}" class="nav-link">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>

        <a class="navbar-brand" href="/">
            <div class="d-flex">
                <div>
                    <img src="{{ asset('assets/box.svg') }}" style="height:50px;" alt="">
                </div>
                <div class="pl-3 ml-3 pt-2 hidden-app-name" >
                    {{ config('app.name') }}
                </div>
            </div>
        </a>

        {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button> --}}

        <button class="navbar-toggler" type="button" onclick="openNav()">
            <span class="fa fa-bars" style="font-size:30px;cursor:pointer" >
            </span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                {{-- link menu for this catalogs --}}
                <li class="nav-item">
                    <a 
                        class="nav-link {{ request()->is(['/', 'products']) ? 'active' : ''}}" 
                        href="/products">Home
                    </a>
                </li>
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('login') ? 'active' : ''}}" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('register') ? 'active' : ''}}" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a href="/profile/{{ Auth::id() }}" class="nav-link">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>