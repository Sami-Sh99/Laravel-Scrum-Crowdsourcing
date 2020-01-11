@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Participant Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script>

// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('b3e67c88a537f5730018', {
  cluster: 'ap2',
  forceTLS: true
});

var channel = pusher.subscribe('my-channel');
channel.bind('new-card', function(data) {
  alert('working...');
});
</script>