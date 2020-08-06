@extends('layouts.app')

@section('title', 'edit product')

@section ('content')
<div class="container bg-white">
    <div class="row">
        <div class="col-md-10">
            <h3>Edit Product</h3>
            <hr>
            <form method="POST" action="{{ route('product.update', $product->id) }}" 
                id="myAwesomeDropzone" class="dropzone" enctype="multipart/form-data">
                @csrf 
                @method('PATCH')
                <div class="row ">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="name" >Product Name</label>
                                <input placeholder="Enter product name" type="text" class="form-control " name="name" value="{{ $product->name }}" required autocomplete="name">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="price" >Product Description</label>
                        <div class="form-group">
                            <div>
                                <textarea name="description"  cols="30" rows="5" class="form-control">{{ $product->description }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div id="product" style="width: 100%">
                        <edit-product/>
                    </div>

                    {{-- <div class="col-md-12 mb-2">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" id="sni" class="custom-control-input" name="sni" 
                            value="1" {{ $product->sni == 1 ? 'checked' : ''}}
                            >
                            <label class="custom-control-label" for="sni">SNI</label>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
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

                    <div class="col-md-12 mb-2">
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
                    </div> --}}
        
                    <div class="col-md-12">
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
        
                    <div class="col-md-12">
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
                    
                    
                    <div class="col-md-12 mt-4">
                        <div class="card">
                            <div class="card-body">
                                @foreach (DB::table('view_product_images')->where('product_id', $product->id)->get() as $image)
                                    <img src="{{ asset('/storage/'.$image->image_path) }}" alt="images" width="60" height="60" class="img-thumbnail">
                                @endforeach
                            </div>
                        </div>
                    </div>
        
                    <div class="col-12 mt-4">
                        <div class="form-group">
        
                            <label class="form-check-label" for="inlineCheckbox1">
                                Update images <span class="text-danger">(*skip if no need to update the image)</span></label>
                            <input type="file" id="images" name="images[]"  multiple>
                        </div>
                    </div>
        
                </div>
                
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group justify-content-between mt-4 float-right">
                            <button type="submit" class="btn btn-primary">Update product</button>
                            <a href="/member" class="btn btn-warning">Cancel</a>
                        </div>
                    </div>
                </div>
            
            </form>
        </div>
    </div>
</div>


    
@endsection