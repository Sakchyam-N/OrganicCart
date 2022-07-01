@extends('layouts.header')
@section('title', 'Wishlist')
@section('content')
    <div class="container mt-md-5 border border-bottom-0">
        <div class="row">
            <div class="col">
                <table class="table">
                    @if (Session::get('status'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ Session::get('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (Session::get('pass'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('pass') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if(count($wishprods)>0)
                    <thead>
                        <tr>
                            <th scope="col-auto">S.N</th>
                            <th scope="col-auto">Product Image</th>
                            <th scope="col-auto">Product Name</th>
                            <th scope="col-auto">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($count = 0; $count < count($products); $count++)
                            @for ($counts = 0; $counts < count($wishprods); $counts++)
                                @if ($products[$count]->id == $wishprods[$counts]->product_id)
                                    <tr>
                                        <th scope="row">{{ $counts + 1 }}</th>

                                        <td><a
                                                href="{{ route('frontProduct.prodDetail', ['frontProduct' => $products[$count]->id]) }}">
                                                <img src="{{ url('uploadedimages/' . $products[$count]->product_image) }}"
                                                    alt="{{ $products[$count]->product_name }}" height="150px"
                                                    width="150px">
                                            </a>
                                        </td>

                                        <td>{{ $products[$count]->product_name }}</td>

                                        <td>
                                            <div class="row">
                                                <div class="col-auto">
                                                    <form method="post"
                                                        action="{{ route('wishlists.destroy', ['wishlist' => $products[$count]->id]) }}">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger"><i
                                                                class="fa fa-trash" aria-hidden="true"></i></button>

                                                    </form>
                                                </div>
                                                <div class="col-auto">
                                                    <a
                                                        href="{{ route('carts.edit', ['cart' => $products[$count]->id]) }}"><button
                                                            class="btn btn-primary"><i class="fa fa-shopping-cart"
                                                                aria-hidden="true"></i></button></a>
                                                </div>
                                            </div>


                                        </td>
                                    </tr>
                                @endif
                            @endfor
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="container checkout-buttons mt-md-5  border-top border-grey">
        <div class="row justify-content-end pt-sm-2">
            <div class="col-md-2">
                <a href="#" class="btn btn-outline-success" role="button">Continue Shopping</a>
            </div>
            

        </div>
    </div>
    @else
    <div class="row">
        <div class="col m-3">
            <h3 class="text-center">No items in wishlist</h3>
        </div>
    </div>
    @endif
@endsection
