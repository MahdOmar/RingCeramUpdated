<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Commande;
use Illuminate\Support\Carbon;
use App\Models\order_details;
use App\Models\order;
use Illuminate\Support\Arr;

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

      $Ceramic =  Product::where('Categorie','!=',"Accessoires")->get();
      $Cer = count($Ceramic); 

      $Acces =  Product::where('Categorie',"Accessoires")->get();
      $Acc = count($Acces); 

     

      $Commandes = Commande::all();
      $CountCommandes = count($Commandes);

      $Not_Completed =  Commande::where('Status','Not_Completed')->get();
      $Count_Not_Completed = count($Not_Completed);

      $Completed =  Commande::where('Status','Completed')->get();
      $Count_Completed = count($Completed);

      $orders = order::all();
      $Count_orders =  count($orders);

      $today = Carbon::now();
      $ord_tod = order::whereDate('created_at',"=",$today)->get();
      $tod =  count($ord_tod);

      $yesterday = Carbon::yesterday();     
      $ord_yes = order::whereDate('created_at',"=",$yesterday)->get();
      $count_yes = count($ord_yes);


      $date = Carbon::now()->subDays(7);
      $ord_lw = order::whereBetween('created_at',  [$date,Carbon::now()])->get();
      $count_lw = count($ord_lw);


      
      $salesData1 = order_details::join('products', 'order_details.Product_id', '=', 'products.id')
                                  ->where(function($query) {
                                    $query->where('products.Categorie','=','Motif') 
                                    ->orWhere('products.Categorie','=','Accessoires');

                                   })
                                
                                ->whereYear('order_details.created_at', date('Y'))
                                ->select(DB::raw('sum(order_details.Price * order_details.Quantity )as amount'))
                                ->groupBy(DB::raw("Month(order_details.created_at) "))
                                
                                ->pluck('amount');
      
       $salesData2 = order_details::join('products', 'order_details.Product_id', '=', 'products.id')
                                ->where(function($query) {
                                    $query->where('products.Categorie','!=','Motif') 
                                    ->where('products.Categorie','!=','Accessoires');

                                   })
                                 
                                   ->whereYear('order_details.created_at', date('Y'))
                                   ->select(DB::raw('sum(order_details.Price * order_details.Quantity * products.meter_C )as amount'))
                                   ->groupBy(DB::raw("Month(order_details.created_at) "))
       
                                  ->pluck('amount');

                             
                                      
                                

      $Months = order_details::select(DB::raw('Month(created_at)as month'))
                                ->whereYear('created_at', date('Y'))
                                ->groupBy(DB::raw("Month(created_at) "))
                                
                                ->pluck('month');
       
                                


       $datas = array(0,0,0,0,0,0,0,0,0,0,0,0); 
       error_log( print_r($salesData2, TRUE) );
       error_log( print_r($Months, TRUE) );
       
       foreach($Months as $index => $month)
       {
         if($index < count($salesData1))
         {
          $datas[$month-1] = $salesData2[$index] + $salesData1[$index] ;

         }
         else
         {
          $datas[$month-1] = $salesData2[$index];

         }
        
       }
      
      // error_log(print_r($datas, TRUE) );

     

      $today_cer = order_details::join('products', 'order_details.Product_id', '=', 'products.id')
                                   ->where(function($query) {
                                    $query->where('products.Categorie','!=','Motif') 
                                    ->where('products.Categorie','!=','Accessoires');

                                   })
                                   ->whereDate('order_details.created_at', '=',Carbon::now())
                                   ->sum(DB::raw('order_details.Price *  order_details.Quantity * products.meter_C ')) ;

      $today_oth = order_details::join('products', 'order_details.Product_id', '=', 'products.id')
                                    ->where(function($query) {
                                    $query->where('products.Categorie','=','Motif') 
                                    ->orWhere('products.Categorie','=','Accessoires');

                                   })
                                   ->whereDate('order_details.created_at', '=',Carbon::now())
                                   ->sum(DB::raw('order_details.Price *  order_details.Quantity')) ;        
                                   
       $today_tot = $today_cer +  $today_oth  ;  
       
       
        $yes_cer = order_details::join('products', 'order_details.Product_id', '=', 'products.id')
                                   ->where(function($query) {
                                    $query->where('products.Categorie','!=','Motif') 
                                    ->where('products.Categorie','!=','Accessoires');

                                   })
                                   ->whereDate('order_details.created_at', '=',Carbon::yesterday())
                                   ->sum(DB::raw('order_details.Price *  order_details.Quantity * products.meter_C ')) ;

      $yes_oth = order_details::join('products', 'order_details.Product_id', '=', 'products.id')
                                    ->where(function($query) {
                                    $query->where('products.Categorie','=','Motif') 
                                    ->orWhere('products.Categorie','=','Accessoires');

                                   })
                                   ->whereDate('order_details.created_at', '=',Carbon::yesterday())
                                   ->sum(DB::raw('order_details.Price *  order_details.Quantity')) ;        
                                   
       $yes_tot = $yes_cer +  $yes_oth  ; 
      
         $lw_cer = order_details::join('products', 'order_details.Product_id', '=', 'products.id')
                                   ->where(function($query) {
                                    $query->where('products.Categorie','!=','Motif') 
                                    ->Where('products.Categorie','!=','Accessoires');

                                   })
                                   ->sum(DB::raw('order_details.Price *  order_details.Quantity * products.meter_C ')) ;

      $lw_oth = order_details::join('products', 'order_details.Product_id', '=', 'products.id')
                                    ->where(function($query) {
                                    $query->where('products.Categorie','=','Motif') 
                                    ->orWhere('products.Categorie','=','Accessoires');

                                   })
                                   ->sum(DB::raw('order_details.Price *  order_details.Quantity')) ;        
                                   
       $lw_tot = $lw_cer +  $lw_oth  ; 
      

        $Sales_all = order_details::join('products', 'order_details.Product_id', '=', 'products.id')
                                     ->where('products.Categorie','=','Motif') 
                                     ->orwhere('products.Categorie','=','Accessoires')
                                     ->sum(DB::raw('(order_details.Price * order_details.Quantity) - (products.Price_A * order_details.Quantity) '));

       $Sales_all2 = order_details::join('products', 'order_details.Product_id', '=', 'products.id')
                                     ->where('products.Categorie','!=','Motif') 
                                     ->where('products.Categorie','!=','Accessoires')
                                     ->sum(DB::raw('(order_details.Price * order_details.Quantity * products.meter_C )-(products.Price_A * order_details.Quantity * products.meter_C ) '));   

 
                                     
         $income = ($Sales_all + $Sales_all2 );  
         
         

         $top = order_details::select(
          'products.Designation',
          'products.meter_C',
          'order_details.Price',
          'products.Price_A',
          DB::raw('SUM((order_details.Quantity))  as total'))
          ->leftJoin('products', 'products.id', '=', 'order_details.Product_id')
          ->groupBy('order_details.Product_id')
          ->orderBy('total', 'desc')
          ->limit(5)
          ->get();
                                     
                                     
                                     
                              
        
     

                              



      return view('Dashboard.index',['CountProducts' => $CountProducts ,'Count' => $Count ,'CountCommandes' =>  $CountCommandes, 
                                     'Count_Not_Completed' => $Count_Not_Completed, 'Count_Completed' => $Count_Completed,
                                     'Ceramic' => $Cer, 'Acc' => $Acc,
                                      'orders' => $Count_orders,'today' => $tod ,'yesterday' => $count_yes, 'LastW' => $count_lw ,
                                      'salesData' => $datas, "salesToday" => $today_tot ,'salesYes' => $yes_tot,'salesLw' => $lw_tot,
                                       'income' => $income ,'top' => $top]);


    }
      
      
}
