@extends('layouts.member')

@section('content')

{{-- <div class="row"> --}}
    <div class="col-12 col-md-10 col-sm-6 col-xs-12">
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
            <div class="card-header">
              About
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tbody>
                        <tr>
                            <th scope="row">Title</th>
                            <td>{{ $about->title }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Description</th>
                            <td>{{ $about->description }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Image</th>
                            <td>
                                <img src="{{ asset('storage/'.$about->image) }}" alt="" class="img-thumbnail">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <a href="/about/edit/{{ $about->id}}" class="btn btn-primary">Edit About</a>
            </div>
          </div>
        
    </div>
  {{-- </div> --}}
    
@endsection