@extends('layouts.dashboard')

@section('content')

<div class="m-3">

  <h4><a class="text-info" href="/dashboard">Dashborad</a> / <a class="text-info" href="/dashboard/sales">Order</a> /Order_Details </h4>

</div>

<div  class="shadow p-3 mb-5 bg-white rounded"  style=" margin-left:10px;margin-right:10px">
    <div class="d-flex justify-content-end">
     
    
      
      <div>
        <a href="/dashboard/sales/view/{{  request()->route('id') }}" class="btn btn-success  m-2 p-2 text-white" role="button" ><i class="fas fa-print m-1 "></i>Print</a>

      </div>
       
      <div>
            <a href="/dashboard/sales/create" class="btn btn-dark btn-sm m-2 p-2 text-white " data-toggle="modal" data-target="#myModal" role="button" onclick="getProductType()" ><i class="fas fa-plus-square m-1"></i>Add Item</a>

      </div>
          
    </div>  
    
      
           <table class="table  table-hover text-center">
            <thead class="bg-dark text-white">
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
              @php
              $total = $total + ($order->Price * $order->Quantity * $order->product->meter_C)
          @endphp
              <tr>
                <td>{{$order->product->Designation}}</td>
                <td>{{$order->Quantity}}  ({{$order->QuantityF}}F, {{$order->QuantityC}}C)</td>
                <td>{{ number_format($order->Price,2,'.',',')}} DA</td>
                <td>{{ number_format($order->Price * $order->Quantity * $order->product->meter_C,2,'.',',')}} DA</td>
                <td><a href=""  data-toggle="modal" data-target="#myModal2" class="btn btn-primary text-white" role="button" onclick="getOrderDetails({{$order->product->id}})" ><i class="fas fa-edit"></i></a>
    
                      <button onclick="deleteOrderDetails({{$order->id}})" id="btn{{$order->id}}" class='btn btn-danger'><i class="fas fa-trash"></i></button>
              </td>

            </tr>
                  
              @else

              <tr>
                <td>{{$order->product->Designation}}</td>
                
                @if ($order->product->Categorie == "Accessoires" || $order->product->Categorie == "Motif")
                <td>{{$order->Quantity}} </td>
                <td>{{ number_format($order->Price,2,'.',',')}} DA</td>
                <td> {{ number_format($order->Price * $order->Quantity,2,'.',',')}} DA</td>
                  
                @php
                    $total = $total + ($order->Price * $order->Quantity )
                @endphp


                @else
                <td>{{$order->Quantity}} </td>
                <td>{{ number_format($order->Price,2,'.',',')}} DA</td>
                <td>{{ number_format($order->Price * $order->Quantity * $order->product->meter_C ,2,'.',',')}} DA</td>
                  
                @php
                    $total = $total + ($order->Price * $order->Quantity * $order->product->meter_C)
                @endphp


                    
                @endif
                <td><a href=""  data-toggle="modal" data-target="#myModal2" class="btn btn-primary text-white" role="button" onclick="getOrderDetails({{$order->product->id}})" ><i class="fas fa-edit"></i></a>
    
                      <button onclick="deleteOrderDetails({{$order->id}})" id="btn{{$order->id}}" class='btn btn-danger'><i class="fas fa-trash"></i></button>
              </td>
  
  
            </tr>
  
                  
              @endif


            
             

                @endforeach
                <tr>
                  <td colspan="3" class="text-right">Total</td>
                  <td>{{ number_format($total  ,2,'.',',')  }} DA</td>


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
                  <label for="Cate">Category:</label>
                 <select name="Cate" id="Cate" class="form-control">
                
                 <option value="Faience">Faience</option>
                 <option value="Dalle de sol">Dalle de Sol</option>
                 <option value="Accessoires">Accessoires</option>
                 <option value="Motif">Motifs</option>
                 
                     
                 
                
              </select>    
                 
          </div>


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
                <label for="QuantityF">QuantityF:</label>
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
              
                <input type="number"  name="" id="idE" value="{{ request()->route('id') }}" style="display: none">
               
                <div class="form-group">
                        <label for="Product">Product:</label>
                       <select name="Product" id="ProductE" class="form-control" disabled>
                       @foreach ($productes as $product)
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
           if( ( $('#myModal .Quan').is(":visible") &&  $('#Quantitys').val() == '') || $('#price').val() == ''  )
           {
               $('.error').text("All fields are required");

              setTimeout(function() { $('.error').text('');
                }, 3000);
           }

           else if( $('#myModal .Quan').is(":visible") &&  $('#Quantitys').val() <= 0)
           {
             $('.error').text("Quantity can not be 0 or negative");

              setTimeout(function() { $('.error').text('');
                }, 3000);

           }
           else if( $('#myModal .Type').is(":visible") && ( $('#QuantityF').val() == '' || $('#QuantityC').val() == ''   )  )
           {
              $('.error').text("QuantityF and QuantityC are required");

              setTimeout(function() { $('.error').text('');
                }, 3000);

           }

           else if( $('#myModal .Type').is(":visible") && ( $('#QuantityF').val() <=0 || $('#QuantityC').val() <=0   )  )
           {
              $('.error').text("QuantityF and QuantityC can not be 0 or negative");

              setTimeout(function() { $('.error').text('');
                }, 3000);

           }

           else if( $('#price').val() < 0  )
           {
             $('.error').text("Price can not be negative");

              setTimeout(function() { $('.error').text('');
                }, 3000);

           }

          

   
           else{

           
         
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
              

               if(item.product.Categorie == "Accessoires" || item.product.Categorie == "Motif" )
               {
                total = total + (item.Quantity * item.Price)
                
                $('tbody').append('\
                 <tr>\
                    <td>'+item.product.Designation+'</td>\
                    <td>'+item.Quantity+'</td>\
                    <td> '+(item.Price).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,")+' DA</td>\
                    <td>'+(item.Price * item.Quantity).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,") +' DA</td>\
                    <td><a href="" data-toggle="modal" data-target="#myModal2" class="btn btn-primary text-white" role="button" onclick="getOrderDetails('+item.product.id+')"><i class="fas fa-edit"></i></a>\
                          <button onclick="deleteOrderDetails('+item.id+')" id="btn'+item.id+'" class="btn btn-danger"><i class="fas fa-trash"></i></button>\
                 </td>\
                </tr>')



               }
                else
                {
                  total = total + (item.Quantity * item.Price * item.product.meter_C)


               if(item.QuantityF > 0 || item.QuantityC > 0 )
               {
                $('tbody').append('\
                 <tr>\
                    <td>'+item.product.Designation+'</td>\
                    <td>'+item.Quantity+'('+item.QuantityF+'F, '+item.QuantityC+'C) </td>\
                    <td> '+(item.Price).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,")+' DA</td>\
                    <td>'+(item.Price * item.Quantity * item.product.meter_C).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,") +' DA</td>\
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
                    <td> '+item.Price.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,")+' DA</td>\
                    <td>'+(item.Price * item.Quantity * item.product.meter_C).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,")+' DA</td>\
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
                  <td>'+total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,")+' DA</td>\
                </tr>');

                setTimeout(function() { $('.success').text('');
             $('#myModal').modal('toggle');}, 1000);

            




            /*    */
          }

             },
             error: function()
            {
                //handle errors
                alert('error...');
            }
          });

        }
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
           
             $('#ProductE').val(item.product.id),
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

   if( ( $('#myModal2 .Quan').is(":visible") &&  $('#QuantitysE').val() == '') || $('#priceE').val() == ''  )
           {
               $('.errore').text("All fields are required");

              setTimeout(function() { $('.errore').text('');
                }, 3000);
           }

           else if( $('#myModal2 .Quan').is(":visible") &&  $('#QuantitysE').val() <= 0)
           {
             $('.errore').text("Quantity can not be 0 or negative");

              setTimeout(function() { $('.errore').text('');
                }, 3000);

           }
           else if( $('#myModal2 .Type').is(":visible") && ( $('#QuantityFE').val() == '' || $('#QuantityCE').val() == ''   )  )
           {
              $('.errore').text("QuantityF and QuantityC are required");

              setTimeout(function() { $('.errore').text('');
                }, 3000);

           }

           else if( $('#myModal2 .Type').is(":visible") && ( $('#QuantityFE').val() <=0 || $('#QuantityCE').val() <=0   )  )
           {
              $('.errore').text("QuantityF and QuantityC can not be 0 or negative");

              setTimeout(function() { $('.errore').text('');
                }, 3000);

           }

           else if( $('#priceE').val() < 0  )
           {
             $('.errore').text("Price can not be negative");

              setTimeout(function() { $('.errore').text('');
                }, 3000);

           }


      else
      {

      
           
          
         
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
               
              
              if(item.product.Categorie == "Accessoires" || item.product.Categorie == "Motif" )
               {
                total = total + (item.Quantity * item.Price)
                
                $('tbody').append('\
                 <tr>\
                    <td>'+item.product.Designation+'</td>\
                    <td>'+item.Quantity+'</td>\
                    <td> '+item.Price.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,")+' DA</td>\
                    <td>'+(item.Price * item.Quantity).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,") +' DA</td>\
                    <td><a href="" data-toggle="modal" data-target="#myModal2" class="btn btn-primary text-white" role="button" onclick="getOrderDetails('+item.product.id+')"><i class="fas fa-edit"></i></a>\
                          <button onclick="deleteOrderDetails('+item.id+')" id="btn'+item.id+'" class="btn btn-danger"><i class="fas fa-trash"></i></button>\
                 </td>\
                </tr>')



               }
                else
                {
                  total = total + (item.Quantity * item.Price * item.product.meter_C)


               if(item.QuantityF > 0 || item.QuantityC > 0 )
               {
                $('tbody').append('\
                 <tr>\
                    <td>'+item.product.Designation+'</td>\
                    <td>'+item.Quantity+'('+item.QuantityF+'F, '+item.QuantityC+'C) </td>\
                    <td> '+(item.Price).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,")+' DA</td>\
                    <td>'+(item.Price * item.Quantity * item.product.meter_C).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,") +' DA</td>\
                    <td><a href="" data-toggle="modal" data-target="#myModal2" class="btn btn-primary text-white" role="button" onclick="getOrderDetails('+item.product.id+')"><i class="fas fa-edit"></i></a>\
                          <button onclick="deleteOrderDetails('+item.id+')" id="btn'+item.id+'" class="btn btn-danger"><i class="fas fa-trash"></i></button>\
                 </td>\
                </tr>')

               }
               else{
                $('tbody').append('\
                 <tr>\
                    <td>'+item.product.Designation+'</td>\
                    <td>'+item.Quantity+'  </td>\
                    <td> '+item.Price.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,")+' DA</td>\
                    <td>'+(item.Price * item.Quantity * item.product.meter_C).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,")+' DA</td>\
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
                  <td>'+total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,")+' DA</td>\
                </tr>')

               }

               setTimeout(function() { $('.successe').text('');
             $('#myModal2').modal('toggle');}, 1000);

             

             },
             error: function()
            {
                //handle errors
                alert('error...');
            }
          });
        }
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
           $('tbody tr:last-child').children().last().text(result.total+' DA');
           
       

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

  $(function(){
       
       $('#Cate').change(function(){

        
        
        
        $.ajaxSetup({
     headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
   });
          
         
          var cate = $(this).val();
      
         
          $.ajax({
             url : '/dashboard/order_item/filter',
             data: {'cate':cate},
             type: 'get',
           //  contentType: "application/json; charset=utf-8",
             dataType: 'json',
             success: function(result)
             {
           
              $('#Product').html(result.html);
                
             },
             error: function()
            {
                //handle errors
                alert('error...');
            }
          });
          
       });
      
   });







 



</script>