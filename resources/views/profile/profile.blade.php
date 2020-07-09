@extends('layouts.member')

@section('content')

{{-- <div class="row"> --}}
<div class="col-6">
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
            {{ Auth::user()->role=='admin' ? 'Admin ' : 'Member '}}Profile
        </div>
        <div class="card-body">
            @if (Auth::user()->avatar !== null)
                <img class="img-circle" 
                style="width: 50%" 
                src="{{ asset('/storage/'.$user->avatar)}}"
                alt="Card image cap">
            @else
                <img class="img-circle" 
                    style="width: 50%" 
                    src="{{ asset('/storage/images/default-avatar.png') }}" 
                    alt="Card image cap">
            @endif
            <p class="card-text mt-2">
                <span class="badge badge-secondary">Additional info</span><br>
                <div class="alert alert-primary">
                    {{ $user->additional_info }}
                </div>
            </p>
        </div>
        <div class="card-footer">
            <form action="{{ route('avatar.update', Auth::id()) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="d-flex justify-content-between">
                    <input type="file" name="avatar" id="avatar">
                    <button type="submit" class="btn btn-warning">Update Avatar</button>
                </div>
            </form>
        </div>
        </div>
    </div>
<div class="col-4">
    <table class="table table-sm">
        <tbody>
            <tr>
                <th scope="row">Name</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th scope="row">Email</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th scope="row">Phone</th>
                <td>{{ $user->phone }}</td>
            </tr>
            <tr>
                <th scope="row">Address</th>
                <td>{{ $user->address }}</td>
            </tr>
            <tr>
                <th scope="row">Tkdn</th>
                <td>{{ $user->tkdn }}</td>
            </tr>
            <tr>
                <th scope="row">Provinsi</th>
                <td>{{ $user->provinsi_name }}</td>
            </tr>
            <tr>
                <th scope="row">Kabupaten</th>
                <td>{{ $user->kabupaten_name }}</td>
            </tr>
            <tr>
                <th scope="row">Kecamatan</th>
                <td>{{ $user->kecamatan_name }}</td>
            </tr>
            <tr>
                <th scope="row">Zipcode</th>
                <td>{{ $user->zipcode }}</td>
            </tr>
            <tr>
                <th scope="row">Nib</th>
                <td>{{ $user->nib }}</td>
            </tr>
        </tbody>
    </table>
    <div>
        <a href="/profile/edit/{{ Auth::id() }}" class="btn btn-primary text-white">Edit Profile</a>
    </div>
</div>
  {{-- </div> --}}
    
@endsection