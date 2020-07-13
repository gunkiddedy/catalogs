@extends('layouts.app')

@section('title', 'product detail')

@section ('content')

<style>
    .img-thumbnail-cstm{
        /* width: 15%; */
        padding: .25rem;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: .25rem;
        max-width: 15%;
        height: auto;
    }
    .card-img-cstm {
        width: 100%;
        border-radius: calc(.25rem - 1px);
        border: 1px solid #dee2e6;
        background-color: #fff;
        padding: .25rem;
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
                aria-controls="collapseOne"><h6 class="text-dark"><i class="fa fa-bell"></i> Product details</h6>
                </button>
            </h5>
        </div>
    
        <div id="collapseOne" class="collapse show multi-collapse" aria-labelledby="headingOne" >
            <div class="card-body">
                <div class="row">

                    <div class="col-md-7 col-sm-12 col-xs-12 mb-5">
                        <div class="main-image mb-2">
                            {{-- @foreach ($images as $image) --}}
                            <img class="card-img" 
                            src="{{ asset('/storage/'.$images[0]->image_path) }}" 
                            alt="image">
                            {{-- @endforeach --}}
                            {{-- <img src="{{ asset('storage/images/kamera1.jpg') }}" alt="Placeholder" class="card-img"> --}}
                        </div>

                        <div class="tmbnl">
                            @foreach ($images as $image)
                            <a href="{{ asset('storage/'.$image->image_path) }}">
                                <img class="img-thumbnail-cstm mb-1" 
                                src="{{ asset('storage/'.$image->image_path) }}" 
                                alt="Thumbnails">
                            </a>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="col-md-5 col-sm-12 col-xs-12">
                        <hr class="prdct_dtl">
                        <h3> 
                            <span class="badge badge-secondary">
                                <i class="fa fa-rocket" style="color: rgb(250, 229, 135)"></i>
                                {{ $product->brand }}
                            </span>
                            <span class="badge badge-secondary">
                                <i class="fa fa-tag" style="color: rgb(250, 229, 135)"></i>
                                {{ $category->name }}
                            </span>
                            <span class="badge badge-secondary">
                                <i class="fa fa-tags" style="color: rgb(250, 229, 135)"></i>
                                {{ $subcategory->name }}
                            </span>
                        </h3>
                        <div class="card">
                            <div class="card-body">
                                <h3>
                                    <span class="badge badge-secondary">
                                        <i class="fa fa-lightbulb-o" style="color: rgb(250, 229, 135)"></i>
                                        {{ $product->name }}
                                    </span>
                                    <span class="badge badge-secondary">
                                        <i class="fa fa-money" style="color: rgb(250, 229, 135)"></i>
                                        @currency($product->price).-
                                    </span>
                                </h3>
                                <hr>
                                <p>{{ $product->description }}</p>
                                <h6>
                                    <span class="badge badge-secondary">
                                        <i class="fa fa-user" style="color: rgb(250, 229, 135)"></i>
                                        {{ $owner->name }}
                                    </span>
                                    <span class="badge badge-secondary">
                                        <i class="fa fa-phone-square" style="color: rgb(250, 229, 135)"></i>
                                        {{ $owner->phone }}
                                    </span>
                                    <span class="badge badge-secondary">
                                        <i class="fa fa-envelope" style="color: rgb(250, 229, 135)"></i>
                                        {{ $owner->email }}
                                    </span>
                                </h6>
                            </div>
                        </div>
                    </div>

                </div><!--.row-->

            </div>
        </div>
    </div>
    <x-product-terkait></x-product-terkait>
</div>

@endsection