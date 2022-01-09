
@extends('layouts.dashboard')

@section('content')


<div  class=" shadow p-3 mb-5 bg-white rounded"  style=" margin-left:250px;margin-right:250px">
        <div class="text-center">
                <h2>Update Commande</h2>
        </div>
<form action="/dashboard/commandes/update/{{$commande->id}}" method="POST">
         @csrf
        <div class="form-group">
                <label for="nm">Name:</label>
                <input type="text" class="form-control"  name="name" value="{{ $commande->Name }}" required>
        </div>

        <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text"   class="form-control" name="phone" pattern="[0-9]+" minlength="10" maxlength="10" value="{{ $commande->phone }}" required>

              </div>

        <div class="form-group">
                <label for="name">Designation:</label>
                <input type="text"   class="form-control" name="des" value="{{ $commande->Designation }}" required>
         
        </div>


        <div class="form-group">
                

                <div >
                        <label for="QuantityE" >Quantity</label>
                        <input type="number"  class="form-control" name="Quantity" id="QuantityE"   value="{{ $commande->Quantity }}"   required>
                </div>


        </div>

        @if ($commande->Status == "Completed")
        <div class="form-group">
                
                        <label for="status" >Status</label>
                        <select name="status" id="status" class="form-control">
                                <option value="Not_Completed" {{ $commande->Status == "Not_Completed" ? 'selected' : '' }}>Not_Completed</option>
                                <option value="Completed" {{ $commande->Status == "Completed" ? 'selected' : '' }}>Completed</option>


                        </select>
                     

        </div>
        @endif
        <div class="form-group">
                <button type="submit" class="btn btn-block btn-dark">Update Commande</button>
        </div>


</form>
</div>
        
  @endsection
