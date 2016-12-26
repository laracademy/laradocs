@extends('layouts.administration.app')

@section('content')

    @include('administration.partials.messages')

    <div id="vueAdminApp">

        <div class="alert alert-info" v-show="showHelp">
            <h4>
                <i class="fa fa-question-circle"></i> Help
            </h4>
            <p>
                On this page you can create a new document for "<strong class="text-warning">{{ $version->tag }}</strong>". We support <strong class="text-warning">Markdown</strong> and you can either paste raw markdown code in the editor below or write it from scratch.
            </p>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="pull-right">
                    <ul class="list-inline">
                        <li>
                            <a href="#" v-on:click.prevent="showHelp = ! showHelp"><i class="fa fa-question-circle"></i> Help</a>
                        </li>
                    </ul>
                </div>
                <h3 class="panel-title">
                    New Document
                </h3>
            </div>
            <div class="panel-body">

                <form action="{{ route('administration.documentation.store') }}" method="POST" autocomplete="off">
                    {!! csrf_field() !!}
                    <input type="hidden" name="version_id" value="{{ $version->id }}">
                    <input type="hidden" name="navigation_id" value="{{ $navigation_id }}">

                    @include('administration.documentation.form', ['document' => $document])

                    <div>
                    <a href="{{ route('administration.documentation', $version) }}" class="btn btn-danger">Cancel</a>
                        <input type="submit" class="btn btn-success btn-lg" value="Create New Document">
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        var simplemde = new SimpleMDE({ element: $("#markdown")[0] });

        new Vue({
            el: '#vueAdminApp',
            data: {
                showHelp: false
            },
        });
    </script>
@endpush