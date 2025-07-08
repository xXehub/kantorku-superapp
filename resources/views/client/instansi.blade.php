<x-app>
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <!-- Filter and Search Section -->
                <div class="d-flex justify-content-between flex-wrap align-items-center mb-3 gap-2">
                    <!-- Filter buttons -->
                    <div class="form-selectgroup d-flex flex-wrap">
                        <label class="form-selectgroup-item">
                            <input type="radio" name="kategori-filter" value="tampilkan-semua" 
                                   class="form-selectgroup-input kategori-filter" 
                                   {{ request('kategori', 'tampilkan-semua') === 'tampilkan-semua' ? 'checked' : '' }} />
                            <span class="form-selectgroup-label">Tampilkan Semua</span>
                        </label>
                        @foreach($categories as $kategori)
                            <label class="form-selectgroup-item">
                                <input type="radio" name="kategori-filter" value="{{ $kategori->slug }}" 
                                       class="form-selectgroup-input kategori-filter"
                                       {{ request('kategori') === $kategori->slug ? 'checked' : '' }} />
                                <span class="form-selectgroup-label">
                                    @if(!empty($kategori->icon))
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" 
                                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
                                             stroke-linejoin="round" class="icon icon-tabler icon-tabler-{{ $kategori->icon }} me-1">
                                        </svg>
                                    @endif
                                    {{ $kategori->nama_kategori }}
                                </span>
                            </label>
                        @endforeach
                    </div>

                    <!-- Search bar -->
                    <div class="input-icon mb-2">
                        <input type="text" id="search-input" value="{{ request('search') }}" 
                               class="form-control" placeholder="Cari aplikasi..." />
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

                <!-- List Apps Section -->
                @forelse ($apps as $app)
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
                                <div class="text-secondary mb-2">{{ $app->deskripsi_app }}</div>
                                @if($app->kategori)
                                    <span class="badge" style="background-color: {{ $app->kategori->color }}; color: white;">
                                        {{ $app->kategori->nama_kategori }}
                                    </span>
                                @endif
                            </div>
                            <div class="d-flex">
                                @auth
                                    @if (auth()->user()->canManageApp($app->id))
                                        <a href="#" class="card-btn" style="border-right: 1px solid #e6ebf1;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon me-1">
                                                <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/>
                                                <circle cx="12" cy="12" r="3"/>
                                            </svg>
                                            Setting
                                        </a>
                                    @endif
                                @endauth
                                <a href="{{ $app->url_app ?? '#' }}" 
                                   class="card-btn" 
                                   {{ $app->url_app ? 'target="_blank"' : '' }}>
                                   {{ $app->url_app ? 'Buka Aplikasi' : 'Selengkapnya' }}
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body text-center py-5">
                                <div class="empty">
                                    <div class="empty-img">
                                        <img src="{{ asset('static/illustrations/undraw_void_3ggu.svg') }}" height="128" alt="">
                                    </div>
                                    <p class="empty-title">Tidak ada aplikasi ditemukan</p>
                                    <p class="empty-subtitle text-secondary">
                                        @if(request('kategori') && request('kategori') !== 'tampilkan-semua')
                                            Tidak ada aplikasi dalam kategori ini.
                                        @elseif(request('search'))
                                            Tidak ada aplikasi yang sesuai dengan pencarian "{{ request('search') }}".
                                        @else
                                            Belum ada aplikasi yang tersedia untuk instansi ini.
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse

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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle category filter
            const categoryFilters = document.querySelectorAll('.kategori-filter');
            const searchInput = document.getElementById('search-input');
            
            categoryFilters.forEach(filter => {
                filter.addEventListener('change', function() {
                    if (this.checked) {
                        applyFilters();
                    }
                });
            });

            // Handle search with debounce
            let searchTimeout;
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    applyFilters();
                }, 500);
            });

            function applyFilters() {
                const selectedCategory = document.querySelector('.kategori-filter:checked').value;
                const searchValue = searchInput.value.trim();
                
                // Build URL with filters
                const url = new URL(window.location.href);
                url.searchParams.delete('page'); // Reset pagination when filtering
                
                if (selectedCategory !== 'tampilkan-semua') {
                    url.searchParams.set('kategori', selectedCategory);
                } else {
                    url.searchParams.delete('kategori');
                }
                
                if (searchValue) {
                    url.searchParams.set('search', searchValue);
                } else {
                    url.searchParams.delete('search');
                }
                
                // Redirect with new filters
                window.location.href = url.toString();
            }
        });
    </script>
</x-app>
