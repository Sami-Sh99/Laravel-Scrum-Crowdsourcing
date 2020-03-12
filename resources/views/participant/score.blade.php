@extends('layouts.app')
@section('content')

<div class="container">

    <div class="workshop-header">

        <div class="workshop-header-left">
            <h2>{{$workshop->title}}</h2>
            {{$workshop->description}}
        </div>

        <div class="workshop-header-right">

            <h2>Round: {{$round}} </h2>

        </div>

    </div>
    <hr>


    <input hidden value={{$workshop->key}} id="workshop_key" />
    <input hidden value={{$score_id}} id="score_id" />

    <div class="mt-4" id="Card">
        <div class="mb-4" style="text-align:center">
            <h2 class="text-primary"> Start Scoring !</h2>
        </div>
        <div class="row mt-2">
            <div class="col-md-6 offset-md-3 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col">
                                {{$card->content}}
                                <hr>
                                <div>
                                    <form method="GET" action="/workshop/{{$workshop->key}}/score/{{$score_id}}" onsubmit="return validateForm()">
                                        <div class="mb-2 mt-4" style="text-align:center">
                                        <span id="star1" class="fa fa-2x fa-star"></span>
                                        <span id="star2" class="fa fa-2x fa-star"></span>
                                        <span id="star3" class="fa fa-2x fa-star"></span>
                                        <span id="star4" class="fa fa-2x fa-star"></span>
                                        <span id="star5" class="fa fa-2x fa-star"></span>
                                        <input id="input_hidden" type="hidden" name="score" value="0">
                                        </div>
                                        <div class="mt-4"  style="text-align:center">
                                        <button type="submit" class="btn btn-primary" id="submit_card_btn">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script src="{{  asset('js/participantWorkshopScore.js') }}"> </script>
@endsection