@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Update Profile</div>

            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ url('facilitator/update') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('Fname') ? ' has-error' : '' }}">
                        <label for="Fname" class="col-md-4 control-label">First name</label>

                        <div class="col-md-3">
                            <input id="Fname" type="text" class="form-control" name="Fname" value="{{ $user['Fname'] }}"  autofocus>

                            @if ($errors->has('Fname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Fname') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('Lname') ? ' has-error' : '' }}">
                        <label for="Lname" class="col-md-4 control-label">Last name</label>

                        <div class="col-md-3">
                            <input id="Lname" type="text" class="form-control" name="Lname" value="{{ $user['Lname'] }}"  autofocus>

                            @if ($errors->has('Lname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Lname') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('old password') ? ' has-error' : '' }}">
                        <label for="old password" class="col-md-4 control-label">Old Password</label>

                        <div class="col-md-6">
                            <input id="old password" type="password" class="form-control" name="old password" >

                            @if ($errors->has('old password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('old password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">New Password</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" >

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="col-md-4 control-label">Confirm New Password</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('profile') ? ' has-error' : '' }}">
                        <label for="profile" class="col-md-4 control-label">Profile Photo</label>

                        <div class="col-md-3">
                            <input class="form-group " id="file-input" name="profile" type="file" />

                            @if ($errors->has('profile'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('profile') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection