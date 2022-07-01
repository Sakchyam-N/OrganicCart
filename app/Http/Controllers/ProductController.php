<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Offer;
use App\Models\Product_Offer;
use App\Models\Category;
use Session;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //GET
        return view('products.shop',[
            'shops' => Shop::all()
            ]);
    }

    public function viewprods()
    {
        //GET
        return view('products.viewProd',[
            'products' => Product::all(),
            'shops' => Shop::all(), 
            'categories' => Category::all()
        ]);
    }

    public function viewoffer(){
        $shop = Shop::where('user_id',Session::get('traderId'))->get();
        return view('products.offerview',[
            'products' => Product::all(),
            'offers' => Offer::all(),
            'shops' => $shop, 
            'product_offers' => Product_Offer::all()
        ]);
    }

    public function sortA(Request $request,$product){
        if($product == "asc"){
            $products = Product::orderBy('product_name')->get();
        }
        elseif($product == "dsc" ){
            $products = Product::orderByDesc('product_name')->get();
        }
        return view('products.viewProd',[
            'products' => $products,
            'shops' => Shop::all(), 
            'categories' => Category::all()
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
        return view('products.prodadd',[
            'shops' => Shop::all(),
            'categories' => Category::all()
        ]);
    }

    public function shopCreate()
    {
        //
        return view('products.shopCreate');
    }

    public function shopStore(Request $request){
        $request->validate([
            'name' => ['required', 'regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/','max:255'],
            'address' => ['required','max:255'],
            'contact' => ['required','numeric','min:8'],
            'category' => ['required','unique:App\Models\Category,category_name,null,null'],
            'imageName' => ['required','image'],
        ]);

        $user = Session::get('traderId');
        $shopcount = Shop::where('user_id',$user)->get();
        if(count($shopcount) >= 2){
            $request->session()->flash('failshop','You cannot add more than two shops');
            return redirect()->route('products.index');
        }else{
            $shop = new Shop();
            $shop->shop_name = $request->input('name');
            $shop->shop_address = $request->input('address');
            $shop->shop_contact = $request->input('contact');
            $shop->user_id = Session::get('traderId');
            
            $category = new Category();
            $category->category_name = $request->input('category');
            $filename=$request->file('imageName')->getClientOriginalName(); 
            $request->file('imageName')->move(public_path('/uploadedimages'), $filename);
            $category->image_name = $filename;

            $category->save();
            $shop->save();
            return redirect()->route('products.index');
        }
        
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
        $request->validate([
            'name' => ['required', 'regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/','max:255'],
            'imageName' => ['required','image'],
            'productPrice' => ['required','numeric'],
            'description' => ['required'],
            'allergy' => ['required'],
            'productQuantity' => ['required','numeric'],
            'manufacture' =>['required','before_or_equal:expiry'],
            'expiry' =>['required','after_or_equal:manufacture'],
            'maxOrder' => ['required','numeric',],
            'minOrder' => ['required','numeric','min:1'],
            'category' =>['required'],
            'shop' => 'required',
            
        ]);

        $product = new Product();
        $product->product_name = $request->input('name');
        
        $filename=$request->file('imageName')->getClientOriginalName(); 
        $request->file('imageName')->move(public_path('/uploadedimages'), $filename);
        $product->product_image = $filename;

        $product->product_price = $request->input('productPrice');
        $product->product_description = $request->input('description');
        $product->product_quantity = $request->input('productQuantity');
        $product->manufacture_date = $request->input('manufacture');
        $product->expiry_date = $request->input('expiry');
        $product->max_order = $request->input('maxOrder');
        $product->min_order = $request->input('minOrder');
        $product->allergy_details = $request->input('allergy');
        $product->shop_id = $request->input('shop');
        $product->categories_id = $request->input('category');

        
        $product->save();
        $request->session()->flash('status','Product Added');
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {
        //
        $products = Product::where('shop_id',$product)->get();
        return view('products.crud',[
            'products'=>$products,
            'shops' => Shop::all(), 
            'categories' => Category::all()
        ]);
    }

    public function createOffer($product){

        $record =Product::where('id',$product)->get();
        return view('products.offer',[
            'products' => $record
        ]);
    }

    public function offerStore(Request $request){

        $offer = new Offer();
        $offerProd = new Product_Offer();

        $offer->start_date = $request->input('offerStart');
        $offer->end_date = $request->input('offerEnd');
        $offer->save();

        $offerProd->offer_percentage = $request->input('offerPercentage');
        $offerProd->offer_id = $offer->id;
        $offerProd->product_id = $request->input('productid');
        $offerProd->save();

        $request->session()->flash('status','Offer For Product Added');
        return redirect()->route('products.viewprods');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($product)
    {
        //
        return view('products.prodedit',[
            'product' => Product:: findOrFail($product),
            'shops' => Shop::all(), 
            'categories' => Category::all()
        ]);
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
        $request->validate([
            'name' => ['required', 'regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/','max:255'],
            'imageName' => ['required','max:255'],
            'productPrice' => ['required','numeric' ],
            'description' => ['required'],
            'allergy' => ['required'],
            'productQuantity' => ['required','numeric'],
            'manufacture' =>['required','before_or_equal:expiry'],
            'expiry' =>['required','after_or_equal:manufacture'],
            'maxOrder' => ['required','numeric',],
            'minOrder' => ['required','numeric','min:1'],
            'category' =>['required'],
            'shop' => 'required',
            
        ]);

        $update = Product::findOrFail($product);
        $update->product_name = $request->input('name');
        $update->product_image = $request->input('imageName');
        $update->product_price = $request->input('productPrice');
        $update->product_description = $request->input('description');
        $update->product_quantity = $request->input('productQuantity');
        $update->manufacture_date = $request->input('manufacture');
        $update->expiry_date = $request->input('expiry');
        $update->max_order = $request->input('maxOrder');
        $update->min_order = $request->input('minOrder');
        $update->allergy_details = $request->input('allergy');
        $update->shop_id = $request->input('shop');
        $update->categories_id = $request->input('category');

        $update->save();
        
        
        $request->session()->flash('status','Product Updated');
        return redirect()->route('products.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
       // Product::where('id',$product)->delete();
       
        $product->delete();
        session()->flash('status','Product Deleted');
        return redirect(route('products.index'));
    }
}



