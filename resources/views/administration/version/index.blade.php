@extends('layouts.administration.app', ['section' => 'Versions'])

@section('content')
    <h1>Versions</h1>
    <p class="text-muted">
        This section is a listing of all versions of your documentation that has been installed on the website active, or not.
    </p>

    <!-- alert -->
    <div class="alert alert-info" role="alert">
        <strong>Heads up!</strong> It looks like you do not have any documentation online yet. This looks like a good time to try out the <a href="#">Docs Wizard</a> to get your documentation started.
    </div>
    <!-- alert -->

    <div class="text-right pb-2">
        <a href="{{ route('administration.version.create') }}" class="btn btn-success"><i class="fa fa-tag"></i> Create New Version</a>
    </div>

    @include('layouts.administration.partials.messages')

    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th width="25%">
                    Version <i class="fa fa-question-circle text-info" data-toggle="tooltip" data-placement="top" title="This is the version or name that you have given"></i>
                </th>
                <th>
                    Default <i class="fa fa-question-circle text-info" data-toggle="tooltip" data-placement="top" title="Indicator of which version is the default"></i>
                </th>
                <th>
                    Active <i class="fa fa-question-circle text-info" data-toggle="tooltip" data-placement="top" title="Indicator of which version is active (will be displayed on the page)"></i>
                </th>
                <th width="30%">
                    Landing Page <i class="fa fa-question-circle text-info" data-toggle="tooltip" data-placement="top" title="The page that is first loaded"></i>
                </th>
                <th width="25%">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($versions as $version)
                <tr>
                    <td>
                        <h5>
                            {{ $version->name }}
                        </h5>
                    </td>
                    <td class="text-center">
                        @if($version->is_default)
                            <i class="fa fa-fw fa-check fa-lg text-success"></i>
                        @else
                            <i class="fa fa-fw fa-ban fa-lg text-danger"></i>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($version->active)
                            <i class="fa fa-fw fa-check fa-lg text-success"></i>
                        @else
                            <i class="fa fa-fw fa-ban fa-lg text-danger"></i>
                        @endif
                    </td>
                    <td>
                        <h5>
                            @if($version->document_id)
                                Installation?
                            @else
                                <i class="fa fa-fw fa-warning fa-lg text-warning"></i> Landing Page not Selected!
                            @endif
                        </h5>
                    </td>
                    <td>
                        <div class="btn-group btn-group-justified">
                            <a class="btn btn-danger" href="{{ route('administration.version.destroy', $version) }}" onclick="return confirm('Are you sure you want to delete the selected version?');"><i class="fa fa-fw fa-trash"></i><span class="hidden-lg-down"> Delete</span></a>
                            <a class="btn btn-primary" href="{{ route('administration.version.edit', $version) }}"><i class="fa fa-fw fa-pencil"></i><span class="hidden-lg-down"> Edit</span></a>
                            <a href="#" class="btn btn-secondary"><i class="fa fa-fw fa-eye"></i><span class="hidden-lg-down"> View</span></a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


@endsection