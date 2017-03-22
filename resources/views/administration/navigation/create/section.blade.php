@extends('layouts.administration.app', ['section' => 'Creating new Section'])

@section('content')
    <h1>
        Creating new Section
    </h1>
    <p class="text-muted">
        Please fill in the form below to create a new section.
    </p>

    <div class="card">
        <div class="card-block">

            @include('administration.partials.messages')

            <form action="{{ route('administration.navigation.store.section') }}" method="POST" autocomplete="off">
                {!! csrf_field() !!}
                <input type="hidden" name="version_id" value="{{ $version->id }}">

                <div class="form-group">
                    <label>Section Title</label>
                    <input type="text" class="form-control" name="title" autofocus="autofocus">
                </div>

                <div class="text-right">
                    <a href="{{ route('administration.navigation', $version) }}" class="btn btn-danger">Cancel</a>
                    <input type="submit" class="btn btn-success btn-lg" value="Create Section">
                </div>
            </form>

        </div>
    </div>
@endsection