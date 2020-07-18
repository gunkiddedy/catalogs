@extends('layouts.member')

@section('title', 'kecamatan')

@section('content')

<div class="col-lg-9 col-md-6 col-sm-6 col-xs-12">

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
            Kecamatan
            <a href="" class="btn btn-sm btn-success float-right text-white">Add Kecamatan</a>
        </div>
        <div class="card-body">
            <table class="table table-sm">
                <thead>
                    <th>Name</th>
                    <th>Kabupaten</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                @foreach ($kecamatans as $kecamatan)
                    <tr>
                    <td>{{ $kecamatan->name }}</td>
                    <td>{{ $kecamatan->kabupaten_id }}</td>
                    <td>
                        <div class="d-flex justify-content-start">
                            <a href="{{ route('kecamatan.edit', $kecamatan->id) }}" class="btn btn-sm btn-primary mr-1">
                                Edit <i class="fa fa-pencil"></i>
                            </a>
                            <form action="{{ route('kecamatan.delete', $kecamatan->id) }}" method="POST">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-warning">
                                    Delete <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
    
@endsection