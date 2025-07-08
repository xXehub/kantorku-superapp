<x-app>
    <div class="page-body">
        <div class="container-xl">
            <!-- Header -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="{{ route('client') }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon">
                                                        <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                                    </svg>
                                                    Beranda
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">
                                                {{ $instansi->nama_instansi }}</li>
                                        </ol>
                                    </nav>
                                    <h2 class="mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="icon me-2">
                                            <path d="M3 21l18 0" />
                                            <path d="M5 21v-16l4 0v16" />
                                            <path d="M9 21v-12l6 0v12" />
                                            <path d="M15 21v-8l4 0v8" />
                                        </svg>
                                        {{ $instansi->nama_instansi }}
                                    </h2>
                                    <p class="mb-0 text-muted">
                                        {{ $instansi->deskripsi_instansi ?: 'Aplikasi dan layanan digital terintegrasi'
                                        }}
                                    </p>
                                </div>
                                <div class="col-md-4 text-end">
                                    @if ($hasManagementAccess)
                                    <a href="{{ route('panel.instansi.edit', $instansi->id) }}" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="icon">
                                            <path
                                                d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                            <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                        </svg>
                                        Kelola Instansi
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="subheader">Total Aplikasi</div>
                            <div class="h1 mb-0">{{ $instansi->apps->count() }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="subheader">Aplikasi Aktif</div>
                            <div class="h1 mb-0 text-success">{{ $instansi->apps->where('is_active', true)->count() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="subheader">Dapat Diakses</div>
                            <div class="h1 mb-0 text-info">{{ $instansi->apps->whereNotNull('url_app')->count() }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="subheader">Coming Soon</div>
                            <div class="h1 mb-0 text-warning">{{ $instansi->apps->whereNull('url_app')->count() }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Apps Grid -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="icon me-2">
                                    <path
                                        d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                    <path
                                        d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                    <path
                                        d="M14 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                    <path d="M14 7l6 0" />
                                    <path d="M17 4l0 6" />
                                </svg>
                                Semua Aplikasi
                            </h3>
                            @if ($hasManagementAccess)
                            <a href="{{ route('panel.apps.create') }}?instansi_id={{ $instansi->id }}"
                                class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="icon">
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                                Tambah Aplikasi
                            </a>
                            @endif
                        </div>
                        <div class="card-body">
                            @if ($instansi->apps->count() > 0)
                            <div class="row">
                                @foreach ($instansi->apps as $app)
                                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                                    <div class="card h-100">
                                        <div class="card-body d-flex flex-column">
                                            <div class="text-center mb-3">
                                                <span
                                                    class="avatar avatar-lg {{ $app->is_active ? 'bg-primary' : 'bg-secondary' }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon">
                                                        <path d="M21 16v-4a10 10 0 0 0 -20 0v4" />
                                                        <path d="M12 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                        <path d="M3 16l5 0" />
                                                        <path d="M16 16l5 0" />
                                                        <path d="M8 13l0 3" />
                                                        <path d="M16 13l0 3" />
                                                    </svg>
                                                </span>
                                            </div>

                                            <h4 class="text-center mb-2">{{ $app->nama_app }}</h4>
                                            <p class="text-muted text-center mb-3 flex-grow-1">
                                                {{ $app->deskripsi_app ?: 'Deskripsi belum tersedia' }}
                                            </p>

                                            <div class="mt-auto">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <small class="text-muted">
                                                        {{ $app->kode_app }}
                                                    </small>
                                                    <span
                                                        class="badge bg-{{ $app->is_active ? 'success' : 'secondary' }}">
                                                        {{ $app->is_active ? 'Aktif' : 'Nonaktif' }}
                                                    </span>
                                                </div>

                                                <div class="btn-list w-100">
                                                    @if ($app->url_app && $app->is_active)
                                                    <a href="{{ $app->url_app }}" target="_blank"
                                                        class="btn btn-primary w-100">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="icon">
                                                            <path
                                                                d="M11 7h-5a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-5" />
                                                            <path d="M10 14l10 -10" />
                                                            <path d="M15 4l5 0l0 5" />
                                                        </svg>
                                                        Buka Aplikasi
                                                    </a>
                                                    @else
                                                    <button class="btn btn-outline-secondary w-100" disabled>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="icon">
                                                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                            <path d="M12 7l0 5" />
                                                            <path d="M12 16l.01 0" />
                                                        </svg>
                                                        Coming Soon
                                                    </button>
                                                    @endif

                                                    @if ($hasManagementAccess || auth()->user()->app_id == $app->id)
                                                    <a href="{{ route('panel.apps.edit', $app->id) }}"
                                                        class="btn btn-outline-warning w-100 mt-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="icon">
                                                            <path
                                                                d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                                            <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                                        </svg>
                                                        Setting
                                                    </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div class="empty">
                                <div class="empty-img">
                                    <img src="./static/illustrations/undraw_printing_invoices_5r4r.svg" height="128"
                                        alt="">
                                </div>
                                <p class="empty-title">Belum Ada Aplikasi</p>
                                <p class="empty-subtitle text-muted">
                                    Instansi ini belum memiliki aplikasi yang terdaftar.
                                </p>
                                @if ($hasManagementAccess)
                                <div class="empty-action">
                                    <a href="{{ route('panel.apps.create') }}?instansi_id={{ $instansi->id }}"
                                        class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="icon">
                                            <path d="M12 5l0 14" />
                                            <path d="M5 12l14 0" />
                                        </svg>
                                        Tambah Aplikasi Pertama
                                    </a>
                                </div>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Instansi Info -->
            @if ($instansi->alamat || $instansi->telepon || $instansi->email)
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="icon me-2">
                                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                    <path d="M12 9h.01" />
                                    <path d="M11 12h1v4h1" />
                                </svg>
                                Informasi Instansi
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @if ($instansi->alamat)
                                <div class="col-md-4 mb-3">
                                    <strong>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="icon text-red me-1">
                                            <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                            <path
                                                d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" />
                                        </svg>
                                        Alamat:
                                    </strong>
                                    <p class="mb-0 text-muted">{{ $instansi->alamat }}</p>
                                </div>
                                @endif
                                @if ($instansi->telepon)
                                <div class="col-md-4 mb-3">
                                    <strong>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="icon text-green me-1">
                                            <path
                                                d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                                        </svg>
                                        Telepon:
                                    </strong>
                                    <p class="mb-0 text-muted">{{ $instansi->telepon }}</p>
                                </div>
                                @endif
                                @if ($instansi->email)
                                <div class="col-md-4 mb-3">
                                    <strong>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="icon text-blue me-1">
                                            <path
                                                d="M3 5m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                                            <path d="M3 7l9 6l9 -6" />
                                        </svg>
                                        Email:
                                    </strong>
                                    <p class="mb-0 text-muted">{{ $instansi->email }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app>