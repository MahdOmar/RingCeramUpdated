@extends('layouts.dashboard')

@section('content')

<div  class="shadow p-3 mb-5 bg-white rounded"  style=" margin-left:10px;margin-right:10px">
    <div class="row">
      <div class="col-md-4 pl-4" >
        <h1 class="">Order_Details</h1>
    
      </div>
    
      <div class="col-md-4">
        <input type="text" name="search" class="form-control" id="searchP" placeholder="search" onkeyup="searchProduct(event)">
    
    
      </div>
    
      <div class="col-md-4" style="padding-left:230px">
        <a href="/dashboard/sales/create" class="btn btn-dark btn-sm m-2 p-2 text-white" data-toggle="modal" data-target="#myModal" role="button" onclick="getProductType()" ><i class="fas fa-plus-square m-1"></i>Add Item</a>
    
      </div>
          
         </div>  
    
      
           <table class="table table-bordered table-hover text-center">
            <thead>
              <tr>
                
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Amount</th>
                <th>Options</th>
              </tr>
            </thead>
            <tbody>
              @php
                  $total = 0;
              @endphp
              @foreach($order_details as $order)

              @if ($order->QuantityF > 0 || $order->QuantityC > 0 )
              <tr>
                <td>{{$order->product->Designation}}</td>
                <td>{{$order->Quantity}} carton ({{$order->QuantityF}}F, {{$order->QuantityC}}C)</td>
                <td>{{  $order->Price}}.00 DA</td>
                <td>{{ $order->Price * $order->Quantity * $order->product->meter_C  }}.00 DA</td>
                <td><a href=""  data-toggle="modal" data-target="#myModal2" class="btn btn-primary text-white" role="button" onclick="getOrderDetails({{$order->product->id}})" ><i class="fas fa-edit"></i></a>
    
                      <button onclick="deleteOrderDetails({{$order->id}})" id="btn{{$order->id}}" class='btn btn-danger'><i class="fas fa-trash"></i></button>
              </td>

            </tr>
                  
              @else

              <tr>
                <td>{{$order->product->Designation}}</td>
                <td>{{$order->Quantity}} c</td>
                <td>{{  $order->Price }}.00 DA</td>
                <td>{{ $order->Price * $order->Quantity * $order->product->meter_C }}.00 DA</td>
                <td><a href=""  data-toggle="modal" data-target="#myModal2" class="btn btn-primary text-white" role="button" onclick="getOrderDetails({{$order->product->id}})" ><i class="fas fa-edit"></i></a>
    
                      <button onclick="deleteOrderDetails({{$order->id}})" id="btn{{$order->id}}" class='btn btn-danger'><i class="fas fa-trash"></i></button>
              </td>
  
  
            </tr>
  
                  
              @endif


            
               
                @php
                    $total = $total + ($order->Price * $order->Quantity * $order->product->meter_C)
                @endphp


                @endforeach
                <tr>
                  <td colspan="3" class="text-right">Total</td>
                  <td>{{  $total   }}.00 DA</td>


                </tr>
            
            </tbody>
           </table>
          
           
    
    </div>


    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
      
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Order_Product</h4>
               
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              
            </div>
            <div class="modal-body">
           <!--   <form action="/dashboard/order/{{ request()->route('id') }}/order_details" method="Post" novalidate> -->
               <p class="text-success success text-center"></p>
               <p class="text-danger error text-center"></p>
                @csrf
                <input type="number" name="" id="id" value="{{ request()->route('id') }}" style="display: none">
                <input type="number" name="" id="idD" value="" style="display: none">
                <div class="form-group">
                        <label for="Product">Product:</label>
                       <select name="Product" id="Product" class="form-control">
                       @foreach ($products as $product)
                       <option value="{{ $product->id }}">{{ $product->Designation }}</option>
                           
                       @endforeach
                      
                    </select>    
                       
                </div>

                <div class="form-group Quan">
                    <label for="Quantitys">Quantity:</label>
                    <input type="number" id="Quantitys" class="form-control" name="Quantity" step="0.01"  required>
                   
                   
               </div>

               <div class="form-group row Type" style="display: none">
                 <div class="col-md-6">
                <label for="QuantityF">Quantityf:</label>
                <input type="number" id="QuantityF" class="form-control" name="QuantityF" step="0.01"  required>
              </div>

              <div class="col-md-6">
                <label for="QuantityC">QuantityC:</label>
                <input type="number" id="QuantityC" class="form-control" name="QuantityC" step="0.01"  required>
              </div>
               
           </div>





               <div class="form-group">
                <label for="price">Price:</label>
                <input type="number"  id="price" class="form-control" step="1"  name="price" required>
               
           </div>


              
            </div>
            <div class="modal-footer">
                <button
                type="button"
                class="btn btn-danger"
                data-dismiss="modal"
              >
                Fermer
              </button>
              <div class="form-group">
              <button  class="btn btn-dark submit">Add</button>
              </div> 
            </div>
          </form>
          </div>
      
        </div>
      </div>


      <div id="myModal2" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
      
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Order_Product</h4>
               
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              
            </div>
            <div class="modal-body">
         
               <p class="text-success successe text-center"></p>
               <p class="text-danger errore text-center"></p>
              
                <input type="number" name="" id="idE" value="{{ request()->route('id') }}" style="display: none">
               
                <div class="form-group">
                        <label for="Product">Product:</label>
                       <select name="Product" id="ProductE" class="form-control">
                       @foreach ($products as $product)
                       <option value="{{ $product->id }}"    >{{ $product->Designation }}</option>
                           
                       @endforeach
                      
                    </select>    
                       
                </div>

                <div class="form-group Quan">
                    <label for="Quantitys">Quantity:</label>
                    <input type="number" id="QuantitysE" class="form-control" name="Quantity" step="0.01"  required>
                   
                   
               </div>

               <div class="form-group row Type" style="display: none">
                 <div class="col-md-6">
                <label for="QuantityF">Quantityf:</label>
                <input type="number" id="QuantityFE" class="form-control" name="QuantityF" step="0.01"  required>
              </div>

              <div class="col-md-6">
                <label for="QuantityC">QuantityC:</label>
                <input type="number" id="QuantityCE" class="form-control" name="QuantityC" step="0.01"  required>
              </div>
               
           </div>





               <div class="form-group">
                <label for="price">Price:</label>
                <input type="number"  id="priceE" class="form-control" step="1"  name="price" required>
               
           </div>


              
            </div>
            <div class="modal-footer">
                <button
                type="button"
                class="btn btn-danger"
                data-dismiss="modal"
              >
                Fermer
              </button>
              <div class="form-group">
              <button  class="btn update btn-dark">Update</button>
              </div> 
            </div>
          </form>
          </div>
      
        </div>
      </div>




