@extends('layouts.administration.app', ['section' => 'Github Import '])

@section('content')
    <h1>
        Github Import
    </h1>
    <p class="text-muted">
        You can import files from github into the specified documentation version. Using a 3rd party service such as github will give you a reliable source control solution.
    </p>

    <div class="card">
        <div class="card-block">
            @include('administration.partials.messages')

            <form id="frmImport" action="{{ route('administration.import.github.store') }}" method="POST" autocomplete="off">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label>Import Into Version <i class="fa fa-asterisk text-danger"></i></label>
                    <select name="version_id" class="form-control" autofocus="autofocus">
                        @foreach($versions as $version)
                            <option value="{{ $version->id }}" {{ $version->id == $selected ? 'selected' : '' }}>
                                {{ $version->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-muted">
                        The documentation version you would like to import the files into
                    </p>
                </div>

                <div class="form-group">
                    <label>Repository Name <i class="fa fa-asterisk text-danger"></i></label>
                    <input type="text" class="form-control" name="repository_name" placeholder="laradocs">
                    <p class="text-muted">
                        This is the repository name that exists on Github. eg: <em>https://github.com/laracademy/<strong class="text-primary">documentation</strong></em>
                    </p>
                </div>

                <div class="form-group">
                    <label>Repository Owner <i class="fa fa-asterisk text-danger"></i></label>
                    <input type="text" class="form-control" name="repository_owner" placeholder="laracademy">
                    <p class="text-muted">
                        The username that owns the repository. eg: <em>https://github.com/<strong class="text-primary">laracademy</strong>/documentation</em>
                    </p>
                </div>

                <div class="form-group">
                    <label>Branch <i class="fa fa-asterisk text-danger"></i></label>
                    <input type="text" class="form-control" name="repository_branch" placeholder="master">
                    <p class="text-muted">
                        This is the branch that you want to pull from. The branch listing can be found on Github.
                    </p>
                </div>

                <div class="form-group">
                    <label>Folder in Repository</label>
                    <input type="text" class="form-control" name="repository_folder" placeholder="documentation">
                    <p class="text-muted">
                        If the documentation is in another folder in the repository, this is where you would add the path to that folder.
                    </p>
                </div>

                <div class="form-group">
                    <div id="submitButton">
                        <input type="submit" class="btn btn-success btn-lg" value="Import from Github">
                    </div>
                    <div id="userUI" style="display: none;">
                        <h3 class="text-success">
                            Please Wait ... <img src="{{ asset('assets/images/ajax-lg.gif') }}" alt="Loading ...">
                        </h3>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        var formSubmitted = false;

        $(function(){
            $('#frmImport').on('submit', function() {
                // prevent multiple calls
                if(formSubmitted) {
                    return false;
                }

                $('#submitButton').hide();
                $('#userUI').show();

                formSubmitted = true;
            });
        })
    </script>
@endpush