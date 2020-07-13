@extends('layouts.app')

@section('title', 'product list')

@section ('content')

<div class="container p-0">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6">
            <h3><i class="fa fa-filter"></i> Filter </h3>
            <input class="mt-3 mb-2" type="text" id="search" placeholder="Enter product name" style="width:100%;">
            <div class="filterprice card mb-2">
                <div class="card-body">
                    <h5 class="card-title">Price</h5>
                    <input type="range" min="{{ $minPrice }}" max="{{ $maxPrice }}" value="100000" class="slider selector" id="pricerange">
                    <p class="p-0 m-0">Max: Rp <span id="currentrange">{{ $minPrice }}</span></p>
                </div>
            </div>
            <div class="filtergender card mb-2">
                <div class="card-body">
                    <h5 class="card-title">Brands</h5>
                    <hr>
                    @foreach ($brands as $brand)
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" id="{{ $brand->brand }}" class="custom-control-input" name="{{ $brand->brand }}" value="{{ $brand->brand }}" >
                        <label class="custom-control-label" for="{{ $brand->brand }}">{{ ucfirst($brand->brand) }}</label>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="filtergender card mb-2">
                <div class="card-body">
                    <h5 class="card-title">Categories</h5>
                    <hr>
                    @foreach ($category as $cat)
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" id="{{ $cat->name }}" class="custom-control-input" name="{{ $cat->name }}" value="{{ $cat->name }}" >
                        <label class="custom-control-label" for="{{ $cat->name }}">{{ ucfirst($cat->name) }}</label>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="filtergender card mb-2">
                <div class="card-body">
                    <h5 class="card-title">Sub Categories</h5>
                    <hr>
                    @foreach ($subcategory as $subcat)
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" id="{{ $subcat->name }}" class="custom-control-input" name="{{ $subcat->name }}" value="{{ $subcat->name }}" >
                        <label class="custom-control-label" for="{{ $subcat->name }}">{{ ucfirst($subcat->name) }}</label>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- end of filter ============================= --}}


        <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12 rspnv">
            <h3>
                <i class="fa fa-bullhorn"></i>
                Our Catalogs here
            </h3>
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
                <div class="col-lg-4 col-md-6 col-sm-12 pt-3 offset-3" style="margin-top: 50px;">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
    
</div>



@endsection