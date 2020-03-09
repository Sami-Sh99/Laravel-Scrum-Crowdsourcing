@extends('layouts.app')
@section('content')

<div class="container">
      <h3>Results:</h3>

    <hr>
    <div class="container bootstrap snippet">
      <div class="row">
        <div class="col-lg-12">
          <div class="main-box no-header clearfix">
            <div class="main-box-body clearfix">
                <br>
                @foreach ($groups as $group)
                    <table border="1" class="table user-list">
                        <thead>
                            <tr><td colspan=2>Group id {{$group[0]['id']}}</td> <td colspan=1>Max Members:{{$group[0]['max_participants']}}</td></tr>
                            <tr>
                                <th><span>Profile</span></th>
                                <th><span>Name</span></th>
                                <th><span>Kick</span></th>
                              </tr>
                        </thead>
                        <tbody>
                            @foreach ($group[1] as $participant)
                                <tr>
                                    <td><img src="{{url('images/'.$participant['photo_link'])}}" alt="" style="width: 200px; height: 200px;"></td>
                                    <td>{{$participant['Fname'].' '.$participant['Lname']}}</td>
                                    <td><a href="{{ url('facilitator/workshop/'.$workshopId.'/'.$group[0]['id'].'/kick/'.$participant['id']) }}">X</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


</div>
@endsection


@section('scripts')
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script src="{{  asset('js/facilitatorWorkshop.js') }}"> </script>
@endsection