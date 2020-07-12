@extends('layouts.member')

@section('title', 'edit contact')

@section ('content')

<div class="col-12 col-md-12 col-sm-12 col-lg-10">
    <h3>Edit Contact</h3>
    <hr>
    <form method="POST" action="{{ route('contact.update', $contact->id) }}">
        @csrf
        @method('PATCH')
        <div class="row ">
            <div class="col-12">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="title" >Company Name</label>
                        <input placeholder="Enter company name" type="text" class="form-control " name="company_name" 
                        value="{{ $contact->company_name }}" autofocus>
                        @error('company_name')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="company_phone" >company_phone</label>
                        <input type="number" class="form-control " name="company_phone" 
                        value="{{ $contact->company_phone }}">
                        @error('company_phone')
                            <div class="alert alert-warning">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="company_email" >company_email</label>
                        <input type="email" class="form-control " name="company_email" 
                        value="{{ $contact->company_email }}">
                        @error('company_email')
                            <div class="alert alert-warning">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="company_address" >company_address</label>
                        <input type="text" class="form-control " name="company_address" 
                        value="{{ $contact->company_address }}">
                        @error('company_address')
                            <div class="alert alert-warning">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="company_country" >company_country</label>
                        <input type="text" class="form-control " name="company_country" 
                        value="{{ $contact->company_country }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="company_whatsapp" >company_whatsapp</label>
                        <input type="text" class="form-control " name="company_whatsapp" 
                        value="{{ $contact->company_whatsapp }}">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="company_telegram" >company_telegram</label>
                        <input type="text" class="form-control " name="company_telegram" 
                        value="{{ $contact->company_telegram }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="company_facebook" >company_facebook</label>
                        <input type="text" class="form-control " name="company_facebook" 
                        value="{{ $contact->company_facebook }}">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="company_instagram" >company_instagram</label>
                        <input type="text" class="form-control " name="company_instagram" 
                        value="{{ $contact->company_instagram }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="company_twitter" >company_twitter</label>
                        <input type="text" class="form-control " name="company_twitter" 
                        value="{{ $contact->company_twitter }}">
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success" style="float: right">Update</button>
    </form>
</div>


    
@endsection