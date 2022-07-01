@extends('layouts.header')
@section('title', 'Trader Register')
@section('content')
    <div class="container mt-sm-5 border">
        <div class="row border-bottom border-grey pt-sm-3">
            <div class="col">
                <h4 class="text-center">Trader Form</h4>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="col form-box">
                @if (Session::get('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form class="border-top border-grey pt-sm-3" method="POST" action="{{ route('trader.storeId') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row justify-content-center">
                        <label for="inputFirstName" class="col-sm-2 col-form-label">Trader Name</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="name" placeholder="Trader Name"
                                value="{{ old('name') }}">
                            @error('name')
                                <div class="form-label text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="form-group row justify-content-center">
                        <label for="shopname" class="col-sm-2 col-form-label">Shop Name</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="shopName" placeholder="Shop Name"
                                value="{{ old('shopName') }}">
                            @error('shopName')
                                <div class="form-label text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="form-group row justify-content-center">
                        <label for="shopnumber" class="col-sm-2 col-form-label">Shop Contact Number</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="shopNumber" placeholder="Shop Contact Number"
                                value="{{ old('shopNumber') }}">
                            @error('shopNumber')
                                <div class="form-label text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="form-group row justify-content-center">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="email" placeholder="Email"
                                value="{{ old('email') }}">
                            @error('email')
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
                        <label for="inputLastName" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="address" placeholder="Address"
                                value="{{ old('address') }}">
                            @error('address')
                                <div class="form-label text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="form-group row justify-content-center">
                        <label for="inputLastName" class="col-sm-2 col-form-label">Product Category</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="productCategory" placeholder="Product Category"
                                value="{{ old('productCategory') }}">
                            @error('productCategory')
                                <div class="form-label text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <br>

                    <div class="form-group row justify-content-center">
                        <label for="imageCat" class="col-sm-2 col-form-label">Category Image </label>
                        <div class="col-sm-4">
                            <input type="file" class="form-control" name="imageCat" placeholder="Image Name">
                            @error('imageCat')
                                <div class="form-label text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <br>

                    <div class="form-group row justify-content-center">
                        <label for="inputDOB" class="col-sm-2 col-form-label">Date of Birth</label>
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
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Sex</label>
                        <div class="col-sm-4">
                            <select class="form-select" aria-label="Default select example" name="gender"
                                value="{{ old('gender') }}">
                                <option selected value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            @error('gender')
                                <div class="form-label text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="form-group row justify-content-center">
                        <label for="inputLastName" class="col-sm-2 col-form-label">Description of Product/Services</label>
                        <div class="col-sm-4">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                name="description">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="form-label text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="form-group row justify-content-center">
                        <div class="col-md-6">
                            <input class="form-check-input" type="checkbox" id="defaultCheck1" name="terms-and-condition">
                            <label class="form-check-label" for="defaultCheck1">
                                By clicking this box you hereby accept to our <a href="{{ route('terms') }}"
                                    class="text-decoration-none" style="color: red">terms and conditions.</a>
                            </label>
                            @error('terms-and-condition')
                                <div class="form-label text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="form-group row justify-content-center">
                        <div class="col-md-4 ms-5">
                            <button type="submit" class="btn btn-primary btn-md btn-block w-100">Submit</button>
                        </div>
                    </div>
                    <br>
                </form>
            </div>
        </div>
    </div>
    <br>
@endsection
