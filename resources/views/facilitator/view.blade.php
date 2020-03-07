@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-10">
            <h2>Profile Settings</h2>
        </div>
    </div>

    <form method="POST" action="{{ url('facilitator/update') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
    <div class="row mt-2">
        <div class="col-sm-3">
            <div class="text-center mt-3">
                @php $photo = Auth::user()->photo_link @endphp
                        <img src="{{ asset('images/'.$photo.'') }}" class="avatar img-circle img-thumbnail"
                        alt="avatar"  onerror="this.src='http://ssl.gstatic.com/accounts/ui/avatar_2x.png'"  />  
                <div class="form-group{{ $errors->has('profile') ? ' has-error' : '' }}">
                    <label for="profile" class="mt-20 control-label">Profile Photo</label>
                    <input class="form-group center btn btn-primary btn-block text-white" id="file-input" name="profile"
                        type="file" />
                    @if ($errors->has('profile'))
                    <span class="help-block">
                        <strong>{{ $errors->first('profile') }}</strong>
                    </span>
                    @endif
                </div>
            </div>



            <div class="panel panel-default">
                <div class="panel-heading"></div>
                <div class="panel-body"></div>
            </div>

        </div>

        <div class="col-sm-9">
            <hr>
                <div class="row">
                    <div class="form-group{{ $errors->has('Fname') ? ' has-error' : '' }} col-sm-6">
                        <label for="Fname" class="control-label">First name</label>
                        <input id="Fname" type="text" class="form-control" name="Fname" value="{{ $user['Fname'] }}"
                            autofocus>
                        @if ($errors->has('Fname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('Fname') }}</strong>
                        </span>
                        @endif
                    </div>


                    <div class="form-group{{ $errors->has('Lname') ? ' has-error' : '' }} col-sm-6">
                        <label for="Lname" class="control-label">Last name</label>
                        <input id="Lname" type="text" class="form-control" name="Lname" value="{{ $user['Lname'] }}"
                            autofocus>

                        @if ($errors->has('Lname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('Lname') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="row">

                    <div class="form-group{{ $errors->has('old password') ? ' has-error' : '' }} col-sm-12">

                        <label for="old-password" class=" control-label  mt-20">Old Password</label>
                        <input id="old-password" type="password" class="form-control" name="old-password">

                        @if ($errors->has('old-password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('old-password') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} col-sm-6">
                        <label for="password" class="control-label ">New Password</label>
                        <input id="password" type="password" class="form-control" name="password">
                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>


                    <div class="form-group col-sm-6">
                        <label for="password_confirmation" class="control-label">Confirm Password</label>
                        <input id="password_confirmation" type="password" class="form-control"
                            name="password_confirmation">
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-xs-2 ml-auto mt-4">
                        <button type="submit" class="btn btn-primary btn-block">Save</button>
                    </div>
                </div>
        </div>

    </div>
</form>

</div>

@endsection