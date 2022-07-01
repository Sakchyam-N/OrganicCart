@extends('layouts.traderheader')
@section('title','Shop ADD')
@section('content')
<div class="container mt-sm-5 border border-warning">
        <div class="row pt-sm-3">
            <div class="col">
                <h4 class="text-center">Shop Form</h4>
                <br>
            </div>
        </div>
        <div class="row " >
            <div class="col form-box" >
                <form class="border-top border-warning pt-sm-3" method="POST" action="{{route('products.shopstore')}}" enctype="multipart/form-data">
                  @csrf
                    <div class="form-group row justify-content-center mt-2">
                        <label for="name" class="col-sm-2 col-form-label">Shop Name</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="name" placeholder="Shop Name" value ="{{old('name')}}" >
                            @error('name')
                                <div class="form-label text-danger">
                                {{$message}}
                                </div>
                            @enderror
                        </div>
                      </div>
                      <br>

                      <div class="form-group row justify-content-center">
                        <label for="address" class="col-sm-2 col-form-label">Shop Address</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="address" placeholder="Shop Address" value ="{{old('address')}}" >
                            @error('address')
                                <div class="form-label text-danger">
                                {{$message}}
                                </div>
                            @enderror
                        </div>
                      </div>
                      <br>

                      <div class="form-group row justify-content-center">
                        <label for="contact" class="col-sm-2 col-form-label">Shop Contact Number</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="contact" placeholder="Shop Contact Number" value ="{{old('contact')}}" >
                            @error('contact')
                                <div class="form-label text-danger">
                                {{$message}}
                                </div>
                            @enderror
                        </div>
                      </div>
                      <br>

                      <div class="form-group row justify-content-center">
                        <label for="category" class="col-sm-2 col-form-label">Product Category</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="category" placeholder="Product Category" value ="{{old('category')}}" >
                            @error('category')
                                <div class="form-label text-danger">
                                {{$message}}
                                </div>
                            @enderror
                        </div>
                      </div>
                      <br>

                      <div class="form-group row justify-content-center">
                        <label for="imageName" class="col-sm-2 col-form-label">Category Image </label>
                        <div class="col-sm-4">
                          <input type="file" class="form-control" name="imageName" placeholder="Image Name" >
                          @error('imageName')
                            <div class="form-label text-danger">
                              {{$message}}
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
                    <br><br>
                  </form>
            </div>
        </div>
    </div>
    <br>
@endsection