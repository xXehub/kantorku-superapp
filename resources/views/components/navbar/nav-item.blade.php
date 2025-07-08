{{-- 
    Navigation Item Component
    Komponen reusable untuk membuat menu item dengan icon
    Mudah dipahami oleh junior developer
--}}

@props(['route', 'pattern', 'title', 'icon'])

<li class="nav-item {{ request()->routeIs($pattern) ? 'active' : '' }}">
    <a class="nav-link" href="{{ route($route) }}">
        <span class="nav-link-icon d-md-none d-lg-inline-block">
            <x-icon name="{{ $icon }}" />
        </span>
        <span class="nav-link-title">{{ $title }}</span>
    </a>
</li>
