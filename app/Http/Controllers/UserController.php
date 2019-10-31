<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class UserController extends Controller
{
    //

    public function profile(){
    	$user=Auth::User();
    	return view('profile.profile')->with('user',$user);
    }
}
