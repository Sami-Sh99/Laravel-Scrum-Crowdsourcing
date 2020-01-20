@extends('layouts.app')
@section('content')
<div class="container">

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Join Workshop</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <form method="GET" action="{{ url('workshop') }}">
              {{ csrf_field() }}

              <div class="form-group">
                <div class="col-xs-12 col-sm-12 mt-20">
                  <input placeholder="please enter the workshop key here" id="key" type="text" class="form-control"
                    name="key" autofocus>
                </div>
              </div>

              <div class="form-group">
                <div class="col-xs-12 mt-20">
                  <button type="submit" class="btn btn-primary">
                    Join
                  </button>
                </div>
              </div>

            </form>
          </div>
        </div>

      </div>
    </div>
  </div>


  <section class="projects">
    <div class="container-fluid">

      @if ($errors->any())
      <span class="help-block">
        <strong>{{ $errors->first() }}</strong>
      </span>
      @endif

      <h1 class="header2 mb-25">Current Workshops</h1>
      <div class="row  mb-25">
        <div class="col-xs-2 col-xs-">
          <button type="button" class="btn btn-primary btn-block btn-lg" data-toggle="modal" data-target="#myModal">Join
            Workshop</button>
          
        </div>
      </div>

      <!-- Project-->
      @foreach ($enrollments as $enrollment)
      @php
      $workshop = $enrollment->workshop 
      @endphp
      <div class="project mb-25 has-shadow bg-white ">
        <div class="row">
          <div class="col-lg-6 align-items-center justify-content-between">
            <div class="project-title  align-items-center">
              <div>
                <h3 class="h4">{{$workshop['title']}}</h3>
                <p>{{$workshop['description']}}</p>
              </div>
            </div>
            <div class="project-date"><small>Created {{$workshop['created_at']->diffForHumans()}}</small></div>
          </div>
          <div class="col-lg-6  align-items-center">
            <div class="time"><i class="fa fa-clock-o"></i> {{$workshop->user['Fname']}} {{$workshop->user['Lname']}}
            </div>
            <div class="comments"><i class="fa fa-comment-o"></i>{{$workshop['required_participants']}}</div>
            <button type="button" class="btn btn-primary btn-sm mt-20">Go To Workshop</button>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </section>


  <section>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6">
          <h1 class="header2 mb-25">Invitations</h1>
          <div class="bg-white has-shadow card">
            <div class="card-header">
              <h3 class="h4"> Workshop invitations</h3>
            </div>
            <div class="card-body">
              <!-- Item-->

            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <h1 class="header2 mb-25">Notifications</h1>
          <div class="bg-white has-shadow card">
            <div class="card-header">
              <h3 class="h4"> Workshop Notifications</h3>
            </div>
            <div class="card-body ">
              <!-- Item-->

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
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
channel.bind('new-card', function(data) {
  alert('working...');
});
</script>