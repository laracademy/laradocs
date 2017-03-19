@extends('layouts.administration.app', ['section' => 'Dashboard'])

@section('content')
    <h1>Documentation - Dashboard</h1>
    <p class="text-muted">This is your dashboard, from here you can get a quick overview of the documentation that you have online.</p>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-block">
                    <h3 class="card-title">{{ number_format($versionCount, 0) }} Versions</h3>
                    <p class="card-text">Versions allow you to keep track of different versions of the documentation. Of course you can also have a single version such as "master".</p>
                    <a href="{{ route('administration.version') }}" class="btn btn-primary">See All Versions</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-block">
                    <h3 class="card-title">{{ number_format($documentCount, 0) }} Files</h3>
                    <p class="card-text">This number is the total number of markdown files that exists inside your database. Each file is connected to a version and converted to <em>HTML</em> automatically.</p>
                    <a href="#" class="btn btn-primary">See All Files</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-block">
                    <h3 class="card-title">Import</h3>
                    <p class="card-text">If you use something like <em>GitHub</em> to version control your documentation, you can import it via our wizard. These documents will be attached to the version of your choosing.</p>
                    <a href="#" class="btn btn-primary">See Import Wizard</a>
                </div>
            </div>
        </div>
    </div>
@endsection