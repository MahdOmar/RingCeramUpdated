<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\order;
use App\Models\Product;
use App\Models\order_details;
use Monolog\Handler\IFTTTHandler;

class OrderDetailsController extends Controller
{
   
    public function order_details($id){
            

        $products = Product::where('Categorie','Faience')->get();
        $productse = Product::all();
        $order_details = order_details::with('product')->where('Order_id',$id)->get();
        

        return view('Vente.order_details',['products' => $products,'order_details' => $order_details,'productes' => $productse]);
    }



    public function store_order_details(){

      $exist= 0;
      $quantity = 1;
      $existf= 0;
      $quantityf = 1;
      $existc= 0;
      $quantityc = 1;
     
        $product = Product::findorfail(request('Product'));
    
      $exist = Product::where('id', request('Product'))->value('Quantity');
     
      
      if(request('QuantityF') > 0 ||  request('QuantityC') > 0 )
      {
        $existf = $product->QuantityF;
        $existc = $product->QuantityC;
        $quantityf = request('QuantityF') * $product->meter_C;
        $quantityc = request('QuantityC') * $product->meter_C;
     
      
       
      }
      else {
       
        if( $product->Categorie == "Accessoires" || $product->Categorie == "Motif" )
        {
         
            $quantity = request('Quantity');
        }
        else{
            $quantity = request('Quantity') * $product->meter_C;
            

        }


        

      }

      

      if( $quantity <= $exist || ($quantityf <= $existf && $quantityc <= $existc) )
      {

      
       
      $order_save = new order_details();
      $order_save->Order_id = request('id');
      $order_save->Product_id = request('Product');
      if(request('QuantityF') > 0 ||  request('QuantityC') > 0 ){

        $order_save->QuantityF = request('QuantityF');
        $order_save->QuantityC = request('QuantityC') ;

        $order_save->Quantity = request('QuantityF') + request('QuantityC') ;

        $product->QuantityF = $product->QuantityF - (request('QuantityF') * $product->meter_C);
        $product->QuantityC = $product->QuantityC - (request('QuantityC')  * $product->meter_C);
        $product->Quantity = $product->Quantity - ($order_save->Quantity  * $product->meter_C);

     }
     else{

         if( $product->Categorie == "Accessoires" || $product->Categorie == "Motif" )
         {
            $order_save->Quantity = request('Quantity');
            $product->Quantity = $product->Quantity - $order_save->Quantity ;
      
         }
         else{
            $order_save->Quantity = request('Quantity');
            $product->Quantity = $product->Quantity - ($order_save->Quantity  * $product->meter_C);
      

         }
     
     }

     
      $order_save->Price = request('price');
      $order_save->save();
      $product->save();



     
      $order_details = order_details::with('product')->where('Order_id',request('id'))->get();
    


    

      return response()->json([
        "success"=>'Item Added',
        "Products" => $order_details
      ]);

      }

      else{
      
       
        $error = "No Quantity";
       
        return response()->json([
          "error"=>$error
          
        ]); ;


      }


  }

  public function Type()
  {
    $id = request('id');

     $product = Product::where('id', $id)->value('Type'); 
     error_log($product);
     return response()->json([
        'products'=>$product,
     ]);
    

    
  }

 public function showView($id)
  {

    $order = order::findOrfail($id);
   
    $order_details = order_details::with('product')->where('Order_id',$id)->get();

    return view('Vente.show',compact('order'),compact('order_details'));
    
  }




  public function getOrderDetails()
  {
  
   
    $order_details = order_details::with('product')->where('Order_id',request('idOrder'))->where('Product_id',request('idProduct'))->get();
    
    return $order_details;
 

    
  }

  public function getProduct()
  {
  
   
    $product = Product::findorfail(request('idProduct'));
    
    return $product;
 

  }

