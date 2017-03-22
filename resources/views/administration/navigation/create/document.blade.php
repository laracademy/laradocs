@extends('layouts.administration.app', ['section' => 'Adding Document'])

@section('content')
    <h1>
        Adding Document
    </h1>
    <p class="text-muted">
        Please fill in the form below to add a document into the navigation
    </p>

    <div class="card">
        <div class="card-block">

            @include('administration.partials.messages')

            <form id="frmDocument" action="{{ route('administration.navigation.store.document') }}" method="POST" autocomplete="off">
                {!! csrf_field() !!}
                <input type="hidden" name="navigation_id" value="{{ $navigation->id }}">

                <div class="form-group">
                    <label><i class="fa fa-asterisk text-danger"></i> Existing Document</label>
                    <select name="document_id" class="form-control" autofocus="autofocus">
                        <option value="">Please select an existing document</option>
                        @foreach($documents as $document)
                            <option value="{{ $document->id }}">{{ $document->title }}</option>
                        @endforeach
                    </select>
                    <p class="text-muted">
                        Please select an existing document to add into the navigation.
                    </p>
                </div>

                <div class="form-group">
                    <label>Document Title (leave empty to use document name)</label>
                    <input type="text" class="form-control" name="title">
                    <p class="text-muted">
                        You can re-title this document only on the navigation. Eg; your document may be titled <em>installation</em> but you can change it to <em>Installation</em> here.
                    </p>
                </div>

                <div class="text-right">
                    <a href="{{ route('administration.navigation', $navigation->version) }}" class="btn btn-danger">Cancel</a>
                    <input type="submit" class="btn btn-success btn-lg" value="Add Document to Navigation">
                </div>
            </form>

        </div>
    </div>
@endsection