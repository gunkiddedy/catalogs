@extends('layouts.app')

@section('title', 'category and subcategory')

@section('content')

<div class="container-fluid bg-white">
    <div class="row">
        <x-admin-sidebar></x-admin-sidebar>
        
        <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">

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
                    Categories
                    <a href="{{ route('category.add') }}" class="btn btn-sm btn-success float-right text-white">
                        <i class="fa fa-plus"></i> Add</a>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <th>Name</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                        @foreach ($categories as $category)
                            <tr>
                            <td>{{ $category->name }}</td>
                            <td>
                                <div class="d-flex justify-content-start">
                                    <a href="{{ route('category.edit', $category->id) }}" class="btn btn-sm btn-primary mr-1">
                                        Edit <i class="fa fa-pencil"></i>
                                    </a>
                                    {{-- <form action="{{ route('category.delete', $category->id) }}" method="POST">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-warning">
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
                    {{ $categories->links() }}
                </div>
            </div>
        </div>

        <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">

            @if(Session::has('success_subcat'))
            <div class="row sccs">
                <div class="col-12">
                    <div id="charge-message" class="alert alert-primary">
                    {{ Session::get('success_subcat') }}
                    </div>
                </div>
            </div>
            @endif
        
            <div class="card">
                <div class="card-header">
                    Sub Categories
                    <a href="{{ route('subcategory.add') }}" class="btn btn-sm btn-success float-right text-white">
                        <i class="fa fa-plus"></i> Add</a>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                        @foreach ($subcategories as $subcategory)
                            <tr>
                            <td>{{ $subcategory->name }}</td>
                            <td>{{ \App\Category::find($subcategory->category_id)->name  }}</td>
                            <td>
                                <div class="d-flex justify-content-start">
                                    <a href="{{ route('subcategory.edit', $subcategory->id) }}" class="btn btn-sm btn-primary mr-1">
                                        Edit <i class="fa fa-pencil"></i>
                                    </a>
                                    {{-- <form action="{{ route('subcategory.delete', $subcategory->id) }}" method="POST">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-warning">
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
                    {{ $subcategories->links() }}
                </div>
            </div>
        </div>

    </div>
</div>



    
    
@endsection