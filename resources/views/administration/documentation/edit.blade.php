@extends('layouts.administration.app')

@section('content')

    @include('administration.partials.messages')

    <div id="vueAdminApp">

        <div class="alert alert-info" v-show="showHelp">
            <h4>
                <i class="fa fa-question-circle"></i> Help
            </h4>
            <p>
                On this page you can edit the document named "<strong class="text-warning">{{ $document->title }}</strong>". We support <strong class="text-warning">Markdown</strong> and you can either paste raw markdown code in the editor below or write it from scratch.
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
                    Editing: {{ $document->title }} (Version: {{ $document->version->tag }})
                </h3>
            </div>
            <div class="panel-body">

                <form action="{{ route('administration.documentation.update', $document) }}" method="POST" autocomplete="off">
                    {!! csrf_field() !!}

                    @include('administration.documentation.form', ['document' => $document])

                    <div>
                    <a href="{{ route('administration.documentation', $document->version) }}" class="btn btn-danger">Cancel</a>
                        <input type="submit" class="btn btn-success btn-lg" value="Update Document">
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