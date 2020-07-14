@extends('layouts.member')

@section('title', 'member profile')

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
                <img class="img-thumbnail" 
                style="width: 50%" 
                src="{{ asset('/storage/'.$user->avatar)}}"
                alt="user-avatar">
            @else
                <img class="img-thumbnail" 
                    style="width: 50%" 
                    src="{{ asset('/storage/images/default-avatar.png') }}" 
                    alt="user-avatar">
            @endif
            <p class="card-text mt-2">
                <span class="badge badge-secondary">Additional info</span><br>
                <div class="alert alert-primary">
                    @if (!empty($user->additional_info))
                        {{ $user->additional_info }}
                    @else
                        <p>No info found</p>
                    @endif
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
                @if (!empty($user->phone))
                    <td>{{ $user->phone }}</td>
                @else
                    <td>-</td>
                @endif
            </tr>
            <tr>
                <th scope="row">Address</th>
                @if (!empty($user->address))
                    <td>{{ $user->address }}</td>
                @else
                    <td>-</td>
                @endif
            </tr>
            <tr>
                <th scope="row">Tkdn</th>
                @if (!empty($user->tkdn))
                    <td>{{ $user->tkdn }}</td>
                @else
                    <td>-</td>
                @endif
            </tr>
            <tr>
                <th scope="row">Provinsi</th>
                @if (!empty($provinsi))
                    <td>{{ $provinsi->name }}</td>
                @else
                    <td>-</td>
                @endif
            </tr>
            <tr>
                <th scope="row">Kabupaten</th>
                @if (!empty($kabupaten))
                    <td>{{ $kabupaten->name }}</td>
                @else
                    <td>-</td>
                @endif
            </tr>
            <tr>
                <th scope="row">Kecamatan</th>
                @if (!empty($kecamatan))
                    <td>{{ $kecamatan->name }}</td>
                @else
                    <td>-</td>
                @endif
            </tr>
            <tr>
                <th scope="row">Zipcode</th>
                @if (!empty($kecamatan))
                    <td>{{ $kecamatan->zipcode }}</td>
                @else
                    <td>-</td>
                @endif
            </tr>
            <tr>
                <th scope="row">Nib</th>
                @if (!empty($user->nib))
                    <td>{{ $user->nib }}</td>
                @else
                    <td>-</td>
                @endif
            </tr>
        </tbody>
    </table>
    <div>
        <a href="/profile/edit/{{ Auth::id() }}" style="float: right" class="btn btn-primary text-white">Edit Profile</a>
    </div>
</div>
  {{-- </div> --}}
    
@endsection