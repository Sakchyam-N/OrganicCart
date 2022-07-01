@extends('layouts.traderheader')
@section('title', 'Change Password')
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

        <div class="col-md-6 offset-md-1 right-profile-edit-bar mt-3 border border-grey ">
            <div class="row ps-5 pt-3">
                <div class="col-sm-2 ">
                    <h5>Name: </h5>
                </div>
                <div class="col-sm-5">
                    <h5>{{ $traders[0]->user_name }}</h5>
                </div>
            </div>
            <br>
    
            <div class="row ps-5 pe-4 pt-1">
                <div class="col-sm-2">
                    <h5>Email: </h5>
                </div>
                <div class="col-sm-5">
                    <h5>{{ $traders[0]->user_email }}</h5>
                </div>
            </div>
    
            <form class="pt-sm-3" action="{{route('trader.update')}}" method="post">
                @csrf
                
                <div class="row ps-5 pt-3">
                    <div class="col-sm-2">
                        <label for="password">
                            <h5>Password: </h5>
                        </label>
                    </div>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    </div>
                    @error('password')
                        <div class="form-label text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <br><br>
    
                <div class="form-group row">
                    <div class="col-md-4 offset-sm-3">
                        <button type="submit" class="btn btn-primary btn-md btn-block w-100">Submit</button>
                    </div>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>
@endsection