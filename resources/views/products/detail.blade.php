@extends('layouts.app')

@section('title', 'product detail')

@section ('content')

<div class="container">
    <div class="card border-light">
        <div class="card-header" id="headingOne">
            <h5 class="mb-0">
                <button class="btn btn-sm btn-link" 
                data-toggle="collapse" 
                data-target="#collapseOne" 
                aria-expanded="true" 
                aria-controls="collapseOne"><h5>Product Images</h5>
                </button>
            </h5>
        </div>
    
        <div id="collapseOne" class="collapse show multi-collapse" aria-labelledby="headingOne" >
            <div class="card-body">
                @foreach ($images as $image)
                <img class="mr-5 mb-5 img-thumbnail" src="{{ asset('/storage/'.$image->image_path) }}" alt="image">
                @endforeach
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#Name</th>
                            <th scope="col">#Brand</th>
                            <th scope="col">#Price</th>
                            <th scope="col">#Hscode</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->brand }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->hs_code }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card border-light">
        <div class="card-header" id="headingTwo">
            <h5 class="mb-0">
                <button class="btn btn-sm btn-link collapsed" 
                data-toggle="collapse" 
                data-target="#collapseTwo" 
                aria-expanded="false" 
                aria-controls="collapseTwo"><h5>Product Description</h5>
                </button>
            </h5>
        </div>
        <div id="collapseTwo" class="collapse multi-collapse" aria-labelledby="headingTwo" >
            <div class="card-body">
                {{ $product->description }}
            </div>
        </div>
    </div>
</div>

@endsection