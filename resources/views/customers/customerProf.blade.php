@extends('layouts.cusprofheader')
@section('title', 'Customer Profile')
@section('content')
    
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

@endsection
