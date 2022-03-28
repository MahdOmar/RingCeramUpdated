@extends('layouts.layout')
@section('content')

<div class="container-fluid ">
  
   <div class="mb-2"  >
    <h2 class=" m-2 p-3" style="display:inline-block" >Products</h2>
    <div class="mt-2 d-flex" style="float: right;display:inline-block; width:350px">
      <label class="m-2 mt-3 " for="Categorie">Categorie</label> 
                        <select name="Categorie"  id="Categorie" class="form-control m-2 "      >
                                <option value="All">All</option>
                                <option value="Faience">Faience</option>
                                <option value="Dalle de sol">Dalle de sol</option>
                                <option value="Accessoires">Accessoires</option>
                               
                          </select>

    </div>
   </div>
   
    
  
    

    <div class="products d-flex flex-wrap justify-content-center bg-white">

    

        @foreach($products as $product)
          @php

            $images = explode('|', $product->image_path);
            
          @endphp 
        <div class="pro card rounded-0  border-0 m-2" style="width:250px">
          <img class="card-img-top rounded-0" src="{{ URL::to($images[0])}}" alt="Card image">
          <div class="card-body">
            <h4 class="card-title text-capitalize">{{ $product->Designation }}</h4>
            <p class="card-text">{{ $product->Categorie }}</p>
            <hr>
       
            <div class="d-flex justify-content-between">
              @if ($product->Categorie == "Accessoires")
              <p class="card-text text-info" >{{ $product->Price_V }} DA</p>
                  
              @else
              <p class="card-text text-info" >{{ $product->Price_V }} DA/m<sup>2</sup></p>
              @endif
              
              <a href="/dashboard/products/{{$product->id}}" class="btn btn-dark stretched-link">Détails</a>

            </div>
            
          </div>
        </div>
        @endforeach

    </div>

    <div class="pagination d-flex justify-content-center mt-4 ">
    {{ $products->links('pagination::bootstrap-4')}}

  </div>


</div>



@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script>

$(function(){
       
       $('#Categorie').change(function(){
        
        
        $.ajaxSetup({
     headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
   });
          
         
          var category = $(this).val();
      
         
          $.ajax({
             url : '/products/filter',
             data: {'category':category},
             type: 'get',
           //  contentType: "application/json; charset=utf-8",
             dataType: 'json',
             success: function(result)
             {
             console.log(result.Products);
              $('.products').html('')

              $.each(result.Products.data, function(key, item){
               var images = item.image_path.split("|")
                $('.products').append('\
                <div class="pro card m-2 rounded-0  border-0" style="width:250px">\
                <img class="card-img-top rounded-0" src="'+images[0]+'" alt="Card image">\
                <div class="card-body">\
                  <h4 class="card-title text-capitalize">'+item.Designation+'</h4>\
                  <p class="card-text">'+item.Categorie+'</p>\
                  <div class="d-flex justify-content-between price'+item.id+'">')

                  if (item.Categorie == "Accessoires") {
                    $('.price'+item.id+' ').append('\
                    <p class="card-text text-info" >'+item.Price_V+' DA</p>\
                 <a href="/dashboard/products/'+item.id+'" class="btn btn-dark stretched-link">Détails</a> ')
                    
                  } else {
                    $('.price'+item.id+'').append('\
                    <p class="card-text text-info" >'+item.Price_V+' DA/m<sup>2</sup></p>\
                 <a href="/dashboard/products/'+item.id+'" class="btn btn-dark stretched-link">Détails</a>')
                    
                  }


                  


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