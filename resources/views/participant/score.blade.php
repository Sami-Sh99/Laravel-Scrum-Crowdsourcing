@extends('layouts.app')
@section('content')
<div class="title">{{$workshop->title}}</div>               <br>
<div class="description">{{$workshop->description}}</div>   <br>
<input hidden value={{$workshop->key}} id="workshop_key" />
<input hidden value={{$score_id}} id="score_id" />
    <div class="container">
        <div id="Loading">
        <h1>Get Ready to start scoring</h1>
        </div>
        <div id="Card" style="display:block">
        <h1>Start Scoring !!!</h1>
        <p class="card">{{$card->content}}</p>
        <span  class="heading">User Rating</span>
        <form method="GET" action="/workshop/{{$workshop->key}}/score/{{$score_id}}">
            <input type="radio" id="star1" class="fa fa-2x fa-star " value="1" name="score">
            <input type="radio" id="star2" class="fa fa-2x fa-star " value="2" name="score">
            <input type="radio" id="star3" class="fa fa-2x fa-star " value="3" name="score">
            <input type="radio" id="star4" class="fa fa-2x fa-star " value="4" name="score">
            <input type="radio" id="star5" class="fa fa-2x fa-star " value="5" name="score">
            <button type="submit" class="btn btn-primary" id="submit_card_btn">Submit Score</button>
        </form>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script src="{{  asset('js/participantWorkshopScore.js') }}"> </script>
@endsection
