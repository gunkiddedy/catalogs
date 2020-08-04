@extends('layouts.app')

@section('title', 'edit product')

@section ('content')
<div class="container bg-white">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <h3>Edit Product</h3>
            <hr>
            <form method="POST" action="{{ route('product.update', $product->id) }}" 
                id="myAwesomeDropzone" class="dropzone" enctype="multipart/form-data">
                @csrf 
                @method('PATCH')
                <div class="row ">
                    <div class="col-10">
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="name" >Product Name</label>
                                <input placeholder="Enter product name" type="text" class="form-control " name="name" value="{{ $product->name }}" required autocomplete="name">
                            </div>
                        </div>
                    </div>

                    <div class="col-10">
                        <label for="price" >Product Description</label>
                        <div class="form-group">
                            <div>
                                <textarea name="description"  cols="30" rows="5" class="form-control">{{ $product->description }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-10 mb-2">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" id="sni" class="custom-control-input" name="sni" 
                            value="1" {{ $product->sni == 1 ? 'checked' : ''}}
                            >
                            <label class="custom-control-label" for="sni">SNI</label>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-8">
                                    <input 
                                        placeholder="nomor sni" 
                                        type="text" class="form-control " 
                                        name="nomor_sni"
                                        value="{{ $product->nomor_sni }}"
                                        >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-10 mb-2">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" id="tkdn" class="custom-control-input" name="tkdn" 
                                value="1" {{ $product->tkdn == 1 ? 'checked' : ''}} 
                                >
                            <label class="custom-control-label" for="tkdn">TKDN</label>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <input placeholder="nilai_tkdn" type="text" class="form-control " name="nilai_tkdn"
                                    value={{ $product->nilai_tkdn }}
                                    >
                                </div>
                                <div class="col-md-4">
                                    <input placeholder="nomor_sertifikat_tkdn" type="text" class="form-control " name="nomor_sertifikat_tkdn" value={{ $product->nomor_sertifikat_tkdn }} >
                                </div>
                                <div class="col-md-4">
                                    <input placeholder="nomor_laporan_tkdn" type="text" class="form-control " name="nomor_laporan_tkdn" value={{ $product->nomor_laporan_tkdn }}>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <div class="col-8">
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
        
                    <div class="col-8">
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
                    
                    
        
                    {{-- <div class="col-10 mb-2">
                        <div class="form-check form-check-inline">
                            <input 
                                class="form-check-input" 
                                type="checkbox" id="sni" 
                                value="{{ $product->sni }}" {{ $product->sni == 1 ? 'checked' : ''}} name="sni">
                            <label class="form-check-label" for="inlineCheckbox1">SNI</label>
                        </div>
                    </div> --}}
        
                    {{-- <div class="col-12">
                        <div class="form-group">
        
                            <label class="form-check-label" for="inlineCheckbox1">
                                Update images <span class="text-danger">(*skip if no need to update)</span></label>
                            <input type="file" id="images" name="images[]"  multiple>
                        </div>
                    </div> --}}
        
                </div>
                
                <button type="submit" class="btn btn-success">Update product</button>
            
            </form>
        </div>
    </div>
</div>


    
@endsection