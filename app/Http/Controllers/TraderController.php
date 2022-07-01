<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Shop;
use App\Models\Category;
use App\Models\Order;
use App\Models\Order_Product;
use App\Models\Product;
use App\Models\Cart;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Mail;
use Session;    

class TraderController extends Controller
{
    public function store(Request $request)
    {
        //POST
        $request->validate([
            'name' => ['required', 'regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/','max:255'],
            'email' => ['required','email:rfc,dns','unique:App\Models\User,user_email,null,null,user_role,Trader','max:255'],
            'imageCat' => ['required','image'],
            'password' => ['required','regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'],
            'address' => ['required','max:255'],
            'gender' => 'required',
            'birthday' =>['required','before_or_equal:2004-01-01'],
            'shopName'=>['required', 'string','max:255'],
            'shopNumber' => ['required','numeric','min:10'],
            'description' =>['required'],
            'productCategory' => 'required',
            'terms-and-condition' => 'required'

        ]);
        $random = rand(111111111,999999999);
        $users = new User();
        $users->user_name =$request->input('name');
        $users->user_email =$request->input('email');
        $users->user_address =$request->input('address');
        $users->user_password =Crypt::encrypt($request->input('password'));
        $users->user_dob =$request->input('birthday');
        $users->user_gender =$request->input('gender');
        $users->user_role ="Trader";
        $users->rand_id = $random;
        $users->verified ="No";

        $users->save();

        $category = new Category();
        $category->category_name = $request->input('productCategory');
        $filename=$request->file('imageCat')->getClientOriginalName(); 
        $request->file('imageCat')->move(public_path('/uploadedimages'), $filename);
        $category->image_name = $filename;
        
        $shop = new Shop();
        $shop->shop_name = $request->input('shopName');
        $shop->shop_contact = $request->input('shopNumber');
        $shop->shop_address = $request->input('address');
        $shop->user_id = $users->id;
        
        $request->session()->flash('status','Trader account registered');
   
        $shop->save();
        $category->save();

        $data = ['user' => $request->input('name'),'random'=>$random,'password'=>$request->input('password')];
        $user['to'] = $request->input('email');
        Mail::send('mailtrader',$data,function($messages)use ($user){
            $messages->to($user['to']);
            $messages->subject('Email verification');
        });
        $request->session()->flash('status','Account registered, verify through email to log in!');
        return redirect()->route('trader.signup');
    }

    public function traderprofile(){
        return view('traderprofile',[
            'customers' => User::where('id',Session::get('traderId'))->get()
        ]);
    }

    public function update(Request $request){
        $request->validate([
            'password' => ['required','min:8','regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/']
            
        ]);

        User::where('id',Session::get('traderId'))->update(['user_password'=>Crypt::encrypt($request->input('password')) ]);
        session()->flash('status','Password Changed successfully');
        return redirect()->route('traderprofile');
    }

    public function traderchangepw(){
        return view('traderchangepw',[
            'traders' => User::where('id',Session::get('traderId'))->get()
        ]);
    }

    public function ordertrader(){
        $customers = User::where('user_role','Customer')->get();
        $cart = Cart::all();
        return view('ordertrader');
    }
    
    
}
