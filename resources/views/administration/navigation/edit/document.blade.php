@extends('layouts.administration.app', ['section' => 'Editing Navigation Document'])

@section('content')
    <h1>
        Editing Navigation Document
    </h1>
    <p class="text-muted">
        In this section you can manage the navigation of your documentation. You can add existing documents or create new documents on the fly.
    </p>

    <div class="card">
        <div class="card-block">

            <form id="frmDocument" action="{{ route('administration.navigation.update.document') }}" method="POST" autocomplete="off">
                {!! csrf_field() !!}
                <input type="hidden" name="id" value="{{ $navigation->id }}">

                <div class="form-group">
                    <label><i class="fa fa-asterisk text-danger"></i> Document</label>
                    <select name="document_id" class="form-control" autofocus="autofocus">
                        <option value="">Please Select a Document</option>
                        @foreach($documents as $document)
                            <option value="{{ $document->id }}" {{ $navigation->document_id == $document->id ? 'selected' : '' }}>{{ $document->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Document Title (leave empty to use document name)</label>
                    <input type="text" class="form-control" name="title" value="{{ $navigation->title }}">
                </div>

                <div class="text-right">
                    <a href="{{ route('administration.navigation', $navigation->version) }}" class="btn btn-danger">Cancel</a>
                    <input type="submit" class="btn btn-success btn-lg" value="Update Navigation Item">
                </div>
            </form>

        </div>
    </div>
@endsection