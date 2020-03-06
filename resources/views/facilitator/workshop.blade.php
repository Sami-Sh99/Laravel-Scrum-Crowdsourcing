@extends('layouts.app')
@section('content')

<div class="container">
  <div class="workshop-header">
    
    <div class="workshop-header-left">
        <h2>{{$workshop->title}}</h2> 
        {{$workshop->description}} 
    </div>

<div class="workshop-header-right" > </div>    
</div>
<hr>

<input hidden id="workshop_key" value="{{$workshop->key}}" />


    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Participants</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered"  id="participants-table" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Profile</th>
                <th>Name</th>
                <th>Email</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($participants as $item)
              <tr  id="{{$item['id']}}">
                <td>
                  <img src="https://bootdey.com/img/Content/user_1.jpg" alt="">
                  <a href="#" class="user-link"> {{$item['Fname']." ".$item["Lname"]}} </a>
                </td>
                <td>
                  <a href="#" class="user-link"> {{$item['Fname']." ".$item["Lname"]}} </a>
                </td>
             <td>   {{$item['email']}} </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>


   
    <div class="row">
      <div class="col-xs-2 ml-auto mt-4">
        <button id="Launch" class="btn btn-primary">Launch Workshop</button>
      </div>
    </div>
    

</div>
@endsection


@section('scripts')
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script src="{{  asset('js/facilitatorWorkshop.js') }}"> </script>
@endsection