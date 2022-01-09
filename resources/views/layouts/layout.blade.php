<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" href="/img/icon.png">
    
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

      
    </head>
    <body>
        <nav class="navbar sticky-top navbar-inverse">
            <div class="header">
       <a href="/"><img  src="/img/logo2.png" class="ml-4 rounded" width="120" height="60" alt=""></a> 
        @guest
            
       
            <ul>
               <li><a href="/"> <i class="fa fa-home"></i>Home</a></li>
               <li><a  href="/allproducts">Products</a></li>
               <li> <a href="" >About Us</a></li>
               <li> <a href="#footer" >Contacts</a></li>
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
                
              
            @else
                <li class="nav-item dropdown">
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
                </li>

                
            @endguest
        </ul>
      
         </nav>

       


         <div class="main">
        @yield('content')
    </div>
        <footer id ="footer">
            <div class="d-flex justify-content-around ">
                <div class="flex-fill" > <img class="mt-5 rounded" src="/img/logo.png" alt=""></div>
                <div class="flex-fill"> 
                    <h3 class="mt-3 ">Quick links </h3>
                    <ul class="p-2">
                         <li class="p-2"><a href="/">Home</a></li>
                         <li class="p-2"><a  href="/dashboard/products">Stock</a></li>
                         <li class="p-2"> <a href="/dashboard/commandes" >Commandes</a></li>
                         <li class="p-2"> <a href="/dashboard/sales" >Ventes</a></li>

                    </ul>
                
                </div>
                <div class="flex-fill" >
                   <h3 class="mt-3"> Contact</h3>

                    <ul class="p-2">
                        <li class="p-2"><i class="fas fa-map-marker-alt "></i>Hey 20 aout TIMIMOUN</li>
                        <li class="p-2"><i class="fas fa-envelope"></i>ringceram@gmail.com</li>
                        <li class="p-2"><i class="fas fa-phone-alt"></i>0662954631</li>
                        <li class="p-2"><i class="fab fa-facebook"></i><a href="https://www.facebook.com/ring.ceram">Ring Ceram Timimoun
                        </a> </li>

                   </ul>
                
                </div>


            </div>
            <hr>


             <div >
                @Copyright 2020 Ring Ceram
             </div>
           
        </footer>
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





        </script>
    </body>
    </html>