<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Fpdf;
use App\Category;
use App\Brand;
use App\Product;
use App\User;
use App\Order;
use Session;
require('pdf/fpdf.php');


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
        
    	$exists = DB::table('products')->where(['name'=>$request->product])->first();

    	if($exists)
    	{
    		return response()->json(['msg'=>'have']);
    	}
    	else
    	{ 
    		$product::create(

    			[

    				'name'=>$request->product,
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
    	$products = DB::table('products')->get();

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
        return DB::table('products')->get();
    }
    public function getSingleProduct(Request $request)
    {

        
        $product = DB::table('products')->where(['name'=>$request->name])->first();
        return response()->json(
            [

                'quantity'=>$product->quantity,
                'price' => $product->price
            ]
        );
    }
    public function saveOrder(Request $request)
    {    
        $order = new Order;
        $update = $request->total_quantity - $request->quantity;
        DB::table('products')->where(['name'=>$request->name])->update(['quantity'=>$update]);
        Session::put('customer',$request->customer);
        Session::put('date',$request->date);

        $order::create(

            [
                'item'=>$request->name,
                'price'=>$request->price,
                'quantity'=>$request->quantity,
                'total'=>$request->total_cost
            ]
        );
        return response()->json(['msg'=>$request->customer]);
    }

    public function updateBrand(Request $request)
    {
        

        DB::table('brands')->where(['name'=>$request->previous])->update(['name'=>$request->brand]);
        
        return response()->json(['msg'=>'updated']);
        
    }
    public function deleteBrand(Request $request)
    {
        DB::table('brands')->where('name',$request->brand)->delete();
        return response()->json(['msg'=>'deleted']);
    }
    public function updateCategory(Request $request)
    {
        DB::table('categories')->where(['name'=>$request->previous])->update(['name'=>$request->category]);
        return response()->json(['msg'=>'updated']);
    }
    public function deleteCategory(Request $request)
    {

        DB::table('categories')->where('name',$request->category)->delete();
        return response()->json(['msg'=>'deleted']);
    }
    public function printInvoice()
    {   
        $customer = Session::get('customer');
        $date = Session::get('date');
        $net_total = 0;

        $pdf = new FPDF();
        $pdf::AddPage();


        $pdf::SetFont('Arial','B',16);
        $pdf::Ln();
        $pdf::Ln();


        $pdf::Cell(70,10,'Customer Name: '.$customer);
        //$pdf::Cell(40,10,$customer);
        $pdf::Ln();

        $pdf::Cell(70,10,'Date: '.$date);
        //$pdf::Cell(40,10,$date);
        $pdf::Ln();
        $pdf::Ln();

        $pdf::Cell(60,10,'Product',1,0,'C');
        $pdf::Cell(40,10,'Price(TK.)',1,0,'C');
        $pdf::Cell(40,10,'Quantity',1,0,'C');
        $pdf::Cell(50,10,'Total(TK.)',1,0,'C');
        $pdf::Ln();
        $table = DB::table('orders')->get();
        

        foreach ($table as $row) {
            
            $pdf::Cell(60,10,$row->item,1,0,'C');
            $pdf::Cell(40,10,$row->price,1,0,'C');
            $pdf::Cell(40,10,$row->quantity,1,0,'C');
            $pdf::Cell(50,10,$row->total,1,0,'C');
            $pdf::Ln();
            $net_total += $row->total;
        }

        $pdf::Ln();
        $pdf::Ln();
        $pdf::Cell(70,10,'Total: '.$net_total.' TK.');
        $pdf::Cell(70,10,'Signature............');

        $pdf::Output(); 

        Session::put('customer',null);
        Session::put('date',null);
        DB::table('orders')->delete();

        exit;     
        //return response()->json(['msg'=>'hello']);
    }

}
