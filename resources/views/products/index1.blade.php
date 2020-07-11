@extends('layouts.app')

@section ('content')

<style>
    .img-thumbnail-cstm{
        width: 20%;
    }
</style>
<div class="container">
    <div class="card border-light">
        <div class="card-header" id="headingOne">
            <h5 class="mb-0">
                <button class="btn btn-sm btn-link" 
                data-toggle="collapse" 
                data-target="#collapseOne" 
                aria-expanded="true" 
                aria-controls="collapseOne"><h6>Product Images</h6>
                </button>
            </h5>
        </div>
    
        <div id="collapseOne" class="collapse show multi-collapse" aria-labelledby="headingOne" >
            <div class="card-body">
                <div class="row">
                    <div class="col-md-7 col-sm-12 col-xs-12">
                        <div class="main-image">
                            <img src="{{ asset('storage/images/kamera1.jpg') }}" alt="Placeholder" class="card-img">
                        </div>

                        <div class="tmbnl">
                            <a href="{{ asset('storage/images/kamera1.jpg') }}">
                                <img class="img-thumbnail-cstm mb-1" src="{{ asset('storage/images/kamera1.jpg') }}" alt="Thumbnails">
                            </a>
                            <a href="{{ asset('storage/images/kamera2.jpg') }}">
                                <img class="img-thumbnail-cstm mb-1" src="{{ asset('storage/images/kamera2.jpg') }}" alt="Thumbnails">
                            </a>
                            <a href="{{ asset('storage/images/kamera3.jpg') }}">
                                <img class="img-thumbnail-cstm mb-1" src="{{ asset('storage/images/kamera3.jpg') }}" alt="Thumbnails">
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-md-5 col-sm-12 col-xs-12">
                        <div class="alert alert-primary">
                            <p>
                                This webpage requires data that you entered earlier in order to be properly displayed. You can send this data again, but by doing so you will repeat any action this page previously performed. Press the reload button to resubmit the data needed to load the page.
                                ERR_CACHE_MISS
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


@endsection