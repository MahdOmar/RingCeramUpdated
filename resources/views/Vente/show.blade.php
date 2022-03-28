<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    
        <title>RingCeram</title>
    
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link href="/css/main.css"  rel="stylesheet">
        <link href="/css/all.css"  rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <style>
            @media print {
                body * { visibility: hidden;}
                
                .print-page , .print-page *{
                 
                    visibility: visible}
            }
        </style>
      
    </head>

<body>

<button class="btn btn-success " style="margin-left: 1280px;margin-top:20px;margin-bottom:20px" onclick="window.print();">Print </button>



<div  class=" p-3 mb-5   font-weight-bolder  print-page"  style="font-size:20px; margin-left:10px;margin-right:10px">
<div class="container">
    <div class="brand-section">
        <div class="">
           
                <h1 class="text-center">Ring Ceram</h1>
        </div>
          
    </div>

    <div class="body-section" style="border-bottom: 2px solid rgb(66, 62, 62)">
        <div class="row">
            <div class="col-6 ">
                <h2 class="heading">Invoice No.: {{ $order->id }}</h2>
                <p class="sub-heading">Order Date: {{ $order->created_at->format('d/m/Y') }} </p>
                <p class="sub-heading">Phone:  0662954631 </p>
            </div>
            <div class="col-6 " style="padding-left: 250px">
                <p class="sub-heading">Full Name:  {{ $order->ClientName }}  </p>
                <p class="sub-heading">Address:  {{ $order->ClientAdress }}  </p>
                <p class="sub-heading">Phone Number:  {{ $order->ClientPhone }}  </p>
               
            </div>
        </div>
    </div>
    

    <div class="body-section mt-4 ">
        <h3 class="heading">Ordered Items</h3>
        <br>
        <table class="table table-bordered table-hover text-center">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @php
                  $total = 0;
              @endphp
              @foreach($order_details as $order)
              
              
                <tr>
                    <td>{{$order->product->Designation}}</td>
                    <td>{{$order->Quantity}}  @if ($order->QuantityF > 0 || $order->QuantityC > 0 ) ({{$order->QuantityF}}F, {{$order->QuantityC}}C) @endif</td>
                    <td>{{  $order->Price, 2 }}.00 Da</td>
                    <td>{{ $order->Price * $order->Quantity,2 }}.00 Da</td>
                   


                </tr>
               
                
                @php
                    $total = $total + ($order->Price * $order->Quantity)
                @endphp


                @endforeach
                <tr>
                  <td colspan="3" class="text-right">Total</td>
                  <td>{{  $total , 2  }}.00 Da</td>


                </tr>
            </tbody>
        </table>
        <br>
       
    </div>

     
</div>   
</div>








</body>
</html>