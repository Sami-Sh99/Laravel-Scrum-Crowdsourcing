@extends('layouts.app')
@section('content')
<div class="container">

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Join Workshop</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="row">
            <form class="col-12" method="GET" action="{{ url('workshop') }}">
              {{ csrf_field() }}
              <div class="form-group col-xs-12">
                  <input placeholder="please enter the workshop key here" id="key" type="text" class="form-control form-user-control"
                    name="key" autofocus>
              </div>

              <div class="form-group col-sm-3 offset-sm-9 ">
                  <button type="submit" class="btn btn-primary btn-block">
                    Join
                  </button>
              </div>

            </form>
          </div>
        </div>

      </div>
    </div>
  </div>


  <section >
    <div class="container">

      @if ($errors->any())
      <span class="help-block">
        <strong>{{ $errors->first() }}</strong>
      </span>
      @endif

      <div class="row">
        <h2>Current Workshops</h2>
      </div>
    
      <div class="row">
        <div class="col-xs-2 ml-auto mt-4">
          <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal">Add Workshop</button> 
        </div>
      </div>



      @if (count($enrollments) == 0 )
      
      <div class="row mt-4">
      <div class="col-12 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div style="text-align:center" class="text-xs font-weight-bold  text-uppercase mb-1"> There are no current workshops </div> 
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
      @endif
      
      @foreach ($enrollments as $enrollment)
      @php
      $workshop = $enrollment->workshop 
      @endphp
  
  <div class="row mt-4">
  <div class="col-12  mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-sm font-weight-bold text-primary mb-1"><a href="{{ url('workshop/'.$workshop->key) }}">{{$workshop['title']}} </a></div>
            <div class="h5 mb-0 font-weight-bold ">{{$workshop['description']}}</div>
            <div class="text-xs font-weight-bold text-gray mt-2 ">Created {{$workshop['created_at']->diffForHumans()}}</div>
          </div>
          <div class="col-auto">
            <div class="text-sm font-weight-bold mb-2"><i class="fa fa-clock-o"></i> {{$workshop->user['Fname']}} {{$workshop->user['Lname']}} </div>
            <div class="h5 mb-0 font-weight-bold "><i class="fa fa-comment-o"></i>{{$workshop['required_participants']}}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

      @endforeach

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