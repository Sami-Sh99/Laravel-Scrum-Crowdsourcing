@extends('layouts.app')
@section('content')

<div class="signup-form">
    <form method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <h2>Login</h2>
        <hr>

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
            <div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </label>
                </div>
            </div>
        </div>



        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block btn-lg">Login</button>
        </div>
        <p class="small text-center">By clicking the login button, you agree to our <br><a href="#">Terms &amp;
                Conditions</a>, and <a href="#">Privacy Policy</a></p>
    </form>
    <div class="text-center">Forgot your password? <a href="#">Reset here</a></div>
</div>

@endsection