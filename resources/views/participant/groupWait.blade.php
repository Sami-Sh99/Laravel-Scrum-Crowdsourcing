@extends('layouts.app')
@section('content')
<div class="title">{{$workshop->title}}</div>               <br>
<div class="description">{{$workshop->description}}</div>   <br>
<input hidden value={{$workshop->key}} id="workshop_key" />
    <div class="container">
        <div id="Loading">
        <h1>Please wait for Facilitator to create the groups</h1>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script src="{{  asset('js/participantWaitGroup.js') }}"> </script>
@endsection
