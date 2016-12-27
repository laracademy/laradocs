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

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="pull-right">
                            <ul class="list-inline">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-arrow-down"></i> Expand
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('administration.documentation.create', $version) }}">
                                        <i class="fa fa-plus"></i> Create Document
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <h3 class="panel-title">
                            Associated Documents
                        </h3>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="35%">
                                    Name
                                </th>
                                <th width="30%">
                                    Last Updated
                                </th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($version->documents()->orderBy('title')->get() as $document)
                                <tr>
                                    <td>
                                        <h5>
                                            {{ $document->title }}
                                        </h5>
                                    </td>
                                    <td>
                                        <h5>
                                            {{ $document->updated_at->format('F d, Y @ g:i A') }}
                                        </h5>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-justified">
                                            <a href="{{ route('administration.documentation.destroy', $document) }}" class="btn btn-primary" onclick="return confirm('Are you sure you want to remove this document? We will remove any associated navigation item automatically if you do.');">
                                                <i class="fa fa-trash"></i> Delete
                                            </a>
                                            <a href="{{ route('administration.documentation.edit', $document) }}" class="btn btn-info">
                                                <i class="fa fa-pencil"></i> Edit
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="pull-right">
                            <ul class="list-inline">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-arrow-down"></i> Expand
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('administration.navigation', $version) }}">
                                        <i class="fa fa-list"></i> Edit Navigation
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <h3 class="panel-title">
                            Associated Navigation
                        </h3>
                    </div>
                    <div class="panel-body">
                        
                    </div>
                </div>
            
            </div>
        </div>
    </div>


@endsection