<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminChatController extends Controller
{
     public function index(){
        return view('admin.chat.index');
    
    }
    //end function
}
