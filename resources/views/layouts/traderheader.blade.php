<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <div class="container p-4" id="header">
        <div class="row">
            <div class="col-md-3 d-flex justify-content-center  ">
                <img src="{{ url('images/OrganicCartLogo.png') }}" alt="" class="img-responsive" height="100">
            </div>
            <div class="col-md-6">
                <div class="row ">
                    <div class="col p-3">
                    </div>
                </div>
                <div class="row border  p-3 border-grey mt-2 mb-2 d-flex justify-content-center me-2">
                    <div class="col-auto"><a href="{{ route('products.index') }}" class="text-decoration-none">View
                            Shops</a></div>
                    <div class="col-auto"><a href="{{ route('products.shopAdd') }}"
                            class="text-decoration-none">Add Shop</a></div>
                    <div class="col-auto"><a href="{{ route('products.create') }}"
                            class="text-decoration-none">Add Product</a></div>
                    <div class="col-auto"><a href="{{ route('products.viewprods') }}"
                            class="text-decoration-none">View Product</a></div>
                    <div class="col-auto"><a href="{{ route('products.offerview') }}"
                            class="text-decoration-none">View Offers</a></div>
                </div>
            </div>

            <div class="col-md-2">
                <div class="row ">
                    <div class="col d-flex justify-content-center">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                <path fill-rule="evenodd"
                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center border border-grey p-2">
                        <span><a href="#" class="text-decoration-none">
                                @if (Session::get('trader'))
                                    <a href="{{route('traderprofile')}}"> {{ Session::get('trader') }}</a>
                                @else
                                    My Profile
                                @endif
                            </a></span>
                    </div>
                    <a class="btn btn-primary btn-sm" href="{{ url('logoutuser') }}" role="button">Logout</a>
                    <a class="btn btn-warning btn-sm" href="http://127.0.0.1:8080/apex/f?p=100:LOGIN_DESKTOP:13132582476013:::::" role="button">Apex Dashboard</a>
                      
                </div>
            </div>
        </div>
    </div>


    @yield('content')
    
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
