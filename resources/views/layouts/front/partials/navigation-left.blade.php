<nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">

    @foreach($navigation as $nav_item)
        <ul class="nav flex-column">
            @if($nav_item['is_heading'])
                <li class="nav-item">
                    <a href="#" class="nav-link disabled">{{ $nav_item['title'] }}</a>
                </li>
            @else
                <li class="nav-item">
                    <a href="#" class="list-group-item indent text-bold">
                        {{ $nav_item['title'] }}
                    </a>
                </li>
            @endif

            @if($nav_item['sub_navigation']->count() > 0)
                @foreach($nav_item['sub_navigation'] as $sub_item)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('document.view', [$version->slug, $sub_item['slug']]) }}">
                            {{ $sub_item['title'] }}
                        </a>
                    </li>
                @endforeach
            @endif
        </ul>
    @endforeach

</nav>