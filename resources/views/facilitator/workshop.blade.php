@extends('layouts.app')
@section('content')

<div class="container">

    <h1>{{$workshop->title}}</h1>
    <p>{{$workshop->description}}</p>

    <button id="Launch" class="btn btn-primary">Launch Workshop</button>
   
      <h3>Participants:</h3>

    <hr>
<input hidden id="workshop_key" value="{{$workshop->key}}" />
    <div class="container bootstrap snippet">
      <div class="row">
        <div class="col-lg-12">
          <div class="main-box no-header clearfix">
            <div class="main-box-body clearfix">
              <div class="table-responsive">
                <table class="table user-list" id="participants-table">
                  <thead>
                    <tr>
                      <th><span>User</span></th>
                      <th><span>Email</span></th>
                      <th>&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach ($participants as $item)
                    <tr>
                      <td>
                        <img src="https://bootdey.com/img/Content/user_1.jpg" alt="">
                        <a href="#" class="user-link"> {{$item['Fname']." ".$item["Lname"]}} </a>
                      </td>

                      <td>
                        <a href="#">marlon@brando.com</a>
                      </td>
                      <td style="width: 20%;">
                        <a> Delete </a>
                      </td>
                    </tr>
                    @endforeach

                  </tbody>
                </table>
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