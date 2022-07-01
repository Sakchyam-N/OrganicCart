@extends('layouts.traderheader')
@section('title','View Products')
@section('content')

<style>
  .own-title{
    text-align: center;
    margin: 0px 0px 20px;
    position: relative;
    line-height: 60px;
    color: #555;
    
}

.own-title:after{
    content:'';
    background: #FF933B;
     /*5EFF00*/
    width: 70px;
    height: 4px;
    border-radius: 5px;
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
}
  </style>

    <div class="container p-3 border border-warning mt-2 rounded shadow  bg-white rounded">
      @if(Session::get('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{Session::get('status')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

      @if(Session::get('failshop'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{Session::get('failshop')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif
    <h3 class="own-title">SHOPS</h3>
      <div class="row d-flex justify-content-center  m-2">
        
        @foreach($shops as $shop)
          @if($shop->user_id == Session::get('traderId'))
              <div class="col-auto ">
                <div class="card" style="width: 20rem;"><img src="{{url('images/shop.png')}}" class="card-img-top" alt="shop img">
                  <div class="card-body">
                    <h5 class="card-title">Name: {{$shop['shop_name']}}</h5>
                    <br>
                    <a href="{{route('products.show',['product'=>$shop['id']] )}}" class="btn btn-primary">Manage products</a>
                  </div>
                </div>
              </div>
          @endif
        @endforeach
      </div>
      
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
@endsection

