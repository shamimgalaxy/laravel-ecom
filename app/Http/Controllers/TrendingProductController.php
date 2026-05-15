<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrendingProductController extends Controller
{
    public function index(){
        return view('website.product.page1');
    }
    //
}
