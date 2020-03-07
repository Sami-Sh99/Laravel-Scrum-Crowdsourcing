@extends('layouts.app')
@section('content')
<div class="title">{{$workshop->title}}</div>               <br>
<div class="description">{{$workshop->description}}</div>   <br>
<input hidden value={{$workshop->key}} id="workshop_key" />
    <div class="container">
        <div id="Loading">
        <h1>Please wait to start the Next Round</h1>
        </div>
        <div id="Card" style="display:none">
        <h1>We have launched! please submit your answer on the following card</h1>
            <textarea id="card_content" name="card" rows="10" cols="50" placeholder="Write your answer...">
            </textarea><br>
            <button class="btn btn-primary" id="submit_card_btn">Submit</button>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script src="{{  asset('js/participantWaitWorkshop.js') }}"> </script>
@endsection
