<nav class="navbar navbar-expand-lg navbar-light shadow-sm bg-white fixed-top" style="z-index: 9999999;">
    <div class="container-fluid bg-white justify-content-between">

        {{-- <button class="navbar-toggler" type="button">
            <span class="fa fa-filter" style="font-size:30px;cursor:pointer" >
            </span>
        </button>         --}}

        {{-- =============================MOBILE VERSION MENUS==================== --}}
        <div id="mySidenav" class="sidenav show-filter">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <ul class="navbar-nav ml-auto">

                {{-- <li class="nav-item nav-item-mobile">
                    <a class="nav-link {{ request()->is(['/', 'products']) ? 'active' : ''}}" 
                        href="/products"><i class="fa fa-home"></i> Home</a>
                </li> --}}

                @guest
                    <li class="nav-item nav-item-mobile">
                        <a 
                            class="nav-link {{ request()->is(['/', 'products']) ? 'active' : ''}}" 
                            href="/products"><i class="fa fa-home"></i> Home
                        </a>
                    </li>
                @else
                    @if (Auth::user()->role == 'member')
                        <li class="nav-item nav-item-mobile">
                            <a 
                                class="nav-link {{ request()->is('member') ? 'active' : ''}}" 
                                href="/member"><i class="fa fa-home"></i> Home
                            </a>
                        </li>    
                    @elseif(Auth::user()->role == 'admin')
                        <li class="nav-item nav-item-mobile">
                            <a 
                                class="nav-link {{ request()->is(['members']) ? 'active' : ''}}" 
                                href="/members"><i class="fa fa-home"></i> Home
                            </a>
                        </li>  
                    @endif
                @endguest

                <!-- Authentication Links -->
                @guest
                    <li class="nav-item nav-item-mobile"><a class="nav-link {{ request()->is('login') ? 'active' : ''}}" href="{{ route('login') }}"><i class="fa fa-key"></i> {{ __('Login') }}</a></li>
                    @if (Route::has('register'))
                    <li class="nav-item"><a class="nav-link {{ request()->is('register') ? 'active' : ''}}" href="{{ route('register') }}"><i class="fa fa-anchor"></i> {{ __('Register') }}</a>
                    </li>
                    @endif
                @else
                    <li class="nav-item nav-item-mobile">
                        <a href="/profile/{{ Auth::id() }}" class="nav-link"><i class="fa fa-user"></i> Profile</a>
                    </li>
                    {{-- @if (Auth::user()->role == 'member')
                    <li class="nav-item nav-item-mobile">
                        <a href="/member" class="nav-link"><i class="fa fa-cube"></i> My Products</a>
                    </li>
                    @endif --}}
                    <li class="nav-item nav-item-mobile"><a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-anchor"></i> {{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    </li>
                @endguest
            </ul>
        </div>
        {{-- =============================END MOBILE VERSION MENUS==================== --}}

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
        
        {{-- =============================DESKTOP VERSION MENUS==================== --}}
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item nav-item-mobile">
                        <a 
                            class="nav-link {{ request()->is(['/', 'products']) ? 'active' : ''}}" 
                            href="/products">Home
                        </a>
                    </li>
                @else
                    @if (Auth::user()->role == 'member')
                        <li class="nav-item nav-item-mobile">
                            <a 
                                class="nav-link {{ request()->is('member') ? 'active' : ''}}" 
                                href="/member">Home
                            </a>
                        </li>    
                    @elseif(Auth::user()->role == 'admin')
                        <li class="nav-item nav-item-mobile">
                            <a 
                                class="nav-link {{ request()->is(['members']) ? 'active' : ''}}" 
                                href="/members">Home
                            </a>
                        </li>  
                    @endif
                @endguest

                
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item nav-item-mobile">
                        <a class="nav-link {{ request()->is('login') ? 'active' : ''}}" href="{{ route('login') }}">
                            {{ __('Login') }}
                        </a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item nav-item-mobile">
                            <a class="nav-link {{ request()->is('register') ? 'active' : ''}}" href="{{ route('register') }}">
                                {{ __('Register') }}
                            </a>
                        </li>
                    @endif
                @else
                    <li class="nav-item nav-item-mobile">
                        <a href="/profile/{{ Auth::id() }}" class="nav-link">
                            Profile
                        </a>
                    </li>
                    {{-- @if (Auth::user()->role == 'member')
                    <li class="nav-item nav-item-mobile">
                        <a href="/member" class="nav-link">My Products</a>
                    </li>
                    @endif --}}
                    <li class="nav-item nav-item-mobile">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
        {{-- =============================END DESKTOP VERSION MENUS==================== --}}
    </div>
</nav>