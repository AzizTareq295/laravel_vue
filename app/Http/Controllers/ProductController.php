<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_data = Product::all();

        return response()->json(['products'=> $all_data],200);
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
        $exploaded = explode(',', $request->image);
        $decoded = base64_decode($exploaded[1]);

        if(str_contains($exploaded[0], 'jpeg', 'jpg')){
            $extension = 'jpg';
        }else{
            $extension = 'png';
        }

        $fileName = str_random().'.'.$extension;

        $path = public_path('images')."/".$fileName;


        $request['product_image'] = $fileName;


        file_put_contents($path,$decoded);

        $product = Product::create($request->except('image'));

        return 1;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function addTocart($id){
        $product = Product::where('id',$id)->first();
        Session::push('carts',$product);
        
        $carts = Session::get('carts');
        
        if(!Session::has('carts')){
            Session::put('total_amount',$product->product_price);
            Session::put('quantity',1);
        }else{
            $total = Session::get('total_amount')+$product->product_price;
            $quantity = Session::get('quantity')+1;
            Session::put('total_amount',$total);
            Session::put('quantity',$quantity);

        }



        return response()->json(['carts'=> $carts,'total_amount'=>Session::get('total_amount'),'quantity'=>Session::get('quantity')],200);
    }

    public function cart(){
        $carts = Session::get('carts');
        $total_amount = Session::get('total_amount');
        return response()->json(['carts'=> $carts,'total_amount'=>$total_amount,'quantity'=>Session::get('quantity')],200);

    }

    public function remove_cart($id){
        $all_data = Session::get('carts');

        

        foreach($all_data as $index => $data){
            
            if($index == $id){

                $new_total = Session::get('total_amount') - intval($all_data[$index]['product_price']);
 

                $total = Session::put('total_amount',$new_total);
                

                $new_quantity = Session::get('quantity') - 1;
                $quantity = Session::put('quantity',$new_quantity);

                unset($all_data[$index]);

                $new_cart = array_values($all_data);
                $carts=Session::put('carts',$new_cart);

                return response()->json(['carts'=>Session::get('carts'),'quantity'=>Session::get('quantity'), 'total_amount'=>Session::get('total_amount')],200);
            }
        }
    
        
    
    }
}
