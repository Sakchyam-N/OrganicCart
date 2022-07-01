<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Cart_Product;
use App\Models\Offer;
use App\Models\Product_Offer;
use Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Session::get('customerId');
        $carts = Cart::where('user_id',$user)->get();
        $cartProd = Cart_Product::where('cart_id',$carts[0]->id)->get();
        $offer = Offer::all();

        return view('carts.cart',[
            'cartprods' => $cartProd,
            'products' => Product::all(),
            'offers' => $offer
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cart,Request $request)
    {
        //
        $user = Session::get('customerId');
        $carts = Cart::where('user_id',$user)->get();
        $products = Product::where('id',$cart)->get();
        $cart_prods = Cart_Product::where('cart_id',$carts[0]->id)->get();
        $flag = false;
        for($i=0;$i<count($cart_prods);$i++){
            if($cart_prods[$i]->product_id==$cart){
                $flag = true;
            }
        }

        if($flag){
            $request->session()->flash('status','Item already in cart');
            return redirect()->back();
        }
        else{
            $prod_offer = Product_Offer::where('product_id',$cart)->get(); 
            if(count($prod_offer)>0){
                $discount = $prod_offer[0]->offer_percentage / 100;
                $price = $products[0]->product_price - ($discount * $products[0]->product_price);
            }
            else{
                $price =$products[0]->product_price;
            }

            $cart_product = new Cart_Product();
            $cart_product->cart_id = $carts[0]->id;
            $cart_product->product_id = $cart;
            $cart_product->total_product = 1;
            $cart_product->total_cost = $price;
            $cart_product->save();
            return redirect()->route('carts.index');
    
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cart)
    {
        //
        $request->validate([
            'quantity' => 'gte:1'
        ]);

        

        $update = Cart_Product::find($cart);
        $prod_offer = Product_Offer::where('product_id',$update->product_id)->get(); 
        if(count($prod_offer)>0){
            $discount = $prod_offer[0]->offer_percentage / 100;
            $price = $request->input('price') - ($discount * $request->input('price'));
        }
        else{
            $price =$request->input('price');
        }

        $update->total_product = $request->input('quantity');
        $tcost = $request->input('quantity') * $price;
        $update->total_cost = $tcost;
        $update->save();
        $request->session()->flash('pass','Item updated in cart');
        return redirect()->back();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cart)
    {
        //
        $user = Session::get('customerId');
        $carts = Cart::where('user_id',$user)->get();
        $cart_prods = Cart_Product::where('cart_id',$carts[0]->id)->where('product_id',$cart)->delete();
        
        session()->flash('status','Product Removed from cart');
        return redirect(route('carts.index'));
    }
}
