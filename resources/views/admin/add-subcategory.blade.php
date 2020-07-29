@extends('layouts.app')

@section('title', 'add sub category')

@section ('content')
<div class="container bg-white" style="margin-bottom: 199px;">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <h3>Add Category</h3>
            <hr>
            <form method="POST" action="{{ route('subcategory.store') }}">
                @csrf 
                @method('POST')

                <div class="row ">
                    <div class="col-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name" >Name</label>
                                <input placeholder="Sub name" type="text" class="form-control " name="name" autofocus>
                                @error('name')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name" >Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
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
                
                <button type="submit" class="btn btn-primary">Save</button>
            
            </form>
        </div>
    </div>
</div>

@endsection
