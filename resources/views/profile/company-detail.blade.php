@extends('layouts.app')

@section('title', 'member profile')

@section('content')

<div class="container bg-white rspnv-container-prdct-detail">
    <div class="row">
        <div class="col-md-5 col-sm-12 col-xs-12 mb-4">
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
                {{-- <div class="card-header">
                    {{ Auth::user()->role=='admin' ? 'Admin ' : 'Member '}}Profile
                </div> --}}
                <div class="card-body rspnv-card-body">
                    @if ($user->avatar !== null)
                        <img class="card-img" 
                        src="{{ asset('/storage/'.$user->avatar)}}"
                        alt="user-avatar">
                    @else
                        <img class="img-thumbnail" 
                            style="width: 50%" 
                            src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png" 
                            alt="user-avatar">
                    @endif
                    {{-- <p class="card-text mt-2">
                        <span class="badge badge-secondary">Additional info</span><br>
                        <div class="alert alert-primary">
                            @if (!empty($user->additional_info))
                                {{ $user->additional_info }}
                            @else
                                <p>No info found</p>
                            @endif
                        </div>
                    </p> --}}
                </div>
                {{-- <div class="card-footer">
                    <form action="{{ route('avatar.update', Auth::id()) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="d-flex justify-content-between">
                            <input type="file" name="avatar" id="avatar">
                            <button type="submit" class="btn btn-warning">Update Avatar</button>
                        </div>
                    </form>
                </div> --}}
            </div>
        </div>
        <style>
            .table td,
            .table th {
                border: 0;
            }
        </style>
        <div class="col-md-7 col-sm-12 col-xs-12">
            <table class="table table-sm">
                <tbody>
                    <tr>
                        {{-- <th scope="row">Company Name</th> --}}
                        <td colspan="2"><h3>{{ $user->name }}</h3></td>
                    </tr>
                    <tr>
                        {{-- <th scope="row">Address</th> --}}
                            <td>
                                {{ $user ? $user->address : '-' }}
                                {{ $kecamatan ? $kecamatan->name : '' }}
                                {{ $kabupaten ? $kabupaten->name : '' }}
                                {{ $provinsi ? $provinsi->name : '' }}
                                {{ $kecamatan ? $kecamatan->zipcode : '' }}
                            </td>
                    </tr>
                    <tr>
                        {{-- <th scope="row">Phone / Email</th> --}}
                        <td>
                            {{ $user ? $user->phone : ''}} - 
                            {{ $user ? $user->email : ''}}
                        </td>
                    </tr>

                    {{-- <tr>
                        <th scope="row">Tkdn</th>
                        @if (!empty($user->tkdn))
                            <td>{{ $user->tkdn }}</td>
                        @else
                            <td>-</td>
                        @endif
                    </tr> --}}
                    {{-- <tr>
                        <th scope="row">Provinsi</th>
                        @if (!empty($provinsi))
                            <td>{{ $provinsi->name }}</td>
                        @else
                            <td>-</td>
                        @endif
                    </tr>
                    <tr>
                        <th scope="row">Kabupaten</th>
                        @if (!empty($kabupaten))
                            <td>{{ $kabupaten->name }}</td>
                        @else
                            <td>-</td>
                        @endif
                    </tr>
                    <tr>
                        <th scope="row">Kecamatan / Zipcode</th>
                        @if ( !empty($kecamatan) || !empty($kecamatan->zipcode))
                            <td>{{ $kecamatan->name }} / {{ $kecamatan->zipcode }}</td>
                        @else
                            <td>-</td>
                        @endif
                    </tr> --}}
                    <tr>
                        {{-- <th scope="row">Additional info</th> --}}
                        @if ( !empty($user->additional_info))
                            <td>{{ $user->additional_info }}</td>
                        @else
                            <td></td>
                        @endif
                    </tr>
                    {{-- <tr>
                        <th scope="row">Nib</th>
                        @if (!empty($user->nib))
                            <td>{{ $user->nib }}</td>
                        @else
                            <td>-</td>
                        @endif
                    </tr> --}}
                </tbody>
            </table>
            {{-- <div>
                <a href="/profile/edit/{{ Auth::id() }}" style="float: right" class="btn btn-primary text-white">Edit Profile</a>
            </div> --}}
        </div>
    </div>

    {{-- SEARCH --}}
    <div class="row">
        <div class="col-md-12">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fa fa-search"></i>
                    </div>
                </div>
                <input type="search" name="search" id="search" class="form-control" placeholder="Search product...">
            </div>
        </div>
    </div>

    {{-- COMPANY PRODUCTS --}}
    {{-- <div class="row"> --}}
        {{-- <div class="col-lg-12 col-md-12 col-sm-6 col-xs-6 rspnv"> --}}
            <div class="row d-flex justify-content-start" id="productsXXX">
                @foreach ($products as $product)
                <div class="col-lg-3 col-md-6 col-sm-6 col-6 pt-3 rspnv-image">
                    <div class="card text-center">
                        <div class="card-body rspnv-card-body">
                            <div class="product-info">
                                @foreach (DB::table('product_images')->where('product_id', $product->id)->limit(1)->get() as $image)
                                <a href="/product/detail/{{ $product->id }}">
                                    <img class="card-img" src="{{ asset('/storage/'.$image->image_path) }}" alt="img-product">
                                </a>
                                @endforeach
                                <div class="mt-2">
                                    <p class="prdct_name">{{ ucwords($product->name) }} </p>
                                    <hr>
                                    <h6>
                                        <a href="{{ route('company.detail', \App\Product::find($product->id)->user->id) }}" 
                                            class="prdct_company"><i class="fa fa-flag mr-1"></i>{{ \App\Product::find($product->id)->user->name }}</a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        {{-- </div> --}}
    {{-- </div> --}}

</div>

    
@endsection