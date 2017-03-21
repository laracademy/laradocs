@extends('layouts.administration.app', ['section' => 'Editing document: '. $document->title])

@section('content')
    <h1>
        Editing: {{ $document->title }} (Version: {{ $version->name }})
    </h1>
    <p class="text-muted">
        Please fill in the form below.
    </p>

    <div class="card">
        <div class="card-block">

            <form action="{{ route('administration.documentation.update', $document) }}" method="POST" autocomplete="off">
                {!! csrf_field() !!}

                @include('administration.documentation.partials.form', ['document' => $document])

                <div class="text-right">
                    <a href="{{ route('administration.documentation', $document->version) }}" class="btn btn-info">Cancel</a>
                    <input type="submit" class="btn btn-success btn-lg" value="Update Document">
                </div>
            </form>

        </div>
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/simplemde/1.11.2/simplemde.min.css">
@endpush

@push('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/simplemde/1.11.2/simplemde.min.js"></script>
    <script>
        var simplemde = new SimpleMDE({ element: $("#markdown")[0] });
    </script>
@endpush