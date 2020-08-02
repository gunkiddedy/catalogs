@extends('layouts.app')

@section('title', 'edit user')

@section ('content')
<div class="container-fluid bg-white">
    <div class="row">
        <x-admin-sidebar></x-admin-sidebar>

        <div class="col-md-10 col-sm-12">
            <h3>Edit User Status</h3>
            <hr>
            <form method="POST" action="{{ route('user.update', $user->id) }}">
                @csrf
                @method('PATCH')
                <div class="row ">
                    <div class="col-10">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                {{-- <label for="title" >Is Active</label> --}}
                                {{-- <input type="radio" 
                                    name="is_active" 
                                    id="is_active" 
                                    value="1" {{ $user->is_active == 1 ? 'checked' : ''}}> Active
                                    <input type="radio" 
                                    name="is_active" 
                                    id="is_active" 
                                    value="0" {{ $user->is_active == 0 ? 'checked' : ''}}> Incomplete --}}
                                {{-- <input type="number" class="form-control " name="is_active" 
                                value="{{ $user->is_active }}" autofocus> --}}
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>

                                    <input 
                                    class="form-check-input"
                                    type="radio" 
                                    name="is_active" 
                                    id="is_active1" 
                                    value="1" {{ $user->is_active == 1 ? 'checked' : ''}}>

                                    <label class="form-check-label mr-4" for="is_active1">
                                      Active
                                    </label>

                                    <input
                                    class="form-check-input" 
                                    type="radio" 
                                    name="is_active" 
                                    id="is_active2" 
                                    value="0" {{ $user->is_active == 0 ? 'checked' : ''}}>
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