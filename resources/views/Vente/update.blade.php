
@extends('layouts.dashboard')

@section('content')



<div  class=" shadow p-3 mb-5 bg-white rounded"  style=" margin-left:250px;margin-right:250px">
        <div class="text-center">
                <h2>Update Order</h2>
        </div>
<form action="/sales/update/{{$sale->id}}" method="POST">
         @csrf
        <div class="form-group">
                <label for="name">Designation:</label>
                <input type="text" id="nameE" name="name" class="form-control" value="{{ $sale->product->Designation }}">
        </div>

        <div class="form-group">
                <label for="firstName">Type:</label>
                <select name="type"    class="form-control"  required >
                  @if( $sale->product->Type  == 'F')
                    <option value="F">Foncé</option>
                    <option value="C">Claire</option>
                    <option value="X">None</option>

                    
                    @elseif( $sale->Type  == "C") 
                     
                    <option value="C">Claire</option>
                    <option value="F">Foncé</option>
                    <option value="X">None</option>
                    
                    @else
                    
                    <option value="X">None</option>
                    <option value="F">Foncé</option>
                    <option value="C">Claire</option>
                   
                    @endif 
                   
              </select>
              </div>

        <div class="form-group ">
         
                <label for="Quantity">Quantity:</label>
                <input type="number" class="form-control" name="Quantity" value="{{ $sale->Quantity }}" step="0.01"  required>
          
        </div>


        <div class="form-group ">
                
                        <label for="price_a">Amount:</label>
                        <input type="number"   class="form-control" step="1"  name="price_a" value="{{ $sale->Amount }}" required>


        </div>
        <div class="form-group">
                <button type="submit" class="btn btn-block btn-dark">Update Sale</button>
        </div>


</form>
</div>
        
  @endsection
