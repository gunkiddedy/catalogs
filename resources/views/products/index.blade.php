@extends('layouts.app')

@section('title', 'product list')

@section ('content')

<div class="container p-0">
    <div class="row">

        <x-frontend-sidebar></x-frontend-sidebar>

        <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 rspnv">
            <div class="row d-flex justify-content-start" id="productsXXX">
                @foreach ($products as $product)
                <div class="col-lg-3 col-md-3 col-sm-6 pt-3 col-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="product-info">
                                <a href="/product/detail/{{ $product->id }}">
                                    <img class="card-img" src="{{ asset('/storage/'.\App\ProductImage::where('product_id', $product->id)->with('product')->first()->image_path) }}" alt="img-product">
                                </a>
                                <div class="mt-2">
                                    <p>{{ ucwords($product->name) }} </p>
                                    {{-- <hr> --}}
                                    <h6>
                                        <a href="{{ route('company.detail', \App\Product::find($product->id)->user->id) }}" 
                                            class="text-warning" style="font-size: 13px;">
                                            {{ \App\Product::find($product->id)->user->name }}
                                        </a>
                                    </h6>
                                </div>
                                
                            </div>
                        </div>
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