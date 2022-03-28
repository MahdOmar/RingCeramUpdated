
@extends('layouts.dashboard')

@section('content')

<div class="m-3">

  <h4><a class="text-info" href="/dashboard">Dashborad</a> / Stock </h4>

</div>

<div  class=" shadow p-3 mb-5 bg-white rounded"  style=" margin-left:10px;margin-right:10px">

<div class="row">

  <div class="col-md-3 ">
    <input type="text" name="search" class="form-control" id="searchP" placeholder="search" >

  </div>

  <div class="col-md-3">

    <select name="filter"  id="filter" class="form-control form-select mt-1 "  >
      <option value="" selected disabled>Filter by</option>
            <option value="Quan">Quantity</option>
            <option value="Acc">Accessoires</option>
            <option value="Mof">Motifs</option>
            <option value="Dalle">Dalle de Sol</option>
            <option value="Fai">Faience</option>
            <option value="Price">Price</option>  
            <option value="Cuisine">Cuisine</option>
            <option value="Douche">Douche</option>
            <option value="Couloir">Couloir</option>
            <option value="CuisineDouche">Cuisine/Douche</option>
            <option value="Def">Default</option>
    </select>

  </div>


  <div class="col-md-6 ">
    <a href="/dashboard/products/create" class="btn btn-dark  m-2  text-white" style="float:right" role="button" ><i class="fas fa-plus-square m-1"></i>Add Product</a>

  </div>

</div>
       
     
      
       

 
       <table class="table   table-striped table-hover text-center">
        <thead class="bg-dark text-white">
          <tr>
            <th>Designation</th>
            <th>Meter/C</th>
            <th>QuantityF</th>
            <th>QuantityC</th>
            <th>Quantity(total)</th>
            <th>Price_A</th>
            <th>Price_V</th>
            <th>Options</th>
          </tr>
        </thead>
        <tbody>
          @foreach($products as $product)
          <tr>
            <td>{{ $product->Designation }}
              @if ($product->Categorie != 'Accessoires')
                  
              {{ $product->Size }} 
             
             </td>
          
            <td>
                  
              
              {{ $product->meter_C }}m
              
                  
              @else
            <td>-</td>  
              
              @endif
            </td>
            @if ($product->QuantityF == 0 && $product->QuantityC == 0 )
            <td>-</td>
            <td>-</td>
       
            @else
            <td>{{ $product->QuantityF }}m</td>
            <td>{{ $product->QuantityC }}m</td>
    
            @endif

           
            <td>{{ $product->Quantity }}@if ($product->Categorie != 'Accessoires')m @endif </td>
            <td>{{ $product->Price_A }} DA</td>
            <td>{{ $product->Price_V }} DA</td>
            <td> <a href="/dashboard/products/update/{{ $product['id'] }}" class="btn btn-primary text-white" role="button" ><i class="fas fa-edit"></i></a>
              
                <button id="btn{{ $product->id}}" onclick="deleteProduct({{ $product->id}})" class="btn btn-danger"><i class="fas fa-trash"></i></button>
        
            </td>
              
          </tr>
          @endforeach
      
        </tbody>
       </table>

       <div class=" d-flex justify-content-center mt-4 ">
      <div> {{ $products->links('pagination::bootstrap-4')}}</div> 
    
      </div>
     
        
       
   
      
      
       
       


</div>
        

    
  @endsection
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
   
   

function deleteProduct(id)

{
 

   $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }       
    });

  
   
   
    swal({
        title: 'Are you sure?',
        text: 'This record and it`s details will be permanantly deleted!',
        icon: 'warning',
        dangerMode: true,
        buttons: ["Cancel", "Yes!"],
    }).then(function(value) {
        if (value) {
            
            
    $.ajax({
          url : '/dashboard/product/delete',
          data:{'id':id},
          type: 'delete',
        //  contentType: "application/json; charset=utf-8",
          dataType: 'json',
          success: function(result)
          {
         
           $("#btn"+id).closest("tr").remove();
       

          },
          error: function()
         {
           
             alert('error...');
         }
       });
           
        }
    });









  }


  $(function(){

$('#filter').change(function(){



  $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }       
    });



var filter = $(this).val();



$.ajax({
  url : '/dashboard/stock/sort',
  data: {'filter':filter},
  type: 'get',
//  contentType: "application/json; charset=utf-8",
  dataType: 'json',
 
  success: function(result)
  {

   $('tbody').html('')

   $.each(result, function(key, item){

    
   
     if(item.Categorie == "Motif" || item.Categorie == "Accessoires" )

     {
      $('tbody').append('\
   <tr>\
            <td>'+item.Designation+'</td>\
            <td>-</td>\
            <td >-</td>\
            <td >-</td>\
            <td>'+item.Quantity+'</td>\
            <td>'+item.Price_A+' DA </td>\
            <td>'+item.Price_V+' DA</td>\
            <td> <a href="/dashboard/products/update/'+item.id+'" class="btn btn-primary text-white" role="button" ><i class="fas fa-edit"></i></a>\
            <button id="btn'+item.id+'" onclick="deleteProduct('+item.id+')" class="btn btn-danger"><i class="fas fa-trash"></i></button>\
          </td>\
              </tr>')

     }

     else if(item.QuantityF > 0 || item.QuantityC > 0){
      $('tbody').append('\
   <tr>\
            <td>'+item.Designation+' '+item.Size+'</td>\
            <td>'+item.meter_C+'</td>\
            <td >'+item.QuantityF+'</td>\
            <td >'+item.QuantityC+'</td>\
            <td>'+item.Quantity+'</td>\
            <td>'+item.Price_A+' DA </td>\
            <td>'+item.Price_V+' DA</td>\
            <td> <a href="/dashboard/products/update/'+item.id+'" class="btn btn-primary text-white" role="button" ><i class="fas fa-edit"></i></a>\
            <button id="btn'+item.id+'" onclick="deleteProduct('+item.id+')" class="btn btn-danger"><i class="fas fa-trash"></i></button>\
          </td>\
              </tr>')



     }
     else {

      $('tbody').append('\
   <tr>\
            <td>'+item.Designation+' '+item.Size+'</td>\
            <td>'+item.meter_C+'</td>\
            <td >-</td>\
            <td >-</td>\
            <td>'+item.Quantity+'</td>\
            <td>'+item.Price_A+' DA </td>\
            <td>'+item.Price_V+' DA</td>\
            <td> <a href="/dashboard/products/update/'+item.id+'" class="btn btn-primary text-white" role="button" ><i class="fas fa-edit"></i></a>\
            <button id="btn'+item.id+'" onclick="deleteProduct('+item.id+')" class="btn btn-danger"><i class="fas fa-trash"></i></button>\
          </td>\
              </tr>')




     }
   

         })


     
  },
  error: function(e)
 {
     //handle errors
     alert(e.error);
 }

});

});
});





  </script>