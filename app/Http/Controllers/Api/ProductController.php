<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    use Response;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        
        if(count($products) == 0){

            return $this->apiResponse(null, true ,'No Items currently Available', 200);

        }
        return $this->apiResponse($products, true ,'All Products', 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
        ]);

        if($validator->fails()){
            return $this->apiResponse(null, false ,$validator->errors(), 400);
        }
        $product = Product::create($input);

        if($product){
            return $this->apiResponse($product, true ,'Product Created Successfully', 201);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        if(! $product){

            return $this->apiResponse(null, false ,'No Items Available', 400);
        }

        return $this->apiResponse($product, true ,'Successfully Identify the Product', 200);

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
        $input = $request->all();

        $validator = Validator::make($input,[
            'name' => ['string', 'max:255'],
            'title' => ['string', 'max:255'],
        ]);

        if($validator->fails()){
            return $this->apiResponse(null, false ,$validator->errors(), 400);
        }
        $product = Product::find($id);

        if(!$product){
            return $this->apiResponse(null, false ,'Product Not Found', 401);
        }
        $product->update($input);

        if($product){
            return $this->apiResponse($product, true ,'Product Updated Successfully', 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if(! $product){

            return $this->apiResponse(null, false ,'Product Not Found', 401);
        }
        $product->delete();

        return $this->apiResponse(null, true ,'Product Deleted Successfully', 201);
    }
}
