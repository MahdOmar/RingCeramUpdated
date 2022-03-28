<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

   public function __construct(){
        $this->middleware('auth',['except' => ['allProducts','showDetails','Category']]);
      } 

    public function index(){
     
       $products = Product::orderBy('Designation', 'ASC')->paginate(16);;

             return view('products.index',['products' => $products]);
         }
     
         
         public function create(){
            $error ="";
            $success ="";
             return view('products.create',['success' => $success,'error' => $error]);
         }
     
     
         public function store(){


            $Exist_Product = Product::where('Designation',request('name'))->get();
            $count = count($Exist_Product);

            if($count > 0)
            {
               $error = "Product Exist";
               $success="";

               return view('products.create',['success' => $success,'error' => $error]);


            }

            else
            {

               

               $image = array();
               $files = request('image');
                   foreach ($files as $file) {
                       $image_name = md5(rand(1000, 10000));
                       $ext = strtolower($file->getClientOriginalExtension());
                       $image_full_name = $image_name.'.'.$ext;
                       $upload_path = 'img/products/';
                       $image_url = $upload_path.$image_full_name;
                       $file->move($upload_path, $image_full_name);
                       $image[] = $image_url;
                   }
               
   
   
   
                $product = new Product();
        
                $product->Designation = request('name');
                $product->Categorie = request('Categorie');
                if(request('Categorie') == "Accessoires" || request('Categorie') == "Motif" )
                {
                  $product->Size = '';
                  $product->Site = '';
                  $product->Type = '';
                  $product->Quantity = request('Quantity');



                }
                else
                {

                  $product->Size = request('size');
                  $product->Site = request('site');
                  $product->Type = request('type');
                  if(request('type') == "FC"){
                     $product->QuantityF = request('QuantityF');
                     $product->QuantityC = request('QuantityC');
                     $product->Quantity = request('QuantityF') + request('QuantityC') ;
     
                  }
                  else{
                     $product->Quantity = request('Quantity');
     
                  }
                  $product->meter_C = request('meter');

                }
                
                $product->image_path = implode('|', $image);
                
                $product->Price_A = request('price_a');
                $product->Price_V = request('price_v');
                $product->save();

                $success = "Product added";
                $error = "";
             
        
                return view('products.create',['success' => $success, 'error' => $error]);




            }






           
         }

         public function showData($id){
            $product = Product::find($id);
            return view('products.update',['product' => $product]);
         }

         public function showDetails($id){
            $product = Product::find($id);
            return view('products.show',['product' => $product]);
         }

         public function update($id){
           

             $product = Product::findOrfail($id);
             
             $product->Designation = request('name');
             $product->Categorie = request('Categorie');
             if(request('Categorie') == "Accessoires" || request('Categorie') == "Motif" )
             {
               $product->Size = '';
               $product->Site = '';
               $product->Type = '';
               $product->Quantity = request('Quantity');



             }

             else
             {
               $product->Size = request('size');
               $product->Site = request('site');
               $product->Type = request('type');
  
               if(request('type') == "FC"){
                  $product->QuantityF = request('QuantityF');
                  $product->QuantityC = request('QuantityC');
                  $product->Quantity = request('QuantityF') + request('QuantityC') ;
  
               }
               else{
  
                  $product->QuantityF = 0;
                  $product->QuantityC = 0;
                  $product->Quantity = request('Quantity');
  
               }
  
  
               $product->meter_C = request('meter');



             }


          
         
             $product->Price_A = request('price_a');
             $product->Price_V = request('price_v');
             $product->save();
             return redirect('/dashboard/products');

         }
     
     
         public function destroy(){
             $product = Product::findOrfail(request('id'));
             $product->delete();
            return response()->json([
               "success"=>'Item deleted',
             
             ]);;



         }



         public function allProducts(){
           
     
            $products = Product::paginate(16);
                
                  return view('products.allProducts',['products' => $products]);
              }


          public function Category()
          {
           
            if(request('category') == 'All'){
               $products = Product::paginate(10);
            }
           else
           {
            $products = Product::where('Categorie',request('category'))->paginate(10);

           }
         
            return response()->json([
               
               "Products" => $products
             ]);



          }    

          public function filter()
          {
           
            

           
             if(request('filter') == "Acc")
             {


               $products = Product::where('Categorie', '=', 'Accessoires')                      
                                    ->get();

               return $products;
             }

             else if( request('filter') == "Mof" )
             {


               $products = Product::where('Categorie', '=', 'Motif')                         
                                    ->get();

               return $products;
             }


             else if( request('filter') == "Dalle" )
             {


               $products = Product::where('Categorie', '=', 'Dalle de sol')                         
                                    ->get();

               return $products;
             }

             else if( request('filter') == "Fai" )
             {


               $products = Product::where('Categorie', '=', 'Faience')                         
                                    ->get();

               return $products;
             }

             else if( request('filter') == "Price" )
             {


               $products = Product::orderBy('Price_V', 'DESC')                         
                                    ->get();

               return $products;
             }

             else if( request('filter') == "Quan" )
             {


               $products = Product::orderBy('Quantity', 'DESC')                         
                                    ->get();

               return $products;
             }
             else if( request('filter') == "Cuisine" )
             {


               $products = Product::where('Site', '=', 'Cuisine')    
                                    ->orWhere('Site', '=', 'CuisineDouche')                        
                                    ->get();

               return $products;
             }

             else if( request('filter') == "Douche" )
             {


               $products = Product::where('Site', '=', 'Douche')  
                                    ->orWhere('Site', '=', 'CuisineDouche')                       
                                    ->get();

                                  
               return $products;
             }

             else if( request('filter') == "Couloir" )
             {


               $products = Product::where('Site', '=', 'Couloir')                        
                                    ->get();

                                    
               return $products;
             }

             else if( request('filter') == "CuisineDouche" )
             {


               $products = Product::where('Site', '=', 'CuisineDouche')                        
                                    ->get();

               return $products;
             }


             else
             {
               $products = Product::orderBy('Designation', 'ASC')->get();
               return $products;
             }



            
          }
     
}
