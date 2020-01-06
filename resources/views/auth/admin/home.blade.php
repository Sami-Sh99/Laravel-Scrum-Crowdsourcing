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
                    <div class="">
                        <table class="table table-striped">
                           <thead>
                           <tr>
                              <th>ID</th>
                              <th>Name</th>
                              <th>Email</th>
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
                                 <td>{{ $user->Fname }}</td>
                                 <td>{{ $user->email }}</td>
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