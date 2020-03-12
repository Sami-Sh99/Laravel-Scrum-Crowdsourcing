@extends('layouts.app')
@section('content')

<div class="container">

  <div class="workshop-header">

    <div class="workshop-header-left">
      <h2>Group Results</h2>
    </div>

    <div class="workshop-header-right"> </div>
  </div>

<hr>

  <div class="mt-5 card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Results</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @foreach ($groups as $group)
        <table class="table table-bordered" id="participants-table" width="100%" cellspacing="0">
          <thead>
            <tr>
              <td colspan=2>Group id {{$group[0]['id']}}</td>
              <td colspan=1>Max Members:{{$group[0]['max_participants']}}</td>
            </tr>
            <tr>
              <th><span>Profile</span></th>
              <th><span>Name</span></th>
              <th><span>Kick</span></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($group[1] as $participant)
            <tr>
              <td><img src="{{url('images/'.$participant['photo_link'])}}" alt="" style="width: 50px; height: 50px;">
              </td>
              <td>{{$participant['Fname'].' '.$participant['Lname']}}</td>
              <td><a href="{{ url('facilitator/workshop/'.$workshopId.'/'.$group[0]['id'].'/kick/'.$participant['id']) }}">X</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @endforeach

        <br>


      </div>
    </div>
  </div>




</div>
@endsection


@section('scripts')
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script src="{{  asset('js/facilitatorWorkshop.js') }}"> </script>
@endsection