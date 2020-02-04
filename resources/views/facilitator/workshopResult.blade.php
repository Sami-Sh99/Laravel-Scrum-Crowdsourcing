@extends('layouts.app')
@section('content')

<div class="container">

    <h1>{{$workshop->title}}</h1>
    <p>{{$workshop->description}}</p>

      <h3>Results:</h3>

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
                      <th><span>Owner</span></th>
                      <th><span>Card Content</span></th>
                      <th><span>Score</span></th>
                      <th>&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach ($results as $result)
                  <tr id="{{$result['id']}}">
                      <td>
                        <a href="#" class="user-link"> {{$result['owner']['Fname']." ".$result['owner']["Lname"]}} </a>
                      </td>

                      <td>
                        {{$result['description']}}
                      </td>
                      <td style="width: 20%;">
                        {{$result['average score']}}
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