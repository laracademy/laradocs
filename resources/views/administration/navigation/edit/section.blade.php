@extends('layouts.administration')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                Create New Section
            </h3>
        </div>
        <div class="panel-body">

            <form action="{{ route('administration.navigation.update.section') }}" method="POST" autocomplete="off">
                {!! csrf_field() !!}
                <input type="hidden" name="id" value="{{ $navigation->id }}">

                <div class="form-group">
                    <label>Section Title</label>
                    <input type="text" class="form-control" name="title" autofocus="autofocus" value="{{ $navigation->title }}">
                </div>

                <div>
                    <a href="{{ route('administration.navigation', $navigation->version_id) }}" class="btn btn-info">Cancel</a>
                    <input type="submit" class="btn btn-success" value="Create Section">
                </div>
            </form>

        </div>
    </div>
@endsection