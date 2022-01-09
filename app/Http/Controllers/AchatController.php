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

      $orders = order::all();





 

      /*  $sales = Achat::join('products','achats.product_id','=','products.id')
        ->select('achats.id','products.Designation','products.Type','achats.Quantity','achats.Amount','achats.created_at')
        ->get();*/

      /*  if(is_null(request('date'))){
          $sales = Achat::with('product')->get();
          $total = $sales->sum('Amount');
          
              
                return view('Vente.index',['sales' => $sales,'total' => $total]);

        }
        else{
          if(request('date') == "lastW"){
            $sales = Achat::with('product')->whereBetween('created_at',[Carbon::now()->subWeeks(1),Carbon::now()])->get();
            $total = $sales->sum('Amount');
            return view('Vente.index',['sales' => $sales,'total' => $total]);
          }
        }*/

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
            $orders = order::all();
            

            return $orders;













      /*
              $sale = new Achat();
              $names = Product::distinct()->get(['Designation']);
      
              

              $product = Product::where('Designation',request('name'))->where('Type',request('type'))->get();
              
             
              if($product->count() == 0){
                  $error='Product does not exist in stock';
                  return view('Vente.create',['error' => $error,'names' => $names]);
              }
              
              else{
              
                  if($product[0]->Quantity < request('Quantity'))
                  {
                    return view('Vente.create',['error' => 'Sale Quantity is sup than Stock Quantity','names' => $names]);
                  }

                  elseif(request('Quantity') == 0)
                  {
                    return view('Vente.create',['error' => 'Sale Quantity is 0','names' => $names]);
                  
                  }

                  else{
                    $sale->product_id = $product[0]->id;  
                    $sale->Quantity = request('Quantity');
                    $sale->Amount = request('price_a');
                    $product[0]->Quantity = $product[0]->Quantity - $sale->Quantity;
                    $product[0]->save();

                    $sale->save();
           
      
                    return redirect('/dashboard/sales');
                  }


              }
*/

         
             
              
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
            $orders = order::all();
            

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

      


      
}
