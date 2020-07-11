@extends('layouts.app')

@section('content')
    <!-- START THE FEATURETTES -->
<div class="container">
    <h3>About Us</h3>
    <hr class="featurette-divider">
    <div class="row featurette">
        <div class="col-md-7">
            <h2 class="featurette-heading">{{ $about->title }}</h2>
            <p class="lead">{{ $about->description }}</p>
        </div>
        <div class="col-md-5">
            <img src="{{ asset('storage/'.$about->image) }}" alt="images" class="card-img">
        </div>
    </div>
</div>


<!-- /END THE FEATURETTES -->
@endsection

