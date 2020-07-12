@extends('layouts.member')

@section('title', 'member profile')

@section('content')

{{-- <div class="row"> --}}
    <div class="col-6">
        <div class="card">
            <div class="card-header">
              Member Profile
            </div>
            <div class="card-body">
                <img class="card-img-top" style="width: 50%" src="{{ asset('/storage/images/default-avatar.png') }}" alt="Card image cap">
                <h5 class="card-title">Additional Info</h5>
                <p class="card-text">
                    {{ $user->additional_info }}
                </p>
              <a href="/profile/edit/{{ Auth::id() }}" class="btn btn-primary">Edit Profile</a>
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
                        <th scope="row">Address</th>
                        <td>{{ $user->address }}</td>
                      </tr>
                      <tr>
                        <th scope="row">Nib</th>
                        <td>{{ $user->nib }}</td>
                      </tr>
                    </tbody>
                  </table>
    </div>
  {{-- </div> --}}
    
@endsection