@extends('layouts.authentication.app', ['section' => 'Login'])

@section('content')
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <form method="POST" action="{{ route('auth.login.post') }}" autocomplete="off">
                {{ csrf_field() }}
                <h2 class="form-signin-heading">Please sign in</h2>

                <div class="form-group">
                    <label>Email address</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input id="password" type="password" class="form-control" name="password" required>
                </div>

                <input type="submit" class="btn btn-lg btn-primary btn-block" value="Sign in">
            </form>
        </div>
    </div>
@endsection
