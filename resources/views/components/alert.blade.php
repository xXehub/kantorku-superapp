@props([
    'type' => 'info',
    'title' => null,
    'dismissible' => false,
    'icon' => true,
    'important' => false
])

@php
    $alertClasses = 'alert';
    
    // Add alert type
    $alertClasses .= ' alert-' . $type;
    
    // Add dismissible class if needed
    if ($dismissible) {
        $alertClasses .= ' alert-dismissible';
    }
    
    // Add important class if needed
    if ($important) {
        $alertClasses .= ' alert-important';
    }
    
    // Define icons for each type
    $icons = [
        'primary' => '<path d="M3 12a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 9h.01" /><path d="M11 12h1v4h1" />',
        'secondary' => '<path d="M3 12a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 9h.01" /><path d="M11 12h1v4h1" />',
        'success' => '<path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 12l2 2l4 -4" />',
        'info' => '<path d="M3 12a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 9h.01" /><path d="M11 12h1v4h1" />',
        'warning' => '<path d="M12 9v4" /><path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" /><path d="M12 16h.01" />',
        'danger' => '<path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M10 10l4 4m0 -4l-4 4" />',
        'light' => '<path d="M3 12a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 9h.01" /><path d="M11 12h1v4h1" />',
        'dark' => '<path d="M3 12a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 9h.01" /><path d="M11 12h1v4h1" />'
    ];
@endphp

<div class="{{ $alertClasses }}" role="alert">
    <div class="d-flex">
        @if($icon && isset($icons[$type]))
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon alert-icon">
                    {!! $icons[$type] !!}
                </svg>
            </div>
        @endif
        <div>
            @if($title)
                <h4 class="alert-title">{{ $title }}</h4>
            @endif
            <div class="text-secondary">
                {{ $slot }}
            </div>
        </div>
    </div>
    @if($dismissible)
        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
    @endif
</div>