@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
   $(function(){
       
       $('.submit').click(function(){
      

           $.ajaxSetup({
     headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
   });
           

   
           
         
          var data = {
            'id':$('#id').val(),
            'Product': $('#Product').val(),
            'Quantity': $('#Quantitys').val(),
            'QuantityF': $('#QuantityF').val(),
            'QuantityC': $('#QuantityC').val(),
            'price': $('#price').val(),
           


          }
            id =$('#id').val();
            
          console.log(data);
          $.ajax({
             url : '/dashboard/order/'+id+'/order_details',
             data: data,
             type: 'post',
           //  contentType: "application/json; charset=utf-8",
             dataType: 'json',
             success: function(result)
             {

               if(result.error)
               {
                $('.error').text(result.error )
               }
            
           else 
           {

           

             $('tbody').html('')
          
             $('.success').text(result.success )
           
             $('#Quantitys').val('')
            $('#QuantityF').val('')
            $('#QuantityC').val('')
            $('#price').val('')

             total = 0;
             
               

             $.each(result.Products, function(key, item){
               total = total + (item.Quantity * item.Price * item.product.meter_C)

               if(item.Categorie == "Accessoires" || item.Categorie == "Motif" )
               {
                $('tbody').append('\
                 <tr>\
                    <td>'+item.product.Designation+'</td>\
                    <td>'+item.Quantity+'Carton('+item.QuantityF+'F, '+item.QuantityC+'C) </td>\
                    <td> '+item.Price+'.00 DA</td>\
                    <td>'+item.Price * item.Quantity * item.product.meter_C +'.00 DA</td>\
                    <td><a href="" data-toggle="modal" data-target="#myModal2" class="btn btn-primary text-white" role="button" onclick="getOrderDetails('+item.product.id+')"><i class="fas fa-edit"></i></a>\
                          <button onclick="deleteOrderDetails('+item.id+')" id="btn'+item.id+'" class="btn btn-danger"><i class="fas fa-trash"></i></button>\
                 </td>\
                </tr>')



               }
                else
                {


               if(item.QuantityF > 0 || item.QuantityC > 0 )
               {
                $('tbody').append('\
                 <tr>\
                    <td>'+item.product.Designation+'</td>\
                    <td>'+item.Quantity+'Carton('+item.QuantityF+'F, '+item.QuantityC+'C) </td>\
                    <td> '+item.Price+'.00 DA</td>\
                    <td>'+item.Price * item.Quantity * item.product.meter_C +'.00 DA</td>\
                    <td><a href="" data-toggle="modal" data-target="#myModal2" class="btn btn-primary text-white" role="button" onclick="getOrderDetails('+item.product.id+')"><i class="fas fa-edit"></i></a>\
                          <button onclick="deleteOrderDetails('+item.id+')" id="btn'+item.id+'" class="btn btn-danger"><i class="fas fa-trash"></i></button>\
                 </td>\
                </tr>')

               }
               else{
                $('tbody').append('\
                 <tr>\
                    <td>'+item.product.Designation+'</td>\
                    <td>'+item.Quantity+' </td>\
                    <td> '+item.Price+'.00 DA</td>\
                    <td>'+item.Price * item.Quantity * item.product.meter_C+'.00 DA</td>\
                    <td><a href="" data-toggle="modal" data-target="#myModal2" class="btn btn-primary text-white" role="button" onclick="getOrderDetails('+item.product.id+')"><i class="fas fa-edit"></i></a>\
                          <button onclick="deleteOrderDetails('+item.id+')" id="btn'+item.id+'" class="btn btn-danger"><i class="fas fa-trash"></i></button>\
                  </form></td>\
                </tr>')


               }
                }


             })
             
             $('tbody').append('\
             <tr>\
                  <td colspan="3" class="text-right">Total</td>\
                  <td>'+total+'.00 DA</td>\
                </tr>');




            /*    */
          }

             },
             error: function()
            {
                //handle errors
                alert('error...');
            }
          });
       });
      
   });
   

   function getOrderDetails(id){

$('.success').text("")

$.ajaxSetup({
 headers: {
   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
 }
});
       

     
      var data = {

        'idOrder': $('#idE').val(),
        'idProduct': id
       
      }

      $.ajax({
         url : '/dashboard/order/order_details/get',
         data: data,
         type: 'get',
       //  contentType: "application/json; charset=utf-8",
         dataType: 'json',
         success: function(result)
         {
          console.log(result);
          $.each(result, function(key, item){
           
          
            console.log(item.product.Type)
             if(item.product.Type == 'FC'){
             
                $('.Quan').hide();
                $('.Type').show();

             }
             else{
                $('.Quan').show();
                $('.Type').hide();

             }
            

            $('#idD').val(item.id)
           
             $('#ProductE option[value='+item.product.id+']').attr('selected','selected'),
             $('#QuantityFE').val(item.QuantityF),
             $('#QuantityCE').val(item.QuantityC),
             $('#QuantitysE').val(item.Quantity),
             $('#priceE').val(item.Price)


          })
        
          

         }
      
        ,
         error: function()
        {
            //handle errors
            alert('error...');
        }
      });

}