   public function updateOrderDetails()
  {

    $exist= 0;
    $existf= 0;
    $existc= 0;
    $quantity = 1;
    $quantityf = 1;
    $quantityc = 1;

    $product = Product::findorfail(request('Product'));
    $order_save = order_details::find(request('id'));

    if($order_save->QuantityF > 0 || $product->QuantityC > 0 )
    {
      $product->QuantityF = $product->QuantityF + ($order_save->QuantityF * $product->meter_C) ;
      $product->QuantityC = $product->QuantityC + ($order_save->QuantityC* $product->meter_C);
      $product->Quantity = $product->Quantity + ($order_save->Quantity * $product->meter_C);

      
  

    }
    
    else
    {
      if( $product->Categorie == "Accessoires" || $product->Categorie == "Motif" )
      {
          $product->Quantity = $product->Quantity + $order_save->Quantity;


      }
      else{
       
          $product->Quantity = $product->Quantity + ($order_save->Quantity * $product->meter_C);


      }


    }
    
   
    
    if(request('QuantityF') > 0 ||  request('QuantityC') > 0 )
    {

      $existf = $product->QuantityF;
      $existc = $product->QuantityC;
      $quantityf = request('QuantityF') * $product->meter_C;
      $quantityc = request('QuantityC') * $product->meter_C;
      

     
    }
    else {




      $exist = $product->Quantity;
      $quantity = request('Quantity') * $product->meter_C;

      error_log('Quan '.$quantity.'--Exist '.$exist);
    

    }
    

  
    if( $quantity <= $exist || ($quantityf <= $existf && $quantityc <= $existc) )
    {
    
   
    $order_save->Order_id = request('idOrder');
    $order_save->Product_id = request('Product');
   
    if(request('QuantityF') > 0 ||  request('QuantityC') > 0 ){

     
     

      $order_save->QuantityF = request('QuantityF');
      $order_save->QuantityC = request('QuantityC') ;

      $order_save->Quantity = request('QuantityF') + request('QuantityC') ;

     

      $product->QuantityF = $product->QuantityF - (request('QuantityF') * $product->meter_C);
      $product->QuantityC = $product->QuantityC - (request('QuantityC')  * $product->meter_C);
      $product->Quantity = $product->Quantity - ($order_save->Quantity  * $product->meter_C);

   }
   else{
     
    $order_save->Quantity = request('Quantity');
    
    $product->Quantity = $product->Quantity - ($order_save->Quantity * $product->meter_C);

   }
  
    $order_save->Price = request('price');
   
    
    $order_save->save();
    $product->save();

   

    $order_details = order_details::with('product')->where('Order_id',request('idOrder'))->get();
    
    return response()->json([
      "success"=>'Item Added',
      "Products" => $order_details
    ]);

    }
    else{
      error_log('-----------------------error');
      $error = "No Quantity";
     

      return response()->json([
        "error"=>$error
      
      ]);
     


    }
    
  }

  public function deleteOrderDetails()
  {

    $order_details = order_details::findOrfail(request('id'));
    $product = Product::findorfail($order_details->Product_id);
    if ( $order_details->QuantityF > 0 ||  $order_details->QuantityC > 0  ){

      $product->QuantityF = $product->QuantityF + ($order_details->QuantityF * $product->meter_C) ;
      $product->QuantityC = $product->QuantityC + ($order_details->QuantityC* $product->meter_C);
      $product->Quantity = $product->Quantity + ($order_details->Quantity * $product->meter_C);

    }
    else{

        if( $product->Categorie == "Accessoires" || $product->Categorie == "Motif" )
        {
            $product->Quantity = $product->Quantity + $order_details->Quantity;


        }
        else{
            $product->Quantity = $product->Quantity + ($order_details->Quantity * $product->meter_C);


        }

        
    
    }
    $product->save();
    $id_Order = $order_details->Order_id;
    $order_details->delete();
       
    $total = 0 ;
    $order_details = order_details::with('product')->where('Order_id',$id_Order)->get();
      
    foreach( $order_details as $item)
    {
      $total = $total + $item->Price * $item->Quantity * $item->product->meter_C; 


    }

     return response()->json([
      "success"=>'Item removed',
      "total" => $total
    
    ]);





  }


  public function getCategory()
  {
    
    

    $items =  Product::where('Categorie',request('cate'))
                       ->get();
   
    $html ='';
    
    foreach($items as $item) {
      $html.='<option value="'.$item->id.'">'.$item->Designation.'</option>';
    
    }
    
    return response()->json([
      "html" => $html
    
    ]);





  }

}
