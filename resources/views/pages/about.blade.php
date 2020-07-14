@extends('layouts.app')

@section('title', 'about')

@section('content')

    <!-- START THE FEATURETTES -->
<div class="container">
    <h3>About Us</h3>
    <hr class="featurette-divider">
    <div class="row featurette">
        @if (!empty($about))
            <div class="col-md-7">
                <h2 class="featurette-heading">{{ $about->title }}</h2>
                <p class="lead">{{ $about->description }}</p>
            </div>
            <div class="col-md-5">
                <img src="{{ asset('storage/'.$about->image) }}" alt="images" class="card-img">
            </div>
        @else 
            <div class="col-md-7">
                <h2 class="featurette-heading">Lorem ipsum</h2>
                <p class="lead">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Sapiente rem illo saepe id blanditiis at laudantium magnam. 
                    Sequi, asperiores dolorem.
                </p>
            </div>
            <div class="col-md-5">
                <img src="{{ asset('storage/images/'.'default-avatar.png') }}" alt="images" class="card-img">
            </div>
        @endif
    </div>
</div>


<!-- /END THE FEATURETTES -->
@endsection

