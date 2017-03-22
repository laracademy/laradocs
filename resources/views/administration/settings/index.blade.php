@extends('layouts.administration.app', ['section' => 'Settings'])

@section('content')

    <h1>Settings</h1>
    <p class="text-muted">
        This section is the configuration of your online documentation website.
    </p>

    <div class="card">
        <div class="card-block">
            @include('administration.partials.messages')

            <form action="{{ route('administration.settings.save') }}" method="POST" autocomplete="off">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label>Site Name</label>
                    <input type="text" class="form-control" name="site_name" value="{{ old('site_name', $settings['site_name']) }}">
                    <p class="text-muted">
                        The name of your website. By default "Laradocs" will be used.
                    </p>
                </div>

                <div class="form-group">
                    <label>Site Theme</label>
                    <input type="text" class="form-control" name="theme" value="{{ old('theme', $settings['theme']) }}">
                    <p class="text-muted">
                        Not used yet
                    </p>
                </div>

                <div class="form-group">
                    <label>Github Username</label>
                    <input type="text" class="form-control" name="github_username" value="{{ old('github_username', $settings['github_username']) }}">
                    <p class="text-muted">
                        Your Github username. This is <strong>ONLY</strong> used if you want to import files from Github.
                    </p>
                </div>

                <div class="form-group">
                    <label>
                        Github Access Token
                        <div>
                            @if($settings['github_token'])
                                <span class="text-info">
                                    A Github token was found would you like to <a href="{{ route('administration.settings.destroy.token') }}">remove it?</a>
                                </span>
                            @else
                                <span class="text-danger">No Github token was found.</span>
                            @endif
                        </div>
                    </label>
                    <input type="password" class="form-control" name="github_token">
                    <p class="text-muted">
                        Your Github personal access token. This is <strong>ONLY</strong> used if you want to import files from Github.
                    </p>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-success btn-lg" value="Save Settings">
                </div>
            </form>

        </div>
    </div>
@endsection