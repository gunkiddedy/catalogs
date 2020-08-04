@extends('layouts.app')

@section('title', 'edit user')

@section ('content')
<div class="container-fluid bg-white">
    <div class="row">
        <x-admin-sidebar></x-admin-sidebar>

        <div class="col-md-10 col-sm-12">
            <h3>Edit Product Status</h3>
            <hr>
            <form method="POST" action="{{ route('product-require.update', $product->id) }}">
                @csrf
                @method('PATCH')
                <div class="row ">
                    <div class="col-10">
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
                                      Active
                                    </label>

                                    <input
                                    class="form-check-input" 
                                    type="radio" 
                                    name="is_active" 
                                    id="is_active2" 
                                    value="0" {{ $product->is_active == 0 ? 'checked' : ''}}>
                                    <label class="form-check-label" for="is_active2">
                                      Inactive
                                    </label>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Update</button>
            </form>
        </div>
    </div>
</div>



    
@endsection