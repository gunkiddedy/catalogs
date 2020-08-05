@extends('layouts.app')

@section('title', 'member list')

@section ('content')
<div class="container-fluid bg-white">
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
                <div class="card-header">
                    <h3>Users list</h3>
                </div>
                <div class="card-body" style="overflow: scroll">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                {{-- <th scope="col">Address</th> --}}
                                <th scope="col">Status</th>
                                {{-- <th scope="col">Kecamatan</th>
                                <th scope="col">Kabupaten</th>
                                <th scope="col">Propinsi</th> --}}
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                {{-- <td width="300">
                                    {{ $user->address }} ,
                                    {{ \App\User::find($user->id)->kecamatan ? \App\User::find($user->id)->kecamatan->name : '-'}},
                                    {{ \App\User::find($user->id)->kabupaten ? \App\User::find($user->id)->kabupaten->name : '-'}},
                                    {{ \App\User::find($user->id)->provinsi ? \App\User::find($user->id)->provinsi->name : '-'}}
                                </td> --}}
                                <td>
                                    @if ($user->is_active == 1)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-warning">Inactive</span>
                                    @endif
                                </td>
                                {{-- <td>
                                    {{ \App\User::find($user->id)->kecamatan ? \App\User::find($user->id)->kecamatan->name : '-'}}
                                </td>
                                <td>
                                    {{ \App\User::find($user->id)->kabupaten ? \App\User::find($user->id)->kabupaten->name : '-'}}
                                </td>
                                <td>
                                    {{ \App\User::find($user->id)->provinsi ? \App\User::find($user->id)->provinsi->name : '-'}}
                                </td> --}}

                                <td>
                                    <div class="d-flex justify-content-start">
                                        <form method="POST" action="{{ route('user.update', $user->id) }}">
                                            @csrf 
                                            @method('PATCH')
                                            {{-- <a href="{{ route('user.edit', $user->id) }}" class="text-white btn btn-sm btn-success mr-1">
                                                <i class="fa fa-thumbs-up"></i> Approve
                                            </a> --}}
                                            <input type="hidden" name="is_active" value="1">
                                            <button type="submit" class="mr-1 btn btn-sm btn-success">
                                                <i class="fa fa-thumbs-up"></i> Approve</button>
                                        </form>
                                        <a href="{{ route('company.detail', $user->id) }}" class="text-white btn btn-sm btn-primary mr-1">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        {{-- <form action="{{ route('user.delete', $user->id) }}" method="POST">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                Delete <i class="fa fa-trash"></i>
                                            </button>
                                        </form> --}}
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>                
        </div>

    </div>
</div>

    
@endsection