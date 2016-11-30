@extends('layouts.administration')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                Creating New Document for Version: {{ $version->tag }}
            </h3>
        </div>
        <div class="panel-body">

            <form action="{{ route('administration.documentation.store') }}" method="POST" autocomplete="off">
                {!! csrf_field() !!}
                <input type="hidden" name="version_id" value="{{ $version->id }}">
                <input type="hidden" name="navigation_id" value="{{ $navigation_id }}">

                @include('administration.documentation.form', ['document' => $document])

                <div>
                <a href="{{ route('administration.documentation', $version) }}" class="btn btn-info">Cancel</a>
                    <input type="submit" class="btn btn-success" value="Save Document">
                </div>
            </form>

        </div>
    </div>
@endsection

@push('script')
    <script>
        var simplemde = new SimpleMDE({ element: $("#markdown")[0] });
    </script>
@endpush