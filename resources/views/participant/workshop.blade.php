@extends('layouts.app')
@section('content')
<div class="title">{{$workshop->title}}</div>               <br>
<div class="description">{{$workshop->description}}</div>   <br>
<div class="facilitator">{{$facilitator->Fname}}</div>      <br>
<input hidden value={{$workshop->key}} id="workshop_key" />
    <div class="container">
        <div id="Loading">
        <h1>Please wait to start the Workshop</h1>
        </div>
        <div id="Card" style="display:none">
        <h1>Ready to work !!</h1>
            <textarea id="card_content" name="card" rows="10" cols="50">
                Write something
            </textarea><br>
            <button class="btn btn-primary" id="submit_card_btn">Submit</button>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script src="{{  asset('js/participantWorkshop.js') }}"> </script>
@endsection
