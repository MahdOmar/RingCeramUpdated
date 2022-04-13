





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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

      
    </head>
    <body>
        <nav class="navbar navbar-inverse sticky-top  ">
            <div class="header">
                <div >
                    <a href="/" class="ml-4 "><img  src="/img/logo2.png" class="ml-4 rounded" width="120" height="60" alt=""></a> 

                </div>
        @guest
            
       
            <ul>
               <li><a href="/"> <i class="fa fa-home"></i>Home</a></li>
               <li><a  href="/dashboard/products"><i class="fas fa-warehouse"></i></i>Stock</a></li>
               <li> <a href="/dashboard/commandes" ><i class="fas fa-clipboard-list"></i>Commandes</a></li>
               <li> <a href="/dashboard/sales" ><i class="fas fa-money-check-alt"></i>Ventes</a></li>
            </ul>

        @endguest
 </div>
     
        <ul>
            <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i>{{ __('Login') }}</a>
                    </li>
                @endif
                
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}"><i class="fas fa-user-plus"></i>{{ __('Register') }}</a>
                    </li>
                @endif
            @else
           
                <li class="nav-item dropdown">
                    <div class="d-flex">
                        <img src="/img/user.png" width="30" height="30" alt="" style="margin-top: 5px">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
    
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                    

                   
                </li>
               

                
            @endguest
        </ul>
      
         </nav>


<div class="main d-flex">
    <div class=" side-bar bg-white shadow " > 
        <hr style="position: relative; top:-15px">

        <div class="text-center">
            <img  src="/img/user.png" width="80" height="90" alt="" >
            <p class="mt-2" style="font-weight: bold"> {{ Auth::user()->name }} (Admin)</p>
           

        </div>
        <hr>

        
        
        <ul class="text center">
            <li><a href="/dashboard"> <i class="fas fa-chart-line"></i>Dashboard</a></li>
        <li><a  href="/dashboard/products"><i class="fas fa-warehouse"></i></i>Stock</a></li>
      <li> <a href="/dashboard/commandes" ><i class="fas fa-clipboard-list"></i>Commandes</a></li>
      <li> <a href="/dashboard/sales" ><i class="fas fa-money-check-alt"></i>Orders</a></li>
     </ul>
    
    
    </div>

    <div class="main flex-grow-1 mt-4">
      <div class="m-3">

        <h4>Dashborad / <a class="text-info" href="/dashboard/stats">Stats</a> </h4>
      
      
      </div>
      
      <div  class=" shadow p-3 mb-5 bg-white rounded"  style=" margin-left:10px;margin-right:10px">
      
      
        
        <div class="row">
      
      
      
            <div class="col-md-4 col-xl-4">
                <div class="card support-bar overflow-hidden">
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-md-8">
                                <h2 class="m-0"> {{$CountProducts }}</h2><br>
      
                            </div>
                            <div class="col-md-4 cl">
                                <img src="{{ asset('img/product.png') }}" width="50" height="70" alt="">
                            </div>
                        </div>
                        <span class="text-c-blue">Total Products</span>
      
                        <p class="mb-3 mt-3">Total number of products in Stock.</p>
      
                    </div>
                    <div id="support-chart"></div>
                    <div class="card-footer bg-primary text-white">
                        <div class="row text-center">
                            <div class="col">
                                <h4 class="m-0 text-white">{{ $Ceramic }}</h4>
                                <span>Ceramic</span>
                            </div>
                            <div class="col">
                                <h4 class="m-0 text-white">{{ $Acc }}</h4>
                                <span>Accessoires</span>
                            </div>
                            <div class="col">
                                <h4 class="m-0 text-white">{{ $Count }}</h4>
                                <span>Out Stock</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      
            <div class="col-md-4 col-xl-4">
              <div class="card support-bar overflow-hidden">
                  <div class="card-body pb-0">
                      <div class="row">
                          <div class="col-md-8">
                              <h2 class="m-0">{{ $orders }}</h2><br>
      
                          </div>
                          <div class="col-md-4 cl">
                              <img src="{{ asset('img/orders.png') }}" width="50" height="70" alt="">
                          </div>
                      </div>
                      <span class="text-c-blue">Total Orders</span>
      
                      <p class="mb-3 mt-3">Total number of orders.</p>
      
                  </div>
                  <div id="support-chart"></div>
                  <div class="card-footer bg-success text-white">
                      <div class="row text-center">
                          <div class="col">
                              <h4 class="m-0 text-white">{{ $today }}</h4>
                              <span>Today</span>
                          </div>
                          <div class="col">
                              <h4 class="m-0 text-white">{{ $yesterday }}</h4>
                              <span>Yesterday</span>
                          </div>
                          <div class="col">
                              <h4 class="m-0 text-white">{{ $LastW }}</h4>
                              <span>Last Week</span>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      
          <div class="col-md-4 col-xl-4">
            <div class="card support-bar overflow-hidden">
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-md-8">
                            <h2 class="m-0">{{ $CountCommandes }}</h2><br>
      
                        </div>
                        <div class="col-md-4 cl">
                            <img src="{{ asset('img/command.png') }}" width="50" height="70" alt="">
                        </div>
                    </div>
                    <span class="text-c-blue">Total Commandes</span>
      
                    <p class="mb-3 mt-3">Total number of Commandes .</p>
      
                </div>
                <div id="support-chart"></div>
                <div class="card-footer bg-warning text-white">
                    <div class="row text-center">
                        <div class="col">
                            <h4 class="m-0 text-white">{{ $CountCommandes }}</h4>
                            <span>Total</span>
                        </div>
                        <div class="col">
                            <h4 class="m-0 text-white">{{ $Count_Completed }}</h4>
                            <span>Completed</span>
                        </div>
                        <div class="col">
                            <h4 class="m-0 text-white">{{ $Count_Not_Completed }}</h4>
                            <span>Pending</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
      
      
      
        </div>
      
        <div class="row  m-2">
      
          <div id="cont" class="col-md-8" style="overflow: scroll">
      
      
          </div>

          <div class=" col-md-4">

            <div class="  w-100  "  style="height: 110px">
                <div class="card card-stats mb-4 mb-xl-0">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Today Sales</h5>
                        <span class="h2 font-weight-bold mb-0">{{ number_format($salesToday   ,2,'.',',') }} DA</span>
                      </div>
                      <div class="col-auto">
                        <div class="">
                            <img src="{{ asset('img/allsales.jpg') }}"  width="60" alt="">
                        </div>
                      </div>
                    </div>
                   
                  </div>
                </div>
              </div>
            
              <div class="w-100   "  style="height: 110px"> 
                <div class="card card-stats mb-4 mb-xl-0">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Yesterday Sales</h5>
                        <span class="h2 font-weight-bold mb-0">{{  number_format($salesYes   ,2,'.',',')   }} DA</span>
                      </div>
                      <div class="col-auto">
                        <div>
                            <img src="{{ asset('img/tod.jpg') }}" width="60" alt="">
                        </div>
                      </div>
                    </div>
                  
                  </div>
                </div>
              </div>
            
              <div class="w-100  " style="height: 110px">
                <div class="card card-stats mb-4 mb-xl-0">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Total Sales</h5>
                        <span class="h2 font-weight-bold mb-0">{{number_format($salesLw   ,2,'.',',') }} DA</span>
                      </div>
                      <div class="col-auto">
                        <div class="">
                            <img src="{{ asset('img/tod.jpg') }}" width="60" alt="">
    
                        </div>
                      </div>
                    </div>
                  
                  </div>
                </div>
              </div>
    
              <div class="w-100 "  style="height: 110px">
                <div class="card card-stats mb-4 mb-xl-0">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Total Revenue</h5>
                        <span class="h2 font-weight-bold mb-0">{{number_format($income   ,2,'.',',')   }} DA</span>
                      </div>
                      <div class="col-auto">
                        <div class="">
                            <img src="{{ asset('img/sales.png') }}" width="60" alt="">
    
                        </div>
                      </div>
                    </div>
                  
                  </div>
                </div>
              </div>
           
        </div>
    </div>




      
        
        <div class="row m-2 mt-4  ">
          <div class=" card col-md-7 p-0" >

            <div class="card-header border-0 bg-info text-white"> <b>Top 5 Most Sold Products</b> </div>

            <table id="datatable-export" class="table  table-hover text-center">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Sales</th>
                        <th>Profit</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($top as $sale)

             
                    <tr>
                      <td>{{$sale->Designation}} </td>
                      <td>{{$sale->total}} </td>
                      <td>@if (isset($sale->meter_C))

                        {{ number_format($sale->total * $sale->Price * $sale->meter_C  ,2,'.',',')  }} DA
                          
                      @else

                      {{ number_format( $sale->total * $sale->Price   ,2,'.',',')}} DA
                          
                      @endif </td>
                    
                      <td >
                        @if (isset($sale->meter_C))

                      <p class="badge badge-success">  {{ number_format($sale->total * $sale->Price * $sale->meter_C - ($sale->total * $sale->Price_A * $sale->meter_C)   ,2,'.',',')   }} DA </p>
                          
                      @else

                   <p class="badge badge-success">   {{ number_format($sale->total * $sale->Price - ($sale->total * $sale->Price_A ) ,2,'.',',')     }} DA </p>
                          
                      @endif 


                      </td>
                    
                  
      
                  </tr>
                  @endforeach
                
                 
                    
                </tbody>
            </table>
        

            
                
         </div>

 
              <div class="card col-md-4 offset-md-1 p-0">
                <div class="card-header bg-warning text-white">Commandes Chart</div>
                <div class="card-body" >
                    <div class="chart-container pie-chart">
                        <canvas id="doughnut_chart" style="max-height: 200px"></canvas>
                    </div>
                </div>
               





              </div>

      
      </div>
        

      
      
               
            
        
      </div>   
      
      
      
       
    </div>

    

