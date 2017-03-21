@extends('layouts.administration.app', ['section' => 'Managing '. $version->name])

@section('content')
    <h1>Managing Version: {{ $version->name }} <span class="small">(<a href="{{ route('administration.version.edit', $version) }}">edit</a>)</span></h1>
    <p class="text-muted">
        In this section you can see a quick overview for the "{{ $version->name }}" documentation.
    </p>

    <div class="row">

        <div class="col">
            <div class="card">
                <div class="card-block">
                    <h3 class="card-title">{{ $version->documents->count() }} Files</h3>
                    <p class="card-text">Create, edit or delete existing files for this version.</p>
                    <a href="{{ route('administration.documentation.listing', $version) }}" class="btn btn-primary">View Associated Files</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-block">
                    <h3 class="card-title">Navigation</h3>
                    <p class="card-text">Setup the navigation for this documentation (left hand side).</p>
                    <a href="#" class="btn btn-primary">View Associated Navigation</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-block">
                    <h3 class="card-title">Import</h3>
                    <p class="card-text">Import documentation from a 3rd party site such as Github.</p>
                    <a href="#" class="btn btn-primary">Import from Github</a>
                </div>
            </div>
        </div>

      </div>
@endsection