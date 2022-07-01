@extends('layouts.header')
@section('title', 'Product Rating')
@section('content')

    <link rel="stylesheet" href="{{ asset('css/product-list.css') }}">

    <!------- Top seller Products--------->
    <div class="small-container">
        <h3 class="own-title">TOP RATED PRODUCTS</h3>
        @php
            use App\Models\Product;
            use App\Models\Review;
            use App\Models\Product_Offer;
            
            $review = Review::orderBy('rating', 'desc')->get();
            
        @endphp
        <div class="row">
            @for ($i = 0; $i < count($review); $i++)
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


        </div>
    </div>
@endsection
