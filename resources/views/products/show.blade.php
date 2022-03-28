
@extends('layouts.layout')

@section('content')

<div class="container">
     

        <div   style=" margin-left:10px;margin-right:10px"class="row shadow p-3 mt-4 mb-5 bg-white rounded" >
                <div class="col-md-6">

                  

              @php

              $images = explode('|', $product->image_path);
                  
              @endphp 

                        <div id="demo" class="carousel slide" data-interval="2000" data-ride="carousel">

                                <!-- Indicators -->
                                <ul class="carousel-indicators">
                                  @for ($i = 0; $i < count($images); $i++)

                                   @if ($i == 0)
                                   <li data-target="#demo" data-slide-to="0" class="active"></li>

                                       
                                   @else
                                   <li data-target="#demo" data-slide-to="".$i></li>
                                       
                                   @endif
                                      
                                  @endfor


                                 
                                  
                                
                                </ul>
                              
                                <!-- The slideshow -->
                                <div class="carousel-inner">
                                 

                                  @foreach ($images as $image)
                                   @if ($image == $images[0])
                                   <div class="carousel-item active">
                                    <img src="{{ URL::to($image)}}"  alt="Chicago">
                                  </div>
                                  @else

                                  <div class="carousel-item ">
                                    <img src="{{ URL::to($image)}}"  alt="Chicago">
                                  </div>
                                       
                                   @endif
                                 
                                      
                                  @endforeach

                                </div>
                              
                                <!-- Left and right controls -->
                                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                  <span class="carousel-control-prev-icon"></span>
                                </a>
                                <a class="carousel-control-next" href="#demo" data-slide="next">
                                  <span class="carousel-control-next-icon"></span>
                                </a>
                              
                              </div>



                </div>




                <div class="col-md-6">

                        <h3 class="text-info text-capitalize mb-4">{{ $product->Designation }} </h3>
                        

                       
                        <hr>
                        @if ($product->Categorie != 'Accessoires')
                        <p><strong>Quality:</strong>    1er choix</p> 
                        <p><strong>Size:</strong> {{ $product->Size }} cm </p>
                        <p><strong>Type:</strong>    {{ $product->Site }}</p> 
                        
                        <hr>
                        @else
                        <p><strong>Quality:</strong>  High</p> 
                        @endif
                       
                      
                        
                        <p><strong>Categories:</strong> {{ $product->Categorie }} </p>
                        <hr>
                        <div class="d-flex justify-content-between">
                          <p><strong>Disponibilité:</strong> @if ($product->Quantity > 10)
                           <strong class="text-success">Disponible</strong>  </p>
                          @else
                               <strong class="text-danger">Indisponible</strong>  </p>
                          @endif
                            
                          

                          <p><strong>Price:</strong> <strong class="text-info">{{ $product->Price_V }} Da/Meter</strong>  </p>

                        </div>
                        



                </div>



        </div>





</div>


        
 @endsection