</div>






<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>

  var userData = <?php echo json_encode($salesData)?>;

  var data = userData

  console.log(userData);


   Highcharts.chart('cont', {
       title: {
           text: 'Sales in 2021'
       },
       subtitle: {
           text: ''
       },
       xAxis: {
           categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep',
               'Oct', 'Nov', 'Dec'
           ]
       },
       yAxis: {
           title: {
               text: 'Amount of Slaes'
           }
       },
       legend: {
           layout: 'vertical',
           align: 'right',
           verticalAlign: 'middle'
       },
       plotOptions: {
           series: {
               allowPointSelect: true
           }
       },
       series: [{
           name: 'Sales',
           data:userData
       }],
       responsive: {
           rules: [{
               condition: {
                   maxWidth: 500
               },
               chartOptions: {
                   legend: {
                       layout: 'horizontal',
                       align: 'center',
                       verticalAlign: 'bottom'
                   }
               }
           }]
       }
   });

   

</script>

<script>
    var  comp =  <?php echo json_encode($Count_Completed)?>;
    var pen =  <?php echo json_encode($Count_Not_Completed)?>;

    let barchart = new Chart('doughnut_chart',{
        type:'doughnut',
        data:{
            labels:['Completed','Pending'],
            datasets: [
                {
                    label:'Points',
                    backgroundColor:['#00FF00','#FF0000'],
                    data:[comp,pen]
                }
            ]
        }
    })


</script>

</body>
</html>
 













