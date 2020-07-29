@extends('layouts.app')

@section('title', 'kabupaten')

@section('content')

<div class="container">
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
                    Kabupaten
                    <a href="" class="btn btn-sm btn-success float-right text-white">Add Kabupaten</a>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <th>Name</th>
                            <th>Provinsi Id</th>
                            {{-- <th>Aksi</th> --}}
                        </thead>
                        <tbody>
                        @foreach ($kabupatens as $kabupaten)
                            <tr>
                            <td>{{ $kabupaten->name }}</td>
                            <td>{{ $kabupaten->provinsi_id }}</td>
                            {{-- <td>
                                <div class="d-flex justify-content-start">
                                    <a href="{{ route('kabupaten.edit', $kabupaten->id) }}" class="btn btn-sm btn-primary mr-1">
                                        Edit <i class="fa fa-pencil"></i>
                                    </a>
                                    <form action="{{ route('kabupaten.delete', $kabupaten->id) }}" method="POST">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-warning">
                                            Delete <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td> --}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $kabupatens->links() }}
                </div>
            </div>
        </div>

    </div>
</div>

    
@endsection