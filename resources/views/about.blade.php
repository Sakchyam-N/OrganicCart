@extends('layouts.header')
@section('title', 'About us')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md">
                <br>
                <h2 class="text-center" style="font-weight: bold">About Us</h2>
                <p class="text-center" style="font-size:19px;">Organic cart is the first ecommerce website in
                    Cleckhuddersfax Kendal street no 11
                    United Kingdom. The main reason of opening this platform is help people get their necessary products
                    without any problem. Built in 2022, the <strong>Organic Cart </strong> envisions to uplifting the local
                    business enthusiasts and overall, Economy of Cleckhuddersfax.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md border border-grey p-3">
                <h2 class="text-center" style="font-weight: bold">Our Mission</h2>
                <br>
                <p style="font-size:19px;">Our mission to use the power of social networking to bring the best in our
                    customers-all the while
                    inspiring and empowering people to shopping easy without wasting so much time on market to search
                    product in every aspect of their lives. Our mission includes reasonable price to all the customers,
                    varieties of products.</p>
            </div>
            <div class="col-md offset-md-2 d-flex justify-content-center">
                <img src="{{ url('images/OrganicCartLogo.png') }}" alt="" style="width:100%">
            </div>
            <div class="row mt-md-4">
                <h3 class="text-center">MEET OUR TEAM</h3>
                <br><br>
                <div class="col">
                    <div class="card">
                        <img src="{{ url('images/mem1.jpg') }}" class="img-fluid w-50 h-50 mx-auto rounded-circle" alt="">
                        <div class="card-body" style="background-color: rgba(68, 255, 0, 0.625)">
                            <h4>Sakchyam Nakarmi</h4>
                            <p class="card-text border-top border-grey">Hi, I am the backend developer of this website.
                                Honestly the journey was tough but anything for the people of Cleckhuddersfax.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <img src="{{ url('images/3.jpg') }}" class="img-fluid w-50 h-50 mx-auto rounded-circle" alt="">
                        <div class="card-body" style="background-color: rgba(68, 255, 0, 0.625)">
                            <h4>Shruti Rai</h4>
                            <p class="card-text border-top border-grey">Greeting users, I am the frontend and content
                                creator of this website and I hope you enjoy using it as much as we enjoyed creating it.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <img src="{{ url('images/4.jpg') }}" class="img-fluid w-50 h-50 mx-auto rounded-circle" alt="">
                        <div class="card-body" style="background-color: rgba(68, 255, 0, 0.625)">
                            <h4>Ranju Sah</h4>
                            <p class="card-text border-top border-grey">Hello, I'm the website's backend developer, and hope
                                you are enjoying our website. </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <img src="{{ url('images/2.jpg') }}" class="img-fluid w-50 h-50 mx-auto rounded-circle" alt="">
                        <div class="card-body" style="background-color: rgba(68, 255, 0, 0.625)">
                            <h4>Asmit Pyakurel</h4>
                            <p class="card-text border-top border-grey" >Hello users, I am the designer and frontend
                                developer of this website.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
