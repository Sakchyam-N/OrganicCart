@extends('layouts.header')
@section('title', 'All category')
@section('content')

    <h3 class="own-title">Categories</h3>
    <div class="row d-flex justify-content-center  m-2">
        <div class="row d-flex justify-content-center">
            <div class="col-auto" style="font-size: 16px;">Sort by name: </div>
            <div class="col-auto border border-grey ">
                <a href="{{ route('frontProduct.catSort', ['frontProduct' => 'asc']) }}" class="text-decoration-none">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="15" height="15">
                        <path
                            d="M374.6 246.6C368.4 252.9 360.2 256 352 256s-16.38-3.125-22.62-9.375L224 141.3V448c0 17.69-14.33 31.1-31.1 31.1S160 465.7 160 448V141.3L54.63 246.6c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0l160 160C387.1 213.9 387.1 234.1 374.6 246.6z" />
                    </svg>A-Z
                </a>

            </div>
            <div class="col-auto border border-grey">
                <a href="{{ route('frontProduct.catSort', ['frontProduct' => 'dsc']) }}"  class="text-decoration-none">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="15" height="15">
                        <path
                            d="M374.6 310.6l-160 160C208.4 476.9 200.2 480 192 480s-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 370.8V64c0-17.69 14.33-31.1 31.1-31.1S224 46.31 224 64v306.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0S387.1 298.1 374.6 310.6z" />
                    </svg>Z-A
                </a>
            </div>
        </div>
        @foreach ($category as $cat)
            <div class="col-auto m-5">

                <div class="prod-cont">

                    <a href="{{ route('frontProduct.show', ['frontProduct' => $cat->category_name]) }}">
                        <img src="{{ url('uploadedimages/' . $cat->image_name) }}" alt="{{ $cat->category_name }}"
                            height="150px" width="150px"></a>
                    <br><br>
                    <h4>{{ $cat['category_name'] }}</h4>

                </div>

            </div>
        @endforeach
    </div>

@endsection
