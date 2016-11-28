@extends('layouts.administration')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                Editing: {{ $document->title }} (Version: {{ $document->version->tag }})
            </h3>
        </div>
        <div class="panel-body">

            <form action="{{ route('administration.documentation.update', $document) }}" method="POST" autocomplete="off">
                {!! csrf_field() !!}

                @include('administration.documentation.form', ['document' => $document])

                <div>
                <a href="{{ route('administration.documentation', $document->version) }}" class="btn btn-info">Cancel</a>
                    <input type="submit" class="btn btn-success" value="Update Document">
                </div>
            </form>

        </div>
    </div>
@endsection