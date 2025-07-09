<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'KantorKu SuperApp' }} - Pemerintah Kota Surabaya</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Meta Tags for SEO -->
    <meta name="description" content="Sistem Informasi Terintegrasi Pemerintah Kota Surabaya">
    <meta name="keywords" content="KantorKu, SuperApp, Surabaya, Pemerintah, Sistem Informasi">
    <meta name="author" content="Pemerintah Kota Surabaya">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Inter:300,400,500,600,700&display=swap" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ asset('libs/jsvectormap/dist/jsvectormap.css?1744816593') }}" rel="stylesheet" />

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{{ asset('dist/css/tabler.css?1744816593') }}" rel="stylesheet" />
    {{-- <link href="./dist/css/tabler.css?1744816593" rel="stylesheet" /> --}}

    <!-- Tabler CSS Framework -->

    <link href="{{ asset('dist/css/tabler-themes.css?1744816593') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-flags.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-payments.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-vendors.css?1744816593') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-socials.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-marketing.css') }}" rel="stylesheet" />


    <!-- BEGIN DEMO STYLES -->
    <link href="{{ asset('./preview/css/demo.css?1744816593') }}" rel="stylesheet" />
    {{-- <link href="./preview/css/demo.css?1744816593" rel="stylesheet" /> --}}
    <!-- END DEMO STYLES -->
    <!-- BEGIN CUSTOM FONT -->
    <style>
        @import url("https://rsms.me/inter/inter.css");
    </style>
    <!-- Laravel Mix Assets -->
    @vite(['resources/js/app.js'])

    <!-- Custom Styles -->

</head>

<body>
    {{-- <script src="./dist/js/tabler-theme.min.js?1744816593"></script> --}}
    <script src="{{ asset('dist/js/tabler-theme.min.js?1744816593') }}"></script>
    {{-- <link href="{{ asset('dist/js/tabler-theme.min.js?1744816593') }}" /> --}}
    <!-- Loading Overlay -->
    {{-- 
    <div id="loading-overlay" class="loading-overlay d-none">
        <div class="text-center">
            <x-loading />
        </div>
    </div> --}}

    <div id="app">
        <x-navbar.tema-builder />
        <!-- Navigation -->
        @if (
            !in_array(Route::currentRouteName(), [
                'login',
                'register',
                'password.request',
                'password.reset',
                'password.confirm',
                'verification.notice',
                'verification.verify',
                'debug.api',
            ]))
            <x-navbar />
        @endif
        <!-- Main Content -->
        <main class="py-4">
            <!-- Flash Messages -->
            @if (session('success'))
                <div class="container-fluid">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="container-fluid">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            @if (session('warning'))
                <div class="container-fluid">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        {{ session('warning') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            @if (session('info'))
                <div class="container-fluid">
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <i class="fas fa-info-circle me-2"></i>
                        {{ session('info') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            <!-- Page Content -->
            {{ $slot }}
        </main>

        <!-- Footer -->
        @if (
            !in_array(Route::currentRouteName(), [
                'login',
                'register',
                'password.request',
                'password.reset',
                'password.confirm',
                'verification.notice',
                'verification.verify',
                'debug-api',
            ]))
            <x-footer />
        @endif
    </div>

    <!-- Profile Modal -->
    <x-modal.profile />

    <!-- Settings Modal -->
    <x-modal.settings />

    <!-- Modal Alert Component -->
    <x-modal-alert />

    <!-- JavaScript Libraries -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- Bootstrap JS (included in Tabler) -->
    <script src="{{ asset('dist/js/tabler.min.js') }}"></script>

    <!-- Modal Alert Script - Load immediately without defer -->
    <script src="{{ asset('js/modal-alert.js') }}"></script>

    <!-- Debug Modal Alert Loading -->
    <script>
        console.log('Debug: Checking modal alert loading...');

        // Check immediately
        if (typeof window.modalAlert !== 'undefined') {
            console.log('Modal alert tersedia langsung:', window.modalAlert);
        } else {
            console.log('Modal alert belum tersedia, menunggu...');
        }

        // Check after DOM loaded
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, checking modal alert again...');

            setTimeout(() => {
                if (typeof window.modalAlert !== 'undefined' && window.modalAlert) {
                    console.log('✅ Modal alert berhasil dimuat:', window.modalAlert);
                    console.log('✅ Modal alert show function:', typeof window.modalAlert.show);
                } else {
                    console.error('❌ Modal alert gagal dimuat!');

                    // Check if modal element exists
                    const modalElement = document.getElementById('alertModal');
                    if (modalElement) {
                        console.log('✅ Modal element ditemukan:', modalElement);
                    } else {
                        console.error('❌ Modal element tidak ditemukan!');
                    }
                }
            }, 500);
        });
    </script>

    <script src="{{ asset('libs/apexcharts/dist/apexcharts.min.js?1744816593') }}" defer></script>
    <script src="{{ asset('libs/jsvectormap/dist/jsvectormap.min.js?1667333929') }}" defer></script>
    <script src="{{ asset('libs/jsvectormap/dist/maps/world.js?1667333929') }}" defer></script>
    <script src="{{ asset('libs/jsvectormap/dist/maps/world-merc.js?1667333929') }}" defer></script>

    <script src="{{ asset('libs/nouislider/dist/nouislider.min.js?1667333929') }}" defer></script>
    <script src="{{ asset('libs/litepicker/dist/litepicker.js?1667333929') }}" defer></script>
    <script src="{{ asset('libs/tom-select/dist/js/tom-select.base.min.js?1667333929') }}" defer></script>
    <script src="{{ asset('dist/js/tabler.min.js?1667333929') }}" defer></script>
    <script src="{{ asset('preview/js/demo.min.js?1667333929') }}" defer></script>


    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Sweet Alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Dropzone -->
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <!-- Moment.js for date handling -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/locale/id.min.js"></script>

    <!-- Custom JavaScript -->

    <!-- Page Specific Scripts -->
    @stack('scripts')
</body>

</html>
