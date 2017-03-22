@extends('layouts.administration.app', ['section' => 'Editing Navigation Section'])

@section('content')
    <h1>
        Section
    </h1>
    <p class="text-muted">
        Please edit the section information below before saving.
    </p>

    <div class="card">
        <div class="card-block">

            <form action="{{ route('administration.navigation.update.section') }}" method="POST" autocomplete="off">
                {!! csrf_field() !!}
                <input type="hidden" name="id" value="{{ $navigation->id }}">

                <div class="form-group">
                    <label>Section Title</label>
                    <input type="text" class="form-control" name="title" autofocus="autofocus" value="{{ $navigation->title }}">
                </div>

                <div class="text-right">
                    <a href="{{ route('administration.navigation', $navigation->version_id) }}" class="btn btn-danger">Cancel</a>
                    <input type="submit" class="btn btn-success btn-lg" value="Update Section">
                </div>
            </form>

        </div>
    </div>
@endsection