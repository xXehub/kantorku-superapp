<x-app>
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <!-- Filter and Search Section -->
                <div class="d-flex justify-content-between flex-wrap align-items-center mb-1 gap-2">
                    <!-- Filter buttons -->
                    <div class="form-selectgroup d-flex flex-wrap">
                        <label class="form-selectgroup-item">
                            <input type="radio" name="icons" value="tampilkan semua" class="form-selectgroup-input"
                                checked />
                            <span class="form-selectgroup-label">Tampilkan Semua</span>
                        </label>
                        <label class="form-selectgroup-item">
                            <input type="radio" name="icons" value="kesehatan" class="form-selectgroup-input" />
                            <span class="form-selectgroup-label">Kesehatan</span>
                        </label>
                        <label class="form-selectgroup-item">
                            <input type="radio" name="icons" value="pendidikan" class="form-selectgroup-input" />
                            <span class="form-selectgroup-label">Pendidikan</span>
                        </label>
                        <label class="form-selectgroup-item">
                            <input type="radio" name="icons" value="pariwisata" class="form-selectgroup-input" />
                            <span class="form-selectgroup-label">Pariwisata</span>
                        </label>
                    </div>

                    <!-- Search bar -->
                    <div class="input-icon mb-2">
                        <input type="text" value="" class="form-control" placeholder="Search…" />
                        <span class="input-icon-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-1">
                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                <path d="M21 21l-6 -6" />
                            </svg>
                        </span>
                    </div>
                </div>

                <!-- List Instansi Section -->
                @foreach ($apps as $app)
                    <div class="col-md-6 col-lg-3">
                        <div class="card">
                            <div class="card-body p-4 text-center">
                                @if ($app->logo_app)
                                    <span class="avatar avatar-xl mb-3"
                                        style="background-image: url({{ $app->logo_app }})"></span>
                                @else
                                    <span
                                        class="avatar avatar-xl mb-3">{{ strtoupper(substr($app->nama_app, 0, 1)) }}</span>
                                @endif
                                <h3 class="m-0 mb-1"><a href="#">{{ $app->nama_app }}</a></h3>
                                <div class="text-secondary">{{ $app->deskripsi_app }}</div>
                            </div>
                            <div class="d-flex">
                                <a href="{{ $app->url_app ?? '#' }}"
                                    class="card-btn">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Pagination Section -->
                <div class="d-flex justify-content-between flex-wrap align-items-center mb-1 gap-2">
                    <p class="m-0 text-secondary">Showing <span>{{ $apps->firstItem() }}</span> to
                        <span>{{ $apps->lastItem() }}</span> of <span>{{ $apps->total() }}</span>
                        entries
                    </p>
                    <ul class="pagination m-0 ms-auto">
                        @if ($apps->onFirstPage())
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                        <path d="M15 6l-6 6l6 6" />
                                    </svg>
                                    sebelumnya
                                </a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $apps->previousPageUrl() }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                        <path d="M15 6l-6 6l6 6" />
                                    </svg>
                                    sebelumnya
                                </a>
                            </li>
                        @endif

                        @foreach ($apps->getUrlRange(1, $apps->lastPage()) as $page => $url)
                            @if ($page == $apps->currentPage())
                                <li class="page-item active"><a class="page-link"
                                        href="#">{{ $page }}</a>
                                </li>
                            @else
                                <li class="page-item"><a class="page-link"
                                        href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        @if ($apps->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $apps->nextPageUrl() }}">
                                    selanjutnya
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                        <path d="M9 6l6 6l-6 6" />
                                    </svg>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                    selanjutnya
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                        <path d="M9 6l6 6l-6 6" />
                                    </svg>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>

            </div>
        </div>
    </div>
</x-app>
