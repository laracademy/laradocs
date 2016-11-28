@extends('layouts.administration')

@section('content')

    @include('administration.partials.messages')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                Settings
            </h3>
        </div>
        <div class="panel-body">
            <div class="alert alert-info">
                Below are all the settings that you can change on the website.
            </div>

            <form action="{{ route('administration.settings.save') }}" method="POST" autocomplete="off">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label>Site Name</label>
                    <input type="text" class="form-control" name="site_name" value="{{ old('site_name', $settings['site_name']) }}">
                </div>

                <div class="form-group">
                    <label>Site Theme</label>
                    <input type="text" class="form-control" name="theme" value="{{ old('theme', $settings['theme']) }}">
                </div>

                <div class="form-group">
                    <label>Github Username</label>
                    <input type="text" class="form-control" name="github_username" value="{{ old('github_username', $settings['github_username']) }}">
                </div>

                <div class="form-group">
                    <label>Github Access Token @if($settings['github_token']) <a href="{{ route('administration.settings.destroy.token') }}">Remove Token <i class="fa fa-trash"></i></a>@else <span class="text-danger">No Github Token <i class="fa fa-exclamation"></i></span>@endif</label>
                    <input type="password" class="form-control" name="github_token">
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2">
                            <input type="submit" class="btn btn-success btn-block" value="Save Settings">
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection