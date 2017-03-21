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

                <div class="text-right">
                    <input type="submit" class="btn btn-success btn-lg" value="Update Version">
                </div>
            </form>

        </div>
    </div>
@endsection