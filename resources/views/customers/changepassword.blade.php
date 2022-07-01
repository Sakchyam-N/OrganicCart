@extends('layouts.cusprofheader')
@section('title', 'Change Password')
@section('content')

    <div class="col-md-6 offset-md-1 right-profile-edit-bar mt-3 border border-grey ">
        <div class="row ps-5 pt-3">
            <div class="col-sm-2 ">
                <h5>Name: </h5>
            </div>
            <div class="col-sm-5">
                <h5>{{ $customers[0]->user_name }}</h5>
            </div>
        </div>
        <br>

        <div class="row ps-5 pe-4 pt-1">
            <div class="col-sm-2">
                <h5>Email: </h5>
            </div>
            <div class="col-sm-5">
                <h5>{{ $customers[0]->user_email }}</h5>
            </div>
        </div>

        <form class="pt-sm-3" action="{{route('customers.update',['customer' => Session::get('customerId')])}}" method="post">
            @csrf
            @method('PUT')
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

@endsection
