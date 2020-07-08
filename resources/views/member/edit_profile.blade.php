@extends('layouts.member')

@section('content')
            <div class="col-12 col-md-12 col-sm-12 col-lg-10">
                <h3>Edit Profile</h3>
                <hr>
                <form method="POST" enctype="multipart/form-data" action="{{ route('profile.update', Auth::id()) }}">

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="name">Name</label>
                            <input value="{{ $user->name }}" type="name" class="form-control" id="inputEmail4" placeholder="Name" name="name">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="email">Email</label>
                            <input value="{{ $user->email }}" type="email" class="form-control" id="" placeholder="Email" name="email">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputCity">Phone</label>
                            <input value="{{ $user->phone }}" type="text" class="form-control" id="" name="phone">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputCity">NIB</label>
                            <input value="{{ $user->nib }}" type="text" class="form-control" id="" name="nib">
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
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputCity">Kabupaten</label>
                            <select class="form-control" name="kabupaten_id">
                                @foreach ($kabupaten as $kab)
                                <option value="{{ $kab->id }}" {{$user->kabupaten_id == $kab->id  ? 'selected' : ''}}>{{ $kab->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputCity">Kecamatan</label>
                            <select class="form-control" name="kecamatan_id">
                                @foreach ($kecamatan as $kec)
                                <option value="{{ $kec->id }}" {{$user->kecamatan_id == $kec->id  ? 'selected' : ''}}>{{ $kec->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputAddress">Address</label>
                        <input value="{{ $user->address }}" type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="address">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Additional Info</label>
                        <textarea class="form-control" id="" rows="3" name="additional_info">{{ $user->additional_info }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Update profile</button>
                </form>
            </div>
@endsection