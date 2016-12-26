<ul class="sidebar-nav">
    <li class="sidebar-brand">
        <a href="{{ route('home') }}">
        {{ $site_name ? $site_name : 'Laradocs' }}
        </a>
    </li>
    @if($navigation)
        @foreach($navigation as $navigation_item)
            <li>
                <a href="">
                    {{ $navigation_item['title'] }}
                </a>
                @if($navigation_item['sub_navigation']->count() > 0)
                    <ul>
                        @foreach($navigation_item['sub_navigation'] as $sub_navigation)
                            <li>
                                <a href="{{ route('document.view', [$version->slug, $sub_navigation['slug']]) }}">
                                    {{ $sub_navigation['title'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    @endif
</ul>