@extends('layouts.app')
@section('content')
<div class="title">{{$workshop->title}}</div>               <br>
<div class="description">{{$workshop->description}}</div>   <br>
<div class="facilitator">{{$facilitator->Fname}}</div>      <br>
    <div class="container">
        <div id="Loading">
        <h1>Please wait to start the Workshop</h1>
        </div>
        <div id="Card" style="display:none">
        <h1>Ready to work !!</h1>
        <form action="{{ route('login') }}" method="POST">
            {{ csrf_field() }}
            <textarea name="card" rows="10" cols="50">
                Write something
            </textarea><br>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
        </div>
    </div>
@endsection()


<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script>
  // Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('2e19e7364cd8170d657c', {
  cluster: 'eu',
  forceTLS: true
});

var workshopKey = <?php echo json_encode($workshop->key) ?>; 
var channel = pusher.subscribe('workshop.' + workshopKey);
channel.bind('Launch', function(data) {
    document.getElementById("Loading").style.display = "none";
    document.getElementById("Card").style.display = "block";
});
</script>