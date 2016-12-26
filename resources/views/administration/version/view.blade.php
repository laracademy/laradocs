@extends('layouts.administration')

@section('content')

    @include('administration.partials.messages')

    <div id="vueAdminVersionIndex">

        <div class="alert alert-info">
            <h4>
                <i class="fa fa-question-circle"></i> Help
            </h4>
            <p>
                In this screen you can quickly see any documents that are associated with this version. You can create, edit or remove these documents.
            </p>
            <p>
                In addition, you can modify the navigation that is associated with this version.
            </p>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Viewing: <strong>{{ $version->tag }}</strong>
                </h3>
            </div>
            <div class="panel-body">
            
            </div>
        </div>
    </div>


@endsection