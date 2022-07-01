@extends('layouts.traderheader')
@section('title','Offer ADD')
@section('content')
<div class="container mt-sm-5 border">
        <div class="row border-bottom border-warning pt-sm-3">
            <div class="col">
                <h4 class="text-center">{{$products[0]->product_name}} Offer Create Form</h4>
                <br>
            </div>
        </div>
        <div class="row" >
            <div class="col form-box" >
                <form class="border-top border-warning pt-sm-3" method="POST" action="{{route('products.offerStore')}}" enctype="multipart/form-data">
                  @csrf
                    <div class="form-group row justify-content-center">
                        <input type="hidden" name="productid" value="{{$products[0]->id}}">
                        <label for="offerPercentage" class="col-sm-2 col-form-label"> Offer Percentage</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="offerPercentage" placeholder="Offer Percentage" value ="{{old('offerPercentage')}}" >
                            @error('offerPercentage')
                                <div class="form-label text-danger">
                                {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <br>

                    <div class="form-group row justify-content-center">
                        <label for="offerStart" class="col-sm-2 col-form-label">Offer Start Date</label>
                        <div class="col-sm-4">
                          <input type="date" id="offerStart" name="offerStart" value ="{{old('offerStart')}}">
                          @error('offerStart')
                            <div class="form-label text-danger">
                              {{$message}}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <br>

                    <div class="form-group row justify-content-center">
                        <label for="offerEnd" class="col-sm-2 col-form-label">Offer End Date</label>
                        <div class="col-sm-4">
                          <input type="date" id="offerEnd" name="offerEnd" value ="{{old('offerEnd')}}">
                          @error('offerEnd')
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