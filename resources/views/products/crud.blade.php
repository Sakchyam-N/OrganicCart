@extends('layouts.traderheader')
@section('title', 'CRUD')
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
        <div class="row">
            <div class="col"><a href="{{ route('products.create') }}"><button class="btn btn-primary float-end">+
                        Add New Product</button></a></div>
        </div>
        <div class="row table-responsive">
            <div class="col ">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center align-middle">ID</th>
                            <th scope="col" class="text-center align-middle">Image</th>
                            <th scope="col" class="text-center align-middle">Name</th>
                            <th scope="col" class="text-center align-middle">Price</th>
                            <th scope="col" class="text-center align-middle">Category</th>
                            <th scope="col" class="text-center align-middle">Shop</th>
                            <th scope="col" class="text-center align-middle">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            @foreach ($shops as $shop)
                                @foreach ($categories as $category)
                                    @if ($category['id'] == $product['categories_id'] && $shop['id'] == $product['shop_id'])
                                        <tr>
                                            <th scope="row" class="text-center align-middle">{{ $product['id'] }}</th>
                                            <td class="text-center align-middle"><img
                                                    src="{{ url('uploadedimages/' . $product->product_image) }}"
                                                    alt="{{ $product->product_image }}" width="150px" height="150px"></td>
                                            <td class="text-center align-middle">{{ $product['product_name'] }}</td>
                                            <td class="text-center align-middle">${{ $product['product_price'] }}</td>
                                            <td class="text-center align-middle">{{ $category['category_name'] }}</td>
                                            <td class="text-center align-middle">{{ $shop['shop_name'] }}</td>
                                            <td class="align-middle">
                                                <div class="d-flex justify-content-center">
                                                    <a class="text-decoration-none text-white"
                                                        href="{{ route('products.edit', ['product' => $product->id]) }}"><button
                                                            class="btn btn-primary">Edit</button></a>&nbsp;&nbsp;
                                                    <a class="text-decoration-none text-white"
                                                        href="{{ route('products.offer', ['product' => $product->id]) }}"><button
                                                            class="btn btn-success">Add Offer</button></a>&nbsp;&nbsp;
                                                    <form method="post"
                                                        action="{{ route('products.destroy', ['product' => $product->id]) }}">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
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
