@extends('layouts.app')

@section('content')
<div class="container">
  <div class="panel panel-default">
    <h2>Admin Dashboard</h2>

    <div class="panel-body">
      @if (session('status'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
      @endif

      <hr>
      <label class="switch mb-4">
        @if ($admin->auto_verify)
        <input id="AutoVerify" type="checkbox" checked>
        @else
        <input id="AutoVerify" type="checkbox">
        @endif
        Auto verify
        <span class="slider round"></span>
      </label>

      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Users</h6>
          
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="participants-table" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Active</th>
                  <th>Verify</th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $user)
                @if($user->id > 1)
                <tr>
                  <td>{{ $user->id }}</td>
                  <td>{{ $user->Fname . $user->Lname }}</td>
                  <td>{{ $user->email }}</td>
                  @if (!$user->is_deactivated)
                  <td><a class="btn btn-danger" href="{{route('activation', ['id'=>$user->id])}}">Deactivate</a></td>
                  @else
                  <td><a class="btn btn-success" href="{{route('activation', ['id'=>$user->id])}}">Activate</a></td>
                  @endif
                  @if (!$user->is_verified)
                  <td><a class="btn btn-primary" href="{{route('verify', ['id'=>$user->id])}}">verify</a></td>
                  @else
                  <td>Already verified</td>
                  @endif
                </tr>
                @endif
                @endforeach
              </tbody>
            </table>
            {{ $users->links() }}
          </div>
        </div>
      </div>





    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
  $("#AutoVerify").change(function(){
        $.get("{{route('auto verify')}}", function(data, status){
        console.log("Data: " + data + "\nStatus: " + status);
      });
      });

</script>
@endsection