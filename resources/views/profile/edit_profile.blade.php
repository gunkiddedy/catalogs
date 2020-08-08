@extends('layouts.app')

@section('title', 'edit profile')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-sm-12">
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
                    <div class="form-group col-md-12">
                        <label for="inputCity">NIB</label>
                        <input value="{{ old('nib') ?? $user->nib }}" type="number" class="form-control" id="" name="nib">
                        @error('nib')
                            <div class="alert text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
        
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="email">Email</label>
                        <input value="{{ old('email') ?? $user->email }}" type="email" class="form-control" id="" placeholder="Email" name="email">
                        @error('email')
                            <div class="alert text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <label for="inputCity">Phone</label>
                        <input value="{{ old('phone') ?? $user->phone }}" type="number" class="form-control" id="" name="phone">
                        @error('phone')
                            <div class="alert text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <input value="{{ old('address') ?? $user->address }}" type="text" class="form-control" id="address" placeholder="enter address" name="address">
                    @error('address')
                        <div class="alert text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                
        
                <div id="product">
                    <provi-kabu/>
                    {{-- <div class="form-group col-md-12">
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

                    <div class="form-group col-md-12">
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
                    </div> --}}

                    {{-- <div class="form-group col-md-12">
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
                    </div> --}}
                </div>
        
                <div class="form-group">
                    <label for="zipcode">Zipcode</label>
                    <input value="{{ old('zipcode') ?? $user->zipcode }}" type="number" 
                    class="form-control" id="zipcode" placeholder="enter zipcode" name="zipcode">
                    @error('zipcode')
                        <div class="alert text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
        
                <div class="form-group">
                    <label for="additional_info">Additional Info</label>
                    <textarea class="form-control" id="additional_info" rows="3" name="additional_info">{{ old('additional_info') ?? $user->additional_info }}</textarea>
                </div>
                
                <div class="form-group float-right mt-4">
                    <button type="submit" class="btn btn-primary">Update profile</button>
                    <a class="btn btn-success" href="/company/detail/{{ $user->id }}">Cancel</a>

                </div>
            </form>
        </div>
    </div>
</div>

@endsection