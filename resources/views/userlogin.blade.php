@extends('layouts.onlyfooter')
@section('title', 'Log in')
@section('content')


    <div class="container mt-sm-5">

        <div class="row">
            <div class="col-md me-md-5">
                <div class="row border">
                    <div class="col">
                        <img src="{{url('images/aboutlogo.jpg')}}" alt="">
                    </div>
                </div>
                <br><br>
                <div class="row border border-grey pt-sm-2">
                    <div class="col">
                        <h5 class="text-center">PERKS OF LOGIN</h5>
                        <p class="text-center">After logging in, you will get to know more about the items and get a clear
                            vision. You'll be informed of the offers as they were in the event only if you register your
                            account. Also, you'll get different choices. More critically, you get to rate and review your
                            purchased items and have your possess wishlist too. So, To urge more data, Don't disregard to
                            log in.</p>
                    </div>
                </div>
            </div>

            <div class="col p-sm-4 shadow p-3 mb-5 bg-white rounded">
                @if (Session::get('status'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ Session::get('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form method="POST" action="{{ route('user.login') }}">
                    @csrf
                    <blockquote class="blockquote text-center">
                        <h2>Login</h2>
                    </blockquote>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-7">
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="role" class="col-sm-2 col-form-label">Role</label>
                        <div class="col-sm-7">
                            <select class="form-select" aria-label="Default select example" name="role">
                                <option selected value="Customer">Customer</option>
                                <option value="Trader">Trader</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <a href="" class="text-decoration-none">
                        <h6 class="text-center me-5">Forgot Password?</h6>
                    </a>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-11 text-center">
                            <button type="submit" class="btn btn-primary btn-md btn-block w-auto ">Log in</button>
                        </div>
                    </div>

                    <br>
                    <a href="{{ route('customers.create') }}" class="text-decoration-none">
                        <h6 class="text-center me-5"><u>Sign Up</u></h6>
                    </a>
                    <p class="text-center">and discover a great amount of new opportunities!</p>
                </form>
            </div>
        </div>
    </div>
@endsection
