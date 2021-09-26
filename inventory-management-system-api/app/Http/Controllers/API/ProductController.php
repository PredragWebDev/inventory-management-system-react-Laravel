<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class ProductController extends Controller
{

    protected function uploadProductImage($request){
        $productImage = $request->file('product_image');
        $imageType = $productImage->getClientOriginalExtension();
        $imageName = rand(100,100000).$request->name.'.'.$imageType;
        $directory = 'inventory/product-images/';
        $imageUrl = $directory.$imageName;
        Image::make($productImage)->save($imageUrl);
        return $imageUrl;

    }


    public function saveProduct(SaveProductRequest $request){

//        $imageUrl  = $this->uploadProductImage($request);
        $product = new Product();
        $product->cat_id = $request->cat_id;
        $product->sup_id = $request->sup_id;
        $product->product_name = $request->product_name;
        $product->product_code = $request->product_code;
        $product->product_garage = $request->product_garage;
        $product->product_route = $request->product_route;
        $product->product_image = 'add later';
        $product->buy_date = $request->buy_date;
        $product->expire_date = $request->expire_date;
        $product->buying_price = $request->buying_price;
        $product->selling_price = $request->selling_price;
        $product->save();
        return response()->json([
            "message"=>"Product added successfully!",
            200,
        ]);

    }

    public function getProducts(){
        $products = Product::all();
        return response()->json([
            "products"=>$products,
            200,
        ]);
    }

    public function getProduct($id){
        $product  = DB::table('products')
            ->join('categories','categories.id','=','products.cat_id')
            ->join('suppliers','suppliers.id','=','products.sup_id')
            ->select('products.*','suppliers.name as sup_name','suppliers.id as sup_id',
                        'categories.cat_name','categories.id as cat_id')
            ->where('products.id','=',$id)
            ->first();
        return response()->json([
            "product"=>$product,
            200,
        ]);
    }

    public function updateProduct(UpdateProductRequest $request){
        //        $imageUrl  = $this->uploadProductImage($request);
        $product = Product::findOrNot($request->prod_id);
        $product->cat_id = $request->cat_id;
        $product->sup_id = $request->sup_id;
        $product->product_name = $request->product_name;
        $product->product_code = $request->product_code;
        $product->product_garage = $request->product_garage;
        $product->product_route = $request->product_route;
        $product->product_image = 'add later';
        $product->buy_date = $request->buy_date;
        $product->expire_date = $request->expire_date;
        $product->buying_price = $request->buying_price;
        $product->selling_price = $request->selling_price;
        $product->update();

        return response()->json([
            "message"=>"Product data updated successfully!",
            200,
        ]);

    }

    public function deleteProduct($id){
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json([
            "message"=>"Product removed successfully!",
            200,
        ]);


    }


}
