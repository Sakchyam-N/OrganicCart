@extends('layouts.traderheader')
@section('title','Product ADD')
@section('content')
<div class="container mt-sm-5 border">
        <div class="row border-bottom border-grey pt-sm-3">
            <div class="col">
                <h4 class="text-center">Product Form</h4>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="col form-box">
                <form class="border-top border-grey pt-sm-3" method="POST" action="{{route('products.store')}}" enctype="multipart/form-data">
                  @csrf
                    <div class="form-group row justify-content-center">
                        <label for="productName" class="col-sm-2 col-form-label">Product Name</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="name" placeholder="Product Name" value ="{{old('name')}}" >
                            @error('name')
                                <div class="form-label text-danger">
                                {{$message}}
                                </div>
                            @enderror
                        </div>
                      </div>
                      <br>

                      <div class="form-group row justify-content-center">
                        <label for="imageName" class="col-sm-2 col-form-label">Product Image </label>
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
                        <label for="productPrice" class="col-sm-2 col-form-label">Product Price</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" name="productPrice" placeholder="Product Price" value ="{{old('productPrice')}}">
                          @error('productPrice')
                            <div class="form-label text-danger">
                              {{$message}}
                            </div>
                          @enderror
                        </div>
                      </div>
                      <br>

                      <div class="form-group row justify-content-center">
                        <label for="productQuantity" class="col-sm-2 col-form-label">Product Quantity</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" name="productQuantity" placeholder="Product Quantity" value ="{{old('productQuantity')}}">
                          @error('productQuantity')
                            <div class="form-label text-danger">
                              {{$message}}
                            </div>
                        @enderror
                        </div>
                      </div>
                    <br>
                    
                    <div class="form-group row justify-content-center">
                      <label for="maxOrder" class="col-sm-2 col-form-label">Max Order</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" name="maxOrder" placeholder="Max Order" value ="{{old('maxOrder')}}">
                        @error('maxOrder')
                            <div class="form-label text-danger">
                              {{$message}}
                            </div>
                        @enderror
                      </div>
                    </div>
                    <br>

                    <div class="form-group row justify-content-center">
                      <label for="minOrder" class="col-sm-2 col-form-label">Min Order</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" name="minOrder" placeholder="Min Order" value ="{{old('minOrder')}}">
                        @error('minOrder')
                            <div class="form-label text-danger">
                              {{$message}}
                            </div>
                        @enderror
                      </div>
                    </div>
                    <br>

                    <div class="form-group row justify-content-center">
                        <label for="shop" class="col-sm-2 col-form-label">Shop</label>
                        <div class="col-sm-4">
                            <select class="form-select" aria-label="Default select example" name ="shop" value ="{{old('shop')}}">
                            <option  value="">Choose Shop</option>
                              @foreach($shops as $shop)
                                @if($shop['user_id'] == Session::get('traderId'))
                                  <option  value="{{$shop['id']}}" >{{$shop['shop_name']}}</option>
                                @endif
                              @endforeach
                            </select>

                           
                            @error('shop')
                              <div class="form-label text-danger">
                                {{$message}}
                              </div>
                            @enderror
                        </div>
                    </div>
                    <br>

                    <div class="form-group row justify-content-center">
                        <label for="category" class="col-sm-2 col-form-label">category</label>
                        <div class="col-sm-4">
                            <select class="form-select" aria-label="Default select example" name ="category" value ="{{old('category')}}">
                            <option  value="">Choose Category</option>
                              @foreach($categories as $category)
                                <option  value="{{$category['id']}}">{{$category['category_name']}}</option>
                              @endforeach
                            </select>
                            @error('category')
                              <div class="form-label text-danger">
                                {{$message}}
                              </div>
                            @enderror
                        </div>
                    </div>
                    <br>

                    <div class="form-group row justify-content-center">
                        <label for="inputmanu" class="col-sm-2 col-form-label">Date of Manufacture</label>
                        <div class="col-sm-4">
                          <input type="date" id="manufacture" name="manufacture" value ="{{old('manufacture')}}">
                          @error('manufacture')
                            <div class="form-label text-danger">
                              {{$message}}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <br>

                    <div class="form-group row justify-content-center">
                        <label for="inputexp" class="col-sm-2 col-form-label">Date of Expiry</label>
                        <div class="col-sm-4">
                          <input type="date" id="expiry" name="expiry" value ="{{old('expiry')}}">
                          @error('expiry')
                            <div class="form-label text-danger">
                              {{$message}}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <br>

                    <div class="form-group row justify-content-center">
                      <label for="desc" class="col-sm-2 col-form-label">Description of Product</label>
                      <div class="col-sm-4">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" >{{old('description')}}</textarea>
                          @error('description')
                            <div class="form-label text-danger">
                              {{$message}}
                            </div>
                          @enderror
                      </div>
                    </div>
                    <br>

                    <div class="form-group row justify-content-center">
                      <label for="allergy" class="col-sm-2 col-form-label">Allergy Description</label>
                      <div class="col-sm-4">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="allergy" >{{old('allergy')}}</textarea>
                          @error('allergy')
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
                    <br>
                  </form>
            </div>
        </div>
    </div>
    <br>
@endsection