
@extends('layouts.dashboard')

@section('content')


<div class="m-3">

  <h4><a class="text-info" href="/dashboard">Dashborad</a> / Orders </h4>

</div>
<div  class=" shadow p-3 mb-5 bg-white rounded"  style=" margin-left:10px;margin-right:10px">

<div class="row">

  <div class="col-md-4">
    <input type="text" name="search" class="form-control" id="searchP" placeholder="search" >
  </div>
  <div class="col-md-4  d-flex " style="width:350px">
    <label class="m-2  " for="date">Date</label> 
                      <select name="date"  id="date" class="form-control form-select m-0 "      >
                              <option value="All">All</option>
                              <option value="tod" selected>Today</option>
                              <option value="yes">Yesterday</option>
                              <option value="lw">Last Week</option>
                              <option value="lm">last Month</option>
                             
                      </select>

</div>


 

<div class="col-md-4 d-flex justify-content-end">
 
 

  <div >
    <a href="" class="btn btn-dark btn-sm mb-2 p-2 text-white" role="button" data-toggle="modal" data-target="#myModal" ><i class="fas fa-plus-square m-1"></i>Add Order</a>

  </div>
      
</div>  

</div>
    
 
  
       <table class="table table-striped table-hover text-center">
        <thead class="bg-dark text-white">
          <tr>
            
            <th>Id</th>
            <th>Client Name</th>
            <th>Client Phone</th>
            <th>Adress</th>
            <th>Date</th>
            <th>Options</th>
          </tr>
        </thead>
        <tbody>
          @foreach($orders as $order)
          <tr>
            <td>{{ $order->id }} </td>
            <td>{{ $order->ClientName }}</td>
            <td>{{ $order->ClientPhone }}</td>
            <td>{{ $order->ClientAdress }}</td>
            
            <td>{{ $order->created_at->format('d-m-Y') }} </td>
            <td> <a href="" class="btn btn-primary text-white" data-toggle="modal" data-target="#myModal2"  role="button" onclick="getOrder({{$order->id}})"><i class="fas fa-edit"></i></a>
           <a href="/dashboard/order/{{ $order->id }}/order_details" class="btn btn-success text-white" role="button" ><i class="fas fa-plus-square"></i></a>
           
               
                <button onclick="deleteOrder({{ $order->id }})" id="btn{{ $order->id }}" class='btn btn-danger' ><i class="fas fa-trash"></i></button>
      
              
          </tr>
          @endforeach
         
         
      
        </tbody>
       </table>

       <div class="pagination d-flex justify-content-center mt-4 ">
        {{ $orders->links('pagination::bootstrap-4')}}
    
      </div>
      
       
   
      
      
       
       


</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Add Order</h4>
         
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
    
         <p class="text-success success text-center"></p>
         <div class="form-group">
          <label for="nameE">Client Name:</label>
          <input type="text" class="form-control" name="name" id="ClientName" required>
         
         
  </div>

  <div class="form-group">
          <label for="firstName">Client Phone:</label>
          <input type="text"   class="form-control" id="ClientPhone" name="phone" pattern="[0-9]+" minlength="10" maxlength="10" required>
         
  </div>

  <div class="form-group  ">
   
          <label for="adress">Adress:</label>
          <input type="text" class="form-control" name="ClientAdress" id="ClientAdress"  required>
    
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
        <button  class="btn btn-dark submit">Add </button>
        </div> 
      </div>
    </form>
    </div>

  </div>
</div>

<!--      Update Model             -->

<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Update Order</h4>
         
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
    
         <p class="text-success successe text-center"></p>

         <input type="hidden" id="id" name="id">
         <div class="form-group">
          <label for="nameE">Client Name:</label>
          <input type="text" class="form-control" name="name" id="ClientNameE"  required>
         
         
  </div>

  <div class="form-group">
          <label for="firstName">Client Phone:</label>
          <input type="text"   class="form-control" id="ClientPhoneE" name="phone" pattern="[0-9]+" minlength="10" maxlength="10" required>
         
  </div>

  <div class="form-group  ">
   
          <label for="adress">Adress:</label>
          <input type="text" class="form-control" name="ClientAdress" id="ClientAdressE"  required>
    
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
        <button  class="btn btn-dark update">Update </button>
        </div> 
      </div>
    </form>
    </div>

  </div>
