@extends('layouts.header')
@section('title', 'search')
@section('content')

    <div class="small-container">
        <h3 class="own-title">Results</h3>

        <div class="row">
            @if (count($products) == 0)
                <h3 class="text-center">No results found</h3 >
            @else
                @foreach ($products as $product)
                    <div class="prod-cont mt-3">

                        <a href="{{ route('frontProduct.prodDetail', ['frontProduct' => $product->id]) }}">
                            <img src="{{ url('uploadedimages/' . $product->product_image) }}"
                                alt="{{ $product->product_name }}" height="150px" width="150px"></a>
                        <br><br>
                        <h4>{{ $product->product_name }}</h4>
                        <br>


                        <p>

                        </p>

                    </div>
                @endforeach
            @endif


        </div>
    </div>

@endsection
