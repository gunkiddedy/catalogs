<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="icon" href="{{ URL::asset('assets/box2.svg') }}" type="image/x-icon"/>

    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{ asset('external-css/style.css') }}" rel="stylesheet">
    
    {{-- SELECR SEARCH --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
    



</head>
<body>
    <div id="app">
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm"> --}}
        <nav class="navbar navbar-expand-md navbar-light shadow-sm bg-white">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <div class="d-flex">
                        <div><img src="{{ asset('assets/box.svg') }}" style="height:50px;" alt=""></div>
                        <div class="pl-3 ml-3 pt-2" style="border-left:1px solid rgba(0, 0, 0, 0.5); font-size:1.5rem;">
                            {{ config('app.name') }}
                        </div>
                    </div>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                
                        <li class="nav-item active dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ ucfirst(Auth::user()->name) }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @if (Auth::user()->role=='admin')
                                <a href="{{ route('admin.dashboard') }}" class="dropdown-item">Dashboard</a>
                                @else
                                <a href="{{ route('member.dashboard') }}" class="dropdown-item">Dashboard</a>
                                @endif
                                <a href="{{ route('profile.edit', Auth::id()) }}" class="dropdown-item">Edit Profile</a>
                                                                
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                  
                    </ul>
                </div>
            </div>
        </nav>

        {{-- IF ADMIN ROLE --}}
        @if (Auth::user()->role == 'admin')
        <main class="py-4">
            <div class="container">
                <div class="row mx-auto">
                    <div class="col-12 col-md-12 col-lg-2 col-md-2 col-sm-12 pb-2">
                        <div class="card">
                            <div class="card-header">
                                NAVIGATION
                            </div>
                            <ul class="list-group">
                                <a href="{{ route('about.index') }}" class="list-group-item member-navigation">About</a>
                                <a href="{{ route('contact.index') }}" class="list-group-item member-navigation">Contact</a>
                                <a href="{{ route('member.list') }}" class="list-group-item member-navigation">Members</a>
                                <a href="" class="list-group-item member-navigation">Provinsi</a>
                                <a href="" class="list-group-item member-navigation">Kabupaten</a>
                                <a href="" class="list-group-item member-navigation">Kecamatan</a>
                                <a href="" class="list-group-item member-navigation">Category</a>
                                <a href="/profile/{{ Auth::id() }}" class="list-group-item member-navigation">Profile</a>
                                <a href="/products" class="list-group-item member-navigation">Preview</a>
                            </ul>
                        </div>
                    </div>
                    @yield('content')
                </div>
            </div>
        </main>  
        @else
        <main class="py-4">
            <div class="container">
                <div class="row mx-auto">
                    <div class="col-12 col-md-12 col-lg-2 col-md-2 col-sm-12 pb-2">
                        <div class="card">
                            <div class="card-header">
                                NAVIGATION
                            </div>
                            <ul class="list-group">
                                <a href="/product/add" class="list-group-item member-navigation">Add Product</a>
                                <a href="/category/add" class="list-group-item member-navigation">Category</a>
                                <a href="/profile/{{ Auth::id() }}" class="list-group-item member-navigation">Profile</a>
                                <a href="/products" class="list-group-item member-navigation">Preview</a>
                            </ul>
                        </div>
                    </div>
                    @yield('content')
                </div>
            </div>
        </main>
        @endif

    </div>


</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

{{-- SELECT SEARCH --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js" defer></script>

<script src="{{ asset('external-js/style.js') }}"></script>
</html>