$(function(){
       
       $('.update').click(function(){
           $.ajaxSetup({
     headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
   });
           
          
         
          var data = {
            'id':$('#idD').val(),
            'idOrder':$('#idE').val(),
            'Product': $('#ProductE').val(),
            'Quantity': $('#QuantitysE').val(),
            'QuantityF': $('#QuantityFE').val(),
            'QuantityC': $('#QuantityCE').val(),
            'price': $('#priceE').val(),
          }
           
            
      
          $.ajax({
             url : '/dashboard/order/order_details/update',
             data: data,
             type: 'post',
           //  contentType: "application/json; charset=utf-8",
             dataType: 'json',
             success: function(result)
             {
               if(result.error)
               {
                $('.successe').text('')
                $('.errore').text(result.error)



               }
               
               else{
                $('.errore').text('')
              $('.successe').text('item updated' )
           
           $('#Quantitys').val('')
          $('#QuantityF').val('')
          $('#QuantityC').val('')
          $('#price').val('')


              total = 0;
              $('tbody').html('');
               

             $.each(result.Products, function(key, item){
               total = total + (item.Quantity * item.Price * item.product.meter_C )

               if(item.QuantityF > 0 || item.QuantityC > 0 )
               {

                $('tbody').append('\
                 <tr>\
                    <td>'+item.product.Designation+'</td>\
                    <td>'+item.Quantity+'Carton('+item.QuantityF+'F, '+item.QuantityC+'C)</td>\
                    <td> '+item.Price+'.00 DA</td>\
                    <td>'+item.Price * item.Quantity * item.product.meter_C+'.00 DA</td>\
                    <td><a href="" data-toggle="modal" data-target="#myModal2" class="btn btn-primary text-white" role="button" onclick="getOrderDetails('+item.product.id+')"><i class="fas fa-edit"></i></a>\
                          <button onclick="deleteOrderDetails('+item.id+')" id="btn'+item.id+'" class="btn btn-danger"><i class="fas fa-trash"></i></button>\
                  </form></td>\
                </tr>')


               }

               else {
                 

                $('tbody').append('\
                 <tr>\
                    <td>'+item.product.Designation+'</td>\
                    <td>'+item.Quantity+' C</td>\
                    <td> '+item.Price+'.00 DA</td>\
                    <td>'+item.Price * item.Quantity * item.product.meter_C+'.00 DA</td>\
                    <td><a href="" data-toggle="modal" data-target="#myModal2" class="btn btn-primary text-white" role="button" onclick="getOrderDetails('+item.product.id+')"><i class="fas fa-edit"></i></a>\
                          <button onclick="deleteOrderDetails('+item.id+')" id="btn'+item.id+'" class="btn btn-danger"><i class="fas fa-trash"></i></button>\
                  </form></td>\
                </tr>')

               }



              


             })
             $('tbody').append('\
             <tr>\
                  <td colspan="3" class="text-right">Total</td>\
                  <td>'+total+'.00 DA</td>\
                </tr>')

               }

             },
             error: function()
            {
                //handle errors
                alert('error...');
            }
          });
       });
      
   });

   function deleteOrderDetails(id)

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
          url : '/dashboard/order/order_details/delete',
          data:{'id':id},
          type: 'delete',
        //  contentType: "application/json; charset=utf-8",
          dataType: 'json',
          success: function(result)
          {
          
           $("#btn"+id).closest("tr").remove();
           $('tbody tr:last-child').children().last().text(result.total+'.00 DA');
           
       

          },
          error: function()
         {
           
             alert('error...');
         }
       });

       
      }
    })







  


}

  function getProductType(){

    var id = $('#Product').find(":selected").val()
    $('.success').text('');
    $('.error').text('');


$.ajaxSetup({
 headers: {
   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
 }
});
       

     
      var data = {

        'idProduct': id
       
      }

      $.ajax({
         url : '/dashboard/order/order_details/getProduct',
         data: data,
         type: 'get',
       //  contentType: "application/json; charset=utf-8",
         dataType: 'json',
         success: function(result)
         {
          console.log(result)
          
           
         
            
             if(result.Type == 'FC'){
             
                $('.Quan').hide();
                $('.Type').show();

             }
             else{
                $('.Quan').show();
                $('.Type').hide();

             }
            

            


          
        
          

         }
      
        ,
         error: function()
        {
            //handle errors
            alert('error...');
        }
      });



  }






 



</script>