@if($active_versions->count() <= 0)
    {{-- no active versions, nothing will be displayed --}}
@else
    @if($active_versions->count() == 1)
        <li>
            <span class="navbar-text">
                Documentation Version: <strong>{{ $active_versions->first()->tag }}</strong>
            </span>
        </li>
    @else
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                Version(s) <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                @foreach($active_versions as $version)
                    <li>
                        <a href="#">{{ $version->tag }}</a>
                    </li>
                @endforeach
            </ul>
        </li>
    @endif
@endif