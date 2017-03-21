@extends('layouts.administration.app', ['section' => 'Creating document for: '. $version->name])

@section('content')
    <h1>
        Creating New Document for Version: {{ $version->tag }}
    </h1>
    <p class="text-muted">
        Please fill in the form below to create the document.
    </p>

    <div class="card">
        <div class="card-block">

            @include('layouts.administration.partials.messages')

            <form action="{{ route('administration.documentation.store') }}" method="POST" autocomplete="off">
                {!! csrf_field() !!}
                <input type="hidden" name="version_id" value="{{ $version->id }}">
                <input type="hidden" name="navigation_id" value="{{ $navigation_id }}">

                @include('administration.documentation.partials.form', ['document' => $document])

                <div class="text-right">
                    <a href="{{ route('administration.documentation.listing', $version) }}" class="btn btn-info">Cancel</a>
                    <input type="submit" class="btn btn-success btn-lg" value="Save Document">
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