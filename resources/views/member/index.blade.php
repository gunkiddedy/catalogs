@extends('layouts.app')

@section('title', 'Member index')

@section ('content')
<div class="container bg-white">
    <div class="row">
        {{-- <div class="col-md-2 col-sm-12">
            <x-member-sidebar></x-member-sidebar>
        </div> --}}
        <div class="col-md-12 col-sm-12">

            <a href="/product/add" class="btn btn-success mb-2"><i class="fa fa-plus"></i> Add Product</a>

            @if (Auth::user()->is_active == 0)
                <span class="alert alert-primary float-right">
                    Anda belum melengkapi profil, silahkan lengkapi dulu <a href="/profile/{{ Auth::id() }}">di sini!</a>
                </span>
            @endif
            
            @if(Session::has('success'))
            <div class="row sccs">
                <div class="col-12">
                    <div id="charge-message" class="alert alert-success">
                    {{ Session::get('success') }}
                    </div>
                </div>
            </div>
            @endif

            {{-- <div class="row"> --}}
                {{-- <div class="col-12"> --}}
                    <table class="table table-hover striped" style="overflow: scroll">
                        <thead>
                            <th>Name</th>
                            <th>Brand</th>
                            {{-- <th>Category</th> --}}
                            {{-- <th>Sub Cat</th> --}}
                            <th>Image</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                        @if (count($products) > 0)
                            @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->brand }}</td>
                                {{-- <td>{{ $product->category_name }}</td> --}}
                                {{-- <td>{{ $product->subcategory_name }}</td> --}}
                                <td>
                                @foreach (DB::table('view_product_images')->where('product_id', $product->id)->get() as $image)
                                    <img src="{{ asset('/storage/'.$image->image_path) }}" alt="images" width="60" height="60" class="img-thumbnail">
                                @endforeach
                                </td>
                                <td>
                                    <div class="row">
                                        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-primary mr-1">
                                            Edit <i class="fa fa-pencil"></i>
                                        </a>
                                        <form action="{{ route('product.delete', $product->id) }}" method="POST">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-warning">
                                                Delete <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td style="justify-content: center">No product available</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                {{-- </div> --}}
            {{-- </div> --}}
        </div>
        <div class="col-md-12 col-sm-12">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection