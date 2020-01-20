@extends('layouts.app')
@section('content')
<div class="title">{{$workshop->title}}</div>               <br>
<div class="description">{{$workshop->description}}</div>   <br>

<div class="participants">
    <h3>Participants:</h3>
    <table id="participants-table">
        <tr><th>id</th><th>Name</th></tr>
        @foreach ($participants as $item)
            <tr>
                <td>{{$item['id']}}</td>
                <td>{{$item['Fname']}}</td>
            </tr>
        @endforeach
    </table>
</div>
@endsection

<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script>
  // Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('2e19e7364cd8170d657c', {
  cluster: 'eu',
  forceTLS: true
});

var channel = pusher.subscribe('my-channel');
channel.bind('new-user', function(data) {
var x=document.getElementById("participants-table").insertRow(1);
var c1=x.insertCell(0);
var c2=x.insertCell(1);
c1.innerHTML=data.id;
c2.innerHTML=data.fullname;
});

</script>