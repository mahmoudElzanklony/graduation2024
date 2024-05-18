<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function products()
    {
        $name = 'ali';
        return view('products',compact('name'));
    }
}
