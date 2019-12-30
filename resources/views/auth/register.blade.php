@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="Fname" class="col-md-4 control-label">First name</label>

                            <div class="col-md-3">
                                <input id="Fname" type="text" class="form-control" name="Fname" value="{{ old('Fname') }}" required autofocus>

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
                                <input id="Lname" type="text" class="form-control" name="Lname" value="{{ old('Lname') }}" required autofocus>

                                @if ($errors->has('Lname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Lname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Role" class="col-md-4 control-label">Choose Role</label>

                            <div class="col-md-3">
                                Participant <input id="role" type="radio" name="role" value="P" checked required>
                            </div>
                            <div class="col-md-3">
                                Facilitator <input id="role" type="radio" name="role" value="F" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
