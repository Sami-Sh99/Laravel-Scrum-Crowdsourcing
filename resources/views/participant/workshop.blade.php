@extends('layouts.app')
@section('content')

    <div class="container">
        <h2>{{$workshop->title}}</h2>  
<div class="description">{{$workshop->description}}</div>   
<div class="facilitator">{{$facilitator->Fname}}</div>      <br>
<input hidden value={{$workshop->key}} id="workshop_key" />

        @if ($wait)
        <div class="row" >
     <div class="ml-auto"><h2>   Waiting for other participants... eh l animation fazlake l se3a 3 l soboh w zhe2et</h2></div>
        <div class="cssload-dots">
            <div class="cssload-dot"></div>
            <div class="cssload-dot"></div>
            <div class="cssload-dot"></div>
            <div class="cssload-dot"></div>
            <div class="cssload-dot"></div>
            Waiting for other participants.... 
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
  

            <div id="Card" style="display:none">
            <h1>Ready to work !!</h1>
                <textarea id="card_content" name="card" rows="10" cols="50">
                    Write something
                </textarea><br>
                <button class="btn btn-primary" id="submit_card_btn">Submit</button>
            </div>
        @else
            <div id="Card">
            <h1>Ready to work !!</h1>
            <form method="GET" action="/workshop/{{$workshop->key}}/card/submit">
                <textarea id="card_content" name="content" rows="10" cols="50">
                    Write something
                </textarea><br>
                <button type="submit" class="btn btn-primary" id="submit_card_btn">Submit</button>
            </form>
            </div>
        @endif

    </div>
@endsection

@section('scripts')
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script src="{{  asset('js/participantWorkshop.js') }}"> </script>
@endsection
