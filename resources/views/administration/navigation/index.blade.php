@extends('layouts.administration.app', ['section' => 'Navigation for '. $version->name])

@section('content')
    <h1>
        Navigation for: {{ $version->name }}
    </h1>
    <p class="text-muted">
        In this section you can manage the navigation of your documentation. You can add existing documents or create new documents on the fly.
    </p>

    @include('administration.partials.messages')

    @if($navigation->count() <= 0)
        <div class="alert alert-danger">
            <h4>
                No Navigation Found!
            </h4>
            Sorry, there appears to be no navigation found for the version "{{ $version->name }}". Please start off by creating a new section.
        </div>
    @endif

    <ul class="list-group">
        <li class="list-group-item">
            <a href="{{ route('administration.navigation.create.section', $version) }}"><i class="fa fa-plus-circle"></i> Add New Section</a>
        </li>
        @foreach($navigation as $nav_item)
            <li class="list-group-item">
                {{ $nav_item['title'] }}&nbsp;
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a href="{{ route('administration.navigation.edit.section', $nav_item['id']) }}" title="Edit Navigation Item"><i class="fa fa-pencil text-info"></i> Edit</a>
                    </li>
                    <li class="list-inline-item">
                        <a href="{{ route('administration.navigation.destroy', $nav_item['id']) }}" onclick="return confirm('This will also remove any linked documents, are you sure?');" class="text-danger"><i class="fa fa-trash"></i> Delete</a>
                    </li>
                    @if(!$loop->first)
                        <li class="list-inline-item">
                            <a href="{{ route('administration.navigation.rank.up', $nav_item['id']) }}" class="text-warning"><i class="fa fa-level-up"></i> Move Up</a>
                        </li>
                    @endif
                    @if(!$loop->last)
                        <li class="list-inline-item">
                            <a href="{{ route('administration.navigation.rank.down', $nav_item['id']) }}" class="text-warning"><i class="fa fa-level-down"></i> Move Down</a>
                        </li>
                    @endif
                </ul>
            </li>
            {{-- DOCUMENTS --}}
            @foreach($nav_item['sub_navigation'] as $sub_item)
                <li class="list-group-item indent">
                    <i class="fa fa-angle-double-right"></i>&nbsp; {{ $sub_item->title ? $sub_item->title : $sub_item->document->title }}&nbsp;
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="{{ route('administration.navigation.edit.document', $sub_item['id']) }}" title="Edit Navigation Item"><i class="fa fa-pencil"></i> Edit</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{ route('administration.documentation.edit', $sub_item->document) }}" title="Edit Document" class="text-info"><i class="fa fa-file-text"></i> View Document</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{ route('administration.navigation.destroy', $sub_item['id']) }}" title="Delete Navigation Item" class="text-danger"><i class="fa fa-trash"></i> Delete</a>
                        </li>
                        @if(!$loop->first)
                            <li class="list-inline-item">
                                <a href="{{ route('administration.navigation.rank.up', $sub_item['id']) }}" class="text-warning"><i class="fa fa-level-up"></i> Move Up</a>
                            </li>
                        @endif
                        @if(!$loop->last)
                            <li class="list-inline-item">
                                <a href="{{ route('administration.navigation.rank.down', $sub_item['id']) }}" class="text-warning"><i class="fa fa-level-down"></i> Move Down</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endforeach
            <li class="list-group-item indent">
                <a href="{{ route('administration.navigation.create.document', $nav_item['id']) }}"><i class="fa fa-plus-circle"></i> Add Existing Document</a>
            </li>
            <li class="list-group-item indent">
                <a href="{{ route('administration.documentation.create', [$nav_item['version_id'], $nav_item['id']]) }}"><i class="fa fa-plus-circle"></i> Add New Document</a>
            </li>
            {{-- DOCUMENTS --}}
        @endforeach
    </ul>
@endsection