</div>





        
  @endsection

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
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
           
            'ClientName': $('#ClientName').val(),
            'ClientPhone': $('#ClientPhone').val(),
            'ClientAdress': $('#ClientAdress').val(),
           
          }
           
            
      
          $.ajax({
             url : '/dashboard/order/save',
             data: data,
             type: 'post',
           //  contentType: "application/json; charset=utf-8",
             dataType: 'json',
             success: function(result)
             {

            
             $('tbody').html('')
          
             $('.success').text('Order Added')
       

            
             $.each(result, function(key, item){
              var dateString = moment(item.created_at).format('DD/MM/YYYY');
              
               
              $('tbody').append('\
              <tr>\
            <td>'+item.id+'</td>\
            <td>'+item.ClientName+'</td>\
            <td>'+item.ClientPhone+'</td>\
            <td>'+item.ClientAdress+'</td>\
            <td>'+dateString+' </td>\
            <td> <a href="" class="btn btn-primary text-white" data-toggle="modal" data-target="#myModal2"  role="button" onclick="getOrder('+item.id+')"><i class="fas fa-edit"></i></a>\
           <a href="/dashboard/order/'+item.id+'/order_details" class="btn btn-success text-white" role="button" ><i class="fas fa-plus-square"></i></a>\
                <button onclick="deleteOrder('+item.id+')" id="btn'+item.id+'" class="btn btn-danger" ><i class="fas fa-trash"></i></button>\
        \
              </tr>')


             })

             $('#ClientName').val(''),
             $('#ClientPhone').val(''),
             $('#ClientAdress').val(''),
            
             setTimeout(function() { $('.success').text('');
             $('#myModal').modal('toggle');}, 1000);
            

            /*    */
             

             },
             error: function()
            {
                //handle errors
                alert('error...');
            }
          });
       });
      
   });

   function getOrder(id){

    $('.success').text("")

    $.ajaxSetup({
     headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
   });
           

         
          var data = {

            'id': id,
           
          }



          $.ajax({
             url : '/dashboard/sales/show',
             data: data,
             type: 'get',
           //  contentType: "application/json; charset=utf-8",
             dataType: 'json',
             success: function(result)
             {
              $.each(result, function(key, item){
                $('#id').val(item.id)

                $('#ClientNameE').val(item.ClientName);
                $('#ClientPhoneE').val(item.ClientPhone);
                 $('#ClientAdressE').val(item.ClientAdress);



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
            'id': $('#id').val(),
           
            'ClientName': $('#ClientNameE').val(),
            'ClientPhone': $('#ClientPhoneE').val(),
            'ClientAdress': $('#ClientAdressE').val(),
           
          }
           
            
      
          $.ajax({
             url : '/dashboard/order/update',
             data: data,
             type: 'post',
           //  contentType: "application/json; charset=utf-8",
             dataType: 'json',
             success: function(result)
             {
            
             $('tbody').html('')
          
            $('.successe').text('Order Updated')
       

            
             $.each(result, function(key, item){
              var dateString = moment(item.created_at).format('DD-MM-YYYY');
              
               
              $('tbody').append('\
              <tr>\
            <td>'+item.id+'</td>\
            <td>'+item.ClientName+'</td>\
            <td>'+item.ClientPhone+'</td>\
            <td>'+item.ClientAdress+'</td>\
            <td>'+dateString+' </td>\
            <td> <a href="" class="btn btn-primary text-white" data-toggle="modal" data-target="#myModal2"  role="button" onclick="getOrder('+item.id+')"><i class="fas fa-edit"></i></a>\
           <a href="/dashboard/order/'+item.id+'/order_details" class="btn btn-success text-white" role="button" ><i class="fas fa-plus-square"></i></a>\
                <button onclick="deleteOrder('+item.id+')" id="btn'+item.id+'" class="btn btn-danger" ><i class="fas fa-trash"></i></button>\
       \
              </tr>')


             })

             $('#ClientNameE').val(''),
             $('#ClientPhoneE').val(''),
             $('#ClientAdressE').val(''),
            
             setTimeout(function() { $('.successe').text('');
             $('#myModal2').modal('toggle');}, 1000);


            


            /*    */
             

             },
             error: function()
            {
                //handle errors
                alert('error...');
            }
          });
       });
      
   });

   function deleteOrder(id)

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
             url : '/dashboard/order/delete',
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
       
       $('#date').change(function(){

        
        
        
        $.ajaxSetup({
     headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
   });
          
         
          var date = $(this).val();
      
         
          $.ajax({
             url : '/dashboard/sales/filter',
             data: {'date':date},
             type: 'get',
           //  contentType: "application/json; charset=utf-8",
             dataType: 'json',
             success: function(result)
             {
           
              $('tbody').html('')

              $.each(result, function(key, item){

                var dateString = moment(item.created_at).format('DD/MM/YYYY');
              
               
                $('tbody').append('\
              <tr>\
            <td>'+item.id+'</td>\
            <td>'+item.ClientName+'</td>\
            <td>'+item.ClientPhone+'</td>\
            <td>'+item.ClientAdress+'</td>\
            <td>'+dateString+' </td>\
            <td> <a href="" class="btn btn-primary text-white" data-toggle="modal" data-target="#myModal2"  role="button" onclick="getOrder('+item.id+')"><i class="fas fa-edit"></i></a>\
           <a href="/dashboard/order/'+item.id+'/order_details" class="btn btn-success text-white" role="button" ><i class="fas fa-plus-square"></i></a>\
                <button onclick="deleteOrder('+item.id+')" id="btn'+item.id+'" class="btn btn-danger" ><i class="fas fa-trash"></i></button>\
       \
              </tr>')


             })
               

              
                 
                
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