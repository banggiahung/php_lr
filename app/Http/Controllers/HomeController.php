<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function Index()
    {
        $allProducts = Products::latest()->get();
        return view('user_template.home', compact('allProducts'));

    }
}