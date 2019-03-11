<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use App\User;
use Session;

class UserController extends Controller
{   
	//home page
    public function index()
    {   
        if(Session::get('user'))
        {
        	return Redirect::to('/main_page');
        }
    	return view('welcome');
    }

    // creatin a user
    public function storeUser(Request $request)
    {   
    	$user = new User;

    	$exists = DB::table('users')->where('email',$request->email)->first();

    	if($exists)
    	{
    		return response()->json(['msg'=>'have']);
    	}
    	else if($request->password != $request->repeat_password)
    	{
    		return response()->json(['msg'=>'mismatch']);
    	}
    	else
    	{
    		$user::create(

    			[
    				'name' => $request->name,
    				'email' => $request->email,
    				'password' => $request->password

    			]
    		);

    		return response()->json(['msg'=>'created']);
    	}
    	
    }
    // checking whether a user valid or not
    public function checkUser(Request $request)
    {   
    	$user = DB::table('users')->where(['email'=>$request->email,'password'=>$request->password])->first();

    	if($user)
    	{   
            $user_id = $user->id;
    		Session::put('user',$user_id);

    		$href = '/main_page';

    		return response()->json(['href'=>$href]);
    	}
    	else
    	{
    		return response()->json(['msg'=>'incorrect']);
    	}
    	
    }
    public function mainPage()
    {   
    	if(Session::get('user'))
        {   
            $user_id = Session::get('user');
            $user = DB::table('users')->where('id',$user_id)->first();
    	    return view('inventory',['user'=>$user]);
        }
    	
    	return Redirect::to('/');
    }

    public function logOut()
    {
    	Session::put('user',null);
    	return Redirect::to('/');
    }
}
