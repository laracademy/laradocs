@extends('layouts.administration')

@section('content')

    @include('administration.partials.messages')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                Import Markdown Files from Github
            </h3>
        </div>
        <div class="panel-body">
            <form id="githubVue" action="{{ route('administration.import.github.store') }}" method="POST" autocomplete="off" v-cloak>
                {!! csrf_field() !!}

                <div class="form-group">
                    <label>Import Into Version</label>
                    <select name="version_id" class="form-control" autofocus="autofocus">
                        @foreach($versions as $version)
                            <option value="{{ $version->id }}" {{ $version->is_default ? 'selected' : '' }}>{{ $version->tag }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Repository Name <i class="fa fa-asterisk text-danger"></i></label>
                    <input type="text" class="form-control" name="repository_name" placeholder="laradocs">
                </div>

                <div class="form-group">
                    <label>Repository Owner <i class="fa fa-asterisk text-danger"></i></label>
                    <input type="text" class="form-control" name="repository_owner" placeholder="laracademy">
                </div>

                <div class="form-group">
                    <label>Branch <i class="fa fa-asterisk text-danger"></i></label>
                    <input type="text" class="form-control" name="repository_branch" placeholder="master">
                </div>

                <div class="form-group">
                    <label>Folder in Repository</label>
                    <input type="text" class="form-control" name="repository_folder" placeholder="documentation">
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-success btn-lg"
                        value="Import from Github"
                        v-show="!isProcessing"
                        v-on:click="isProcessing = true">
                    <h3 class="text-success" v-show="isProcessing">
                        <img src="{{ asset('assets/images/ajax-lg.gif') }}" alt="Please Wait ..."> Please Wait ...
                    </h3>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('script')
    <script>
        new Vue({
            el: '#githubVue',
            data: {
                isProcessing: false,
            }
        })
    </script>
@endpush