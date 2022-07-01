@extends('layouts.traderheader')
@section('title', 'My Profile')
@section('content')
<div class="container ">
    @if (Session::get('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row">
        <div class="col-md-2 left-inforamtion-bar border m-md-3">
            <div class="row">
                <div class="col">
                    <br>
                    <h4 class="text-dark">Information</h4>
                    <a href="{{route('traderprofile')}}" class="text-decoration-none"><h6>My Profile</h6></a>
                    <br>
                </div>
            </div>
            
            <div class="row border-top pt-2">
                <h4 class="text-dark">Security</h4>
                <a href="{{route('traderchangepw')}}" class="text-decoration-none"><h6>Change Password</h6></a>
                <a href="{{ url('/logoutuser')}}" class="text-decoration-none"><h6>Log Out</h6></a>
                <br><br>
            </div>
        </div>

        <div class="col-md-6 offset-md-1 right-profile-edit-bar mt-3">
            <div class="row ps-5 pt-3">
                <div class="col-sm-4 ">
                    <h5>Name: </h5>
                </div>
                <div class="col-sm-5">
                    <h5>{{ $customers[0]->user_name }}</h5>
                </div>
            </div>
            <br>
    
            <div class="row ps-5 pe-3 pt-1">
                <div class="col-sm-4">
                    <h5>Email: </h5>
                </div>
                <div class="col-sm-5">
                    <h5>{{ $customers[0]->user_email }}</h5>
                </div>
            </div>
            <br>
    
            <div class="row ps-5 pe-3 pt-1">
                <div class="col-sm-4">
                    <h5>Date Of Birthday: </h5>
                </div>
                <div class="col-sm-5">
                    <h5>{{ \Carbon\Carbon::parse($customers[0]->user_dob)->format('Y-m-d') }}</h5>
                </div>
            </div>
            <br>
    
            <div class="row ps-5 pe-3 pt-1">
                <div class="col-sm-4">
                    <h5>Address: </h5>
                </div>
                <div class="col-sm-5">
                    <h5> {{ $customers[0]->user_address }}</h5>
                </div>
            </div>
            <br>
    
            <div class="row ps-5 pe-3 pt-1">
                <div class="col-sm-4">
                    <h5>Gender: </h5>
                </div>
                <div class="col-sm-5">
                    <h5> {{ $customers[0]->user_gender }}</h5>
                </div>
            </div>
            <br>
    
    
        </div>
    </div>
</div>
@endsection