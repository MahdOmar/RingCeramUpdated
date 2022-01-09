
@extends('layouts.dashboard')

@section('content')

<div  class=" shadow p-3 mb-5 bg-white rounded"  style=" margin-left:250px;margin-right:250px">
        <div class="text-center">
                <h2>Add Order</h2>
        </div>
<form action="/dashboard/sales/save" method="POST">
         @csrf
        <div class="form-group">
                <label for="nameE">Client Name:</label>
                <input type="text" class="form-control" name="name" required>
               
               
        </div>

        <div class="form-group">
                <label for="firstName">Client Phone:</label>
                <input type="text"   class="form-control" name="phone" pattern="[0-9]+" minlength="10" maxlength="10" required>
               
        </div>

        <div class="form-group  ">
         
                <label for="adress">Adress:</label>
                <input type="text" class="form-control" name="adress"  required>
          
        </div>

        <div class="form-group">
                <button type="submit" class="btn btn-block btn-dark">Add Order</button>
        </div>


</form>
</div>

        
  @endsection
