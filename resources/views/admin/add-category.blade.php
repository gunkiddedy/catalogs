@extends('layouts.app')

@section('title', 'add category')

@section ('content')
<div class="container-fluid bg-white" style="margin-bottom: 199px;">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <h3>Add Category</h3>
            <hr>
            <form method="POST" action="{{ route('category.store') }}">
                @csrf 
                @method('POST')

                <div class="row ">
                    <div class="col-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name" >Category Name</label>
                                <input placeholder="Category name" type="text" class="form-control " name="name" autofocus>
                                @error('name')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>                    
                </div>
                
                <button type="submit" class="btn btn-primary">Save</button>
            
            </form>
        </div>
    </div>
</div>

@endsection
