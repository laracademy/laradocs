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

                <div class="text-right">
                    <input type="submit" class="btn btn-success btn-lg" value="Create Version">
                </div>
            </form>
        </div>
    </div>

@endsection