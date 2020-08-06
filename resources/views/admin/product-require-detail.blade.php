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
    
        <div class="card-body rspnv-card-body">
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 mb-5">
                    <div class="main-image mb-2">
                        <img class="card-img" 
                        src="{{ asset('/storage/'.$images[0]->image_path) }}" 
                        alt="image">
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
                        <div class="card-footer bg-white">
                            <form method="POST" action="{{ route('product-require.update', $product->id) }}">
                                @csrf
                                @method('PATCH')
                                <div class="row d-flex justify-content-start">
                                    <div class="col-md-12">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                
                                                    <input 
                                                    class="form-check-input"
                                                    type="radio" 
                                                    name="is_active" 
                                                    id="is_active1" 
                                                    value="1" {{ $product->is_active == 1 ? 'checked' : ''}}>
                
                                                    <label class="form-check-label mr-4" for="is_active1">
                                                      Publish
                                                    </label>
                
                                                    <input
                                                    class="form-check-input" 
                                                    type="radio" 
                                                    name="is_active" 
                                                    id="is_active2" 
                                                    value="0" {{ $product->is_active == 0 ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="is_active2">
                                                      Draft
                                                    </label>
                
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success ml-2">Update</button>
                                        <a href="/product-require" class="btn btn-primary text-white ml-2">Back</a>
                                    </div>
                                </div>
                            </form>
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
                {{-- <div class="col-md-4 col-sm-4 col-xs-12 mb-5">
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
                </div> --}}
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
                        {{ $kabupaten_name ? $kabupaten_name : ''}}, 
                        {{ $provinsi_name ? $provinsi_name : ''}}
                    </h6>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection