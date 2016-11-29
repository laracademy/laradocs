@extends('layouts.administration')

@section('content')

    @include('administration.partials.messages')

    <div id="vueDocuments">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="pull-right">
                    <a href="{{ route('administration.documentation.create', $version) }}"><i class="fa fa-plus"></i> Create New Document</a>
                </div>
                <h3 class="panel-title">
                    Listing of Documents for Version: {{ $version->tag }}
                </h3>
            </div>
            <div class="panel-body">

                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="40%">
                                <h4>Document</h4>
                            </th>
                            <th width="40%">
                                <h4>Last Updated</h4>
                            </th>
                            <th>
                                <h4>Actions</h4>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($documents as $document)
                            <tr>
                                <td>
                                    <h5>
                                        {{ $document->title }}
                                    </h5>
                                </td>
                                <td>
                                    <h5>
                                        {{ $document->updated_at->format('F d, Y g:iA') }}
                                    </h5>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-justified">
                                        <a href="{{ route('administration.documentation.destroy', $document) }}" class="btn btn-danger" onclick="return confirm('Are you sure?');"><i class="fa fa-trash"></i></a>
                                        <a href="{{ route('administration.documentation.edit', $document) }}" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>

    </div>
@endsection