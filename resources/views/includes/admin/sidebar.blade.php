<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header align-items-center">
            <a class="navbar-brand" href="{{ route('pages.admin.dashboard') }}">
                <h2 class="text-primary text-uppercase">Pengaduan JSN</h2>
            </a>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="navbar-collapse collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->segment(2) == 'dashboard' ? 'active' : '' }}"
                            href="{{ route('pages.admin.dashboard') }}">
                            <i class="fas fa-tv text-primary"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item nav-with-child">
                        <a class="nav-link {{ request()->segment(2) == 'pengaduan' ? 'active' : '' }}" href="#">
                            <i class="fas fa-bullhorn text-orange"></i> Pengaduan
                            <i class="fas fa-chevron-down text-right"></i>
                        </a>
                        <ul class="nav-item-child">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->segment(2) == 'pengaduan/0' ? 'active' : '' }}"
                                    href="{{ route('admin.pengaduan.index', '0') }}">
                                    <i class="fas fa-clipboard-check text-info"></i> Verifikasi & Validasi
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.pengaduan.index', 'proses') }}">
                                    <i class="fas fa-sync text-yellow"></i> Sedang Diproses
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.pengaduan.index', 'selesai') }}">
                                    <i class="fas fa-check text-success"></i> Selesai
                                </a>
                            </li>
                        </ul>
                    </li>
                        @if (Auth::user()->role == 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.laporan.index') }}">
                                    <i class="fas fa-file-alt text-green"></i>
                                    <span class="nav-link-text">Laporan</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.pelanggan.index') }}">
                                    <i class="fas fa-users text-default"></i>
                                    <span class="nav-link-text">Pelanggan</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('petugas') }}">
                                    <i class="fas fa-users-cog text-info"></i>
                                    <span class="nav-link-text">Petugas</span>
                                </a>
                            </li>
                    @endif

                </ul>
            </div>
        </div>
    </div>
</nav>
