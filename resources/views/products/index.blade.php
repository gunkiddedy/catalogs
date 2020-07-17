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
                        <div class="card-body ">
                            <div class="product-info">
                                @foreach (DB::table('product_images')->where('product_id', $product->id)->limit(1)->get() as $image)
                                <a href="/product/detail/{{ $product->id }}">
                                    <img class="card-img" src="{{ asset('/storage/'.$image->image_path) }}" alt="img-product">
                                </a>
                                @endforeach
                                <div class="info-2 mt-4">
                                    <h4>{{ strtoupper($product->name) }}</h4>
                                    <hr>
                                    <h6>
                                        <a href="{{ route('company.detail', \App\Product::find($product->id)->user->id) }}" 
                                            class="btn btn-sm btn-warning text-white">
                                            <i class="fa fa-code-fork"></i> {{ \App\Product::find($product->id)->user->name }}
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
                {{-- {{ $products->links() }} --}}
            </div>            
        </div>
    </div>
    
</div>



@endsection