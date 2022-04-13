<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;

class CommandeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
      }

    public function index(){
     
        $Commandes = Commande::where('Status','Not_Completed')->orderBy('created_at','DESC')->paginate(10);
        
        $Completeds = Commande::where('Status','Completed')->orderBy('created_at','DESC')->paginate(10);
            
              return view('commandes.index',['Commandes' => $Commandes , 'Completeds' => $Completeds]);
          }
      
          
          public function create(){
           
            $success ="";

              return view('commandes.create',['success' => $success]);
          }
      
      
          public function store(){

            
            

                
              $commande = new Commande();
              $commande->Name = request('name');
              $commande->phone = request('phone');
              $commande->Designation = request('des');
    
              $commande->Quantity = request('Quantity');
           
             
              $commande->save();

              $success ="Command Added";
           
           
      
              return view('commandes.create',['success' => $success]);


      
          }
 
          public function showData($id){
             $Commande = Commande::find($id);
             return view('commandes.update',['commande' => $Commande]);
          }
 
          public function update($id){
 
              $commande = Commande::findOrfail($id);
              $commande->Name = request('name');
              $commande->phone = request('phone');
              $commande->Designation = request('des');
           
            
              $commande->Quantity = request('Quantity');
              $commande->save();
              return redirect('/dashboard/commandes');
 
          }
      
      
          public function destroy(){
              $Commande = Commande::findOrfail(request('id'));
              $Commande->delete();

           
              return response()->json([
                "success"=>'Commande removed',
              

              
              ]);
      
          }

          public function complete(){
             
            $Commande = Commande::findOrfail(request('id'));
            $Commande->Status = "Completed";
            $Commande->save();

            $Commandes = Commande::where('Status','Not_Completed')->get();
        
            $Completeds = Commande::where('Status','Completed')->get();
              return response()->json([
                "success"=>'Commande removed',
                'Commandes' => $Commandes,
                'Completeds' => $Completeds,

              
              ]);
        }

        public function deComplete(){
           
          $Commande = Commande::findOrfail(request('id'));
          $Commande->Status = "Not_Completed";
          $Commande->save();
          $Commandes = Commande::where('Status','Not_Completed')->get();
        
          $Completeds = Commande::where('Status','Completed')->get();
          return response()->json([
              "success"=>'Commande deCompeletd',
              'Commandes' => $Commandes,
              'Completeds' => $Completeds,
            
            ]);
      }


}
