<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laradocs') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="//bootswatch.com/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .navbar { border-radius: 0px; }

        .indent { padding-left: 32px; }
        .text-bold{ font-weight: bold; }
    </style>
</head>
<body>

    <nav class="navbar navbar-inverse"> <!-- or nav-default -->
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('home') }}"><i class="fa fa-arrow-left fa-lg"></i> Back to Site</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                @if(Auth::check())
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Navigation</h3>
                        </div>
                        <div class="panel-body" style="padding-bottom: 0px;">
                            <div class="list-group">
                                <a href="{{ route('administration') }}" class="list-group-item">
                                    <h5>
                                        Documentation
                                    </h5>
                                </a>
                                <a href="{{ route('administration.settings') }}" class="list-group-item">
                                    <h5>
                                        Site Settings
                                    </h5>
                                </a>
                                <a href="{{ route('administration.import.github') }}" class="list-group-item">
                                    <h5>
                                        Import Files
                                    </h5>
                                </a>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <form action="{{ route('auth.logout') }}" method="POST">
                                {!! csrf_field() !!}
                                <input type="submit" class="btn btn-danger btn-sm btn-block" value="Log Out">
                            </form>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-sm-8">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/vue/2.0.8/vue.min.js"></script>
    <script src="//unpkg.com/axios/dist/axios.min.js"></script>

    @stack('scripts')
</body>
</html>
