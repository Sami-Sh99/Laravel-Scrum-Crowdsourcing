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


  <section >
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
            <button type="button" class="btn btn-primary btn-sm mt-20"><a href="{{ url('workshop/'.$workshop->key) }}"> Go To Workshop </a></button>
          </div>
        </div>
      </div>
      @endforeach
    
      <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (Monthly)</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Earnings (Annual)</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks</div>
                  <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                    </div>
                    <div class="col">
                      <div class="progress progress-sm mr-2">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Requests</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-comments fa-2x text-gray-300"></i>
                </div>
              </div>
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