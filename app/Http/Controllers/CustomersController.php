<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use App\Models\Wishlist;
use Session;
use Illuminate\Support\Facades\Crypt;
use Mail;

class CustomersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('customers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('customers.signup');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //POST
        $request->validate([
            'inputFirstName' => ['required', 'regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/'],
            'inputLastName' => ['required', 'regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/'],
            'inputEmail' => ['required','email:rfc,dns','unique:App\Models\User,user_email,null,null,user_role,Customer'],
            'password' => ['required','min:8','regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'],
            'password_confirmation' =>['required','same:password'],
            'inputAddress' => 'required',
            'inputGender' => 'required',
            'birthday' =>['required','before_or_equal:2004-01-01'],
            'terms&condition' => 'required'
        ]);
        
        $random = rand(111111111,999999999);
        $users = new User();
        $users->user_email = $request->input('inputEmail');
        $users->user_name = $request->input('inputFirstName')." ".$request->input('inputLastName');
        $users->user_password = Crypt::encrypt($request->input('password'));
        $users->user_address = $request->input('inputAddress');
        $users->user_dob = $request->input('birthday');
        $users->user_gender = $request->input('inputGender');
        $users->user_role ="Customer";
        $users->verified ="No";
        $users->rand_id = $random;

        $users->save();

        $cart = new Cart();
        $cart->user_id = $users->id;
        $cart->save();

        $wishlist = new Wishlist();
        $wishlist->user_id = $users->id;
        $wishlist->wishlist_name =$users->user_name. "'s Wishlist";
        $wishlist->save();

        $data = ['user' => $request->input('inputFirstName'),'random'=>$random];
        $user['to'] = $request->input('inputEmail');
        Mail::send('mail',$data,function($messages)use ($user){
            $messages->to($user['to']);
            $messages->subject('Email verification');
        });
        $request->session()->flash('status','Account registered, verify through email to log in!');
        return redirect()->route('customers.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($customer)
    {
        //
        return view('customers.customerProf',[
            'customers' => User::where('id',Session::get('customerId'))->get()
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($customer)
    {
        //
        return view('customers.changepassword',[
            'customers' => User::where('id',Session::get('customerId'))->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $customer)
    {
        //
        $request->validate([
            'password' => ['required','min:8','regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/']
            
        ]);

        User::where('id',Session::get('customerId'))->update(['user_password'=>Crypt::encrypt($request->input('password'))]);
        session()->flash('status','Password Changed successfully');
        return redirect()->route('customers.show',['customer'=>Session::get('customerId')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function email_verification($customer){
        $cust = User::where('rand_id',$customer)->get();

        if(isset($cust[0])){
            User::where('id',$cust[0]->id)->update([
                'verified' => "Yes",
                'rand_id' => ""
            ]);
        }
        else{
            return redirect('/');
        }
        return view('customers.verified');
    }

}
