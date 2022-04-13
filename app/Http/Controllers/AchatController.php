<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\PDF;

use Illuminate\Http\Request;
use App\Models\Achat;
use App\Models\order;
use App\Models\Product;
use App\Models\order_details;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Dompdf\Adapter\PDFLib;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class AchatController extends Controller
{

  
  public function __construct(){
    $this->middleware('auth');
  }



    public function index(){

    
              
      $orders = order::orderBy('created_at','DESC')->paginate(10);

      
     

        return view('Vente.index',['orders' => $orders]);
        
       
          }
      
          
          public function create(){
           



              return view('Vente.create');
          }
      
      
          public function store(){ 

            $order = new order();

            $order->ClientName = request('ClientName');
            $order->ClientPhone = request('ClientPhone');
            $order->ClientAdress = request('ClientAdress');
            $order->save();

            $orders = order::orderBy('created_at',"DESC")->get();

            

            return $orders;
       
          }
 
          public function showData(){

          
             $order = order::find(request('id'));
            
              return response()->json([
              'order'=>$order,
           ]);
          }
 
          public function update(){

            $order = order::find(request('id'));
            $order->ClientName = request('ClientName');
            $order->ClientPhone = request('ClientPhone');
            $order->ClientAdress = request('ClientAdress');
            $order->save();

            
           
            $orders = order::orderBy('created_at',"DESC")->get();
            

            return $orders;
 
             


              
           
          }
      
      
          public function destroy(){
              $order = order::findOrfail(request('id'));
               order_details::where('Order_id',request('id'))->delete();
            
              $order->delete();

               return response()->json([
                "success"=>'Item removed',
              
              ]);
          }

          public function filter()
          {

            if(request('date') == "tod")
            {
              $today = Carbon::today();
              
              $sales = order::whereDate('created_at',"=",$today)->get();
    
              return $sales;
            }
    
            else if(request('date') == "yes")
            {
              $yesterday = Carbon::yesterday();
              
              $sales = order::whereDate('created_at',"=",$yesterday)->get();
    
              return $sales;
            }
            else if(request('date') == "lw")
            {
    
              $date = Carbon::now()->subDays(7);
              $sales = order::whereBetween('created_at',  [$date,Carbon::now()])->get();
    
              return $sales;
    
    
            }
    
            else if(request('date') == "lm")
            {
              $date = Carbon::now()->subDays(30);
              $sales = order::whereBetween('created_at',  [$date,Carbon::now()])->get();
    
              return $sales;
    
    
            }
            else{
    
              $sales = order::orderBy('created_at', 'DESC')->get();
              return $sales;
    
    
            }
    
    
    
    
          }
        

      


      
}
