{{-- ---------------------------- UNTUK SUPERADMIN --------------------------- --}}
@if (auth()->user()->isSuperAdmin())
    {{-- Super Admin melihat semua menu --}}
    <x-navbar.nav-item route="panel.users.index" pattern="panel.users*" title="Users" icon="users" />
    <x-navbar.nav-item route="panel.apps.index" pattern="panel.apps*" title="Aplikasi" icon="apps" />
    <x-navbar.nav-item route="panel.instansi.index" pattern="panel.instansi*" title="Instansi" icon="building" />

    {{-- Dropdown Role & Permission --}}
    <li
        class="nav-item dropdown {{ request()->routeIs('panel.roles*') || request()->routeIs('panel.permissions*') ? 'active' : '' }}">
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside"
            role="button">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
                <x-icon name="shield" />
            </span>
            <span class="nav-link-title">Akses & Role</span>
        </a>
        <div class="dropdown-menu">
            <a class="dropdown-item {{ request()->routeIs('panel.roles*') ? 'active' : '' }}"
                href="{{ route('panel.roles.index') }}">
                    <x-icon name="ceklis" />
    
                Manajemen Role
            </a>
            <a class="dropdown-item {{ request()->routeIs('panel.permissions*') ? 'active' : '' }}"
                href="{{ route('panel.permissions.index') }}">
                    <x-icon name="buku" />
                Manajemen Permission
            </a>
        </div>
    </li>

    <x-navbar.nav-item route="panel.kategori.index" pattern="panel.kategori*" title="Kategori" icon="category" />

    {{-- ---------------------------- UNTUK USER BIASA YANG PUNYA PERMISSION --------------------------- --}}
@else
    {{-- User biasa hanya lihat yang ada permission-nya --}}
    @if (auth()->user()->hasPermission('users.view'))
        <x-navbar.nav-item route="panel.users.index" pattern="panel.users*" title="Users" icon="users" />
    @endif

    @if (auth()->user()->hasPermission('apps.view') ||
            auth()->user()->canManageApp(auth()->user()->app_id))
        {{-- kondisi gawe perbedaan nama title --}}
        @php
            $appTitle = auth()->user()->isAdmin() && auth()->user()->app_id ? 'Aplikasi Saya' : 'Aplikasi';
        @endphp
        <x-navbar.nav-item route="panel.apps.index" pattern="panel.apps*" :title="$appTitle" icon="apps" />
    @endif

    @if (auth()->user()->hasPermission('instansi.view'))
        <x-navbar.nav-item route="panel.instansi.index" pattern="panel.instansi*" title="Instansi" icon="building" />
    @endif

    @if (auth()->user()->hasPermission('roles.view') || auth()->user()->hasPermission('permissions.view'))
        <li
            class="nav-item dropdown {{ request()->routeIs('panel.roles*') || request()->routeIs('panel.permissions*') ? 'active' : '' }}">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                role="button">
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <x-icon name="shield" />
                </span>
                <span class="nav-link-title">Akses & Role</span>
            </a>
            <div class="dropdown-menu">
                @if (auth()->user()->hasPermission('roles.view'))
                    <a class="dropdown-item {{ request()->routeIs('panel.roles*') ? 'active' : '' }}"
                        href="{{ route('panel.roles.index') }}">
                                 <x-icon name="ceklis" />
                        Manajemen Role
                    </a>
                @endif
                @if (auth()->user()->hasPermission('permissions.view'))
                    <a class="dropdown-item {{ request()->routeIs('panel.permissions*') ? 'active' : '' }}"
                        href="{{ route('panel.permissions.index') }}">
                                 <x-icon name="buku" />
                        Manajemen Permission
                    </a>
                @endif
            </div>
        </li>
    @endif
@endif
