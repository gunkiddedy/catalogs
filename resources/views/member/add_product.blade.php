@extends('layouts.app')

@section('title', 'add product')

@section ('content')
<div class="container bg-white">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <h3>Add Product</h3>
            <hr>
            <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                @csrf 
                @method('POST')
                <div class="row ">
                    <div class="col-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name" >Product Name</label>
                                <input placeholder="Product name" type="text" class="form-control " name="name" value="" autofocus>
                                @error('name')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="brand" >Brand</label>
                                <input type="text" name="brand" placeholder="Enter brand name" class="form-control">
                                @error('brand')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
        
                    <div class="col-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="price" >Price</label>
                                <input type="text" name="price" placeholder="Enter price" class="form-control">
                                @error('price')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="hs_code" >HS Code</label>
                                <input type="text" name="hs_code" placeholder="Enter Hs Code" class="form-control">
                                @error('hs_code')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
        
                    <div class="col-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="category_id" >Category</label>
                                <select class="form-control" name="category_id" id="category_id">
                                    <option value="" selected>Choose...</option>
                                    @foreach($category as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="subcategory_id" >Sub Category</label>
                                <select class="form-control" name="subcategory_id" id="subcategory_id">
                                    <option value="99" selected>Choose...</option>
                                    @foreach($subcat as $subc)
                                        <option value="{{ $subc->id }}">{{ $subc->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <label for="price" >Product Description</label>
                        <div class="form-group">
                            <div>
                                <textarea name="description" rows="10" class="form-control"></textarea>
                                @error('description')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
        
                    <div class="col-12 mb-2">
                        {{-- <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="sni" value="1" name="sni">
                            <label class="form-check-label" for="inlineCheckbox1">SNI</label>
                        </div> --}}
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" id="sni" class="custom-control-input" name="sni" value="1" >
                            <label class="custom-control-label" for="sni">SNI</label>
                        </div>
                    </div>
        
                    <div class="col-12">
                        <label for="photos">Choose images</label>
                        <div class="form-group">
                            <input type="file" name="images[]" id="images" multiple>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary" style="float: right">Submit product</button>
            
            </form>
        </div>
    </div>
</div>




@endsection
