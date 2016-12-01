@extends('layouts.administration')

@section('content')

    @include('administration.partials.messages')

    @if($navigation->count() <= 0)
        <div class="alert alert-danger">
            <h4>
                No Navigation for {{ $version->tag }}
            </h4>
            <p>
                Sorry, there was no navigation found for the version ({{ $version->tag }}). Please start by creating a new section.
            </p>
        </div>
    @endif

    <div class="list-group">
        <div class="list-group-item">
            <a href="{{ route('administration.navigation.create.section', $version) }}"><i class="fa fa-plus-circle"></i> Add New Section</a>
        </div>

        @foreach($navigation as $nav_item)
            <div class="list-group-item active">
                {{ $nav_item['title'] }}
                <span class="pull-right">
                    <ul class="list-inline">
                        <li>
                            <a href="{{ route('administration.navigation.edit.section', $nav_item['id']) }}" title="Edit Navigation Item"><i class="fa fa-pencil text-info"></i></a>
                        </li>
                        <li>
                            <a href="{{ route('administration.navigation.destroy', $nav_item['id']) }}" onclick="return confirm('This will also remove any linked documents, are you sure?');"><i class="fa fa-trash"></i></a>
                        </li>
                    </ul>
                </span>
            </div>
            <!-- documents -->
            @foreach($nav_item['sub_navigation'] as $sub_item)
                <div class="list-group-item indent text-bold">
                    {{ $sub_item->title ? $sub_item->title : $sub_item->document->title }}
                    <span class="pull-right">
                        <ul class="list-inline">
                            <li>
                                <a href="{{ route('administration.navigation.edit.document', $sub_item['id']) }}" title="Edit Navigation Item"><i class="fa fa-pencil text-info"></i></a>
                            </li>
                            <li>
                                <a href="{{ route('administration.documentation.edit', $sub_item->document) }}" title="Edit Document"><i class="fa fa-file-text"></i></a>
                            </li>
                            <li>
                                <a href="{{ route('administration.navigation.destroy', $sub_item['id']) }}" title="Delete Navigation Item"><i class="fa fa-trash text-danger"></i></a>
                            </li>
                        </ul>
                    </span>
                </div>
            @endforeach
            <div class="list-group-item indent">
                <a href="{{ route('administration.navigation.create.document', $nav_item['id']) }}"><i class="fa fa-plus-circle"></i> Add Existing Document</a>
            </div>
            <div class="list-group-item indent">
                <a href="{{ route('administration.documentation.create', [$nav_item['version_id'], $nav_item['id']]) }}"><i class="fa fa-plus-circle"></i> Add New Document</a>
            </div>
        @endforeach
    </div>
@endsection