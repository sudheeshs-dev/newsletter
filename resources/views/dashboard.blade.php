@extends('layouts.admin')
@section('content')
   <div class="row mt-2">
       <div class="col">
           {{-- Start --}}

<div class="card border-success mb-3" style="max-width: 18rem;">
  <div class="card-header bg-transparent border-success">Users</div>
  <div class="card-body text-success text-center">
    <h5 class="card-title">Users Count</h5>
    <p class="card-text"><h2>{{\App\Models\Customer::count()}}</h2></p>
  </div>
 
</div>

           {{-- End --}}
       </div>
       <div class="col">
           {{-- Start --}}

<div class="card border-info mb-3" style="max-width: 18rem;">
  <div class="card-header bg-transparent border-info">Queue</div>
  <div class="card-body text-info text-center">
    <h5 class="card-title">Queue Status</h5>
    <p class="card-text"><h2>{{DB::table('jobs')->count()}}</h2></p>
  </div>
 
</div>

           {{-- End --}}
       </div>
       <div class="col">
           {{-- Start --}}

<div class="card border-warning mb-3" style="max-width: 18rem;">
  <div class="card-header bg-transparent border-warning">NewsLetters</div>
  <div class="card-body text-warning text-center">
    <h5 class="card-title">Active NewsLetters</h5>
    <p class="card-text"><h2>{{\App\Models\Newsletter::where('status',1)->count()}}</h2></p>
  </div>
 
</div>

           {{-- End --}}
       </div>
   </div>
@endsection