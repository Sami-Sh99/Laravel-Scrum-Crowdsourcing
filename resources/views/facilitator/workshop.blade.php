@extends('layouts.app')
@section('content')

<div class="container">

    <h1>{{$workshop->title}}</h1>
    <p>{{$workshop->description}}</p>

    <button id="Launch" class="btn btn-primary">Launch Workshop</button>
   
      <h3>Participants:</h3>

    <hr>

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
<script>

      $("#Launch").on('click',function(){
        console.log('launching');
        $.get("/facilitator/workshop/{{$workshop->key}}/launch", function(data, status){
        console.log("Data: " + data + "\nStatus: " + status);
        });
      });

  // Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('2e19e7364cd8170d657c', {
  cluster: 'eu',
  forceTLS: true
});

var workshopKey = <?php echo json_encode($workshop->key) ?>; 

var channel = pusher.subscribe('workshop.' + workshopKey);
channel.bind('new-user', function(data) {
var row=document.getElementById("participants-table").insertRow();
var cell1 = row.insertCell(0);
var cell2 = row.insertCell(1);
var cell3 = row.insertCell(2);

cell1.innerHTML = '<td><img src="https://bootdey.com/img/Content/user_1.jpg" alt=""><a href="#" class="user-link">' + data.fullname + '</a></td>';
cell2.innerHTML = '<td><a href="#">marlon@brando.com</a></td>';
cell3.innerHTML = '<td style="width: 20%;"><a> Delete </a></td>';

});

</script>
@endsection