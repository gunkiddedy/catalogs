@extends('layouts.app')

@section ('content')
{{ $image }}
<div class="container p-0 show">
   <div class="row sixtyvh">
       <div class="col-lg-8 col-sm-12 mb-3 show-picture">
            <div class="card">
                {{-- <img src="{{ asset('/storage/'.$image->image_path) }}" alt="images" width="50" class="img-thumbnail"> --}}
            </div>
       </div>
       <div class="col-lg-4 col-sm-12 pl-5 pr-5">
        <h6><strong>{{ $product->brand }}</strong></h6>
        <h5>{{ $product->name}}</h5>
            <div class="card">
                <div class="card-body">
                    <div class="show-info">
                        <div class="info-1">
                            <h6>BUY NEW</h6>
                        </div>
                        <div class="info-3">
                            {{-- <p>{{ $product->description}}</p> --}}
                        </div>
                        <a href="" id="add-to-cart" class="add-to-cart disabled">
                            <div class="info-4">
                                ADD TO CART
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
   </div>
</div>

@endsection