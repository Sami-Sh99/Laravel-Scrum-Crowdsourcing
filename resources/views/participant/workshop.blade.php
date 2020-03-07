@extends('layouts.app')
@section('content')

<div class="container">
    
    <div class="workshop-header">
    
        <div class="workshop-header-left">
            <h2>{{$workshop->title}}</h2> 
            {{$workshop->description}} 
        </div>
  
<div class="workshop-header-right" > <i class="fa fa-user"> </i>  {{$facilitator->Fname}} </div>    

    </div>
   
    <hr>

    <input hidden value={{$workshop->key}} id="workshop_key" />



        @if ($wait)
        <div id="Loading" class="row mt-5" >
     <div class="col-12 my-auto" style="text-align:center" > Waiting for other participants...</div>
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

            <div id="Card" style="display:none">
            

                <div class="mb-4" style="text-align:center"> <h2 class="text-primary">Ready to work !</h2></div>
                <form method="GET" action="/workshop/{{$workshop->key}}/card/submit">  
                <div class="row mt-2">
                    <div class="col-md-6 offset-md-3 mb-4">
                      <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                          <div class="row no-gutters align-items-center">
                            <div class="col">
                                <textarea class = "workshop-card-textarea" id="card_content" name="content" autofocus>Write something 
                                </textarea>
                                <hr>
                                <div style="text-align:center">
                                <button type="submit" class="btn btn-primary " id="submit_card_btn">Submit</button>
                                </div>
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                    
                </form>

            
            
            </div>
        @else
            <div id="Card">
            <div class="mb-4" style="text-align:center"> <h2 class="text-primary">Ready to work !</h2></div>
            <form method="GET" action="/workshop/{{$workshop->key}}/card/submit">  
            <div class="row mt-2">
                <div class="col-md-6 offset-md-3 mb-4">
                  <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col">
                            <textarea class = "workshop-card-textarea" id="card_content" name="content" autofocus>Write something 
                            </textarea>
                            <hr>
                            <div style="text-align:center">
                            <button type="submit" class="btn btn-primary " id="submit_card_btn">Submit</button>
                            </div>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                
            </form>
            </div>




        @endif

    </div>
@endsection

@section('scripts')
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script src="{{  asset('js/participantWorkshop.js') }}"> </script>
@endsection
