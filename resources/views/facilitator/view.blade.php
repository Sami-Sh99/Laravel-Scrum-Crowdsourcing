@extends('layouts.app')

@section('content')

<div class="container bootstrap snippet">
    <div class="row mb-50">
        <div class="col-sm-10">
            <h1 class="header1">Profile Settings </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <!--left col-->
            <div class="text-center mb-25">
                <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail"
                    alt="avatar">
                <div class="form-group{{ $errors->has('profile') ? ' has-error' : '' }}">
                    <label for="profile" class="mt-20 control-label">Profile Photo</label>
                    <input class="form-group center btn btn-block text-white" id="file-input" name="profile"
                        type="file" />
                    @if ($errors->has('profile'))
                    <span class="help-block">
                        <strong>{{ $errors->first('profile') }}</strong>
                    </span>
                    @endif
                </div>
            </div>



            <div class="panel panel-default">
                <div class="panel-heading">Website <i class="fa fa-link fa-1x"></i></div>
                <div class="panel-body"><a href="http://bootnipets.com">bootnipets.com</a></div>
            </div>


            <ul class="list-group">
                <li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Shares</strong></span> 125</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Likes</strong></span> 13</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Posts</strong></span> 37</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Followers</strong></span> 78</li>
            </ul>

            <div class="panel panel-default">
                <div class="panel-heading">Social Media</div>
                <div class="panel-body">
        
                </div>
            </div>

        </div>
        <!--/col-3-->
        <div class="col-sm-9">
            <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <hr>
                    <form method="POST" action="{{ url('facilitator/update') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}


                        <div class="form-group{{ $errors->has('Fname') ? ' has-error' : '' }}">
                            <div class="col-xs-6">
                                <label for="Fname" class="control-label">First name</label>
                                <input id="Fname" type="text" class="form-control" name="Fname"
                                    value="{{ $user['Fname'] }}" autofocus>
                                @if ($errors->has('Fname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Fname') }}</strong>
                                </span>
                                @endif

                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('Lname') ? ' has-error' : '' }}">
                            <div class="col-xs-6">
                                <label for="Lname" class="control-label">Last name</label>
                                <input id="Lname" type="text" class="form-control" name="Lname"
                                    value="{{ $user['Lname'] }}" autofocus>

                                @if ($errors->has('Lname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Lname') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>




                        <div class="form-group{{ $errors->has('old password') ? ' has-error' : '' }}">
                            <div class="col-xs-12">
                                <label for="old-password" class=" control-label  mt-20">Old Password</label>
                                <input id="old-password" type="password" class="form-control" name="old-password">

                                @if ($errors->has('old-password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('old-password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-xs-6">
                                <label for="password" class="control-label mt-20">New Password</label>
                                <input id="password" type="password" class="form-control" name="password">
                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="password_confirmation" class="control-label  mt-20">Confirm Password</label>
                                <input id="password_confirmation" type="password" class="form-control"
                                    name="password_confirmation">
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="col-xs-12 mt-20">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>

                    </form>

                    <hr>

                </div>
            </div>
            <!--/tab-pane-->
        </div>
        <!--/tab-content-->

    </div>
    <!--/col-9-->
</div>
<!--/row-->

@endsection