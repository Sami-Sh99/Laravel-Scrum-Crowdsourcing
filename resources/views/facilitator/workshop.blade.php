@extends('layouts.app')
@section('content')

@if ($workshop->is_closed)
  <div  class="row mt-5" >
    <div class="col-12 my-auto" style="text-align:center" > Please wait until rating process ends </div>
       <div class="cssload-dots">
           <div class="cssload-dot"></div>
           <div class="cssload-dot"></div>
           <div class="cssload-dot"></div>
           <div class="cssload-dot"></div>
           <div class="cssload-dot"></div> 
       </div>
       <svg version="1.1" xmlns="http://www.w3.org/2000/svg">
           <defs>
               <filter id="goo">
                   <feGaussianBlur in="SourceGraphic" result="blur" stdDeviation="12" ></feGaussianBlur>
                   <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0	0 1 0 0 0	0 0 1 0 0	0 0 0 18 -7" result="goo" ></feColorMatrix>
                   <!--<feBlend in2="goo" in="SourceGraphic" result="mix" ></feBlend>-->
               </filter>
           </defs>
       </svg>
       </div>


@else

<div style="display:none" id="facilitator_load_msg" >
  <div  class="row mt-5" >
    <div class="col-12 my-auto" style="text-align:center" > Please wait until rating process ends </div>
       <div class="cssload-dots">
           <div class="cssload-dot"></div>
           <div class="cssload-dot"></div>
           <div class="cssload-dot"></div>
           <div class="cssload-dot"></div>
           <div class="cssload-dot"></div> 
       </div>
       <svg version="1.1" xmlns="http://www.w3.org/2000/svg">
           <defs>
               <filter id="goo">
                   <feGaussianBlur in="SourceGraphic" result="blur" stdDeviation="12" ></feGaussianBlur>
                   <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0	0 1 0 0 0	0 0 1 0 0	0 0 0 18 -7" result="goo" ></feColorMatrix>
                   <!--<feBlend in2="goo" in="SourceGraphic" result="mix" ></feBlend>-->
               </filter>
           </defs>
       </svg>
       </div>
</div>

<div id="facilitator_content" class="container">
  <div class="workshop-header">
    
    <div class="workshop-header-left">
        <h2>{{$workshop->title}}</h2> 
        {{$workshop->description}} 
    </div>

<div class="workshop-header-right" >

  <label > Key  </label>
  <input value="{{$workshop->key}}" readonly />
  
</div>    
</div>
<hr>

<input hidden id="workshop_key" value="{{$workshop->key}}" />


    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Participants</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered"  id="participants-table" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Profile</th>
                <th>Name</th>
                <th>Email</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($participants as $item)
              <tr  id="{{$item['id']}}">
                <td>
                  <img src="{{url('images/'.$item['photo_link'])}}" alt="" style="width: 50px; height: 50px;">
                  <!-- <a href="#" class="user-link"> {{$item['Fname']." ".$item["Lname"]}} </a> -->
                </td>
                <td>
                  <a href="#" class="user-link"> {{$item['Fname']." ".$item["Lname"]}} </a>
                </td>
             <td>   {{$item['email']}} </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>


   
    <div class="row">
      <div class="col-xs-2 ml-auto mt-4">
        <button id="Launch" class="btn btn-primary">Launch Workshop</button>
      </div>
    </div>
    

</div>
@endif


@endsection


@section('scripts')
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script src="{{  asset('js/facilitatorWorkshop.js') }}"> </script>
@endsection