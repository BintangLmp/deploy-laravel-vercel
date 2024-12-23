<!-- Topnav -->
<nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
    <div class="container-fluid">
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <!-- Navbar links -->
            <ul class="navbar-nav align-items-center ml-md-auto">
                <li class="nav-item d-xl-none">
                    <!-- Sidenav toggler -->
                    <div class="sidenav-toggler sidenav-toggler-dark pr-3" data-action="sidenav-pin"
                        data-target="#sidenav-main">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </div>
                </li>
                <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right overflow-hidden py-0">
                </div>
            </ul>
            <ul class="navbar-nav align-items-center ml-md-0 ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                                @if (auth('admin')->check())
                                    <img alt="image"
                                        src="https://ui-avatars.com/api/?background=fff&color=0D8ABC&bold=true&name={{ auth()->user()->name }}"
                                        class="rounded-circle mr-1">
                                @else
                                    <img alt="image"
                                        src="https://ui-avatars.com/api/?background=fff&color=0D8ABC&bold=true&name={{ auth()->user()->name }}"
                                        class="rounded-circle mr-1">
                                @endif
                            </span>
                            <div class="media-body d-none d-lg-block ml-2">
                                <span class="font-weight-bold mb-0 text-sm">
                                    @if (auth()->check())
                                        {{ auth()->user()->name }}
                                    @else
                                        Nama Tidak Dikenal
                                    @endif
                                </span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome!</h6>
                        </div>
                        <!-- Uncomment if you want to add a profile link -->
                        <!-- <a href="/admin/dashboard" class="dropdown-item">
                          <i class="ni ni-single-02"></i>
                          <span>My profile</span>
                      </a> -->
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item" title="Logout" data-toggle="tooltip">
                                <i class="ni ni-user-run"></i>
                                <span>Log Out</span>
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
