<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('frontend.home');
    }

    public function shop(){
        $products = Products::where('status', 1)->get();
        return view('frontend.shop', compact('products'));
    }

    public function productSingle($slug){
        
        $products = Products::with('product_variant')->with('image_gallery')->where('slug', $slug)->first();
        
        //dd($products);
        return view('frontend.productSingle', compact('products'));
    }
}
