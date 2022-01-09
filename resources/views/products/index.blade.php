
@extends('layouts.dashboard')

@section('content')

<div  class="row shadow p-3 mb-5 bg-white rounded"  style=" margin-left:10px;margin-right:10px">

  <div class="col-md-4 pl-4">
    <h1 class="">Stock</h1>
  </div>

  <div class="col-md-4">
    <input type="text" name="search" class="form-control" id="searchP" placeholder="search" onkeyup="searchProduct(event)">
  </div>

  <div class="col-md-4 " style="padding-left:183px">
    <a href="/dashboard/products/create" class="btn btn-dark  m-2  text-white" role="button" ><i class="fas fa-plus-square m-1"></i>Add Product</a>

  </div>
       
     
      
       

 
       <table class="table  table-bordered  table-hover text-center">
        <thead>
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
                  
              {{ $product->Size }}cm {{ $product->Site }}
              @endif
             </td>
          
            <td> @if ($product->Categorie != 'Accessoires')
                  
              
              {{ $product->meter_C }}m
              
                  
              @else
              -
              
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

  
    console.log("yaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaw");
   
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






  </script>