@extends('layouts.header')
@section('title', 'Category')
@section('content')

    <link rel="stylesheet" href="{{ asset('css/product-list.css') }}">
    <div class="small-container">
        @php
            use App\Models\Review;
            use App\Models\Product_Offer;
        @endphp
        <h3 class="own-title">{{ $catName }}</h3>
        <div class="row d-flex justify-content-center  m-2">
            @if (Session::get('status'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ Session::get('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if(count($products)==0)
                <h3 class="text-center">No products to display</h3>
            @endif
            
            <div class="row d-flex justify-content-center">
                <div class="col-md-auto ">
                    <div class="dropdown show">
                        <a class="dropdown-toggle text-decoration-none text-dark" href="#" role=""
                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Sort By
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a href="{{ route('frontProduct.prodSort', ['frontProduct' => $catName,'sort' =>'asc']) }}" class="text-decoration-none">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="15" height="15">
                                    <path
                                        d="M374.6 246.6C368.4 252.9 360.2 256 352 256s-16.38-3.125-22.62-9.375L224 141.3V448c0 17.69-14.33 31.1-31.1 31.1S160 465.7 160 448V141.3L54.63 246.6c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0l160 160C387.1 213.9 387.1 234.1 374.6 246.6z" />
                                </svg>A-Z
                            </a></li>
                            <li><a href="{{ route('frontProduct.prodSort', ['frontProduct' => $catName,'sort' =>'dsc']) }}"  class="text-decoration-none">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="15" height="15">
                                    <path
                                        d="M374.6 310.6l-160 160C208.4 476.9 200.2 480 192 480s-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 370.8V64c0-17.69 14.33-31.1 31.1-31.1S224 46.31 224 64v306.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0S387.1 298.1 374.6 310.6z" />
                                </svg>Z-A
                            </a></li>
                            <li><a href="{{ route('frontProduct.prodSort', ['frontProduct' => $catName,'sort' =>'priceasc']) }}" class="text-decoration-none">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="15" height="15">
                                    <path
                                        d="M374.6 246.6C368.4 252.9 360.2 256 352 256s-16.38-3.125-22.62-9.375L224 141.3V448c0 17.69-14.33 31.1-31.1 31.1S160 465.7 160 448V141.3L54.63 246.6c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0l160 160C387.1 213.9 387.1 234.1 374.6 246.6z" />
                                </svg>Price Asc
                            </a></li>
                            <li><a href="{{ route('frontProduct.prodSort', ['frontProduct' => $catName,'sort' =>'pricedsc']) }}"  class="text-decoration-none">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="15" height="15">
                                    <path
                                        d="M374.6 310.6l-160 160C208.4 476.9 200.2 480 192 480s-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 370.8V64c0-17.69 14.33-31.1 31.1-31.1S224 46.31 224 64v306.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0S387.1 298.1 374.6 310.6z" />
                                </svg>Price Dsc
                            </a></li>
                        </div>
                    </div>
                </div>
                
                
            </div>
            @foreach ($products as $product)
                <div class="col-auto m-5">

                    <div class="prod-cont">

                        <a href="{{ route('frontProduct.prodDetail', ['frontProduct' => $product->id]) }}" >
                            <img src="{{ url('uploadedimages/' . $product->product_image) }}"
                                alt="{{ $product->product_name }}" height="150px" width="150px"></a>
                        <br><br>
                        <h4>{{ $product['product_name'] }}</h4>
                        @php
                            

                            $review = Review::where('product_id',$product->id)->get();
                            $rat=0;
                            $totalrat =0;   
                            if(count($review)>0){
                                for($i=0;$i<count($review);$i++){
                                    $rat += $review[$i]->rating;
                                }
                                $totalrat = round($rat / count($review));
                                $empty = 5- $totalrat; 
                            }
                            else{
                                $empty =5;
                            }
                            
                        @endphp
                        @for ($i = 1; $i <= $totalrat; $i++)
                            <i class='fa fa-star yellow-color'></i>
                        @endfor
                        @for ($i = 1; $i <= $empty; $i++)
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                        @endfor


                        <p>
                            @php
                                $prod_offer = Product_Offer::where('product_id',$product->id)->get();
                                if(count($prod_offer)>0){
                                    $off = $prod_offer[0]->offer_percentage / 100;
                                    $price = round($product['product_price'] - ($off * $product['product_price']),2);
                                }
                                else{
                                    $price = $product['product_price'];
                                }
                            @endphp

                            @if(count($prod_offer)>0)
                                $ <del>{{$product['product_price']}}</del> {{$price}}
                            @else
                                {{$price}}
                            @endif
                        </p>


                        
                        <a href="{{ route('carts.edit', ['cart' => $product->id]) }}"><button class="btn btn-primary"><i class="fa fa-shopping-cart" aria-hidden="true"></i></button></a>
                        <a href="{{ route('wishlists.edit', ['wishlist' => $product->id]) }}"><button class="btn btn-danger"><i class="fa fa-heart" aria-hidden="true"></i></button></a>
                        
                    </div>

                </div>
            @endforeach

        </div>
    </div>

@endsection
