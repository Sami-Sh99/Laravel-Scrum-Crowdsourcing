@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Admin Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Welcome Admin are logged in!
                    <br>
                    <label class="switch">
                        @if ($admin->auto_verify)
                            <input id="AutoVerify" type="checkbox" checked>
                        @else
                            <input id="AutoVerify" type="checkbox">
                        @endif
                            Auto verify
                        <span class="slider round"></span>
                      </label>
                    <br>
                    <div class="">
                        <table class="table table-striped">
                           <thead>
                           <tr>
                              <th>ID</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Active</th>
                              <th></th> 
                           </tr>
                           </thead>
                           <tbody>
                              @foreach($users as $user)
                              @if ($user->is_verified)
                                <tr class="success">
                              @else
                                <tr class="danger">
                              @endif
                                 <td>{{ $user->id }}</td>
                                 <td>{{ $user->Fname . $user->Lname }}</td>
                                 <td>{{ $user->email }}</td>
                                 @if (!$user->is_deactivated)
                                    <td><a class="btn btn-success" href="{{route('activation', ['id'=>$user->id])}}">Activate</a></td>
                                 @else
                                    <td><a class="btn btn-danger" href="{{route('activation', ['id'=>$user->id])}}">Deactivate</a></td>
                                  @endif
                                 @if (!$user->is_verified)
                                <td><a class="btn btn-primary" href="{{route('verify', ['id'=>$user->id])}}">verify</a></td>
                                 @endif
                              </tr>
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