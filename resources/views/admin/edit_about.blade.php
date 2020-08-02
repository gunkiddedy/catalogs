@extends('layouts.app')

@section('title', 'edit about')

@section ('content')
<div class="container-fluid bg-white">
    <div class="row">
        <x-admin-sidebar></x-admin-sidebar>
        <div class="col-md-10 col-sm-12">
            <h3>Edit About</h3>
            <hr>
            <form method="POST" action="{{ route('about.update', $about->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row ">
                    <div class="col-12">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="title" >Title</label>
                                <input placeholder="Enter title" type="text" class="form-control " name="title" 
                                value="{{ $about->title }}" required autocomplete="name" autofocus>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="price" >Description</label>
                        <div class="form-group">
                            <div>
                                <textarea name="description" id="description" rows="10" class="form-control">{{ $about->description }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="price" >Image</label>
                        <div class="form-group">
                            <div>
                                <input type="file" name="image">
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success" style="float: right">Update</button>
            </form>
        </div>
    </div>
</div>


    
@endsection