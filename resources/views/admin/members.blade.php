@extends('layouts.member')

@section('title', 'member list')

@section ('content')

<div class="col-12 col-md-12 col-sm-12 col-lg-10">
    @if(Session::has('success'))
    <div class="row sccs">
        <div class="col-12">
            <div id="charge-message" class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-12">
            <h3>Member list</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Address</th>
                        <th scope="col">Kecamatan</th>
                        <th scope="col">Kabupaten</th>
                        <th scope="col">Propinsi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->address }}</td>
                        <td>
                            {{ \App\User::find($user->id)->kecamatan ? \App\User::find($user->id)->kecamatan->name : '-'}}
                        </td>
                        <td>
                            {{ \App\User::find($user->id)->kabupaten ? \App\User::find($user->id)->kabupaten->name : '-'}}
                        </td>
                        <td>
                            {{ \App\User::find($user->id)->provinsi ? \App\User::find($user->id)->provinsi->name : '-'}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
    
@endsection