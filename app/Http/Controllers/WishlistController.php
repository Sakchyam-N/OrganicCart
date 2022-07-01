<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Wishlist_Product;

use Session;

use Illuminate\Http\Request;

class WishlistController extends Controller
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
        $wishlists = Wishlist::where('user_id',$user)->get();
        $wish_prod = Wishlist_Product::where('wishlist_id',$wishlists[0]->id)->get();

        return view('wishlists.wishlist',[
            'wishprods' => $wish_prod,
            'products' => Product::all()
        ]);
        return view('wishlists.wishlist');
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($wishlist,Request $request)
    {
        //
        $user = Session::get('customerId');
        $wishlists = Wishlist::where('user_id',$user)->get();
        $products = Product::where('id',$wishlist)->get();
        $wish_prods = Wishlist_Product::where('wishlist_id',$wishlists[0]->id)->get();
        $flag = false;
        for($i=0;$i<count($wish_prods);$i++){
            if($wish_prods[$i]->product_id==$wishlist){
                $flag = true;
            }
        }

        if($flag){
            $request->session()->flash('status','Item already in wishlist');
            return redirect()->back();
        }
        else{
            $wish_product = new Wishlist_Product();
            $wish_product->wishlist_id = $wishlists[0]->id;
            $wish_product->product_id = $wishlist;
            $wish_product->save();
            return redirect()->route('wishlists.index');
    
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($wishlist)
    {
        //
        $user = Session::get('customerId');
        $wishlists = Wishlist::where('user_id',$user)->get();
        $wish_prods = Wishlist_Product::where('wishlist_id',$wishlists[0]->id)->where('product_id',$wishlist)->delete();
        
        session()->flash('status','Product Removed from wishlist');
        return redirect(route('wishlists.index'));
    }
}
