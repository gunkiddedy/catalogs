<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.AppName', 'Catalog') }}</title> --}}

    <title>@yield('title')</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="icon" href="{{ URL::asset('assets/box2.svg') }}" type="image/x-icon"/>
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

    <link href="{{ asset('external-css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('external-css/responsive.css') }}">

    {{-- <link href="{{ asset('css/loading.css') }}" rel="stylesheet"> --}}


</head>
<body >
    <div id="app" class="overflow-hidden">
        <x-frontend-navbar></x-frontend-navbar>
              
        <main class="container-fluid py-4 bg-white">
            @yield('content')
        </main>

    </div>
    <!-- FOOTER -->
    @include('layouts.footer-app')

</body>

<script src="{{ mix('js/app.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


{{-- product detail image --}}
<script src="{{ asset('external-js/simpleGal.js') }}"></script>
<script>
    $('.tmbnl').simpleGal({
        mainImage: '.card-img'
    });
</script>

<script>
    // function openNav() {
    //   document.getElementById("mySidenav").style.width = "100%";
    // }
    
    // function closeNav() {
    //   document.getElementById("mySidenav").style.width = "0";
    // }
    // function openNav() {
    // document.getElementById("mySidenav").style.width = "250px";
    // document.getElementById("main").style.marginLeft = "250px";
    // }

    // function closeNav() {
    // document.getElementById("mySidenav").style.width = "0";
    // document.getElementById("main").style.marginLeft= "0";
    // }

    function openNav() {
        document.getElementById("mySidenav").style.width = "70%";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>

{{-- custom js style --}}
{{-- <script src="{{ asset('external-js/style.js') }}"></script> --}}

</html>

