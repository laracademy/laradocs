@extends('layouts.administration.app')

@section('content')

    <div id="vueAdminApp">

        <div class="alert alert-info" v-show="showHelp">
            <h4>
                <i class="fa fa-question-circle"></i> Help
            </h4>
            <p>
                You are viewing the information about "<strong class="text-warning">{{ $version->tag }}</strong>". From this screen you are able to create, update or delete documents that have been linked into this specific version. In addition you can edit the navigation that is displayed on the main page.
            </p>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="pull-right">
                    <ul class="list-inline">
                        <li>
                            <a href="#" v-on:click.prevent="showHelp = ! showHelp"><i class="fa fa-question-circle"></i> Help</a>
                        </li>
                        <li>
                            <a href="{{ route('administration.documentation.create', $version) }}"><i class="fa fa-plus"></i> Create New Document</a>
                        </li>
                    </ul>
                </div>
                <h3 class="panel-title">
                    <i class="fa fa-file-text"></i> Linked Documents
                </h3>
            </div>
            <div class="panel-body">
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="40%">
                                <h4>Document</h4>
                            </th>
                            <th width="40%">
                                <h4>Last Updated</h4>
                            </th>
                            <th>
                                <h4>Actions</h4>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($version->documents as $document)
                            <tr>
                                <td>
                                    <h5>
                                        {{ $document->title }}
                                    </h5>
                                </td>
                                <td>
                                    <h5>
                                        {{ $document->updated_at->format('F d, Y g:iA') }}
                                    </h5>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-justified">
                                        <a href="{{ route('administration.documentation.destroy', $document) }}" class="btn btn-danger" onclick="return confirm('Are you sure?');"><i class="fa fa-trash"></i></a>
                                        <a href="{{ route('administration.documentation.edit', $document) }}" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        new Vue({
            el: '#vueAdminApp',
            data: {
                showHelp: false
            },
        });
    </script>
@endpush