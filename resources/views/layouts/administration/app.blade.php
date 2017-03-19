<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laradocs - SPOT</title>

    <!-- bootstrap -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
    <!-- font-awesome -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- base -->
    <link rel="stylesheet" href="{{ asset('assets/css/base.css') }}">
</head>
<body>

    @include('layouts.administration.partials.navigation-top')

    <div class="container-fluid">
        <div class="row">
            @include('layouts.administration.partials.navigation-left')
        </div>
        <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
            @yield('content')
        </main>
    </div>

    <!-- jquery -->
    <script src="//code.jquery.com/jquery-3.1.1.slim.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
    <!-- bootstrap -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>

    <!-- global jquery -->
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>

    @stack('scripts')
</body>
</html>
