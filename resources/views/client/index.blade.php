   <x-app>
       <div class="page-body">
           <div class="container-xl">
               <div class="row row-deck row-cards">
                   <!-- ENJUY -->
                   <div class="card p-12 mb-4 rounded shadow-sm border">
                       <h2 class="mb-2 fw-bold">Layanan SuperApp</h2>
                       <p class="mb-4 text-secondary" style="max-width: 700px;">
                           SuperApp adalah platform layanan digital terpadu yang dirancang untuk memudahkan masyarakat
                           dalam mengakses berbagai layanan publik dari berbagai instansi pemerintahan di Kota Surabaya.
                           Melalui satu pintu aplikasi ini, pengguna dapat menjelajahi, mengajukan, dan memantau layanan
                           dari dinas-dinas seperti Pendidikan, Kominfo, Kesehatan, hingga Perizinan.
                       </p>
                       <a href="#" class="btn btn-primary position-absolute"
                           style="bottom: 1rem; right: 1rem; padding: 0.20rem 1.5rem; font-size: 0.75rem;">
                           <i class="ti ti-book me-1"></i> Panduan Pengguna
                       </a>
                   </div>
                   <div class="d-flex justify-content-between flex-wrap align-items-center mb-1 gap-2">
                       <!-- Filter buttons -->
                       <div class="form-selectgroup d-flex flex-wrap">
                           <label class="form-selectgroup-item">
                               <input type="radio" name="icons" value="tampilkan semua"
                                   class="form-selectgroup-input" checked />
                               <span class="form-selectgroup-label">
                                   Tampilkan Semua
                               </span>
                           </label>
                           <label class="form-selectgroup-item">
                               <input type="radio" name="icons" value="kesehatan" class="form-selectgroup-input" />
                               <span class="form-selectgroup-label">
                                   Kesehatan
                               </span>
                           </label>
                           <label class="form-selectgroup-item">
                               <input type="radio" name="icons" value="pendidikan" class="form-selectgroup-input" />
                               <span class="form-selectgroup-label">
                                   Pendidikan
                               </span>
                           </label>
                           <label class="form-selectgroup-item">
                               <input type="radio" name="icons" value="pariwisata" class="form-selectgroup-input" />
                               <span class="form-selectgroup-label">
                                   Pariwisata
                               </span>
                           </label>
                       </div>

                       <!-- Search bar -->
                       <div class="input-icon mb-2">
                           <input type="text" value="" class="form-control" placeholder="Search…" />
                           <span class="input-icon-addon">
                               <!-- Download SVG icon from http://tabler.io/icons/icon/search -->
                               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                   fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                   stroke-linejoin="round" class="icon icon-1">
                                   <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                   <path d="M21 21l-6 -6" />
                               </svg>
                           </span>
                       </div>
                   </div>
                   <!-- BUAT LIST DINAS -->
                   @foreach ($instansi as $item)
                       <div class="col-md-6 col-lg-3">
                           <div class="card">
                               <div class="card-body p-4 text-center">
                                   @if ($item->logo_url)
                                       <span class="avatar avatar-xl mb-3"
                                           style="background-image: url({{ $item->logo_url }})">
                                       </span>
                                   @else
                                       <span class="avatar avatar-xl mb-3">
                                           {{ strtoupper(substr($item->nama_instansi, 0, 1)) }}
                                       </span>
                                   @endif
                                   <h3 class="m-0 mb-1"><a href="#">{{ $item->nama_instansi }}</a></h3>
                                   <div class="text-secondary">
                                       {{ $item->deskripsi }}
                                   </div>
                               </div>
                               <div class="d-flex">
                                   <a href="{{ route('client.instansi.show', $item->id) }}"
                                       class="card-btn">Selengkapnya</a>
                               </div>
                           </div>
                       </div>
                   @endforeach
                   <!-- end buat list dinas -->
                   <div class="d-flex justify-content-between flex-wrap align-items-center mb-1 gap-2">

                       <p class="m-0 text-secondary">Showing <span>{{ $instansi->firstItem() }}</span> to
                           <span>{{ $instansi->lastItem() }}</span> of <span>{{ $instansi->total() }}</span>
                           entries
                       </p>
                       <ul class="pagination m-0 ms-auto">
                           @if ($instansi->onFirstPage())
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
                                   <a class="page-link" href="{{ $instansi->previousPageUrl() }}">
                                       <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                           viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                           stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                           <path d="M15 6l-6 6l6 6" />
                                       </svg>
                                       sebelumnya
                                   </a>
                               </li>
                           @endif

                           @foreach ($instansi->getUrlRange(1, $instansi->lastPage()) as $page => $url)
                               @if ($page == $instansi->currentPage())
                                   <li class="page-item active"><a class="page-link"
                                           href="#">{{ $page }}</a>
                                   </li>
                               @else
                                   <li class="page-item"><a class="page-link"
                                           href="{{ $url }}">{{ $page }}</a></li>
                               @endif
                           @endforeach

                           @if ($instansi->hasMorePages())
                               <li class="page-item">
                                   <a class="page-link" href="{{ $instansi->nextPageUrl() }}">
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
