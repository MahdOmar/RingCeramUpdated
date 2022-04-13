
@extends('layouts.dashboard')

@section('content')


<div class="m-3">

  <h4><a class="text-info" href="/dashboard">Dashborad</a> / Commandes </h4>

</div>


<div  class="row shadow p-3 mb-5 bg-white rounded"  style=" margin-left:10px;margin-right:10px">

  

  <div class="col-md-4">
    <input type="text" name="search" class="form-control" id="searchP" placeholder="search" onkeyup="searchCommande(event)">
  </div>

  <div class="col-md-8 d-flex justify-content-end " >
    
    <a href="/dashboard/commandes/create" class="btn btn-dark btn-sm m-2 p-2 text-white" role="button" ><i class="fas fa-plus-square m-1"></i>Add Commande</a>

  </div>
       

  
       <table class="table table-striped table-hover text-center">
        <thead class="bg-dark text-white">
          <tr>
              <th>Name</th>
              <th>Phone</th>
            <th>Designation</th>
            <th>Quantity</th>
            <th>Date</th>
            
            <th>Options</th>
          </tr>
        </thead>
        <tbody id="tbody1">
          @foreach($Commandes as $commande)
          <tr>
            <td>{{ $commande->Name }}</td>
           <td>{{ $commande->phone }}</td> 
            <td id="name">{{ $commande->Designation }}</td>
            <td>{{ $commande->Quantity }} </td>
            <td>{{ $commande->created_at->format('d/m/Y') }}</td>
            
            <td> <a href="/dashboard/commandes/update/{{ $commande['id'] }}" class="btn btn-primary text-white" role="button" ><i class="fas fa-edit"></i></a>
              <button onclick="deleteCommande({{$commande['id'] }})" id="btn{{$commande['id'] }}"  class="btn btn-danger"><i class="fas fa-trash"></i></button>

        
          
          <button onclick="CompleteCommande({{$commande['id']}})" id="Comp{{$commande['id']}}" class="btn btn-success"><i class="fas fa-check-square"></i></button>
        
              
          </tr>
          @endforeach
      
        </tbody>
       </table>
       
       <div class=" d-flex justify-content-center mt-4 ">
        <div> {{ $Commandes->links('pagination::bootstrap-4')}}</div> 
      
        </div>
        
    </div>
        <div class="d-flex justify-content-center mb-2">
        <button class="btn btn-success" onclick="show()">Show Completed Commandes</button>
    </div> 

    <div  class=" shadow p-3 mb-5 bg-white rounded text-center Completed"  style=" margin-left:10px;margin-right:10px; display:none">
        <div class="d-flex justify-content-center">
        <h1 >Completed Commandes</h1>
        </div>
           <table class="table table-striped table-hover text-center">
            <thead class="bg-dark text-white">
              <tr>
                  <th>Name</th>
                  <th>Phone</th>
                <th>Designation</th>
                <th>Quantity</th>
                <th>Date</th>
                
                <th>Options</th>
              </tr>
            </thead>
            <tbody id="tbody2">
              @foreach($Completeds as $Completed)
              <tr>
                <td>{{ $Completed->Name }}</td>
               <td>{{ $Completed->phone }}</td> 
                <td id="name">{{ $Completed->Designation }}</td>
                <td>{{ $Completed->Quantity }} </td>
                <td>{{ $Completed->created_at->format('d/m/Y') }}</td>
                
                <td> <a href="/dashboard/commandes/update/{{ $Completed['id'] }}" class="btn btn-primary text-white" role="button" ><i class="fas fa-edit"></i></a>
                
                    <button onclick="deCompleteCommande({{ $Completed['id'] }})" id="deComp{{$Completed['id']}}"  class="btn btn-danger"><i class="fas fa-trash"></i></button>
         
    
            
              <button onclick="return confirm('Are you sure?')" class="btn btn-success" disabled><i class="fas fa-check-square"></i></button>
            
                  
              </tr>
              @endforeach
          
            </tbody>
           </table>

           
       <div class=" d-flex justify-content-center mt-4 ">
        <div> {{ $Completeds->links('pagination::bootstrap-4')}}</div> 
      
        </div>
            
    </div>







  @endsection
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script>
   

function deleteCommande(id)

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
          url : '/dashboard/commandes/delete',
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


  function CompleteCommande(id)

{
 

   $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }       
    });

  
    swal({
        title: 'Are you sure?',
        text: 'This record and it`s details will be in Completed Commandes!',
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
    }).then(function(value) {
        if (value) {
            
            
    $.ajax({
          url : '/dashboard/commandes/complete',
          data:{'id':id},
          type: 'post',
        //  contentType: "application/json; charset=utf-8",
          dataType: 'json',
          success: function(result)
          {
         
            $("#Comp"+id).closest("tr").remove();

            $('#tbody2').html('');

           $.each(result.Completeds, function(key, item){
            var dateString = moment(item.created_at).format('DD/MM/YYYY');

            $('#tbody2').append('\
             <tr>\
                 <td>'+item.Name+'</td>\
                 <td>'+item.phone+'</td>\
                 <td> '+item.Designation+'</td>\
                 <td>'+item.Quantity+'</td>\
                 <td>'+dateString+'</td>\
                 <td> <a href="/dashboard/commandes/update/'+item.id+'" class="btn btn-primary text-white" role="button" ><i class="fas fa-edit"></i></a>\
              <button onclick="deCompleteCommande('+item.id+')" id="deComp'+item.id+'"  class="btn btn-danger"><i class="fas fa-trash"></i></button>\
          <button  class="btn btn-success" disabled><i class="fas fa-check-square"></i></button>\
            </tr>')


  })
       

          },
          error: function()
         {
           
             alert('error...');
         }
       });
           
        }
    });



  }

  function deCompleteCommande(id)

{
 

   $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }       
    });

  
    swal({
        title: 'Are you sure?',
        text: 'This record and it`s details will be in Not Completed Commandes!',
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
    }).then(function(value) {
        if (value) {
            
            
    $.ajax({
          url : '/dashboard/commandes/deComplete',
          data:{'id':id},
          type: 'post',
        //  contentType: "application/json; charset=utf-8",
          dataType: 'json',
          success: function(result)
          {
         
           $("#deComp"+id).closest("tr").remove();
           $('#tbody1').html('');
           console.log(result.Commandes);

                $.each(result.Commandes, function(key, item){
              var dateString = moment(item.created_at).format('DD/MM/YYYY');

              console.log(item);

                $('#tbody1').append('\
                      <tr>\
                       <td>'+item.Name+'</td>\
                       <td>'+item.phone+'</td>\
                       <td> '+item.Designation+'</td>\
                       <td>'+item.Quantity+'</td>\
                       <td>'+dateString+'</td>\
                       <td> <a href="/dashboard/commandes/update/'+item.id+'" class="btn btn-primary text-white" role="button" ><i class="fas fa-edit"></i></a>\
                       <button onclick="deleteCommande('+item.id+')" id="btn'+item.id+'"  class="btn btn-danger"><i class="fas fa-trash"></i></button>\
                      <button onclick="CompleteCommande('+item.id+')" id="Comp'+item.id+'"  class="btn btn-success" ><i class="fas fa-check-square"></i></button>\
                    </tr>')


                      })
       

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