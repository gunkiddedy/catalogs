@extends('layouts.member')

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
                        <th scope="col">Propinsi</th>
                        <th scope="col">Kabupaten</th>
                        <th scope="col">Kecamatan</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->provinsi_name }}</td>
                        <td>{{ $user->kabupaten_name }}</td>
                        <td>{{ $user->kecamatan_name }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
    
@endsection