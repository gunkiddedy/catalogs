@extends('layouts.member')

@section ('content')

<div class="col-12 col-md-12 col-sm-12 col-lg-10">

    @if(Session::has('success'))
    <div class="row sccs">
      <div class="col-12">
        <div id="charge-message" class="alert alert-success">
          {{ Session::get('success') }}
        </div>
      </div>
    </div>
    @endif

    <div class="row">
        <div class="col-12">
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
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->brand }}</td>
                        {{-- <td>{{ $product->category_name }}</td> --}}
                        {{-- <td>{{ $product->subcategory_name }}</td> --}}
                        <td>
                        @foreach (DB::table('view_product_images')->where('product_id', $product->product_id)->get() as $image)
                            <img src="{{ asset('/storage/'.$image->image_path) }}" alt="images" width="60" height="60" class="img-thumbnail">
                        @endforeach
                        </td>
                        <td>
                            <a href="{{ route('product.edit', $product->product_id) }}" class="btn btn-sm btn-primary">
                                Edit <i class="fa fa-pencil"></i></a>
                            <form action="{{ route('product.delete', $product->product_id) }}" method="POST">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-warning">
                                    Delete <i class="fa fa-trash"></i>
                                </button>
                            </form>
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
        </div>
    </div>
</div>
    
@endsection