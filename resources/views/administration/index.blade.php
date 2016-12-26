@extends('layouts.administration')

@section('content')

    @include('administration.partials.messages')

    <div id="vueAdminOverview">

        <div class="alert alert-info" v-if="showHelp">
            <h4>
                <i class="fa fa-question-circle"></i> Help
            </h4>
            <p>
                This screen shows you a quick overview of what documentation you have installed on the site. It will let you know which versions are active, which version you have set to the default of the site and in addition what versions have a starting page.
            </p>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="pull-right">
                    <ul class="list-inline">
                        <li>
                            <a href="#" v-on:click.stop.prevent="showHelp = !showHelp">
                                <i class="fa fa-question-circle"></i> Help
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('administration.version.create')}}">
                                <i class="fa fa-plus"></i> Create Version
                            </a>
                        </li>
                    </ul>
                </div>
                <h3 class="panel-title">
                    Documentation Overview
                </h3>
            </div>
            <div class="panel-body">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>

                            <th width="20%">
                                Name
                            </th>
                            <th width="15%">
                                Default
                            </th>
                            <th width="15%">
                                Active
                            </th>
                            <th width="15%">
                                Starting Page
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
                                    <h4>
                                        <a href="{{ route('administration.version.view', $version) }}">
                                            {{ $version->tag }}
                                        </a>
                                    </h4>
                                </td>
                                <td class="text-center">
                                    @if($version->is_default)
                                        <i class="fa fa-check text-success fa-2x"></i>
                                    @else
                                        <i class="fa fa-times text-danger fa-2x"></i>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($version->active)
                                        <i class="fa fa-check text-success fa-2x"></i>
                                    @else
                                        <i class="fa fa-times text-danger fa-2x"></i>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($version->default_document_id != 0)
                                        <i class="fa fa-check text-success fa-2x"></i>
                                    @else
                                        <i class="fa fa-times text-danger fa-2x"></i>
                                    @endif
                                </td>
                                <!--
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
                                -->
                                <td>
                                    <div class="btn-group btn-group-justified">
                                        <a href="{{ route('administration.version.destroy', $version) }}" class="btn btn-danger" onclick="return confirm('This will remove all assigned documents and navigational links, are you sure?');">
                                            <i class="fa fa-trash"></i> Delete
                                        </a>
                                        <a href="{{ route('administration.version.edit', $version) }}" class="btn btn-info">
                                            <i class="fa fa-pencil"></i> Edit
                                        </a>
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
            el: "#vueAdminOverview",
            data: {
                showHelp: false,
            }
        });
    </script>
@endpush