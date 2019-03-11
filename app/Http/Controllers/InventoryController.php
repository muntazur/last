<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Brand;
use App\Product;
use App\User;
use Session;


class InventoryController extends Controller
{
    public function saveBrand(Request $request)
    {
    	$brand = new Brand;

    	$exists = DB::table('brands')->where('name',$request->brand)->first();

    	if($exists)
        {
        	return response()->json(['msg'=>'have']);
        }
        else 
        {
        	$brand::create(

        		[
        			'name'=>$request->brand,
        			'status'=>'1'
        		]
        	);

        	return response()->json(['msg'=>'created !']);
        }
    }
    //manage brands 
    public function manageBrand()
    {
    	$brands = DB::table('brands')->get();

    	return view('brand.table',['table'=>$brands]);
    }

    //save category
    public function saveCategory(Request $request)
    {   
    	$category = new Category;

    	$exists = DB::table('categories')->where('name',$request->category)->first();

    	if($exists)
    	{
    		return response()->json(['msg'=>'have']);
    	}
    	else
    	{
    		$category::create(

    			[

    				'name'=>$request->category,
    				'parent_category'=>$request->parent,
    				'status'=>'1'
    		    ]
    	    );

    	    return response()->json(['msg'=>'created !']);
    	}
    }
    public static function getCategoryList()
    {
    	$category = DB::table('categories')->select('name')->get();
    	return $category;
    }

    public static function getBrandList()
    {
    	$brand = DB::table('brands')->select('name')->get();
    	return $brand;
    }

    //manage category
    public function manageCategory()
    {
    	$categories = DB::table('categories')->get();

    	return view('category.table',['table'=>$categories]);
    }

    //save product

    public function saveProduct(Request $request)
    {   
    	$product = new Product;
        
        $user_id = Session::get('user'); 
    	$exists = DB::table('products')->where(['user_id'=>$user_id,'name'=>$request->product])->first();

    	if($exists)
    	{
    		return response()->json(['msg'=>'have']);
    	}
    	else
    	{ 
            $user_id = Session::get('user');
    		$product::create(

    			[

    				'name'=>$request->product,
                    'user_id'=> $user_id,
    				'category'=>$request->category,
    				'brand'=>$request->brand,
    				'price'=>$request->price,
    				'quantity'=>$request->quantity,
    				'status'=>'1'
    		    ]
    	    );

    	    return response()->json(['msg'=>'created !']);
    	}
    }
    //manage product

    public function manageProduct()
    {   
        $user_id = Session::get('user');
    	$products = DB::table('products')->where('user_id',$user_id)->get();

    	return view('product.table',['table'=>$products]);
    }

    public function getOrder()
    {   
        $returnHtml = view('order.table')->render();
        return response()->json(['html'=>$returnHtml]);
    }

    public static function getProduct()
    {   
        $user_id = Session::get('user');
        return DB::table('products')->where('user_id',$user_id)->get();
    }

}
