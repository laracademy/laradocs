@extends('layouts.administration.app')

@section('content')

    @include('administration.partials.messages')

    <div id="vueAdminApp">

        <div class="alert alert-info" v-show="showHelp">
            <h4>
                <i class="fa fa-question-circle"></i> Help
            </h4>
            <p>
                In the table listing below you can see all of the versions that have been created on the application.
            </p>
            <p>
                You can see a quick overview of each of these versions. Please click the appropriate button to edit or delete that version.
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
                            <a href="{{ route('administration.version.create')}}"><i class="fa fa-plus"></i> Create Version</a>
                        </li>
                    </ul>
                </div>
                <h3 class="panel-title">
                    Versions
                </h3>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="20%">
                                Name
                            </th>
                            <th width="10%">
                                Default
                            </th>
                            <th width="10%">
                                Active
                            </th>
                            <th width="10%">
                                Start Page
                            </th>
                            <th>
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($versions as $version)
                            <tr>
                                <td>
                                    <h3>
                                        {{ $version->tag }}
                                    </h3>
                                </td>
                                <td class="text-center">
                                    @if($version->is_default)
                                        <i class="fa fa-check text-success fa-3x"></i>
                                    @else
                                        <i class="fa fa-times text-danger fa-3x"></i>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($version->active)
                                        <i class="fa fa-check text-success fa-3x"></i>
                                    @else
                                        <i class="fa fa-times text-danger fa-3x"></i>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($version->default_document_id != 0)
                                        <i class="fa fa-check text-success fa-3x"></i>
                                    @else
                                        <i class="fa fa-times text-danger fa-3x"></i>
                                    @endif
                                </td>
                                {{--
                                <td>
                                    <h4>
                                        <a href="{{ route('administration.documentation', $version) }}">
                                            Edit Documents ({{ $version->documents()->count() }})
                                        </a>
                                    </h4>
                                </td>
                                <td>
                                    <h4>
                                        <a href="{{ route('administration.navigation', $version) }}">
                                            Edit Navigation
                                        </a>
                                    </h4>
                                </td>
                                --}}
                                <td>
                                    <div class="btn-group btn-group-justified">
                                        <a href="{{ route('administration.version.edit', $version) }}" class="btn btn-info">
                                            Edit
                                        </a>
                                        <a href="{{ route('administration.version.destroy', $version) }}" class="btn btn-danger" onclick="return confirm('This will delete all documents and any navigation associated, are you sure?');">Delete</a>
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