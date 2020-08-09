@extends('layouts.app')

@section('title', 'emails blacklist')

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
                    <h3>Email Blacklist</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($emails as $email)
                            <tr>
                                <td>{{ $email->name }}</td>
                                <td>{{ $email->email }}</td>
                                <td>
                                    <div class="d-flex justify-content-start">
                                        <form method="POST" action="{{ route('blacklist.delete', $email->id) }}">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" class="mr-1 btn btn-sm btn-danger">
                                                <i class="fa fa-trash"></i> Delete</button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div>
                        {{ $emails->links() }}
                    </div>
                </div>
            </div>                
        </div>

    </div>
</div>

    
@endsection