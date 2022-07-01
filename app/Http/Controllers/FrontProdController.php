<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Shop;
use App\Models\User;
use App\Models\Product;
use App\Models\Offer;
use App\Models\Product_Offer;
use App\Models\Review;
use DB;

class FrontProdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('frontProduct.allcat',[
            'category' => Category::all()
        ]);
    }

    public function search(Request $request){
        $search = $request->input('search');
        $product = Product::where(DB::raw('lower(product_name)'),'like','%'.strtolower($search).'%')->get();
        return view('frontProduct.searchprod',[
            'products' => $product,
            'reviews' => Review::all(),
            'product_offer' =>Product_Offer::all()
        ]);
    }

    public function sortCategory($frontProduct){
        if($frontProduct == "asc"){
            $category = Category::orderBy('category_name')->get();
        }
        elseif($frontProduct == "dsc" ){
            $category = Category::orderByDesc('category_name')->get();
        }
        return view('frontProduct.allcat',[ 
            'category' => $category
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
    public function show($frontProduct)
    {
        $category =Category::where('category_name',$frontProduct)->get();
        return view('frontProduct.categoryProd',[
            'catName' => $frontProduct,
            'products' => Product::where('categories_id',$category[0]->id)->get()
        ]);

    }

    public function sortProduct($frontProduct,$sort){
        $category = Category::where('category_name',$frontProduct)->get();
        if($sort == "asc"){
            $product = Product::where('categories_id',$category[0]->id)->orderBy('product_name')->get();
        }
        elseif($sort == "dsc" ){
            $product = Product::where('categories_id',$category[0]->id)->orderByDesc('product_name')->get();
        }
        elseif($sort == "pricedsc" ){
            $product = Product::where('categories_id',$category[0]->id)->orderByDesc('product_price')->get();
        }
        elseif($sort == "priceasc" ){
            $product = Product::where('categories_id',$category[0]->id)->orderBy('product_price')->get();
        }
        return view('frontProduct.categoryProd',[
            'catName' => $frontProduct,
            'products' => $product
        ]);
    }

    public function prodDetail($frontProduct)
    {
        $product = Product::where('id',$frontProduct)->get();
        $shop_id = $product[0]->shop_id;
        $shop = Shop::where('id',$shop_id)->get();
        $trader_id = $shop[0]->user_id;
        $trader = User::where('id',$trader_id)->get();
        $prod_offer = Product_Offer::where('product_id',$frontProduct)->get();

        if(count($prod_offer) >0){
            $offer = Offer::where('id',$prod_offer[0]->offer_id)->get();
            return view('frontProduct.productDetail',[
                'products' => $product,
                'shops' => $shop,
                'traders' => $trader,
                'offers' => $offer,
                'prod_offers' =>$prod_offer,
                'flag' => true,
            ]);
        }

        
        return view('frontProduct.productDetail',[
            'products' => $product,
            'shops' => $shop,
            'traders' => $trader,
            'flag' => false,

        ]);
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
    public function destroy($id)
    {
        //
    }
}
