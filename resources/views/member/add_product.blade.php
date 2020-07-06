@extends('layouts.member')

@section ('content')

<div class="col-12 col-md-12 col-sm-12 col-lg-10">
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
                        <input placeholder="Enter product name" type="text" class="form-control " name="name" value="" required autocomplete="name" autofocus>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="brand" >Brand</label>
                        <input type="text" name="brand" placeholder="Enter brand name" class="form-control">
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="price" >Price</label>
                        <input type="text" name="price" placeholder="Enter price" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="hs_code" >HS Code</label>
                        <input type="text" name="hs_code" placeholder="Enter Hs Code" class="form-control">
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="category_id" >Category</label>
                        <select class="form-control" name="category_id" required id="category_id">
                            @foreach($category as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="subcategory_id" >Sub Category</label>
                        <select class="form-control" name="subcategory_id" required id="category_id">
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
                        <textarea name="description"  cols="30" rows="5" class="form-control"></textarea>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-2">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="sni" value="1" name="sni">
                    <label class="form-check-label" for="inlineCheckbox1">SNI</label>
                </div>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <input type="file" id="images" name="images[]"  multiple>
                </div>
            </div>
            <div class="input-images"></div>
        </div>
        
        <button type="submit" class="btn btn-primary" style="float: right">Submit product</button>
    
    </form>
</div>


    
@endsection