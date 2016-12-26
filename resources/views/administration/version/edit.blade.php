@extends('layouts.administration.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                Editing: {{ $version->tag }}
            </h3>
        </div>
        <div class="panel-body">

            <form action="{{ route('administration.version.update', $version) }}" method="POST" autocomplete="off">
                {!! csrf_field() !!}

                @include('administration.version.form', ['version' => $version])

                <input type="submit" class="btn btn-success" value="Update Version">
            </form>

        </div>
    </div>
@endsection