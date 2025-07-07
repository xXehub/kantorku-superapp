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
    <div id="loading-overlay" class="loading-overlay d-none">
        <div class="text-center">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2 text-muted">Memuat...</p>
        </div>
    </div>

    <div id="app">
        <!-- Navigation -->

        <x-navbar />
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
        <x-footer />
    </div>

    <!-- Profile Modal -->
    <x-modal.profile />

    <!-- Settings Modal -->
    <x-modal.settings />

    <!-- JavaScript Libraries -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- Bootstrap JS (included in Tabler) -->
    <script src="{{ asset('dist/js/tabler.min.js') }}"></script>
    <script src="{{ asset('libs/apexcharts/dist/apexcharts.min.js?1744816593') }}" defer></script>
    <script src="{{ asset('libs/jsvectormap/dist/js/jsvectormap.min.js?1667333929') }}" defer></script>
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
    <script>
        // Global JavaScript functions and initialization

        // Set CSRF token for all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Loading overlay functions
        function showLoading() {
            $('#loading-overlay').removeClass('d-none');
        }

        function hideLoading() {
            $('#loading-overlay').addClass('d-none');
        }

        // Profile modal
        function showProfileModal() {
            var profileModal = new bootstrap.Modal(document.getElementById('profileModal'));
            profileModal.show();
        }

        // Settings modal
        function showSettingsModal() {
            var settingsModal = new bootstrap.Modal(document.getElementById('settingsModal'));
            settingsModal.show();
        }

        function saveSettings() {
            const theme = document.getElementById('themeSelector').value;
            const notifications = document.getElementById('notificationsToggle').checked;

            // Save to localStorage
            localStorage.setItem('theme', theme);
            localStorage.setItem('notifications', notifications);

            // Apply theme
            applyTheme(theme);

            // Show success message
            Swal.fire({
                icon: 'success',
                title: 'Pengaturan Disimpan',
                text: 'Pengaturan berhasil disimpan.',
                timer: 2000,
                showConfirmButton: false
            });

            // Close modal
            bootstrap.Modal.getInstance(document.getElementById('settingsModal')).hide();
        }

        function applyTheme(theme) {
            if (theme === 'dark') {
                document.documentElement.setAttribute('data-bs-theme', 'dark');
            } else if (theme === 'light') {
                document.documentElement.setAttribute('data-bs-theme', 'light');
            } else {
                // Auto theme based on system preference
                if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                    document.documentElement.setAttribute('data-bs-theme', 'dark');
                } else {
                    document.documentElement.setAttribute('data-bs-theme', 'light');
                }
            }
        }

        // Initialize DataTables with default configuration
        function initDataTable(selector, options = {}) {
            const defaultOptions = {
                responsive: true,
                pageLength: 25,
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "Semua"]
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'
                },
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            };

            return $(selector).DataTable($.extend({}, defaultOptions, options));
        }

        // Initialize Select2 with default configuration
        function initSelect2(selector, options = {}) {
            const defaultOptions = {
                theme: 'bootstrap4',
                language: 'id'
            };

            return $(selector).select2($.extend({}, defaultOptions, options));
        }

        // Notification system
        function showNotification(type, title, message, duration = 5000) {
            Swal.fire({
                icon: type,
                title: title,
                text: message,
                timer: duration,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        }

        // Confirm dialog
        function confirmAction(title, text, confirmButtonText = 'Ya', cancelButtonText = 'Batal') {
            return Swal.fire({
                title: title,
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: confirmButtonText,
                cancelButtonText: cancelButtonText
            });
        }

        // Format currency
        function formatCurrency(amount) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(amount);
        }

        // Format date
        function formatDate(date, format = 'DD MMMM YYYY') {
            return moment(date).locale('id').format(format);
        }

        // Initialize on document ready
        $(document).ready(function() {
            // Set moment locale to Indonesian
            moment.locale('id');

            // Load saved settings
            const savedTheme = localStorage.getItem('theme') || 'auto';
            const savedNotifications = localStorage.getItem('notifications') !== 'false';

            document.getElementById('themeSelector').value = savedTheme;
            document.getElementById('notificationsToggle').checked = savedNotifications;

            applyTheme(savedTheme);

            // Auto-hide alerts after 5 seconds
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);

            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Initialize popovers
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
            var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl);
            });

            // Handle form submissions with loading
            $('form').on('submit', function() {
                if (!$(this).hasClass('no-loading')) {
                    showLoading();
                }
            });

            // Handle AJAX errors globally
            $(document).ajaxError(function(event, xhr, settings, error) {
                hideLoading();
                if (xhr.status === 401) {
                    window.location.href = '/login';
                } else if (xhr.status === 403) {
                    showNotification('error', 'Akses Ditolak',
                        'Anda tidak memiliki izin untuk melakukan aksi ini.');
                } else if (xhr.status >= 500) {
                    showNotification('error', 'Server Error',
                        'Terjadi kesalahan pada server. Silakan coba lagi.');
                }
            });
        });

        // Service Worker for PWA (optional)
        // if ('serviceWorker' in navigator) {
        //     window.addEventListener('load', function() {
        //         navigator.serviceWorker.register('/sw.js').then(function(registration) {
        //             console.log('ServiceWorker registration successful');
        //         }, function(err) {
        //             console.log('ServiceWorker registration failed');
        //         });
        //     });
        // }
    </script>

    <!-- Page Specific Scripts -->
    @stack('scripts')
</body>

</html>
