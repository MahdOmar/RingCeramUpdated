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
        <nav class="navbar navbar-inverse">
            <div class="header">
        <h3 class="mt-2 ml-2">Ring Ceram</h3>
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
    <div class="side-bar bg-dark "> 
        <ul>
            <li><a href="/dashboard"> <i class="fas fa-chart-line"></i>Dashboard</a></li>
        <li><a  href="/dashboard/products"><i class="fas fa-warehouse"></i></i>Stock</a></li>
      <li> <a href="/dashboard/commandes" ><i class="fas fa-clipboard-list"></i>Commandes</a></li>
      <li> <a href="/dashboard/sales" ><i class="fas fa-money-check-alt"></i>Orders</a></li>
     </ul>
    
    
    </div>

    <div class="main flex-grow-1 mt-4">
      
        @yield('content')
    </div>

</div>





<script>

    function searchProduct(event){

        const search = document.getElementById('searchP');
     const rows = document.querySelectorAll('tbody tr');


        const q =event.target.value.toLowerCase();

        rows.forEach(row => {
            row.querySelector('td').textContent.toLowerCase().startsWith(q) 
            ?(row.style.display='')
            : row.style.display='none';
        })

    }

    function searchCommande(event){
        const search = document.getElementById('searchC');
        const rows = document.querySelectorAll('tbody tr');

        const q =event.target.value.toLowerCase();

        rows.forEach(row => {
            row.querySelector('#name').textContent.toLowerCase().startsWith(q) 
            ?(row.style.display='')
            : row.style.display='none';
        })

    }


    function quantity(){

        $('.Quantity').slideToggle();
        $('.Qn').slideToggle();
    

    }

    function show(){

        $('.Completed').slideToggle();



    }

    $(function(){
       
    $('#Product').change(function(){
        $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
       
      
       var id = $(this).val();
      
       $.ajax({
          url : '{{ route( 'type' ) }}',
          data: {'id':id},
          type: 'get',
        //  contentType: "application/json; charset=utf-8",
          dataType: 'json',
          success: function(result)
          {
              
             if(result.products == 'FC'){
                $('.Quan').hide();
                $('.Type').show();

             }
             else{
                $('.Quan').show();
                $('.Type').hide();

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







</script>
</body>
</html>
 
