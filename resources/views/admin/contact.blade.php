@extends('layouts.member')

@section('title', 'contact')

@section('content')

{{-- <div class="row"> --}}
    <div class="col-12 col-md-10 col-sm-6 col-xs-12">
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
                <h3>Contact</h3>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tbody>
                        <tr>
                            <th scope="row">Company Name</th>
                            <td>{{ $contact->company_name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Phone</th>
                            <td>{{ $contact->company_phone }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td>{{ $contact->company_email }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Address</th>
                            <td>{{ $contact->company_address }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Country</th>
                            <td>{{ $contact->company_country }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Whatsapp</th>
                            <td>{{ $contact->company_whatsapp }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Telegram</th>
                            <td>{{ $contact->company_telegram }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Facebook</th>
                            <td>{{ $contact->company_facebook }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Instagram</th>
                            <td>{{ $contact->company_instagram }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Twitter</th>
                            <td>{{ $contact->company_twitter }}</td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <a href="/contact/edit/{{ $contact->id}}" class="btn btn-primary text-white">Edit Contact</a>
            </div>
          </div>
        
    </div>
  {{-- </div> --}}
    
@endsection