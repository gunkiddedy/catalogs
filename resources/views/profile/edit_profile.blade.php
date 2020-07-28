@extends('layouts.app')

@section('title', 'edit profile')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <h3>Edit Profile</h3>
            <hr>
            <form method="POST" enctype="multipart/form-data" action="{{ route('profile.update', $user->id) }}">
                @csrf
                @method('PATCH')
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="name">Name</label>
                        <input value="{{ old('name') ?? $user->name }}" type="name" class="form-control" id="inputEmail4" placeholder="Name" name="name">
                        @error('name')
                            <div class="alert text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
        
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input value="{{ old('email') ?? $user->email }}" type="email" class="form-control" id="" placeholder="Email" name="email">
                        @error('email')
                            <div class="alert text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputCity">Phone</label>
                        <input value="{{ old('phone') ?? $user->phone }}" type="text" class="form-control" id="" name="phone">
                        @error('phone')
                            <div class="alert text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">TKDN</label>
                        <input value="{{ old('tkdn') ?? $user->tkdn }}" type="text" class="form-control" id="" name="tkdn">
                        @error('tkdn')
                            <div class="alert text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputCity">NIB</label>
                        <input value="{{ old('nib') ?? $user->nib }}" type="text" class="form-control" id="" name="nib">
                        @error('nib')
                            <div class="alert text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
        
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="email">Provinsi</label>
                        <select class="form-control" name="provinsi_id">
                            @foreach ($provinsi as $prop)
                            <option value="{{ $prop->id }}" {{$user->provinsi_id == $prop->id  ? 'selected' : ''}}>{{ $prop->name }}</option>
                            @endforeach
                        </select>
                        @error('provinsi_id')
                            <div class="alert text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputCity">Kabupaten</label>
                        <select class="form-control" name="kabupaten_id">
                            @foreach ($kabupaten as $kab)
                            <option value="{{ $kab->id }}" {{$user->kabupaten_id == $kab->id  ? 'selected' : ''}}>{{ $kab->name }}</option>
                            @endforeach
                        </select>
                        @error('kabupaten_id')
                            <div class="alert text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputCity">Kecamatan</label>
                        <select class="form-control" name="kecamatan_id">
                            @foreach ($kecamatan as $kec)
                            <option value="{{ $kec->id }}" {{$user->kecamatan_id == $kec->id  ? 'selected' : ''}}>{{ $kec->name }}</option>
                            @endforeach
                        </select>
                        @error('kecamatan_id')
                            <div class="alert text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
        
                <div class="form-group">
                    <label for="inputAddress">Address</label>
                    <input value="{{ old('address') ?? $user->address }}" type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="address">
                    @error('address')
                        <div class="alert text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
        
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Additional Info</label>
                    <textarea class="form-control" id="" rows="3" name="additional_info">{{ old('additional_info') ?? $user->additional_info }}</textarea>
                </div>
        
                <button type="submit" class="btn btn-primary">Update profile</button>
            </form>
        </div>
    </div>
</div>

@endsection