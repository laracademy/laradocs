@extends('layouts.administration.app', ['section' => 'Editing '. $version->name])

@section('content')
    <h1>Editing {{ $version->name }}</h1>
    <p class="text-muted">
        Please make the changes below and then click the Save Version button.
    </p>

    <div class="card">
        <div class="card-block">
            <form action="{{ route('administration.version.update', $version) }}" method="POST" autocomplete="off">
                {!! csrf_field() !!}

                @include('administration.version.partials.form', ['version' => $version])

                <input type="submit" class="btn btn-success" value="Update Version">
            </form>

        </div>
    </div>
@endsection