@extends('layouts.administration')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                Create New Section
            </h3>
        </div>
        <div class="panel-body">

            <form action="{{ route('administration.navigation.store.section') }}" method="POST" autocomplete="off">
                {!! csrf_field() !!}
                <input type="hidden" name="version_id" value="{{ $version->id }}">

                <div class="form-group">
                    <label>Section Title</label>
                    <input type="text" class="form-control" name="title" autofocus="autofocus">
                </div>

                <div>
                    <a href="{{ route('administration.navigation', $version) }}" class="btn btn-info">Cancel</a>
                    <input type="submit" class="btn btn-success" value="Create Section">
                </div>
            </form>

        </div>
    </div>
@endsection