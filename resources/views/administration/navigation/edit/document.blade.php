@extends('layouts.administration')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                Edit Navigation Item
            </h3>
        </div>
        <div class="panel-body">

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

                <div>
                    <a href="{{ route('administration.navigation', $navigation->version) }}" class="btn btn-info">Cancel</a>
                    <input type="submit" class="btn btn-success" value="Update Navigation Item">
                </div>
            </form>

        </div>
    </div>
@endsection