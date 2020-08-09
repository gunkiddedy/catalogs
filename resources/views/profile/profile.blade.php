@extends('layouts.app')

@section('title', 'member profile')

@section('content')

<div class="container bg-white">
    <div class="row" >
        
        @if (Auth::user()->role == 'admin')
            <x-admin-sidebar></x-admin-sidebar>
        @endif

        <div class="col-md-10 col-sm-12 col-xs-12">

            @if(Session::has('success'))
                <div class="row sccs">
                    <div class="col-12">
                        <div id="charge-message" class="alert alert-success">
                        {{ Session::get('success') }}
                        </div>
                    </div>
                </div>
            @endif
            
            <table class="table table-sm border-white">
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
                        @if (!empty($user->address) || !empty($propinsi) || !empty($propinsi))
                            <td>
                                {{ $user->address.', ' }}
                                {{ $kabupaten->name.', ' }}
                                {{ $provinsi->name }}
                            </td>
                        @else
                            <td>-</td>
                        @endif
                    </tr>
                    <tr>
                        <th scope="row">Zipcode</th>
                        @if (!empty($user->zipcode))
                            <td>{{ $user->zipcode }}</td>
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
                    <tr>
                        <th scope="row" style="width:200px;">Additional Info</th>
                        @if (!empty($user->additional_info))
                            <td>{{ $user->additional_info }}</td>
                        @else
                            <td>-</td>
                        @endif
                    </tr>
                </tbody>
            </table>
            <div>
                <a href="/profile/edit/{{ Auth::id() }}" class="btn btn-primary text-white">Edit Profile</a>
            </div>
        </div>
    </div>
</div>
@endsection