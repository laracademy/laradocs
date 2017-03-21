@extends('layouts.administration.app', ['section' => 'Editing '. $version->name])

@section('content')
    <h1>Editing {{ $version->name }}</h1>
    <p class="text-muted">
        Please make the changes below and then click the Save Version button.
    </p>

    <div class="card">
        <div class="card-block">
            @include('administration.partials.messages')

            <form action="{{ route('administration.versions.update', $version) }}" method="POST" autocomplete="off">
                {!! csrf_field() !!}

                @include('administration.versions.partials.form', ['version' => $version])

                <div class="text-right">
                    <a href="{{ route('administration.versions') }}" class="btn btn-danger">Cancel</a>
                    <input type="submit" class="btn btn-success btn-lg" value="Update Version">
                </div>
            </form>

        </div>
    </div>
@endsection