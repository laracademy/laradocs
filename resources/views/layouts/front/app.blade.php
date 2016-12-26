<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $site_name ? $site_name : 'Laradocs' }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    @if($theme)
        <link rel="stylesheet" href="{{ $theme }}">
    @else
        <link rel="stylesheet" href="//bootswatch.com/flatly/bootstrap.min.css">
    @endif

    <style>
        .navbar { border-radius: 0px; }

        .indent { padding-left: 32px; }
        .text-bold{ font-weight: bold; }
        .list-group-item{ border-radius: 0px; }
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
                <a class="navbar-brand" href="{{ route('home') }}">{{ $site_name ? $site_name : 'Laradocs' }}</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                {{--
                <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
                --}}

                <ul class="nav navbar-nav navbar-right">
                    @include('layouts.front.partials.versions')
                    <li>
                        <a href="{{ route('auth.login') }}">
                            Login!
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2">
                @include('layouts.front.partials.left-navigation')
            </div>
            <div class="col-sm-10">
                @yield('content')
            </div>
        </div>
    </div>


    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
