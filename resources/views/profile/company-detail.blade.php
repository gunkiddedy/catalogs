@extends('layouts.app')

@section('title', 'member profile')

@section('content')

<div class="container bg-white rspnv-container-prdct-detail">
    <div class="row">
        <style>
            .table td,
            .table th { 
                border: 0;
            }
        </style>
        <div class="col-md-12 col-sm-12 col-xs-12">
            @if(Session::has('success'))
            <div class="row sccs">
                <div class="col-12">
                    <div id="charge-message" class="alert alert-success">
                    {{ Session::get('success') }}
                    </div>
                </div>
            </div>
            @endif
            <div class="card mb-4">
                <div class="card-body">
                    <table class="table table-sm">
                        <tbody>
                            <tr>
                                <td colspan="2"><h3>{{ $user->name }}</h3></td>
                            </tr>
                            <tr>
                                <td>
                                    {{ $user ? $user->address : '' }}
                                    {{ $kecamatan ? $kecamatan->name.', ' : '' }}
                                    {{ $kabupaten ? $kabupaten->name.', ' : '' }}
                                    {{ $provinsi ? $provinsi->name.', ' : '' }}
                                    {{ $kecamatan ? $kecamatan->zipcode : '' }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {{ $user ? $user->phone : ''}} - 
                                    {{ $user ? $user->email : ''}}
                                </td>
                            </tr>
                            <tr>
                                @if ( !empty($user->additional_info))
                                    <td>{{ $user->additional_info }}</td>
                                @else
                                    <td></td>
                                @endif
                            </tr>
                            @guest
                                <tr><td>&nbsp;</td></tr>
                            @else
                                @if (Auth::user()->role == 'member')
                                <tr>
                                    <td>
                                        <a href="/profile/edit/{{ $user->id }}" class="btn btn-success text-white">
                                            <i class="fa fa-user"></i> Edit Profile
                                        </a>
                                    </td>
                                </tr>
                                @endif
                            @endguest
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>

    <div id="product" style="margin-bottom: 140px;">
        <company-products></company-products>
    </div>

</div>

    
@endsection