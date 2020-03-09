@extends('layouts.app')
@section('content')


<div class="container">
  <section>
    <div class="container">

      @if ($errors->any())
      <span class="help-block">
        <strong>{{ $errors->first() }}</strong>
      </span>
      @endif


      <div class="row">
        <h2>Groups</h2>
      </div>
      @foreach ($groups as $group)
      <div class="row mt-4">
        <div class="col-12  mb-4">
          <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-sm font-weight-bold text-success mb-1">{{$group['idea']}}</div>
                  <div class="text-xs font-weight-bold text-gray mt-2 ">Max required:
                    {{$group['max']}}</div>
                </div>
                <a class="btn btn-success" href="{{ url('/workshop/'.$key.'/group/join/'.$group['id']) }}">Join </a>
                {{-- <div class="col-auto">
                  <div class="text-sm font-weight-bold mb-2"><i class="fa fa-clock-o"></i> {{$workshop->user['Fname']}}
                    {{$workshop->user['Lname']}} </div>
                  <div class="h5 mb-0 font-weight-bold "><i
                      class="fa fa-comment-o"></i>{{$workshop['required_participants']}}</div> --}}
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