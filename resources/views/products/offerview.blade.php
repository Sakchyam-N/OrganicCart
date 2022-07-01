@extends('layouts.traderheader')
@section('title', 'All Product Offers')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col"><button class="btn btn-primary">PRODUCT RECORDS</button></div>
        </div>
        <br>
        <div class="row table-responsive">
            <div class="col">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center align-middle">ID</th>
                            <th scope="col" class="text-center align-middle">Name</th>
                            <th scope="col" class="text-center align-middle">Image</th>
                            <th scope="col" class="text-center align-middle">Price</th>
                            <th scope="col" class="text-center align-middle">Offer</th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            @foreach ($shops as $shop)
                                @foreach ($product_offers as $product_offer)
                                    @foreach ($offers as $offer)
                                        @if ($product_offer['product_id'] == $product['id'] && $offer['id'] == $product_offer['offer_id'] && $shop['id'] == $product['shop_id'])
                                            <tr>
                                                <th scope="row" class="text-center align-middle">{{ $product['id'] }}</th>
                                                <td class="text-center align-middle">{{ $product['product_name'] }}</td>
                                                <td class="text-center align-middle"><img
                                                        src="{{ url('uploadedimages/' . $product->product_image) }}"
                                                        alt="{{ $product->product_image }}" width="170px" height="170px">
                                                </td>
                                                <td class="text-center align-middle">${{ $product['product_price'] }}</td>
                                                <td class="text-center align-middle">
                                                    {{ $product_offer['offer_percentage'] }}%</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row"></div>
    </div>
@endsection
