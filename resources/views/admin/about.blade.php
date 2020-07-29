@extends('layouts.app')

@section('title', 'about')

@section('content')
<div class="container">
    <div class="row">
        <x-admin-sidebar></x-admin-sidebar>

        <div class="col-md-10 col-sm-12">
            @if(Session::has('success'))
            <div class="row sccs">
                <div class="col-12">
                    <div id="charge-message" class="alert alert-success">
                    {{ Session::get('success') }}
                    </div>
                </div>
            </div>
            @endif
            <div class="card">
                <div class="card-header">About</div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tbody>
                            <tr>
                                <th scope="row">Title</th>
                                <td>{{ $about ? $about->title : '' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Description</th>
                                <td>{{ $about ? $about->description : '' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Image</th>
                                @if (!empty($about->image))
                                <td>
                                    <img src="{{ asset('storage/'.$about->image) }}" alt="" class="img-thumbnail">
                                </td>  
                                @else
                                <td>
                                    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png" alt="" class="img-thumbnail">
                                </td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="/about/edit/{{ $about ? $about->id : ''}}" class="btn btn-primary text-white">Edit About</a>
                </div>
              </div>
        </div>

    </div>
</div>
    
    
@endsection