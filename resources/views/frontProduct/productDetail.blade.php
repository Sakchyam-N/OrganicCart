@extends('layouts.header')
@section('title', 'Organic Cart')
@section('content')

    <div class="container mt-4">
        <div class="row">
            @if (Session::get('status'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ Session::get('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="col d-flex justify-content-center">
                <img style="box-shadow: rgba(0, 0, 0, 0.2) 0px 20px 30px;border-radius:1em;"
                    src="{{ url('uploadedimages/' . $products[0]->product_image) }}"
                    alt="{{ $products[0]->product_name }}" width="350px" height="350px">
            </div>
            <div class="col-lg-6 col-md-12 col-12 ">
                <div class="row">
                    <div class="col-auto">
                        <h3 class="display-3">{{ $products[0]->product_name }}</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2 ">
                        <h5><b>Rating:</b></h5>
                    </div>
                    <div class="col-sm-5">
                        @php
                            use App\Models\Review;
                            $reviewalluser = Review::where('product_id', $products[0]->id)->get();
                            $rat = 0;
                            $totalrat = 0;
                            if (count($reviewalluser) > 0) {
                                for ($i = 0; $i < count($reviewalluser); $i++) {
                                    $rat += $reviewalluser[$i]->rating;
                                }
                                $totalrat = round($rat / count($reviewalluser));
                                $emptystars = 5 - $totalrat;
                            } else {
                                $emptystars = 5;
                            }
                            
                        @endphp

                        @for ($i = 1; $i <= $totalrat; $i++)
                            <i class='fa fa-star yellow-color'></i>
                        @endfor
                        @for ($i = 1; $i <= $emptystars; $i++)
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                        @endfor
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2 ">
                        <h5><b>From:</b></h5>
                    </div>
                    <div class="col-sm-5">
                        <h5>{{ $shops[0]->shop_name }}</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2 ">
                        <h5><b>By(Trader):</b></h5>
                    </div>
                    <div class="col-sm-5">
                        <h5>{{ $traders[0]->user_name }}</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2 ">
                        <h5><b>Contact:</b></h5>
                    </div>
                    <div class="col-sm-5">
                        <h5>{{ $shops[0]->shop_contact }}</h5>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-sm-2 ">
                        <h5><b>Price:</b></h5>
                    </div>
                    <div class="col-sm-5">
                        <h5>$
                        @if($flag)
                        @php
                            $off = $prod_offers[0]->offer_percentage / 100;
                        @endphp
                        <del>{{$products[0]->product_price }} </del>
                            {{round($products[0]->product_price-($off * $products[0]->product_price ),2)  }}
                        @else
                            {{$products[0]->product_price }}
                        @endif
                        </h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2 ">
                        <h5><b>Avaibility:</b></h5>
                    </div>
                    <div class="col-sm-5">
                        @if ($products[0]->product_quantity > 1)
                            <h5> In Stock</h5>
                        @else
                            <h5> Not in Stock</h5>
                        @endif
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-2">
                        <label for="">
                            <h5> <b> Product Quantity:</b></h5>
                        </label>
                    </div>
                    <div class="col-sm-2">
                        <h5> {{ $products[0]->product_quantity }}</h5>

                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-auto ">
                        <a href="{{ route('carts.edit', ['cart' => $products[0]->id]) }}">
                            <button class="btn btn-primary"><i class="fa fa-shopping-cart"
                                    aria-hidden="true"></i></button></a>
                    </div>
                    
                    <div class="col-auto ">
                        <a href="{{ route('wishlists.edit', ['wishlist' => $products[0]->id]) }}">
                            <button class="btn btn-danger"><i class="fa fa-heart"
                                aria-hidden="true"></i></button></a>
                    </div>
                </div>




            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <h3>Product Details</h3>
                <p>
                <h5>Description : </h5>{{ $products[0]->product_description }}</p>
                <p>
                <h5>Allergy Info: </h5>{{ $products[0]->allergy_details }}</p>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-3 border border-grey">
                    <form action="{{ route('reviews.store') }}" method="post">
                        @csrf
                        <label for="" class="">Rating</label>
                        <div class="product-review-stars">

                            <input type="radio" id="star5" name="rating" value="5" class="visuallyhidden" /><label
                                for="star5" title="Excellent">★</label>
                            <input type="radio" id="star4" name="rating" value="4" class="visuallyhidden" /><label
                                for="star4" title="Pretty good">★</label>
                            <input type="radio" id="star3" name="rating" value="3" class="visuallyhidden" /><label
                                for="star3" title="good">★</label>
                            <input type="radio" id="star2" name="rating" value="2" class="visuallyhidden" /><label
                                for="star2" title="neutral">★</label>
                            <input type="radio" id="star1" name="rating" value="1" class="visuallyhidden" /><label
                                for="star1" title="Bad">★</label>

                        </div>
                        <br>
                        <label for="comment" class="col-sm-2 col-form-label">Comment</label>

                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="comment"></textarea>
                        @error('comment')
                            <div class="form-label text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        <br>
                        <input type="hidden" value="{{ $products[0]->id }}" name="productid">
                        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        <br><br>
                    </form>

                </div>

                <div class="col border border-grey">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td class="">
                                    <div id="accordion">
                                        <div class="card">
                                            <div class="card-header" id="headingTwo">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link collapsed text-decoration-none"
                                                        data-toggle="collapse" data-target="#collapseTwo"
                                                        aria-expanded="false" aria-controls="collapseTwo">
                                                        Ratings and Comments
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                                data-parent="#accordion">
                                                <div class="card-body">
                                                    <span>
                                                        @php
                                                            use App\Models\User;
                                                            
                                                            $user = Session::get('customer');
                                                            $review = Review::where('user_id', Session::get('customerId'))
                                                                ->where('product_id', $products[0]->id)
                                                                ->get();
                                                            if (count($review) > 0) {
                                                                $stars = $review[0]->rating;
                                                                $empty = 5 - $stars;
                                                            }
                                                            $allreview = Review::where('product_id', $products[0]->id)->get();
                                                            $users = User::all();
                                                            
                                                        @endphp

                                                        @if ($user != null && count($review) != 0)
                                                            <h5>{{ $user }}</h5>
                                                            @for ($i = 1; $i <= $stars; $i++)
                                                                <i class='fa fa-star yellow-color'></i>
                                                            @endfor
                                                            @for ($i = 1; $i <= $empty; $i++)
                                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                                            @endfor
                                                            <br>
                                                            <b> Comment: </b>{{ $review[0]->review_statement }}<form
                                                                method="post"
                                                                action="{{ route('reviews.destroy', ['review' => $review[0]->id]) }}">
                                                                @method('delete')
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger"><i
                                                                        class="fa fa-trash"
                                                                        aria-hidden="true"></i></button>
                                                            </form>
                                                            <hr>

                                                        @endif
                                                        @foreach ($allreview as $rev)
                                                            @foreach ($users as $uname)
                                                                @if ($rev->user_id == $uname->id)
                                                                    <h5>{{ $uname->user_name }}</h5>
                                                                    @for ($i = 1; $i <= $rev->rating; $i++)
                                                                        <i class='fa fa-star yellow-color'></i>
                                                                    @endfor
                                                                    @for ($i = 1; $i <= 5 - $rev->rating; $i++)
                                                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                    @endfor
                                                                    <br>
                                                                    <b> Comment: </b>{{ $rev->review_statement }}
                                                                    <hr>
                                                                @endif
                                                            @endforeach
                                                        @endforeach

                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <br><br>
    <div class="row">

    </div>
    <br><br>




@endsection
