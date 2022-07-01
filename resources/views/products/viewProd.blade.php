@extends('layouts.traderheader')
@section('title', 'All Products')
@section('content')

    @if (Session::get('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
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
                            <th scope="col" class="text-center align-middle">
                                Name
                                
                                    <a href="{{ route('products.sort', ['product' => 'asc']) }}"
                                        class="text-decoration-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="12"
                                            height="12">
                                            <path
                                                d="M374.6 246.6C368.4 252.9 360.2 256 352 256s-16.38-3.125-22.62-9.375L224 141.3V448c0 17.69-14.33 31.1-31.1 31.1S160 465.7 160 448V141.3L54.63 246.6c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0l160 160C387.1 213.9 387.1 234.1 374.6 246.6z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('products.sort', ['product' => 'dsc']) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="12"
                                            height="12">
                                            <path
                                                d="M374.6 310.6l-160 160C208.4 476.9 200.2 480 192 480s-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 370.8V64c0-17.69 14.33-31.1 31.1-31.1S224 46.31 224 64v306.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0S387.1 298.1 374.6 310.6z" />
                                        </svg>
                                    </a>

            </div>

            </th>
            <th scope="col" class="text-center align-middle">Image</th>
            <th scope="col" class="text-center align-middle">Price</th>
            <th scope="col" class="text-center align-middle">Category</th>
            <th scope="col" class="text-center align-middle">Shop</th>


            </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    @foreach ($shops as $shop)
                        @foreach ($categories as $category)
                            @if ($category['id'] == $product['categories_id'] && $shop['id'] == $product['shop_id'] && $shop['user_id'] == Session::get('traderId'))
                                <tr>
                                    <th scope="row" class="text-center align-middle">{{ $product['id'] }}</th>
                                    <td class="text-center align-middle">{{ $product['product_name'] }}</td>
                                    <td class="text-center align-middle"><img
                                            src="{{ url('uploadedimages/' . $product->product_image) }}"
                                            alt="{{ $product->product_image }}" width="170px" height="170px"></td>
                                    <td class="text-center align-middle">${{ $product['product_price'] }}</td>
                                    <td class="text-center align-middle">{{ $category['category_name'] }}</td>
                                    <td class="text-center align-middle">{{ $shop['shop_name'] }}</td>
                                </tr>
                            @endif
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
