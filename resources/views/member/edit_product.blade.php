@extends('layouts.member')

@section('title', 'edit product')

@section ('content')

<div class="col-12 col-md-12 col-sm-12 col-lg-10">
    <h3>Edit Product</h3>
    <hr>
    <form method="POST" action="{{ route('product.update', $product->id) }}" 
        id="myAwesomeDropzone" class="dropzone" enctype="multipart/form-data">
        @csrf 
        @method('PATCH')
        <div class="row ">
            <div class="col-12">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name" >Product Name</label>
                        <input placeholder="Enter product name" type="text" class="form-control " name="name" value="{{ $product->name }}" required autocomplete="name" autofocus>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="brand" >Brand</label>
                        <input placeholder="Enter brand" type="text" class="form-control " name="brand" value="{{ $product->brand }}" required autocomplete="name" autofocus>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="price" >HS Code</label>
                        <input type="text" name="hs_code" placeholder="Enter Hs Code" class="form-control" value="{{ $product->hs_code }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="price" >Price</label>
                        <input type="text" name="price" placeholder="Enter price" class="form-control" value="{{ $product->price }}">
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="category_id" >Category</label>
                        <select class="form-control" name="category_id" required id="category_id">
                            <option value="" selected>Choose...</option>
                            @foreach($category as $cat)
                                <option value="{{ $cat->id }}" {{$product->category_id == $cat->id  ? 'selected' : ''}}>{{ $cat->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="subcategory_id" >Sub Category</label>
                        <select class="form-control" name="subcategory_id" id="category_id">
                            <option value="99" disabled>Choose...</option>
                            @foreach($subcat as $subc)
                                <option value="{{ $subc->id }}" {{$product->subcategory_id == $subc->id  ? 'selected' : ''}}>{{ $subc->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="col-12">
                <label for="price" >Product Description</label>
                <div class="form-group">
                    <div>
                        <textarea name="description"  cols="30" rows="5" class="form-control">{{ $product->description }}</textarea>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-2">
                <div class="form-check form-check-inline">
                    <input 
                        class="form-check-input" 
                        type="checkbox" id="sni" 
                        value="{{ $product->sni }}" {{ $product->sni == 1 ? 'checked' : ''}} name="sni">
                    <label class="form-check-label" for="inlineCheckbox1">SNI</label>
                </div>
            </div>

            {{-- <div class="col-12">
                <div class="form-group">

                    <label class="form-check-label" for="inlineCheckbox1">
                        Update images <span class="text-danger">(*skip if no need to update)</span></label>
                    <input type="file" id="images" name="images[]"  multiple>
                </div>
            </div> --}}

        </div>
        
        <button type="submit" class="btn btn-success" style="float: right">Update product</button>
    
    </form>
</div>

    
@endsection