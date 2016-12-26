<ul class="sidebar-nav">
    <li class="sidebar-brand">
        <a href="{{ route('home') }}">
            <i class="fa fa-arrow-left fa-lg"></i> Back to site
        </a>
    </li>
    <li class="title">
        Versions:
        <ul>
            <li>
                <a href="{{ route('administration.version.create') }}">
                    Create New Version
                </a>
            </li>
            @if($list_versions->count())
                @foreach($list_versions as $version)
                    <li>
                        <a href="{{ route('administration.version.view', $version) }}">
                            {{ $version->tag }}
                        </a>
                    </li>
                @endforeach
            @else
                <li>
                    <span class="text-danger">No versions created</span>
                </li>
            @endif
        </ul>
    </li>
    <li>
        <a href="#">
            Import
        </a>
    </li>
    <li>
        <a href="#">
            Settings
        </a>
    </li>
    <li>
        <a href="#">
            Logout
        </a>
    </li>
</ul>