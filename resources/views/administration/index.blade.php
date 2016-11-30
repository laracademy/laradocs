@extends('layouts.administration')

@section('content')

    @include('administration.partials.messages')

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="pull-right">
                <a href="{{ route('administration.version.create')}}"><i class="fa fa-plus"></i> Create Version</a>
            </div>
            <h3 class="panel-title">
                Documentation Versions
            </h3>
        </div>
        <div class="panel-body">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>

                        <th width="20%">
                            Name
                        </th>
                        <th width="10%">
                            Is Default
                        </th>
                        <th width="10%">
                            Is Active
                        </th>
                        <th width="10%">
                            Has Start Page
                        </th>
                        <th width="15%">
                            Documents
                        </th>
                        <th width="15%">
                            Navigation
                        </th>
                        <th>
                            Delete
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($versions as $version)
                        <tr>
                            <td>
                                <h4>
                                    <a href="{{ route('administration.version.edit', $version) }}" title="Edit {{ $version->tag }}" alt="Edit {{ $version->tag }}">{{ $version->tag }}</a>
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
                                @if($version->default_document_id != 0)
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
                            <td>
                                <div class="btn-group btn-group-justified">
                                    <a href="{{ route('administration.version.destroy', $version) }}" class="btn btn-danger" onclick="return confirm('Are you sure?');"><i class="fa fa-trash"></i> Delete</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection