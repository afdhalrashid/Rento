<div class="row my-3">
    <ul class="nav nav-pills">
        @foreach ($nav_house as $nav)

            <li class="nav-item" style="font-size: 0.95rem; font-weight: bold;">
                <a class="nav-link {{ $nav['is_active'] }}" href="{{ $nav['pageurl'] }}">{{ $nav['pagename'] }}</a>
            </li>

        @endforeach
    </ul>
</div>
