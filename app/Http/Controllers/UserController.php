<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Http\Middleware\CustomerAuth;
//use \Crypt;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    //
    public function loginuser(Request $request){
        
        $user = User::where('user_email',$request->input('email'))
        ->where('user_role',$request->input('role'))->get();
        
        if(isset($user[0])){
            if(Crypt::decrypt($user[0]->user_password) == $request->input('password')){
                if($user[0]->verified == "No"){
                    $request->session()->flash('status','Account not verified yet!');
                    return redirect(url('/userlogin'));  
                }
                else{
                    if("Customer" == $request->input('role')){
                        $name = $user[0]->user_name;
                        $id = $user[0]->id;
                        $request->session()->put('customer',$name);
                        $request->session()->put('customerId',$id);
                        return redirect(route('customers.index'));
                    }
                    
                    else if("Trader" == $request->input('role')){
                        $name = $user[0]->user_name;
                        $id = $user[0]->id;
                        $request->session()->put('trader',$name);
                        $request->session()->put('traderId',$id);
                        //echo Session::get('trader');
                        return redirect(route('products.index'));
                    }
                }
                
                
            }
        }
        $request->session()->flash('status','Incorrect login credentials try again');
        return redirect(url('/userlogin'));
    }

    public function logoutuser(Request $request){
        $request->session()->flush();
        $request->session()->save();

        return redirect(route('customers.index'));
    }

    public function __construct()
   {
       $this->middleware('protected');
   }

   
}
