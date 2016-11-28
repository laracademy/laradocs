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
                        <th width="5%">
                            Default
                        </th>
                        <th width="5%">
                            Active
                        </th>
                        <th width="25%">
                            Version Name
                        </th>
                        <th width="20%">
                            Documents
                        </th>
                        <th width="20%">
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
                            <td class="text-center">
                                @if($version->is_default)
                                    <i class="fa fa-check text-success fa-2x"></i>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($version->active)
                                    <i class="fa fa-circle text-success fa-2x"></i>
                                @else
                                    <i class="fa fa-circle text-danger fa-2x"></i>
                                @endif
                            </td>
                            <td>
                                <h4>
                                    <a href="{{ route('administration.version.edit', $version) }}" title="Edit {{ $version->tag }}" alt="Edit {{ $version->tag }}">{{ $version->tag }}</a>
                                </h4>
                            </td>
                            <td>
                                <h4 class="text-right">
                                    <a href="{{ route('administration.documentation', $version) }}" title="View documents for {{ $version->tag }}" alt="View documents for {{ $version->tag }}">
                                        <span class="label label-default">
                                            {{ $version->documents()->count() }}
                                        </span>
                                    </a>
                                </h4>
                            </td>
                            <td>
                                <h4>
                                    <a href="{{ route('administration.navigation', $version) }}">View</a>
                                </h4>
                            </td>
                            <td>
                                <div class="btn-group btn-group-justified">
                                    <a href="#" class="btn btn-danger" onclick="return false;"><i class="fa fa-trash"></i> Delete</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection