@if($navigation)
    <h4>
        Navigation
    </h4>
    <div class="list-group">
        @foreach($navigation as $nav_item)
            @if($nav_item['is_heading'])
                <span class="list-group-item active">
                    {{ $nav_item['title'] }}
                </span>
            @else
                <a href="#" class="list-group-item indent text-bold">
                    {{ $nav_item['title'] }}
                </a>
            @endif
            @if($nav_item['sub_navigation']->count() > 0)
                @foreach($nav_item['sub_navigation'] as $sub_item)
                    <a href="{{ route('document.view', [$version->slug, $sub_item['slug']]) }}" class="list-group-item indent text-bold">
                        {{ $sub_item['title'] }}
                    </a>
                @endforeach
            @endif

        @endforeach
    </div>
@endif