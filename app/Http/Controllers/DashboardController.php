<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Commande;
use App\Models\order;



class DashboardController extends Controller
{

  
  public function __construct(){
    $this->middleware('auth');
  }



    public function index(){

      $Products = Product::all();
      $CountProducts = count($Products);

      $Product = Product::where('Quantity','<',10)->get();
      $Count = count($Product);

      $Commandes = Commande::all();
      $CountCommandes = count($Commandes);

      $Not_Completed =  Commande::where('Status','Not_Completed')->get();
      $Count_Not_Completed = count($Not_Completed);

      $Completed =  Commande::where('Status','Completed')->get();
      $Count_Completed = count($Completed);

      $orders = order::all();
      $Count_orders =  count($orders);




      return view('Dashboard.index',['CountProducts' => $CountProducts ,'Count' => $Count ,'CountCommandes' =>  $CountCommandes, 
                                     'Count_Not_Completed' => $Count_Not_Completed, 'Count_Completed' => $Count_Completed,
                                      'orders' => $Count_orders]);


    }
      
      
}
