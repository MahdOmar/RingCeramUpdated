@extends('layouts.dashboard')

@section('content')
<h2 class="m-2">Products</h2>
<div class="row m-2">
<div class=" col-md-4 ">
    <div class="card card-stats mb-4 mb-xl-0">
      <div class="card-body">
        <div class="row">
          <div class="col">
            <h5 class="card-title text-uppercase text-muted mb-0">Best Product</h5>
            <span class="h2 font-weight-bold mb-0">Luna</span>
          </div>
          <div class="col-auto">
            <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
              <i class="fas fa-chart-bar"></i>
            </div>
          </div>
        </div>
       
      </div>
    </div>
  </div>

  <div class="col-md-4 ">
    <div class="card card-stats mb-4 mb-xl-0">
      <div class="card-body">
        <div class="row">
          <div class="col">
            <h5 class="card-title text-uppercase text-muted mb-0">Nearly Finished Products</h5>
            <span class="h2 font-weight-bold mb-0">{{ $Count }}</span>
          </div>
          <div class="col-auto">
            <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
              <i class="fas fa-chart-bar"></i>
            </div>
          </div>
        </div>
      
      </div>
    </div>
  </div>

  <div class="col-md-4 ">
    <div class="card card-stats mb-4 mb-xl-0">
      <div class="card-body">
        <div class="row">
          <div class="col">
            <h5 class="card-title text-uppercase text-muted mb-0">Total Products</h5>
            <span class="h2 font-weight-bold mb-0">{{ $CountProducts }}</span>
          </div>
          <div class="col-auto">
            <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
              <i class="fas fa-chart-bar"></i>
            </div>
          </div>
        </div>
      
      </div>
    </div>
  </div>
  
</div>

<h2 class="m-2">Commandes</h2>
<div class="row m-2">
<div class=" col-md-4 ">
    <div class="card card-stats mb-4 mb-xl-0">
      <div class="card-body">
        <div class="row">
          <div class="col">
            <h5 class="card-title text-uppercase text-muted mb-0">Total Commandes</h5>
            <span class="h2 font-weight-bold mb-0">{{  $CountCommandes }}</span>
          </div>
          <div class="col-auto">
            <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
              <i class="fas fa-chart-bar"></i>
            </div>
          </div>
        </div>
        <p class="mt-3 mb-0 text-muted text-sm">
          <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
          <span class="text-nowrap">Since last month</span>
        </p>
      </div>
    </div>
  </div>

  <div class="col-md-4 ">
    <div class="card card-stats mb-4 mb-xl-0">
      <div class="card-body">
        <div class="row">
          <div class="col">
            <h5 class="card-title text-uppercase text-muted mb-0">Completed Commandes</h5>
            <span class="h2 font-weight-bold mb-0">{{$Count_Completed}}</span>
          </div>
          <div class="col-auto">
            <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
              <i class="fas fa-chart-bar"></i>
            </div>
          </div>
        </div>
        <p class="mt-3 mb-0 text-muted text-sm">
          <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
          <span class="text-nowrap">Since last month</span>
        </p>
      </div>
    </div>
  </div>

  <div class="col-md-4 ">
    <div class="card card-stats mb-4 mb-xl-0">
      <div class="card-body">
        <div class="row">
          <div class="col">
            <h5 class="card-title text-uppercase text-muted mb-0">Pending Commandes</h5>
            <span class="h2 font-weight-bold mb-0">{{$Count_Not_Completed}}</span>
          </div>
          <div class="col-auto">
            <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
              <i class="fas fa-chart-bar"></i>
            </div>
          </div>
        </div>
        <p class="mt-3 mb-0 text-muted text-sm">
          <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
          <span class="text-nowrap">Since last month</span>
        </p>
      </div>
    </div>
  </div>
  
</div>

<h2 class="m-2">Sales</h2>
<div class="row m-2">
<div class=" col-md-4 ">
    <div class="card card-stats mb-4 mb-xl-0">
      <div class="card-body">
        <div class="row">
          <div class="col">
            <h5 class="card-title text-uppercase text-muted mb-0">Orders</h5>
            <span class="h2 font-weight-bold mb-0">{{ $orders }}</span>
          </div>
          <div class="col-auto">
            <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
              <i class="fas fa-chart-bar"></i>
            </div>
          </div>
        </div>
        <p class="mt-3 mb-0 text-muted text-sm">
          <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
          <span class="text-nowrap">Since last month</span>
        </p>
      </div>
    </div>
  </div>

  <div class="col-md-4 ">
    <div class="card card-stats mb-4 mb-xl-0">
      <div class="card-body">
        <div class="row">
          <div class="col">
            <h5 class="card-title text-uppercase text-muted mb-0">Sales</h5>
            <span class="h2 font-weight-bold mb-0">15</span>
          </div>
          <div class="col-auto">
            <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
              <i class="fas fa-chart-bar"></i>
            </div>
          </div>
        </div>
        <p class="mt-3 mb-0 text-muted text-sm">
          <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
          <span class="text-nowrap">Since last month</span>
        </p>
      </div>
    </div>
  </div>

  <div class="col-md-4 ">
    <div class="card card-stats mb-4 mb-xl-0">
      <div class="card-body">
        <div class="row">
          <div class="col">
            <h5 class="card-title text-uppercase text-muted mb-0">Income</h5>
            <span class="h2 font-weight-bold mb-0">350,897</span>
          </div>
          <div class="col-auto">
            <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
              <i class="fas fa-chart-bar"></i>
            </div>
          </div>
        </div>
        <p class="mt-3 mb-0 text-muted text-sm">
          <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
          <span class="text-nowrap">Since last month</span>
        </p>
      </div>
    </div>
  </div>
  
</div>


@endsection