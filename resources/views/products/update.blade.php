
@extends('layouts.dashboard')

@section('content')


<div  class=" shadow p-3 mb-5 bg-white rounded"  style=" margin-left:250px;margin-right:250px">
        <div class="text-center">
                <h2>Update Product</h2>
        </div>
<form action="/dashboard/products/update/{{$product->id}}" method="POST">
         @csrf
         <div class="form-group row">
                <div class="col-md-6">
                        <label for="username">Designation:</label>
                        <input type="text" class="form-control" name="name" value="{{ $product->Designation}}" required>


                </div>

                <div class="col-md-6">
                        <label for="Categorie">Categorie:</label>
                        <select name="Categorie" id="Categorie"   class="form-control"  required >
                                <option value="Faience"  {{ $product->Categorie == "Faience" ? 'selected' : '' }}>Faience</option>
                                <option value="Dalle de sol"  {{ $product->Categorie == "Dalle de sol" ? 'selected' : '' }}>Dalle de sol</option>
                                <option value="Motif"  {{ $product->Categorie == "Motif" ? 'selected' : '' }} >Motif</option>
                                <option value="Motif"  {{ $product->Categorie == "Accessoires" ? 'selected' : '' }} >Accessoires</option>
                                
                               
                          </select>


                </div>



         
        </div>

        @if ($product->Categorie != "Motif" && $product->Categorie != "Accessoires")
            
        

        <div class="form-group row size">
                <div class="col-md-6">
                        <label for="size">Size:</label>
                        <input type="text" class="form-control" value="{{ $product->Size }}" name="size" required>


                </div>

                <div class="col-md-6">
                        <label for="Lieu">Site:</label>
                        <select name="site"    class="form-control"   required >
                                <option value="Cuisine"  {{ $product->Site == "Cuisine" ? 'selected' : '' }}>Cuisine</option>
                                <option value="Douche" {{ $product->Site == "Douche" ? 'selected' : '' }} >Douche</option>
                                <option value="Couloir" {{ $product->Site == "Couloir" ? 'selected' : '' }}  >Couloir</option>
                                <option value="CuisineDouche" {{ $product->Site == "CuisineDouche" ? 'selected' : '' }}   >Cuisine/Douche</option>
                                <option value="Sol" {{ $product->Site == "Sol" ? 'selected' : '' }} >Sol</option>
                               
                          </select>


                </div>



         
        </div>
        

        <div class="form-group Type">
                <label for="aioConceptName">Type:</label>
                <select name="type"  id="aioConceptName"  class="form-control" onchange="quantity()"  required >
                    <option value="X"  {{ $product->Type == "X" ? 'selected' : '' }}>None</option>
                    <option value="FC" {{ $product->Type == "FC" ? 'selected' : '' }}>Foncé/Claire</option>
                   
              </select>
        </div>

        @if ( $product->Type == "X" )

        <div class="form-group row Quantity" style="display: none">
                <div class="col-md-6">
                      <label for="QuantityF">Quantity Foncé:</label>
                      <input type="number" class="form-control" name="QuantityF" step="0.01" value="{{ $product->QuantityF }}"  required>
                  
                </div>
                <div class="col-md-6">
                      <label for="QuantityC">Quantity Claire:</label>
                      <input type="number"   class="form-control" name="QuantityC"  value="{{ $product->QuantityC }}"   step="0.01" required><br>
                </div>
        </div>

        <div class="form-group Qn" >
                <div >
                      <label for="Quantity">Quantity:</label>
                      <input type="number" class="form-control" name="Quantity" step="0.01" value="{{ $product->Quantity }}" required>
                  
                </div>
        </div>

        


            
        @else
            
       
        <div class="form-group row Quantity" >
                <div class="col-md-6">
                      <label for="QuantityF">Quantity Foncé:</label>
                      <input type="number" class="form-control" name="QuantityF" step="0.01" value="{{ $product->QuantityF }}"  required>
                  
                </div>
                <div class="col-md-6">
                      <label for="QuantityC">Quantity Claire:</label>
                      <input type="number"   class="form-control" name="QuantityC"  value="{{ $product->QuantityC }}"   step="0.01" required><br>
                </div>
        </div>
        <div class="form-group Qn" style="display: none">
                <div >
                      <label for="Quantity">Quantity:</label>
                      <input type="number" class="form-control" name="Quantity" step="0.01" value="{{ $product->Quantity }}" required>
                  
                </div>
        </div>

        @endif


       
              <div class="form-group meter"> 
                <div >
                      <label for="meter">Meter/K:</label>
                      <input type="number"   class="form-control" name="meter"  step="0.01" value="{{ $product->meter_C }}" required><br>
                </div>
              </div>
              @else
              <div class="form-group Qn" >
                <div >
                      <label for="Quantity">Quantity:</label>
                      <input type="number" class="form-control" name="Quantity" step="0.01" value="{{ $product->Quantity }}" required>
                  
                </div>
        </div>
    
              @endif    


        <div class="form-group row">
                <div class="col-md-6">
                        <label for="price_a">Price_Achat:</label>
                        <input type="number"   class="form-control" step="1"  name="price_a" value="{{ $product->Price_A }}" required>


                </div>

                <div class="col-md-6">
                        <label for="price_v">Price_Vendre:</label>
                        <input type="number"   class="form-control" step="1"  name="price_v" value="{{ $product->Price_V }}" required>
                </div>


        </div>
        <div class="form-group">
                <button type="submit" class="btn btn-block btn-dark ">Update Product</button>
        </div>


</form>
</div>






        
  @endsection
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script>

          
        $(function(){

$('#Categorie').change(function(){
        if($('#Categorie').find(":selected").val() == "Accessoires" || $('#Categorie').find(":selected").val() == "Motif" )
        {

                console.log($('#Categorie').find(":selected").val());
                $('.Quantity').hide();
                $('.Type').hide();
                $('.size').hide();
                $('.meter').hide();
        }
        else
        {
               
                $('.Type').show();
                $('.size').show();
                $('.meter').show();



        }

})

});





  </script>