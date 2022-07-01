@extends('layouts.header')
@section('title', 'Organic Cart')
@section('content')


    <link rel="stylesheet" href="{{ asset('css/product-list.css') }}">

    @if (Session::get('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="container mt-2">
        <div class="row ">
            <div class="col  p-md-2">
                <div class="carousel slide" id="SlideShowBelowNav" data-ride="carousel" data-interval="000">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100"  src="images/Banner1.png" alt="1 Slide" />
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100"  src="images/discount.jpeg" alt="2 Slide" />
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100"  src="images/b3.jpg" alt="3 Slide" />
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100"  src="images/b4.jpg" alt="4 Slide" />
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100"  src="images/b5.jpg" alt="4 Slide" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!------- Top rated Products--------->
    <div class="small-container">
        <h3 class="own-title">TOP RATED PRODUCTS</h3>
        @php
            use App\Models\Product;
            use App\Models\Review;
            use App\Models\Category;
            use App\Models\Product_Offer;
            
            $category = Category::all();
            $review = Review::orderBy('rating', 'desc')->get();
            
        @endphp
        <div class="row">
            @for ($i = 0; $i < 4; $i++)
                <div class="prod-cont mt-3">
                    @php
                        $product = Product::find($review[$i]->product_id);
                        $totalrat = $review[$i]->rating;
                        $empty = 5 - $totalrat;
                    @endphp

                    <a href="{{ route('frontProduct.prodDetail', ['frontProduct' => $product->id]) }}">
                        <img src="{{ url('uploadedimages/' . $product->product_image) }}"
                            alt="{{ $product->product_name }}" height="150px" width="150px"></a>
                    <br><br>
                    <h4>{{ $product->product_name }}</h4>
                    
                    @for ($j = 1; $j <= $totalrat; $j++)
                        <i class='fa fa-star yellow-color'></i>
                    @endfor
                    @for ($k = 1; $k <= $empty; $k++)
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                    @endfor

                    <p>
                        @php
                            $prod_offer = Product_Offer::where('product_id', $product->id)->get();
                            if (count($prod_offer) > 0) {
                                $off = $prod_offer[0]->offer_percentage / 100;
                                $price = round($product['product_price'] - $off * $product['product_price'], 2);
                            } else {
                                $price = $product['product_price'];
                            }
                        @endphp

                        @if (count($prod_offer) > 0)
                            $ <del>{{ $product['product_price'] }}</del> {{ $price }}
                        @else
                            $ {{ $price }}
                        @endif
                    </p>

                </div>
            @endfor


            <div class="prod-cont">
                <a href="{{ url('prodsrating') }}"><img src="images/viewall.png" alt="see more"></a><br><br>
                <h4>See more </h4>

            </div>

        </div>
    </div>
    <!---Categories-->
    <div class="small-container">
        <h3 class="own-title mt-5">CATEGORIES</h3>
        <div class="row">
            @for($i=0;$i<3;$i++)
                <div class="col-auto m-5">

                    <div class="prod-cont">

                        <a href="{{ route('frontProduct.show', ['frontProduct' => $category[$i]->category_name]) }}">
                            <img src="{{ url('uploadedimages/' . $category[$i]->image_name) }}" alt="{{ $category[$i]->category_name }}"
                                height="150px" width="150px"></a>
                        <br><br>
                        <h4>{{ $category[$i]['category_name'] }}</h4>

                    </div>

                </div>
            @endfor
            

            <div class="prod-cont">
                <a class="dropdown-item" href="{{route('frontProduct.index')}}"><img src="images/viewall.png" alt="see more"></a><br><br>
                <h4>See more </h4>

            </div>

        </div>
    @endsection
