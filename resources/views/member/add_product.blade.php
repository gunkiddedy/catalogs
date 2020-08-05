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
                    <div class="col-10">
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
                        </div>
                    </div>

                    <div class="col-10">
                        <label for="price" >Product Description</label>
                        <div class="form-group">
                            <div>
                                <textarea name="description" rows="3" class="form-control"></textarea>
                                @error('description')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div id="product" class="row col-md-10">
                        <field-custom></field-custom>
                    </div>

                    {{-- <div class="row col-10">
                        <div class="col-10 mb-2">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" id="sni" class="custom-control-input" name="sni" value="1" >
                                <label class="custom-control-label" for="sni">SNI</label>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input placeholder="nomor sni" type="text" class="form-control " name="nomor_sni">
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-10 mb-2">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" id="tkdn" class="custom-control-input" name="tkdn" value="1" >
                                <label class="custom-control-label" for="tkdn">TKDN</label>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input placeholder="nilai_tkdn" type="text" class="form-control " name="nilai_tkdn">
                                    </div>
                                    <div class="col-md-4">
                                        <input placeholder="nomor_sertifikat_tkdn" type="text" class="form-control " name="nomor_sertifikat_tkdn">
                                    </div>
                                    <div class="col-md-4">
                                        <input placeholder="nomor_laporan_tkdn" type="text" class="form-control " name="nomor_laporan_tkdn">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

        
                    <div class="col-10">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="price" >Price</label>
                                {{-- <input type="number" name="price" placeholder="Enter price" class="form-control"> --}}
                                <input type="text" name="price"
                                    class="form-control" 
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" 
                                    />
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
        
                    {{-- <div class="col-10">
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
                    </div> --}}
                    
                    
        
                    
        
                    <div class="col-10">
                        <label for="photos">Choose images</label>
                        <div class="form-group">
                            <input type="file" name="images[]" id="images" multiple>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Submit product</button>
            
            </form>
        </div>
    </div>
</div>




@endsection
