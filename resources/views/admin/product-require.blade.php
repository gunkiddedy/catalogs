@extends('layouts.app')

@section('title', 'member list')

@section ('content')
<div class="container-fluid bg-white">
    <div class="row">

        <x-admin-sidebar></x-admin-sidebar>

        <div class="col-md-10 col-sm-12">
            @if(Session::has('success'))
            <div class="row sccs">
                <div class="col-12">
                    <div id="charge-message" class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                </div>
            </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3>Company Products</h3>
                </div>
                <div class="card-body" style="overflow: scroll">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Company</th>
                                <th scope="col">Product</th>
                                <th scope="col">Image</th>
                                <th scope="col">Status</th>
                               <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if (!empty($products))
                            @foreach ($products as $item)
                                <tr>
                                    <td>{{ $item->company_name }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <img src="{{ asset('/storage/'.$item->image_path) }}" alt="images" width="60" height="60" class="img-thumbnail">
                                    </td>
                                    <td>
                                        @if ($item->is_active == 1)
                                            <span class="badge badge-success">Published</span>
                                        @else
                                            <span class="badge badge-warning">Draft</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-start">
                                            {{-- <a href="{{ route('product-require.edit', $item->id) }}" class="text-white btn btn-sm btn-primary mr-1">
                                                <i class="fa fa-pencil"></i>
                                            </a> --}}
                                            <a href="{{ route('product-require.detail', $item->id) }}" class="text-white btn btn-sm btn-primary mr-1">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr><td>No product require found!</td></tr>
                        @endif
                        
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>                
        </div>

    </div>
</div>

    
@endsection