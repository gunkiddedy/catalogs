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
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>
                                    @if ($user->is_active == 1)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-warning">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    @if($user->is_active == 0)
                                    <div class="d-flex justify-content-start">
                                        <a href="{{ route('company.detail', $user->id) }}" class="text-white btn btn-sm btn-secondary mr-1">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        <form method="POST" action="{{ route('user.update', $user->id) }}">
                                            @csrf 
                                            @method('PATCH')
                                            <input type="hidden" name="is_active" value="1">
                                            <button type="submit" class="mr-1 btn btn-sm btn-success">
                                                <i class="fa fa-level-up"></i> Approve
                                            </button>
                                        </form>
                                    </div>
                                    @elseif($user->is_active == 1)
                                    <div class="d-flex justify-content-start">
                                        <a href="{{ route('company.detail', $user->id) }}" class="text-white btn btn-sm btn-secondary mr-1">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        <form method="POST" action="{{ route('user.update', $user->id) }}">
                                            @csrf 
                                            @method('PATCH')
                                            <input type="hidden" name="is_active" value="0">
                                            <button type="submit" class="mr-1 btn btn-sm btn-warning">
                                                <i class="fa fa-level-down"></i> Set to inactive</button>
                                        </form>
                                        <form method="POST" action="{{ route('user.delete', $user->id) }}">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" class="mr-1 btn btn-sm btn-danger">
                                                <i class="fa fa-trash"></i> Remove and Blacklist</button>
                                        </form>
                                        <a href="mailto:{{ $user->email }}" class="btn btn-primary btn-sm text-white">
                                            <i class="fa fa-envelope"></i> {{ $user->email }}
                                        </a>
                                    </div>
                                    @endif
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