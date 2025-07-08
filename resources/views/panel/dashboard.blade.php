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
                                        249
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
                                        249
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
                                        249
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
                                        249
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
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table">
                                    <thead>
                                        <tr>
                                            <th>Nama Instansi</th>
                                            <th>User</th>
                                            <th>APlikasi</th>
                                            <th>Status</th>
                                            <th class="w-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Dinas Komunikasi dan Informatika</td>
                                            <td class="text-secondary">100</td>
                                            <td class="text-secondary"><a href="#" class="text-reset">5</a>
                                            </td>
                                            <td class="sort-status">
                                                <span class="badge bg-success-lt">Active</span>
                                            </td>
                                            <td>
                                                <a href="#">Edit</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Dinas Kebudayaan dan Pariwisata</td>
                                            <td class="text-secondary">100</td>
                                            <td class="text-secondary"><a href="#" class="text-reset">5</a>
                                            </td>
                                            <td class="sort-status">
                                                <span class="badge bg-success-lt">Active</span>
                                            </td>
                                            <td>
                                                <a href="#">Edit</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Dinas Lingkungan Hidup</td>
                                            <td class="text-secondary">100</td>
                                            <td class="text-secondary"><a href="#" class="text-reset">5</a>
                                            </td>
                                            <td class="sort-status">
                                                <span class="badge bg-danger-lt">Inactive</span>
                                            </td>
                                            <td>
                                                <a href="#">Edit</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Dinas Perhubungan</td>
                                            <td class="text-secondary">100</td>
                                            <td class="text-secondary"><a href="#" class="text-reset">5</a>
                                            </td>
                                            <td class="sort-status">
                                                <span class="badge bg-success-lt">Active</span>
                                            </td>
                                            <td>
                                                <a href="#">Edit</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Dinas Pendidikan</td>
                                            <td class="text-secondary">100</td>
                                            <td class="text-secondary"><a href="#" class="text-reset">5</a>
                                            </td>
                                            <td class="sort-status">
                                                <span class="badge bg-success-lt">Active</span>
                                            </td>
                                            <td>
                                                <a href="#">Edit</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Dinas Sosial</td>
                                            <td class="text-secondary">100</td>
                                            <td class="text-secondary"><a href="#" class="text-reset">5</a>
                                            </td>
                                            <td class="sort-status">
                                                <span class="badge bg-danger-lt">Inactive</span>
                                            </td>
                                            <td>
                                                <a href="#">Edit</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Dinas Perikanan</td>
                                            <td class="text-secondary">100</td>
                                            <td class="text-secondary"><a href="#" class="text-reset">5</a>
                                            </td>
                                            <td class="sort-status">
                                                <span class="badge bg-success-lt">Active</span>
                                            </td>
                                            <td>
                                                <a href="#">Edit</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Polisi Pamong Praja</td>
                                            <td class="text-secondary">100</td>
                                            <td class="text-secondary"><a href="#" class="text-reset">5</a>
                                            </td>
                                            <td class="sort-status">
                                                <span class="badge bg-danger-lt">Inactive</span>
                                            </td>
                                            <td>
                                                <a href="#">Edit</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- aplikasi teratas --}}
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Aplikasi Teratas</h3>
                                <table class="table table-sm table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Aplikasi</th>
                                            <th class="text-end">Users</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="progressbg">
                                                    <div class="progress progress-3 progressbg-progress">
                                                        <div class="progress-bar bg-primary-lt" style="width: 82.54%"
                                                            role="progressbar" aria-valuenow="82.54"
                                                            aria-valuemin="0" aria-valuemax="100"
                                                            aria-label="82.54% Complete">
                                                            <span class="visually-hidden">82.54% Complete</span>
                                                        </div>
                                                    </div>
                                                    <div class="progressbg-text">e-Surat</div>
                                                </div>
                                            </td>
                                            <td class="w-1 fw-bold text-end">4896</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="progressbg">
                                                    <div class="progress progress-3 progressbg-progress">
                                                        <div class="progress-bar bg-primary-lt" style="width: 76.29%"
                                                            role="progressbar" aria-valuenow="76.29"
                                                            aria-valuemin="0" aria-valuemax="100"
                                                            aria-label="76.29% Complete">
                                                            <span class="visually-hidden">76.29% Complete</span>
                                                        </div>
                                                    </div>
                                                    <div class="progressbg-text">WargaKu</div>
                                                </div>
                                            </td>
                                            <td class="w-1 fw-bold text-end">3652</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="progressbg">
                                                    <div class="progress progress-3 progressbg-progress">
                                                        <div class="progress-bar bg-primary-lt" style="width: 72.65%"
                                                            role="progressbar" aria-valuenow="72.65"
                                                            aria-valuemin="0" aria-valuemax="100"
                                                            aria-label="72.65% Complete">
                                                            <span class="visually-hidden">72.65% Complete</span>
                                                        </div>
                                                    </div>
                                                    <div class="progressbg-text">e-Health</div>
                                                </div>
                                            </td>
                                            <td class="w-1 fw-bold text-end">3256</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="progressbg">
                                                    <div class="progress progress-3 progressbg-progress">
                                                        <div class="progress-bar bg-primary-lt" style="width: 44.89%"
                                                            role="progressbar" aria-valuenow="44.89"
                                                            aria-valuemin="0" aria-valuemax="100"
                                                            aria-label="44.89% Complete">
                                                            <span class="visually-hidden">44.89% Complete</span>
                                                        </div>
                                                    </div>
                                                    <div class="progressbg-text">Mal Pelayanan Publik</div>
                                                </div>
                                            </td>
                                            <td class="w-1 fw-bold text-end">986</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="progressbg">
                                                    <div class="progress progress-3 progressbg-progress">
                                                        <div class="progress-bar bg-primary-lt" style="width: 41.12%"
                                                            role="progressbar" aria-valuenow="41.12"
                                                            aria-valuemin="0" aria-valuemax="100"
                                                            aria-label="41.12% Complete">
                                                            <span class="visually-hidden">41.12% Complete</span>
                                                        </div>
                                                    </div>
                                                    <div class="progressbg-text">SIAGUS</div>
                                                </div>
                                            </td>
                                            <td class="w-1 fw-bold text-end">912</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="progressbg">
                                                    <div class="progress progress-3 progressbg-progress">
                                                        <div class="progress-bar bg-primary-lt" style="width: 32.65%"
                                                            role="progressbar" aria-valuenow="32.65"
                                                            aria-valuemin="0" aria-valuemax="100"
                                                            aria-label="32.65% Complete">
                                                            <span class="visually-hidden">32.65% Complete</span>
                                                        </div>
                                                    </div>
                                                    <div class="progressbg-text">Satu Data</div>
                                                </div>
                                            </td>
                                            <td class="w-1 fw-bold text-end">855</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="progressbg">
                                                    <div class="progress progress-3 progressbg-progress">
                                                        <div class="progress-bar bg-primary-lt" style="width: 16.22%"
                                                            role="progressbar" aria-valuenow="16.22"
                                                            aria-valuemin="0" aria-valuemax="100"
                                                            aria-label="16.22% Complete">
                                                            <span class="visually-hidden">16.22% Complete</span>
                                                        </div>
                                                    </div>
                                                    <div class="progressbg-text">e-Parking</div>
                                                </div>
                                            </td>
                                            <td class="w-1 fw-bold text-end">764</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="progressbg">
                                                    <div class="progress progress-3 progressbg-progress">
                                                        <div class="progress-bar bg-primary-lt" style="width: 8.69%"
                                                            role="progressbar" aria-valuenow="8.69" aria-valuemin="0"
                                                            aria-valuemax="100" aria-label="8.69% Complete">
                                                            <span class="visually-hidden">8.69% Complete</span>
                                                        </div>
                                                    </div>
                                                    <div class="progressbg-text">lh.surabaya.go.id</div>
                                                </div>
                                            </td>
                                            <td class="w-1 fw-bold text-end">686</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app>
