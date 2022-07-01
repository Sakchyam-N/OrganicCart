<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Review;
use App\Models\Product;
use Session;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $user = Session::get('customerId');
        $product = $request->input('productid');

        $record = Review::where('user_id',$user)->where('product_id',$product)->get();
        if($user == null)
        {
            return redirect()->route('user.login');
        }
        else{
            if(count($record)==0){
                $review = new Review();
                $review->user_id = $user;
                $review->product_id =  $product;
                $review->rating = $request->input('rating');
                $review->review_statement = $request->input('comment');
                $review->save();
    
                return redirect()->back();
            }
            else{
                //return redirect()->route('cust.index');e
                $user = Session::get('customerId');
                $review = Review::find($record[0]->id);
                $review->user_id = $user;
                $review->product_id =  $product;
                $review->rating = $request->input('rating');
                $review->review_statement = $request->input('comment');
                $review->save();
            
                return redirect()->back();
            }
    
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($review)
    {
        //
        $user = Session::get('customerId');
        return view('reviews.custReview',[
            'reviews' => Review::where('user_id',$user)->get()
        ]);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product)
    {
        //
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
        $review->delete();
        return redirect()->back();
    }
}
