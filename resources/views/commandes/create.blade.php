
@extends('layouts.dashboard')

@section('content')

<div class="m-3">

        <h4><a class="text-info" href="/dashboard">Dashborad</a> / <a class="text-info" href="/dashboard/commandes">Commandes</a> / Add </h4>
      
      </div>


<div  class=" shadow p-3 mb-5 bg-white rounded"  style=" margin-left:250px;margin-right:250px">
        <div class="text-center">
                <h2 class="mt-2">Add Commande</h2>
                <p class="text-success">  {{ $success }} </p>
        </div>
<form action="/dashboard/commandes" method="POST">
         @csrf
        <div class="form-group mr-5 ml-5">
                <label for="nm">Name:</label>
                <input type="text" class="form-control "  name="name"  required>
        </div>

        <div class="form-group mr-5 ml-5">
                <label for="phone">Phone:</label>
                <input type="text"   class="form-control" name="phone" pattern="[0-9]+" minlength="10" maxlength="10" required>

              </div>

        <div class="form-group mr-5 ml-5">
                <label for="name">Designation:</label>
                <input type="text"   class="form-control" name="des" required>
         
        </div>


        <div class="form-group  mr-5 ml-5 ">
              

                <div class="mb-4">
                        <label for="QuantityE" >Quantity</label>
                        <input type="number"  class="form-control" name="Quantity" id="QuantityE" required>
                </div>


        </div>
        <div class="form-group mr-5 ml-5 ">
                <button type="submit" class="btn btn-block btn-dark">Add Commande</button>
        </div>


</form>
</div>



        
  @endsection
