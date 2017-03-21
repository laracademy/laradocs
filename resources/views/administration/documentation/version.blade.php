@extends('layouts.administration.app', ['section' => 'Document Listing for '. $version->name])

@section('content')
    <h1>Document Listing for: {{ $version->name }} <span class="small">(<a href="{{ route('administration.versions.edit', $version) }}">edit</a>)</span></h1>
    <p class="text-muted">
        This section lists all of the documents that have been stored for the selected versions. You can create, edit or delete these documents from here.
    </p>

    <div class="text-right pb-2">
        <a href="{{ route('administration.documentation.create', $version) }}" class="btn btn-success"><i class="fa fa-file"></i> Create New Document</a>
    </div>

    @include('layouts.administration.partials.messages')

    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th width="25%">
                    Title <i class="fa fa-question-circle text-info" data-toggle="tooltip" data-placement="top" title="The given name for the document"></i>
                </th>
                <th>
                    Last Updated On <i class="fa fa-question-circle text-info" data-toggle="tooltip" data-placement="top" title="When the document was last modified on this system"></i>
                </th>
                <th width="25%">
                    Actions
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

@endsection