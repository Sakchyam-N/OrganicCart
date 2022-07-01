<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Illuminate\Http\Request;

class CustomerAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $path= $request->path();

        if(Session::get('customer')){
            if($path=="userlogin"  ){
                return redirect(route('customers.index'));
            }
        }
        else if(Session::get('trader')){
            if($path=="userlogin" || $path == "traderregister"){
                return redirect(route('products.index'));
            }
        }
        else if(!Session::get('trader') ){
            if($path!="userlogin"){
                return redirect('/userlogin');
            }
            else if($path == "traderregister"){
                return redirect(route('trader.signup'));
            }
        }
        else if(!Session::get('customer') ){
            if($path!="userlogin" && $path != "customers/create"){
                return redirect('/userlogin');
            }
           /* else if($path == "customers/create"){
                echo "hero ka chau timi";
                //return redirect(route('customers.create'));
            }*/
        }
        /*else if(!Session::get('trader') && !Session::get('customer')){
            if($path == "customers/create" &&  $path!="userlogin"){
                return redirect(route('customers.create'));
            }
            else if($path == "traders/create" &&  $path!="userlogin"){
                return redirect(route('products.create'));
            }
        }*/
        //Qwer12@!
        return $next($request);
    }
}