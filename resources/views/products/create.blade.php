
@extends('layouts.dashboard')

@section('content')



<div  class=" shadow p-3 mb-5 bg-white rounded"  style=" margin-left:250px;margin-right:250px">
        <div class="text-center">
                <h2>Add Product</h2>
                <p class="text-danger">{{ $error }}</p>
                <p class="text-success">{{ $success }}</p>
        </div>
<form action="/dashboard/products" method="POST" enctype="multipart/form-data" novalidate>
         @csrf

        <div class="form-group row">
                <div class="col-md-6">
                        <label for="username">Designation:</label>
                        <input type="text" class="form-control" name="name" required>


                </div>

                <div class="col-md-6">
                        <label for="Categorie">Categorie:</label>
                        <select name="Categorie"  id="Categorie"   class="form-control "  required >
                                <option value="Faience">Faience</option>
                                <option value="Dalle de sol">Dalle de sol</option>
                                <option value="Motif">Motif</option>
                                <option value="Accessoires">Accessoires</option>
                               
                          </select>


                </div>



         
        </div>

        <div class="form-group row size">
                <div class="col-md-6">
                        <label for="size">Size:</label>
                        <input type="text" class="form-control" name="size" required>


                </div>

                <div class="col-md-6">
                        <label for="Lieu">Site:</label>
                        <select name="site"    class="form-control"  required >
                                <option value="Cuisine">Cuisine</option>
                                <option value="Douche">Douche</option>
                                <option value="Couloir">Couloir</option>
                                <option value="CuisineDouche">Cuisine/Douche</option>
                                <option value="Sol">Sol</option>
                               
                          </select>


                </div>



         
        </div>

        <div class="form-group Type">
                <label for="aioConceptName">Type:</label>
                <select name="type"  id="aioConceptName"  class="form-control" onchange="quantity()"  required >
                    <option value="X">None</option>
                    <option value="FC">Foncé/Claire</option>
                   
              </select>
        </div>

        <div class="form-group row Quantity" style="display: none">
                <div class="col-md-6">
                      <label for="QuantityF">Quantity Foncé:</label>
                      <input type="number" class="form-control" name="QuantityF" step="0.01"  required>
                  
                </div>
                <div class="col-md-6">
                      <label for="QuantityC">Quantity Claire:</label>
                      <input type="number"   class="form-control" name="QuantityC"  step="0.01" required><br>
                </div>
        </div>

        <div class="form-group Qn">
          <div >
                <label for="Quantity">Quantity:</label>
                <input type="number" class="form-control" name="Quantity" step="0.01"  required>
            
          </div>
        </div>
        <div class="form-group meter "> 
          <div >
                <label for="meter">Meter/K:</label>
                <input type="number"   class="form-control" name="meter"  step="0.01" required><br>
          </div>
        </div>


        <div class="form-group row">
                <div class="col-md-6">
                        <label for="price_a">Price_Achat:</label>
                        <input type="number"   class="form-control" step="1"  name="price_a" required>


                </div>

                <div class="col-md-6">
                        <label for="price_v">Price_Vendre:</label>
                        <input type="number"   class="form-control" step="1"  name="price_v" required>
                </div>


        </div>

        <div class="user-image mb-3 text-center">
                <div class="imgPreview"> </div>
        </div>

        <div class="input-group">
                
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                </div>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="inputGroupFile01"
                    aria-describedby="inputGroupFileAddon01" name="image[]" multiple>
                  <label class="custom-file-label" for="inputGroupFile01">Choose image</label>
                </div>
        </div>



        <div class="form-group">
                <button type="submit" class="btn btn-block btn-dark mt-3">Add Product</button>
        </div>


</form>
</div>

      

        

   

      
        
  @endsection
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>

        $(function(){

                $('#Categorie').change(function(){
                        if($('#Categorie').find(":selected").val() == "Accessoires")
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
        

        $(function() {
        // Multiple images preview with JavaScript
        var multiImgPreview = function(input, imgPreviewPlaceholder) {

            if (input.files) {
                var filesAmount = input.files.length;

                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                    }

                    reader.readAsDataURL(input.files[i]);
                }
            }

        };

        $('#inputGroupFile01').on('change', function() {
            multiImgPreview(this, 'div.imgPreview');
        });
        });



  </script>