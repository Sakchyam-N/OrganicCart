<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Order_Product;
use App\Models\Cart_Product;
use App\Models\Cart;
use App\Models\PaymentUser;
use App\Models\Collection_Slot;
use Session;
class PaypalController extends Controller
{
    //
    public function order(Request $request){
        $request->validate([
            'timeSlot' => 'required'
        ]);

        $collection = new Collection_Slot();
        $collection->date_time = $request->input('timeSlot');
        $collection->save();
        $uid = Session::get('customerId');
        $cartid = Cart::where('user_id',$uid)->get();
        $order= new Order();
        $order->order_quantity = $request->input('totalprod');
        $order->cart_id = $cartid[0]->id;
        $order->total_charge = $request->input('amount');
        $order->order_date = date("Y-m-d");
        $order->status = "Pending";
        $order->collection_id =  $collection->id;
        $order->save();
        $orders = Order::where('id',$order->id)->get();

        $cartprods = Cart_Product::where('cart_id',$order->cart_id)->get();
        foreach($cartprods as $item){
            $orderprod = new Order_Product();
            $orderprod->order_id = $order->id;
            $orderprod->product_id = $item->product_id;
            $orderprod->prod_quantity = $item->total_product;
            $orderprod->save();

            $product = Product::where('id',$item->product_id)->get();
            Product::where('id',$item->product_id)->update([
                'product_quantity' =>   ($product[0]->product_quantity - $item->total_product)
            ]);
        }
        Cart_Product::where('cart_id',$order->cart_id)->delete();

        return view('pay',[
            'order' => $order->id,
            'orders' => $orders[0]->total_charge,
            'collection' =>$collection->date_time
            //send collection slot id also 
        ]);
        // return response()->json([
        //     'done' => $request->input('total')
        // ]);
    }

    //order id is getting returned
    public function paid($id){
        $order = Order::where('id',$id)->get();
        $payment = new PaymentUser();
        $payment->amount = $order[0]->total_charge;
        $payment->paydate = date("Y-m-d");
        $payment->order_id = $id;
        $payment->user_id = Session::get('customerId');
        $payment->save();
        Order::where('id',$id)->update([
            'status' => "Paid"
        ]);

        Session::flash('paid','Payment done successfully for items!');
        return redirect()->route('carts.index');
    }
}
