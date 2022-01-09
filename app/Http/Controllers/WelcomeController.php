<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class WelcomeController extends Controller
{

    

    public function index(){
     
       $products = Product::latest()->take(8)->get();
           
             return view('welcome',['products' => $products]);
         }
     
         
        
     
     
       

         
         
     
     
         
     
}
