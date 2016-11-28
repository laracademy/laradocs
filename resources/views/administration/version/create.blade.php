@extends('layouts.administration')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                Creating New Version
            </h3>
        </div>
        <div class="panel-body">

            <form action="{{ route('administration.version.store') }}" method="POST" autocomplete="off">
                {!! csrf_field() !!}

                @include('administration.version.form')

                <input type="submit" class="btn btn-success" value="Create Version">
            </form>

        </div>
    </div>
@endsection