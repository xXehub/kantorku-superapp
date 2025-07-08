@props(['name', 'class' => 'icon icon-1', 'size' => '24'])
@php
    // Koleksi semua icon SVG dalam format asli
    $icons = [
        // Icon untuk menu navigasi
        'users' =>
            '<svg xmlns="http://www.w3.org/2000/svg" width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' .
            $class .
            '">
            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
        </svg>',

        'apps' =>
            '<svg xmlns="http://www.w3.org/2000/svg" width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' .
            $class .
            '">
            <path d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
            <path d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
            <path d="M14 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
            <path d="M14 7l6 0" />
            <path d="M17 4l0 6" />
        </svg>',

        'building' =>
            '<svg xmlns="http://www.w3.org/2000/svg" width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' .
            $class .
            '">
            <path d="M3 21l18 0" />
            <path d="M5 21v-16l8 -4v20" />
            <path d="M19 21v-10l-6 -4" />
            <path d="M9 9l0 .01" />
            <path d="M9 12l0 .01" />
            <path d="M9 15l0 .01" />
            <path d="M9 18l0 .01" />
        </svg>',

        'category' =>
            '<svg xmlns="http://www.w3.org/2000/svg" width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 24 24" fill="currentColor" class="' .
            $class .
            '">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M10 3h-6a1 1 0 0 0 -1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1 -1v-6a1 1 0 0 0 -1 -1z" />
            <path d="M20 3h-6a1 1 0 0 0 -1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1 -1v-6a1 1 0 0 0 -1 -1z" />
            <path d="M10 13h-6a1 1 0 0 0 -1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1 -1v-6a1 1 0 0 0 -1 -1z" />
            <path d="M17 13a4 4 0 1 1 -3.995 4.2l-.005 -.2l.005 -.2a4 4 0 0 1 3.995 -3.8z" />
        </svg>',

        // Icon untuk dashboard dan navigasi
        'dashboard' =>
            '<svg xmlns="http://www.w3.org/2000/svg" width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' .
            $class .
            '">
            <path d="M3 13c0 -3.771 0 -5.657 1.172 -6.828s3.057 -1.172 6.828 -1.172s5.657 0 6.828 1.172s1.172 3.057 1.172 6.828s0 5.657 -1.172 6.828s-3.057 1.172 -6.828 1.172s-5.657 0 -6.828 -1.172s-1.172 -3.057 -1.172 -6.828z" />
            <path d="M9 16l0 -4l6 0l0 4" />
            <path d="M10 12l0 -2a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v2" />
        </svg>',

        'home' =>
            '<svg xmlns="http://www.w3.org/2000/svg" width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' .
            $class .
            '">
            <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
        </svg>',

        'home-share' =>
            '<svg xmlns="http://www.w3.org/2000/svg" width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' .
            $class .
            '">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M9 21v-6a2 2 0 0 1 2 -2h2c.247 0 .484 .045 .702 .127" />
            <path d="M19 12h2l-9 -9l-9 9h2v7a2 2 0 0 0 2 2h5" />
            <path d="M16 22l5 -5" />
            <path d="M21 21.5v-4.5h-4.5" />
        </svg>',

        // Icon untuk UI elements
        'settings' =>
            '<svg xmlns="http://www.w3.org/2000/svg" width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' .
            $class .
            '">
            <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
            <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
        </svg>',

        'help' =>
            '<svg xmlns="http://www.w3.org/2000/svg" width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' .
            $class .
            '">
            <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
            <path d="M15 15l3.35 3.35" />
            <path d="M9 15l-3.35 3.35" />
            <path d="M5.65 5.65l3.35 3.35" />
            <path d="M18.35 5.65l-3.35 3.35" />
        </svg>',

        // Icon untuk notifications dan theme
        'bell' =>
            '<svg xmlns="http://www.w3.org/2000/svg" width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' .
            $class .
            '">
            <path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
            <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
        </svg>',

        'moon' =>
            '<svg xmlns="http://www.w3.org/2000/svg" width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' .
            $class .
            '">
            <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
        </svg>',

        'sun' =>
            '<svg xmlns="http://www.w3.org/2000/svg" width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' .
            $class .
            '">
            <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
            <path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
        </svg>',

        // Icon untuk logo brand
        'building-skyscraper' =>
            '<svg xmlns="http://www.w3.org/2000/svg" width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' .
            $class .
            '">
            <path stroke="none" d="M0 0h32v32H0z" fill="none" />
            <path d="M4 28l24 0" />
            <path d="M6 28v-18l10 -5v23" />
            <path d="M25 28v-13l-8 -5" />
            <path d="M12 12l0 .01" />
            <path d="M12 16l0 .01" />
            <path d="M12 20l0 .01" />
            <path d="M12 24l0 .01" />
        </svg>',

        // Icon untuk role dan permission
        'shield' =>
            '<svg xmlns="http://www.w3.org/2000/svg" width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' .
            $class .
            '">
            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
        </svg>',

        'dots' =>
            '<svg xmlns="http://www.w3.org/2000/svg" width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' .
            $class .
            '">
            <path d="M12 6l0 .01" />
            <path d="M12 18l0 .01" />
            <path d="M6 12l0 .01" />
            <path d="M18 12l0 .01" />
            <path d="M7.5 7.5l0 .01" />
            <path d="M16.5 16.5l0 .01" />
            <path d="M7.5 16.5l0 .01" />
            <path d="M16.5 7.5l0 .01" />
        </svg>',

        'lock' =>
            '<svg xmlns="http://www.w3.org/2000/svg" width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' .
            $class .
            '">
            <path d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z" />
            <path d="M11 4a2 2 0 0 1 2 0v4a2 2 0 0 1 -2 0v-4z" />
            <path d="M12 7m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
        </svg>',

        // buku
        'buku' =>
            '<svg xmlns="http://www.w3.org/2000/svg" width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' .
            $class .
            '">
           <path d="M10 19h-6a1 1 0 0 1 -1 -1v-14a1 1 0 0 1 1 -1h6a2 2 0 0 1 2 2a2 2 0 0 1 2 -2h6a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-6a2 2 0 0 0 -2 2a2 2 0 0 0 -2 -2z" /><path d="M12 5v16" /><path d="M7 7h1" /><path d="M7 11h1" /><path d="M16 7h1" /><path d="M16 11h1" /><path d="M16 15h1" />
        </svg>',

        // ceklis
        'ceklis' =>
            '<svg xmlns="http://www.w3.org/2000/svg" width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' .
            $class .
            '">
           <path d="M8.56 3.69a9 9 0 0 0 -2.92 1.95" /><path d="M3.69 8.56a9 9 0 0 0 -.69 3.44" /><path d="M3.69 15.44a9 9 0 0 0 1.95 2.92" /><path d="M8.56 20.31a9 9 0 0 0 3.44 .69" /><path d="M15.44 20.31a9 9 0 0 0 2.92 -1.95" /><path d="M20.31 15.44a9 9 0 0 0 .69 -3.44" /><path d="M20.31 8.56a9 9 0 0 0 -1.95 -2.92" /><path d="M15.44 3.69a9 9 0 0 0 -3.44 -.69" /><path d="M9 12l2 2l4 -4" />
        </svg>',

        // plus
        'plus' =>
            '<svg xmlns="http://www.w3.org/2000/svg" width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' .
            $class .
            '">
            <path d="M12 5l0 14" />
            <path d="M5 12l14 0" />
        </svg>',

        // edit
        'edit' =>
            '<svg xmlns="http://www.w3.org/2000/svg" width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' .
            $class .
            '">
            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
            <path d="M16 5l3 3" />
        </svg>',

        // eye
        'eye' =>
            '<svg xmlns="http://www.w3.org/2000/svg" width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' .
            $class .
            '">
            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
        </svg>',

        // check
        'check' =>
            '<svg xmlns="http://www.w3.org/2000/svg" width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' .
            $class .
            '">
            <path d="M5 12l5 5l10 -10" />
        </svg>',

        // list
        'list' =>
            '<svg xmlns="http://www.w3.org/2000/svg" width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' .
            $class .
            '">
            <path d="M9 6l11 0" />
            <path d="M9 12l11 0" />
            <path d="M9 18l11 0" />
            <path d="M5 6l0 .01" />
            <path d="M5 12l0 .01" />
            <path d="M5 18l0 .01" />
        </svg>',
    ];
@endphp

{{-- fungsi gawe render icon lek ditemukan --}}
@if (isset($icons[$name]))
    {!! $icons[$name] !!}
@else
    {{-- default icon jika tidak ditemukan --}}
    <svg xmlns="http://www.w3.org/2000/svg" width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24"
        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
        class="{{ $class }}">
        <circle cx="12" cy="12" r="10" />
        <path d="M12 6v6l4 2" />
    </svg>
@endif
