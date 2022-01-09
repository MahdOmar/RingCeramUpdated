@extends('layouts.layout')
@section('content')
        
        <div class="">
         <!--   <img src="/img/ring.jpg" alt="">  -->

         <div id="demo" class="carousel slide" style="z-index: -1" data-interval="3000" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
              <li data-target="#demo" data-slide-to="0" class="active"></li>
              <li data-target="#demo" data-slide-to="1"></li>
              <li data-target="#demo" data-slide-to="2"></li>
              <li data-target="#demo" data-slide-to="3"></li>
            </ul>
          
            <!-- The slideshow -->
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="/img/im1.jpg" alt="Los Angeles">
              </div>
              <div class="carousel-item">
                <img src="/img/im2.jpg" alt="Chicago">
              </div>
              <div class="carousel-item">
                <img src="/img/im3.jpg" alt="New York">
              </div>
              <div class="carousel-item">
                <img src="/img/im4.jpg" alt="New York">
              </div>
            </div>
          
            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
              <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
              <span class="carousel-control-next-icon"></span>
            </a>
          
          </div>

          <div class="text-center  pt-4 logo bg-white" >
            <img src="/img/logo.png" alt="">
            <h3 style="color: brown">We share the Best with You</h3>

            <div class="d-flex justify-content-around m-4">

              <div class="m-5">
                <img src="/img/quality.png" width="200" height="200" alt="">
                <h1 class="font-weight-bold">High Quality Products</h1>
              </div>
  
              <div class="m-5">
                <img src="/img/price.png" width="200" height="200" alt="">
                <h1 class="font-weight-bold">With Best Prices</h1>
              </div>
  
  
  
            </div>


          </div>


          


          <!------------------- Products Section ---------------------------->




          <div class="products m-4 " style="max-width: 100%">
              <h2 class="text-center text-success">New Products</h2>
              
              <div class="products-some d-flex flex-wrap justify-content-center ">

              

           
              @foreach($products as $product)
              @php

              $images = explode('|', $product->image_path);
                  
              @endphp
              <div class="card border-0 rounded-0 m-2" style="width:250px">
                 
                  <img class="card-img-top rounded-0" src="{{ URL::to($images[0])}}" alt="Card image">

                      
                 
               
                <div class="card-body">
                  <h4 class="card-title">{{ $product->Designation }}  </h4>
                  <p class="card-text">{{ $product->Categorie }}</p>
                  <hr>
             
                  <div class="d-flex justify-content-between">
                    <p class="card-text text-primary" >{{ $product->Price_V }} DA/Mete  </p>
                    <a href="/dashboard/products/{{$product->id}}" class="btn btn-dark stretched-link">Détails</a>

                  </div>
                  
                </div>
              </div>
              @endforeach

              


              </div>

              <div class="text-center m-4  ">
                <a href="/allproducts" class="btn btn-primary text-center w-25" role="button">See All Products</a>

              </div>
           

              

            


          </div>

          
          
           

        </div>
    @endsection
    