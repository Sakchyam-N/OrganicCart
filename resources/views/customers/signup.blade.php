@extends('layouts.header')
@section('title', 'Sign up')
@section('content')
    <div class="container mt-sm-5">
        <div class="row">
            <div class="col form-box ">
                @if (Session::get('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <h4 class="text-center">SIGN UP</h4>
                <h6 class="text-center">Its free and only takes a minute.</h6>
                <form class="border-top border-grey pt-sm-3" action="{{ route('customers.store') }}" method="POST">
                    @csrf
                    <div class="form-group row justify-content-center">
                        <label for="inputFirstName" class="col-sm-2 col-form-label">First Name</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="inputFirstName" placeholder="First Name"
                                value="{{ old('inputFirstName') }}">
                            @error('inputFirstName')
                                <div class="form-label text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="form-group row justify-content-center">
                        <label for="inputLastName" class="col-sm-2 col-form-label">Last Name</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="inputLastName" placeholder="Last Name"
                                value="{{ old('inputLasttName') }}">
                            @error('inputLastName')
                                <div class="form-label text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="form-group row justify-content-center">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="inputEmail" placeholder="Email"
                                value="{{ old('inputEmail') }}">
                            @error('inputEmail')
                                <div class="form-label text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <br>
                    <div class="form-group row justify-content-center">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control" name="password" placeholder="Password"
                                value="{{ old('password') }}">
                            @error('password')
                                <div class="form-label text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="form-group row justify-content-center">
                        <label for="inputConfirmPassword" class="col-sm-2 col-form-label">Confirm Password</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control" name="password_confirmation"
                                placeholder="Confirm Password" value="{{ old('password_confirmation') }}">
                            @error('password_confirmation')
                                <div class="form-label text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="form-group row justify-content-center">
                        <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="inputAddress" placeholder="Address"
                                value="{{ old('inputAddress') }}">
                            @error('inputAddress')
                                <div class="form-label text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="form-group row justify-content-center">
                        <label for="birthday" class="col-sm-2 col-form-label">Date of Birth</label>
                        <div class="col-sm-4">
                            <input type="date" id="birthday" name="birthday" value="{{ old('birthday') }}">
                            @error('birthday')
                                <div class="form-label text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="form-group row justify-content-center">
                        <label for="inputGender" class="col-sm-2 col-form-label">Sex</label>
                        <div class="col-sm-4">
                            <select class="form-select" aria-label="Default select example" name="inputGender">
                                <option value="Male">Male</option>
                                <option value="Female"> Female</option>
                            </select>
                            @error('inputGender')
                                <div class="form-label text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="form-group row justify-content-center">
                        <div class="col-md-6">
                            <input class="form-check-input" type="checkbox" id="defaultCheck1" name="terms&condition">
                            <label class="form-check-label" for="defaultCheck1">
                                By clicking this box you hereby accept to our <a href="{{ route('terms') }}"
                                    class="text-decoration-none" style="color: red">terms and conditions.</a>
                            </label>
                            @error('terms&condition')
                                <div class="form-label text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="form-group row justify-content-center">
                        <div class="col-md-4 ms-5 text-center">
                            <button type="submit" class="btn btn-primary btn-md btn-block w-auto">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

@endsection
