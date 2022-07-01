<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order_Product;

use Session;


class CustomerController extends Controller
{

    public function about(){
        return view('about');
    }

    public function myorder(){
        $cart = Cart::where('user_id',Session::get('customerId'))->get();
        $orders = Order::where('cart_id',$cart[0]->id)->get();
        return view('customers/myorder',[
            'orders' => $orders,
            'orderprods' => Order_Product::all(),
            'products' => Product::all()
        ]);
    }

    public function privacy(){
        return view('privacy');
    }

    public function ques(){
        return view('ques');
    }

    public function contact(){
        return view('contact');
    }

    public function howtosell(){
        return view('howtosell');
    }

    public function terms(){
        return view('terms');
    }

    public function cart(){
        return view('cart');
    }

    public function userLogin(){
        return view('userlogin');
    }

    public function signup(){
        return view('signup');
    }

    public function traderSignup(){
        return view('traderSignup');
    }
}
