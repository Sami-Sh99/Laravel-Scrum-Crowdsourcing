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
            
                                    <div class="form-group{{ $errors->has('key') ? ' has-error' : '' }}">
                                        <div class="col-xs-12 col-sm-12 mt-20">
                                            <input placeholder="please enter the workshop key here" id="key" type="text" class="form-control" name="key"
                                                autofocus>
                                            @if ($errors->has('key'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                            @endif
            
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
      <h1 class="header2 mb-25">Current Workshops</h1>
      <div class="row  mb-25">
        <div class="col-xs-2 col-xs-">
          <button type="button" class="btn btn-primary btn-block btn-lg" data-toggle="modal" data-target="#myModal">Join Workshop</button>
        </div>
      </div>

      <!-- Project-->
      <div class="project mb-25 has-shadow bg-white ">
        <div class="row">
          <div class="col-lg-6 align-items-center justify-content-between">
            <div class="project-title  align-items-center">
              <div >
                <h3 class="h4">Project Title</h3><small>Lorem Ipsum Dolor</small>
              </div>
            </div>
            <div class="project-date"><span class="hidden-sm-down">Today at 4:24 AM</span></div>
          </div>
          <div class="col-lg-6  align-items-center">
            <div class="time"><i class="fa fa-clock-o"></i>12:00 PM </div>
            <div class="comments"><i class="fa fa-comment-o"></i>20</div>
            <div class="project-progress">
              <div class="progress">
                <div role="progressbar" style="width: 45%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                  aria-valuemax="100" class="progress-bar bg-red"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Project-->
      <div class="project mb-25 has-shadow bg-white">
        <div class="row">
          <div class="col-lg-6  align-items-center justify-content-between">
            <div class="project-title  align-items-center">
              <div >
                <h3 class="h4">Project Title</h3><small>Lorem Ipsum Dolor</small>
              </div>
            </div>
            <div class="project-date"><span class="hidden-sm-down">Today at 4:24 AM</span></div>
          </div>
          <div class="col-lg-6  align-items-center">
            <div class="time"><i class="fa fa-clock-o"></i>12:00 PM </div>
            <div class="comments"><i class="fa fa-comment-o"></i>20</div>
            <div class="project-progress">
              <div class="progress">
                <div role="progressbar" style="width: 60%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                  aria-valuemax="100" class="progress-bar bg-green"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
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

var pusher = new Pusher('b3e67c88a537f5730018', {
  cluster: 'ap2',
  forceTLS: true
});

var channel = pusher.subscribe('my-channel');
channel.bind('new-card', function(data) {
  alert('working...');
});
</script>