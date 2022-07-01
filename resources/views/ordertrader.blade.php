@extends('layouts.traderheader')
@section('title', 'Order Details')
@section('content')

    <div class="container ">
        @if (Session::get('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row">
            <div class="col-md-2 left-inforamtion-bar border m-md-3">
                <div class="row">
                    <div class="col">
                        <br>
                        <h4 class="text-dark">Information</h4>
                        <a href="{{ route('traderprofile') }}" class="text-decoration-none">
                            <h6>My Profile</h6>
                        </a>
                        <br>
                    </div>
                </div>
                <div class="row border-top pt-2">
                    <h4 class="text-dark">Orders</h4>
                    <a href="{{ route('ordertrader') }}" class="text-decoration-none">
                        <h6>My Orders</h6>
                    </a>
                    <br><br>
                </div>
                <div class="row border-top pt-2">
                    <h4 class="text-dark">Security</h4>
                    <a href="{{ route('traderchangepw') }}" class="text-decoration-none">
                        <h6>Change Password</h6>
                    </a>
                    <a href="{{ url('/logoutuser') }}" class="text-decoration-none">
                        <h6>Log Out</h6>
                    </a>
                    <br><br>
                </div>
            </div>

            <div class="col-md-9  right-profile-edit-bar mt-3 ">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Products</th>
                            <th scope="col">Total charge</th>
                            <th scope="col">Order Date</th>
                            <th scope="col">Order Status</th>
                            <th scope="col">Delivery Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>hi</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    @endsection
