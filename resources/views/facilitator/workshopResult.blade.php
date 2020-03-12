@extends('layouts.app')
@section('content')

<div class="container">


  <div class="workshop-header">

    <div class="workshop-header-left">
      <h2>{{$workshop->title}}</h2>
      Select the ideas you want to grenerate a group from them
    </div>

    <div class="workshop-header-right"> </div>
  </div>





  <hr>


  <input hidden id="workshop_key" value="{{$workshop->key}}" />


  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Results</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <form action="/facilitator/workshop/{{$workshop->id}}/createGroups" method="POST">
          {{ csrf_field() }}
          <table class="table table-bordered" id="participants-table" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th><span>Owner</span></th>
                <th><span>Card Content</span></th>
                <th><span>Score</span></th>
                <th><span>Group</span></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($results as $result)
              <tr id="{{$result['id']}}">
                <td>
                  {{$result['owner']['Fname']." ".$result['owner']["Lname"]}} 
                </td>

                <td>
                  {{$result['description']}}
                </td>
                <td style="width: 20%;">
                  {{$result['average score']}}
                </td>
                <td>
                  <input type="checkbox" name="cb{{$result['id']}}" value="{{$result['id']}}"> create </option><input
                    type="number" name="nb{{$result['id']}}">
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
            <div style="text-align: end">
          <input type="submit" class="btn btn-primary text-center" />
            </div>
        
        </form>
      </div>
    </div>
  </div>

</div>
@endsection


@section('scripts')
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script src="{{  asset('js/facilitatorWorkshop.js') }}"> </script>
@endsection