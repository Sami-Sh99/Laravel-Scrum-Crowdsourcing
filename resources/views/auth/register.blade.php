@extends('layouts.app')
@section('content')

<div class="signup-form">
    <form method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}
        <h2>Sign Up</h2>
        <p>It's free and only takes a minute.</p>
        <hr>
        <div class="form-group{{ $errors->has('Fname') ? ' has-error' : '' }}">
            <label for="Fname">First name</label>
            <input id="Fname" type="text" class="form-control" name="Fname" value="{{ old('Fname') }}" required
                autofocus>
            @if ($errors->has('Fname'))
            <span class="help-block">
                <strong>{{ $errors->first('Fname') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('Lname') ? ' has-error' : '' }}">
            <label for="Lname">Last Name</label>
            <input id="Lname" type="text" class="form-control" name="Lname" value="{{ old('Lname') }}" required
                autofocus>
            @if ($errors->has('Lname'))
            <span class="help-block">
                <strong>{{ $errors->first('Lname') }}</strong>
            </span>
            @endif

        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email">Email Address</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
            @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password">Password</label>
            <input id="password" type="password" class="form-control" name="password" required>

            @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <label for="password-confirm">Confirm Password</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </div>

        <div class="form-group">
            <label for="Role">Choose Role</label>
            <div>
                Participant <input id="role" type="radio" name="role" value="P" checked required>
                Facilitator <input id="role" type="radio" name="role" value="F" required>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block btn-lg">Sign Up</button>
        </div>
        <p class="small text-center">By clicking the Sign Up button, you agree to our <br><a href="#">Terms &amp;
                Conditions</a>, and <a href="#">Privacy Policy</a></p>
    </form>
    <div class="text-center">Already have an account? <a href="#">Login here</a></div>
</div>

@endsection