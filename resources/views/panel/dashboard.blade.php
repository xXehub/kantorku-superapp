<x-app>
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">
                            Summary
                        </div>
                        <h2 class="page-title">
                            Dashboard Superadmin
                        </h2>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-12 col-md-auto ms-auto d-print-none">
                        <div class="page-pretitle">
                            Summary
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">

                    {{-- card 1 --}}
                    <div class="col-sm-6 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="text-muted text-uppercase small fw-bold">TOTAL USER
                                    </div>
                                    <div class="dropdown">
                                        <a class="text-muted" href="#" data-bs-toggle="dropdown">Last 7
                                            days</a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item active" href="#">Last 7 days</a>
                                            <a class="dropdown-item" href="#">Last 30 days</a>
                                            <a class="dropdown-item" href="#">Last 3 months</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="bg-primary text-white avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                        </svg>
                                    </span>
                                    <div class="h1 m-0 ms-3 d-flex align-items-center">
                                        {{ $stats['total_users'] ?? ($stats['instansi_users'] ?? 0) }}
                                        <div class="ms-2 text-success d-flex align-items-center"
                                            style="font-size: 15px;">
                                            7%
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="16"
                                                height="16" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <polyline points="3 17 9 11 13 15 21 7" />
                                                <polyline points="14 7 21 7 21 14" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 d-flex align-items-center border-top pt-3">
                                    <a href="#" class="text-muted text-decoration-none small">Lebih
                                        lengkap</a>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="ms-auto">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <polyline points="9 6 15 12 9 18" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- card 2 --}}
                    <div class="col-sm-6 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="text-muted text-uppercase small fw-bold">TOTAL APLIKASI
                                    </div>
                                    <div class="dropdown">
                                        <a class="text-muted" href="#" data-bs-toggle="dropdown">Last 7
                                            days</a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item active" href="#">Last 7 days</a>
                                            <a class="dropdown-item" href="#">Last 30 days</a>
                                            <a class="dropdown-item" href="#">Last 3 months</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="bg-green text-white avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-apps">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                            <path
                                                d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                            <path
                                                d="M14 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                            <path d="M14 7l6 0" />
                                            <path d="M17 4l0 6" />
                                        </svg>
                                    </span>
                                    <div class="h1 m-0 ms-3 d-flex align-items-center">
                                        {{ $stats['total_apps'] ?? ($stats['instansi_apps'] ?? 0) }}
                                        <div class="ms-2 text-success d-flex align-items-center"
                                            style="font-size: 15px;">
                                            7%
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="16"
                                                height="16" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <polyline points="3 17 9 11 13 15 21 7" />
                                                <polyline points="14 7 21 7 21 14" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 d-flex align-items-center border-top pt-3">
                                    <a href="#" class="text-muted text-decoration-none small">Lebih
                                        lengkap</a>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="ms-auto">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <polyline points="9 6 15 12 9 18" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- card 3 --}}
                    <div class="col-sm-6 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="text-muted text-uppercase small fw-bold">TOTAL INSTANSI
                                    </div>
                                    <div class="dropdown">
                                        <a class="text-muted" href="#" data-bs-toggle="dropdown">Last 7
                                            days</a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item active" href="#">Last 7 days</a>
                                            <a class="dropdown-item" href="#">Last 30 days</a>
                                            <a class="dropdown-item" href="#">Last 3 months</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="bg-primary text-white avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-building-skyscraper">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M3 21l18 0" />
                                            <path d="M5 21v-14l8 -4v18" />
                                            <path d="M19 21v-10l-6 -4" />
                                            <path d="M9 9l0 .01" />
                                            <path d="M9 12l0 .01" />
                                            <path d="M9 15l0 .01" />
                                            <path d="M9 18l0 .01" />
                                        </svg>
                                    </span>
                                    <div class="h1 m-0 ms-3 d-flex align-items-center">
                                        {{ $stats['total_instansi'] ?? 1 }}
                                        <div class="ms-2 text-success d-flex align-items-center"
                                            style="font-size: 15px;">
                                            7%
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="16"
                                                height="16" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <polyline points="3 17 9 11 13 15 21 7" />
                                                <polyline points="14 7 21 7 21 14" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 d-flex align-items-center border-top pt-3">
                                    <a href="#" class="text-muted text-decoration-none small">Lebih
                                        lengkap</a>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="ms-auto">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <polyline points="9 6 15 12 9 18" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- card 4 --}}
                    <div class="col-sm-6 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="text-muted text-uppercase small fw-bold">TOTAL ROLES
                                    </div>
                                    <div class="dropdown">
                                        <a class="text-muted" href="#" data-bs-toggle="dropdown">Last 7
                                            days</a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item active" href="#">Last 7 days</a>
                                            <a class="dropdown-item" href="#">Last 30 days</a>
                                            <a class="dropdown-item" href="#">Last 3 months</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="bg-primary text-white avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-circle-dashed-check">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M8.56 3.69a9 9 0 0 0 -2.92 1.95" />
                                            <path d="M3.69 8.56a9 9 0 0 0 -.69 3.44" />
                                            <path d="M3.69 15.44a9 9 0 0 0 1.95 2.92" />
                                            <path d="M8.56 20.31a9 9 0 0 0 3.44 .69" />
                                            <path d="M15.44 20.31a9 9 0 0 0 2.92 -1.95" />
                                            <path d="M20.31 15.44a9 9 0 0 0 .69 -3.44" />
                                            <path d="M20.31 8.56a9 9 0 0 0 -1.95 -2.92" />
                                            <path d="M15.44 3.69a9 9 0 0 0 -3.44 -.69" />
                                            <path d="M9 12l2 2l4 -4" />
                                        </svg>
                                    </span>
                                    <div class="h1 m-0 ms-3 d-flex align-items-center">
                                        {{ $stats['total_roles'] ?? 0 }}
                                        <div class="ms-2 text-success d-flex align-items-center"
                                            style="font-size: 15px;">
                                            7%
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="16"
                                                height="16" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <polyline points="3 17 9 11 13 15 21 7" />
                                                <polyline points="14 7 21 7 21 14" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 d-flex align-items-center border-top pt-3">
                                    <a href="#" class="text-muted text-decoration-none small">Lebih
                                        lengkap</a>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="ms-auto">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <polyline points="9 6 15 12 9 18" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- instansi informasi --}}
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                                <table class="table table-vcenter card-table">
                                    <thead class="sticky-top bg-white">
                                        <tr>
                                            <th>Nama Instansi</th>
                                            <th>User</th>
                                            <th>Aplikasi</th>
                                            <th>Status</th>
                                            <th class="w-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($instansiData as $instansi)
                                            <tr>
                                                <td>{{ $instansi->nama_instansi }}</td>
                                                <td class="text-secondary">{{ $instansi->users_count }}</td>
                                                <td class="text-secondary">
                                                    <a href="#"
                                                        class="text-reset">{{ $instansi->apps_count }}</a>
                                                </td>
                                                <td class="sort-status">
                                                    <span
                                                        class="badge {{ $instansi->is_active ? 'bg-success-lt' : 'bg-danger-lt' }}">
                                                        {{ $instansi->is_active ? 'Aktif' : 'Nonaktif' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if (auth()->user()->isSuperAdmin() || auth()->user()->hasPermission('instansi.edit'))
                                                        <a
                                                            href="{{ route('panel.instansi.edit', $instansi->id) }}">Edit</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted">Tidak ada data
                                                    instansi</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    {{-- codeku saat ini --}}
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Aplikasi Teratas</h3>
                                <div style="max-height: 400px; overflow-y: auto;">

                                    {{--  
                                    <table class="table table-vcenter card-table">
                                    <thead class="sticky-top bg-white">
                                        <tr>
                                            <th>Nama Instansi</th>
                                            <th>User</th>
                                            <th>Aplikasi</th>
                                            <th>Status</th>
                                            <th class="w-1"></th>
                                        </tr>
                                    </thead>--}}
                                    <table class="table table-sm table-borderless">
                                        <thead>
                                            <tr>
                                                <th>Aplikasi</th>
                                                <th class="text-end">Users</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($topApps as $app)
                                                <tr>
                                                    <td>
                                                        <div class="progressbg">
                                                            <div class="progress progress-3 progressbg-progress">
                                                                <div class="progress-bar bg-primary-lt"
                                                                    style="width: {{ $app->percentage ?? 0 }}%"
                                                                    role="progressbar"
                                                                    aria-valuenow="{{ $app->percentage ?? 0 }}"
                                                                    aria-valuemin="0" aria-valuemax="100"
                                                                    aria-label="{{ $app->percentage ?? 0 }}% Complete">
                                                                    <span
                                                                        class="visually-hidden">{{ $app->percentage ?? 0 }}%
                                                                        Complete</span>
                                                                </div>
                                                            </div>
                                                            <div class="progressbg-text">{{ $app->nama_app }}</div>
                                                        </div>
                                                    </td>
                                                    <td class="w-1 fw-bold text-end">{{ $app->users_count }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="2" class="text-center text-muted">Tidak ada data
                                                        aplikasi</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app>
