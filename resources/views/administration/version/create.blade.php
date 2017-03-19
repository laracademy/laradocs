@extends('layouts.administration.app', ['section' => 'Create Version'])

@section('content')
    <h1>Creating a New Version</h1>
    <p class="text-muted">
        Please fill in the form below to create a new version of documentation.
    </p>

    <div class="card">
        <div class="card-block">
            <form action="{{ route('administration.version.store') }}" method="POST" autocomplete="off">
                {!! csrf_field() !!}

                @include('administration.version.partials.form')

                <input type="submit" class="btn btn-success" value="Create Version">
            </form>
        </div>
    </div>

@endsection