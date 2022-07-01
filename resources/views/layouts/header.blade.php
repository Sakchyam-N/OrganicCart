<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ url('css/product-list.css') }}">
    <link rel="stylesheet" href="{{url('css/stars.css')}}">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <style>
        .yellow-color {
    color:yellow;
    text-shadow: 0 0 2px #000;
    }
    </style>
</head>

<body>
    <div class="container" id="header">
        <div class="bg-image"></div>
        <div class="row justify-content-sm-end">
            <div class="col-md-1 col-sm-2 col-lg-1">
                @if (Session::get('customer'))
                    <a class="btn btn-primary btn-sm" href="{{ url('/logoutuser') }}" role="button">Logout</a>
                @else
                    <a class="btn btn-primary btn-sm" href="{{ route('user.login') }}" role="button">Login</a>
                @endif
            </div>
        </div>
        <div class="row align-items-center border border-grey" style="background-color: #f6eddb">
            <div class="col-md-auto align-self-center">
                <a href="{{ url('/') }}" class="text-decoration-none text-dark">
                    <img src="{{ url('images/OrganicCartLogo.png') }}" alt="" class="img-responsive" height="100">
                </a>
            </div>
            <div class="col-md-5 ">
                <div class="input-group rounded  d-flex justify-content-center">
                    <form action="{{route('frontProduct.search')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-auto"><input type="search" class="form-control rounded" placeholder="Search for product"
                                aria-label="Search" aria-describedby="search-addon" name="search"/></div>
                                <div class="col-auto"><span class="input-group-text" id="search-addon">
                                    <button type="submit" class="btn"><i class="fa fa-search">Search</i></button>
                                </span></div>
                        </div>
                        
                        
                    </form>
                </div>
            </div>
            <div class="col-md-5 p-md-2">
                <div class="row align-items-start justify-content-around">
                    <div class="col-md-2">
                        <a href="{{ route('carts.index') }}"><button type="btn"
                                class="btn btn-default btn-sm text-center"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="25" height="25" fill="currentColor" style="color:rgb(255, 149, 0);" class="bi bi-cart-plus"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z" />
                                    <path
                                        d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                </svg><span></span><br>My Cart</button></a>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('wishlists.index') }}"><button type="btn" class="btn btn-default btn-sm text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" style="color:red;" width="25" height="25" fill="currentColor"
                                class="bi bi-heart" viewBox="0 0 16 16">
                                <path
                                    d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                            </svg><span></span><br>WishList
                        </button></a>
                    </div>
                    <div class="col-md-2">
                        <button type="btn" class="btn btn-default btn-sm text-center">
                            <a href="{{route('contact')}}"> <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" style="color:blue;"
                                class="bi bi-headset" viewBox="0 0 16 16">
                                <path
                                    d="M8 1a5 5 0 0 0-5 5v1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a6 6 0 1 1 12 0v6a2.5 2.5 0 0 1-2.5 2.5H9.366a1 1 0 0 1-.866.5h-1a1 1 0 1 1 0-2h1a1 1 0 0 1 .866.5H11.5A1.5 1.5 0 0 0 13 12h-1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h1V6a5 5 0 0 0-5-5z" />
                            </svg></a><span></span><br>Customer Service
                        </button>
                    </div>
                    <div class="col-md-2">
                        <button type="btn" class="btn btn-default btn-sm text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" style="color:rgb(0, 93, 253);"
                                class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                <path fill-rule="evenodd"
                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                            </svg><span></span><br>
                            @if (Session::get('customer'))
                            <a href="{{route('customers.show',['customer' =>Session::get('customer')])}}">
                                {{ Session::get('customer') }}</a>
                            @else
                                My Profile
                            @endif

                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-2 row justify-content-md-center">
            <div class="col-offset-3"></div>
            <div class="col-md-auto p-sm-2">
                <div class="row border rounded border-secondary  pt-2 pb-2">
                    <div class="col-md-auto ">
                        <div class="dropdown show ">
                            <a class="dropdown-toggle text-decoration-none text-dark" href="#" role=""
                                id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Shop By Category
                            </a>
                            @php
                                use App\Models\Category;
                                $cat = Category::all();
                            @endphp
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="{{route('frontProduct.index')}}">All</a>
                                @foreach ($cat as $category)
                                    <a class="dropdown-item"
                                        href="{{ route('frontProduct.show', ['frontProduct' => $category->category_name]) }}">{{ $category->category_name }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-auto ">
                        <a href="{{ url('/') }}" class="text-decoration-none text-dark">Home</a>
                    </div>
                    <div class="col-md-auto ">
                        <a href="{{route('contact')}}" class="text-decoration-none text-dark">Contact Us</a>
                    </div>
                    
                    <div class="col-md-auto ">
                        <div class="dropdown show">
                            <a class="dropdown-toggle text-decoration-none text-dark" href="#" role=""
                                id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Help
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('about') }}">About us</a>
                                <a class="dropdown-item" href="{{ url('ques') }}">FAQ</a>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="col-offset-3"></div>
        </div>
    </div>

    

    @yield('content')

    <div class="container mt-md-4 border-top border-grey" id="footer" style="background-color: #343F56; color:white;">
        <div class="row p-4">
            <div class="col">
                <b>Links</b><br><br>
                <ul class="list-unstyled">
                    <li><a href="{{route('about')}}" style="color: white">
                        About Us</a></li>
                    <li><a href="{{route('contact')}}" style="color: white">Contact Us</a></li>
                    <li><a href="{{route('ques')}}" style="color: white">FAQ</a></li>
                </ul>
            </div>
            <div class="col">
                <b>Policies</b><br><br>
                <ul class="list-unstyled">
                    <li><a href="{{route('terms')}}" style="color: white">
                        Terms and Condition</a></li>
                        <li><a href="{{route('privacy')}}" style="color: white">
                            Privacy Policy</a></li>
                </ul>
            </div>
            <div class="col">
                <b>Sell</b><br><br>
                <ul class="list-unstyled">
                    <li><a href="{{route('howtosell')}}" style="color: white">Sell on Organic Cart</a></li>
                    <li><a href="{{route('trader.signup')}}" style="color: white">Start Selling</a></li>
                    <li><a href="{{route('terms')}}" style="color: white">Terms and Condition</a></li>
                </ul>
            </div>
            <div class="col-4">
                <b>Find Us at</b><br><br>
                <span class="mx-1"><a href="https://www.facebook.com/organiccart">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-facebook" viewBox="0 0 16 16">
                        <path
                            d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                    </svg></a>
                </span>
                <span class="mx-2"><a href="https://www.instagram.com/organiccart">
                    <i class="fa fa-instagram" aria-hidden="true"></i></a>
                </span>
                <span class="mx-2"><a href="https://twitter.com/?lang=en/organiccart">
                    <i class="fa fa-twitter" aria-hidden="true"></i></a>
                </span>
                <span class="mx-2"><a href="https://discord.gg/WKQu6De5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-discord" viewBox="0 0 16 16">
                        <path
                            d="M13.545 2.907a13.227 13.227 0 0 0-3.257-1.011.05.05 0 0 0-.052.025c-.141.25-.297.577-.406.833a12.19 12.19 0 0 0-3.658 0 8.258 8.258 0 0 0-.412-.833.051.051 0 0 0-.052-.025c-1.125.194-2.22.534-3.257 1.011a.041.041 0 0 0-.021.018C.356 6.024-.213 9.047.066 12.032c.001.014.01.028.021.037a13.276 13.276 0 0 0 3.995 2.02.05.05 0 0 0 .056-.019c.308-.42.582-.863.818-1.329a.05.05 0 0 0-.01-.059.051.051 0 0 0-.018-.011 8.875 8.875 0 0 1-1.248-.595.05.05 0 0 1-.02-.066.051.051 0 0 1 .015-.019c.084-.063.168-.129.248-.195a.05.05 0 0 1 .051-.007c2.619 1.196 5.454 1.196 8.041 0a.052.052 0 0 1 .053.007c.08.066.164.132.248.195a.051.051 0 0 1-.004.085 8.254 8.254 0 0 1-1.249.594.05.05 0 0 0-.03.03.052.052 0 0 0 .003.041c.24.465.515.909.817 1.329a.05.05 0 0 0 .056.019 13.235 13.235 0 0 0 4.001-2.02.049.049 0 0 0 .021-.037c.334-3.451-.559-6.449-2.366-9.106a.034.034 0 0 0-.02-.019Zm-8.198 7.307c-.789 0-1.438-.724-1.438-1.612 0-.889.637-1.613 1.438-1.613.807 0 1.45.73 1.438 1.613 0 .888-.637 1.612-1.438 1.612Zm5.316 0c-.788 0-1.438-.724-1.438-1.612 0-.889.637-1.613 1.438-1.613.807 0 1.451.73 1.438 1.613 0 .888-.631 1.612-1.438 1.612Z" />
                    </svg></a>
                </span>
            </div>
            <div class="col-2">
                <b>We Accept</b><br><br>
                <span>Paypal</span>
                <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-paypal" viewBox="0 0 16 16">
                        <path
                            d="M14.06 3.713c.12-1.071-.093-1.832-.702-2.526C12.628.356 11.312 0 9.626 0H4.734a.7.7 0 0 0-.691.59L2.005 13.509a.42.42 0 0 0 .415.486h2.756l-.202 1.28a.628.628 0 0 0 .62.726H8.14c.429 0 .793-.31.862-.731l.025-.13.48-3.043.03-.164.001-.007a.351.351 0 0 1 .348-.297h.38c1.266 0 2.425-.256 3.345-.91.379-.27.712-.603.993-1.005a4.942 4.942 0 0 0 .88-2.195c.242-1.246.13-2.356-.57-3.154a2.687 2.687 0 0 0-.76-.59l-.094-.061ZM6.543 8.82a.695.695 0 0 1 .321-.079H8.3c2.82 0 5.027-1.144 5.672-4.456l.003-.016c.217.124.4.27.548.438.546.623.679 1.535.45 2.71-.272 1.397-.866 2.307-1.663 2.874-.802.57-1.842.815-3.043.815h-.38a.873.873 0 0 0-.863.734l-.03.164-.48 3.043-.024.13-.001.004a.352.352 0 0 1-.348.296H5.595a.106.106 0 0 1-.105-.123l.208-1.32.845-5.214Z" />
                    </svg></span>
            </div>
        </div>
    </div>
    @yield('scripts')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script>
</body>

</html>
