@extends('layouts.cusprofheader')
@section('title', 'Change Password')
@section('content')
    @php
        use App\Models\Product;
    @endphp
    <div class="col-md-6 offset-md-1 right-profile-edit-bar mt-3 border border-grey ">
        <div class="row p-2">
            <h5 class="text-center"><b>{{ Session::get('customer') }}</b></h5>
        </div>
        
        @foreach ($reviews as $review)
            <div class="row">
                <div class="col-sm-2 ">
                    <h5><b>Product:</b></h5>
                </div>
                <div class="col">
                    @php
                        $product = Product::where('id', $review->product_id)->get();
                    @endphp
                    <h5><a href="{{ route('frontProduct.prodDetail', ['frontProduct' => $review->product_id]) }}" >{{ $product[0]->product_name }}</a></h5>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2 ">
                    <h5><b>Rating:</b></h5>
                </div>
                <div class="col-sm-5">
                    @php
                        $totalrat = $review->rating;
                        $emptystars = 5 - $totalrat;
                        
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
                    <h5><b>Comment:</b></h5>
                </div>
                <div class="col-sm-5">
                    {{ $review->review_statement }}
                </div>
            </div>
            <hr>
        @endforeach
    </div>

@endsection
