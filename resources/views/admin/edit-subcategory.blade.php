@extends('layouts.app')

@section('title', 'edit sub category')

@section ('content')
<div class="container bg-white">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <h3>Edit Category</h3>
            <hr>
            <form method="POST" action="{{ route('subcategory.update', $subcategory->id) }}">
                @csrf 
                @method('PATCH')

                <div class="row ">
                    <div class="col-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name" >Name</label>
                                <input placeholder="Category name" 
                                    type="text" class="form-control" 
                                    value="{{ $subcategory->name }}" name="name" autofocus>
                                @error('name')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name" >Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{$subcategory->category_id == $cat->id  ? 'selected' : ''}}>
                                            {{ $cat->name}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
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
