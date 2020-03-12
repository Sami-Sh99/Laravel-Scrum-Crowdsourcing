@extends('layouts.app')
@section('content')


<div class="container">
    <div class="workshop-header">
        
        <div class="workshop-header-left">
            <h2>{{$workshop->title}}</h2> 
            {{$workshop->description}}
        </div>
    
    <div class="workshop-header-right" > </div>    
    
    </div>
    
    <hr>
    <input hidden value={{$workshop->key}} id="workshop_key" />
    
    <div id="Loading" class="row mt-5" >
        <div class="col-12 my-auto" style="text-align:center" > Please wait for Facilitator to create the groups </div>
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
@endsection

@section('scripts')
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script src="{{  asset('js/participantWaitGroup.js') }}"> </script>
@endsection
