@extends('layouts.app')

@section('title', 'product list')

@section ('content')

<div class="container p-0">
    <div class="row">

        <x-frontend-sidebar></x-frontend-sidebar>

        <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12 rspnv">
            {{-- <h3>
                <i class="fa fa-bullhorn"></i>
                Our Catalogs here
            </h3> --}}
            <div class="row d-flex justify-content-start" id="productsXXX">
                @foreach ($products as $product)
                <div class="col-lg-4 col-md-6 col-sm-12 pt-3">
                    <div class="card">
                        {{-- <a href="{{ route('product.detail', $product->id) }}"> --}}
                            <div class="card-header">
                                <h6>
                                    <i class="fa fa-bookmark" style="color: rgb(250, 209, 29)"></i> 
                                    {{ strtoupper($product->product_brand) }}
                                </h6>
                            </div>
                            <div class="card-body ">
                                <div class="product-info">
                                    {{-- <div class="info-1"> --}}
                                        <img class="card-img" src="{{ asset('/storage/'.$product->image_path) }}" alt="">
                                    {{-- </div> --}}
                                    <div class="info-2 mt-4">
                                        <h4>{{ strtoupper($product->product_name) }}</h4>
                                        <hr>
                                        <h6>
                                            {{-- <i class="fa fa-tag" style="color: rgb(250, 209, 29)"></i>
                                            @currency($product->price) --}}
                                            <a href="{{ route('product.detail', $product->id) }}" 
                                                class="btn btn-sm btn-warning text-white">
                                               <i class="fa fa-info-circle"></i> Details product
                                            </a>
                                        </h6>
                                    </div>
                                    
                                </div>
                            </div>
                        {{-- </a> --}}
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 pt-3 offset-5" style="margin-top: 50px;">
                {{ $products->links() }}
            </div>            
        </div>
    </div>
    
</div>



@endsection