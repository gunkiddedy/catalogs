@extends('layouts.app')

@section('title', 'edit category')

@section ('content')
<div class="container bg-white">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <h3>Edit Category</h3>
            <hr>
            <form method="POST" action="{{ route('category.update', $category->id) }}">
                @csrf 
                @method('PATCH')

                <div class="row ">
                    <div class="col-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name" >Category Name</label>
                                <input placeholder="Category name" 
                                    type="text" class="form-control" 
                                    value="{{ $category->name }}" name="name" autofocus>
                                @error('name')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>                    
                </div>
                
                <button type="submit" class="btn btn-primary">Update</button>
            
            </form>
        </div>
    </div>
</div>

@endsection
