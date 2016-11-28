@extends('layouts.administration')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                Add Existing Document
            </h3>
        </div>
        <div class="panel-body">

            <form action="{{ route('administration.navigation.store.document') }}" method="POST" autocomplete="off">
                {!! csrf_field() !!}
                <input type="hidden" name="navigation_id" value="{{ $navigation->id }}">

                <div class="form-group">
                    <label><i class="fa fa-asterisk text-danger"></i> Document</label>
                    <select name="document_id" class="form-control" autofocus="autofocus">
                        <option value="">Please Select a Document</option>
                        @foreach($documents as $document)
                            <option value="{{ $document->id }}">{{ $document->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Document Title (leave empty to use document name)</label>
                    <input type="text" class="form-control" name="title">
                </div>

                <div>
                    <a href="{{ route('administration.navigation', $navigation->version) }}" class="btn btn-info">Cancel</a>
                    <input type="submit" class="btn btn-success" value="Add Document to Navigation">
                </div>
            </form>

        </div>
    </div>
@endsection