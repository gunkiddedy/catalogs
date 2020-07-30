@extends('layouts.app')

@section('title', 'product detail')

@section ('content')

<style>
    .img-thumbnail-cstm{
        /* width: 15%; */
        padding: .25rem;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: .25rem;
        max-width: 15%;
        height: auto;
    }
    .card-img-cstm {
        width: 100%;
        border-radius: calc(.25rem - 1px);
        border: 1px solid #dee2e6;
        background-color: #fff;
        padding: .25rem;
    }
</style>

<div class="container rspnv-container-prdct-detail">
    <div class="card border-white">
        {{-- <div class="card-header bg-white border-white" id="headingOne">
            <h5 class="mb-0">
                <button class="btn btn-sm btn-link" 
                data-toggle="collapse" 
                data-target="#collapseOne" 
                aria-expanded="true" 
                aria-controls="collapseOne"><h6 class="text-dark">Product details</h6>
                </button>
            </h5>
        </div> --}}
    
        {{-- <div id="collapseOne" class="collapse show multi-collapse" aria-labelledby="headingOne" > --}}
            <div class="card-body rspnv-card-body">
                <div class="row">
                    {{-- PRODUCT IMAGE --}}
                    <div class="col-md-6 col-sm-12 col-xs-12 mb-5">
                        <div class="main-image mb-2">
                            {{-- @foreach ($images as $image) --}}
                            <img class="card-img" 
                            src="{{ asset('/storage/'.$images[0]->image_path) }}" 
                            alt="image">
                            {{-- @endforeach --}}
                            {{-- <img src="{{ asset('storage/images/kamera1.jpg') }}" alt="Placeholder" class="card-img"> --}}
                        </div>

                        <div class="tmbnl">
                            @foreach ($images as $image)
                            <a href="{{ asset('storage/'.$image->image_path) }}">
                                <img class="img-thumbnail-cstm mb-1" 
                                src="{{ asset('storage/'.$image->image_path) }}" 
                                alt="Thumbnails">
                            </a>
                            @endforeach
                        </div>
                    </div>
                    {{-- =========================================END PRODUCT IMAGE --}}
                    
                    {{-- PRODUCT DESC --}}
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <hr class="prdct_dtl">                        
                        <div class="card bg-white border-white">
                            <div class="card-body rspnv-card-body">
                                <h3>{{ $product->name }}</h3>
                                <h6>
                                    <i class="fa fa-tag" style="color: rgb(250, 229, 135)"></i>
                                    {{ $category->name }}
                                    
                                    @if (!empty($subcategory->name))
                                        <i class="fa fa-tags" style="color: rgb(250, 229, 135)"></i>
                                        {{ $subcategory->name }}
                                    @endif
                                </h6>
                                <h3>
                                    Product Description
                                </h3>
                                {{-- <hr> --}}
                                <p>{{ $product->description }}</p>
                                <h6>
                                    <span class="badge badge-secondary">
                                        <i class="fa fa-phone-square" style="color: rgb(250, 229, 135)"></i>
                                        {{ $company->phone }}
                                    </span>
                                    <span class="badge badge-secondary">
                                        <i class="fa fa-envelope" style="color: rgb(250, 229, 135)"></i>
                                        {{ $company->email }}
                                    </span>
                                </h6>
                                <hr>
                                <h6>Hs Code : {{ $product->hs_code }}</h6>
                            </div>
                        </div>
                    </div>
                    {{-- ====================================END PRODUCT DESC --}}

                </div><!--.row-->

            </div>
            <h3 class="mt-4">Company Info</h3>
            <hr>
            {{-- COMPANY NAME, PROV, KAB --}}
            <div class="card-body rspnv-card-body">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12 mb-5">
                        <div>
                            @if ($company->avatar !== null)
                            <img class="img-thumbnail"
                                src="{{ asset('/storage/'.$company->avatar)}}"
                                alt="user-avatar">
                            @else
                                <img class="img-thumbnail" 
                                    src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png" 
                                    alt="user-avatar">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-12 mb-5">
                        <h3>
                            <a href="/company/detail/{{ $company->id }}">{{ $company->name }}</a>
                        </h3>
                        <h6>
                            {{ $company->address }}
                        </h6>
                        <h6>
                            {{ $company->email }} | {{ $company->phone }}
                        </h6>
                        <h6>
                            {{ \App\User::find($company->id)->kabupaten->name ? \App\User::find($company->id)->kabupaten->name : '' }}, 
                            {{ \App\User::find($company->id)->provinsi->name ? \App\User::find($company->id)->provinsi->name : '' }}
                        </h6>
                        {{-- <h4>
                            <span class="badge badge-secondary">
                                <i class="fa fa-flag" style="color: rgb(250, 229, 135)"></i>
                                @if (!empty(\App\User::find($company->id)->provinsi->name))
                                    {{ \App\User::find($company->id)->provinsi->name }}
                                @else
                                    -
                                @endif
                            </span>
                            <span class="badge badge-secondary">
                                <i class="fa fa-flag-o" style="color: rgb(250, 229, 135)"></i>
                                @if (!empty(\App\User::find($company->id)->provinsi->name))
                                    {{ \App\User::find($company->id)->kabupaten->name }}
                                @else
                                    -
                                @endif
                            </span>
                        </h4> --}}
                    </div>
                </div>
            </div>
            {{-- END COMPANY --}}
        {{-- </div> --}}
    </div>
    {{-- <x-related-product></x-related-product> --}}
</div>

@endsection