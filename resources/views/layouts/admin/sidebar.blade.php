<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto ">
                <a class="navbar-brand" href="{{ route('start') }}">
                    <span class="brand-logo">
                        <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                            <defs>
                                <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%"
                                    y2="89.4879456%">
                                    <stop stop-color="#000000" offset="0%"></stop>
                                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                                </lineargradient>
                                <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%"
                                    y2="100%">
                                    <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                                </lineargradient>
                            </defs>
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                    <g id="Group" transform="translate(400.000000, 178.000000)">
                                        <path class="text-primary" id="Path"
                                            d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z"
                                            style="fill:currentColor"></path>
                                        <path id="Path1"
                                            d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z"
                                            fill="url(#linearGradient-1)" opacity="0.2"></path>
                                        <polygon id="Path-2" fill="#000000" opacity="0.049999997"
                                            points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325">
                                        </polygon>
                                        <polygon id="Path-21" fill="#000000" opacity="0.099999994"
                                            points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338">
                                        </polygon>
                                        <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994"
                                            points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288">
                                        </polygon>
                                    </g>
                                </g>
                            </g>
                        </svg></span>
                    <h2 class="brand-text">Surat</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i
                        class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                        class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc"
                        data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    @if ($user->id_role == 'R-01')
        <div class="main-menu-content mt-3">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="{{ request()->is('teacher/dashboard') ? 'active' : '' }} nav-item">
                    <a class="d-flex align-items-center" href="{{ route('teacher') }}">
                        <i data-feather="home"></i>
                        <span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span>
                    </a>
                </li>
                <li class=" navigation-header">
                    <span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span>
                    <i data-feather="more-horizontal"></i>
                </li>
                @if ($user->role->incoming == 1)
                    <li
                        class="{{ request()->is('teacher/surat-masuk') || request()->is('teacher/surat-masuk/*') ? 'active' : '' }} nav-item">
                        <a class="d-flex align-items-center" href="{{ route('teacher.suratmasuk.index') }}">
                            <i data-feather="file-text"></i>
                            <span class="menu-title text-truncate" data-i18n="Surat">Surat Disposisi</span>
                        </a>
                    </li>
                @else
                @endif
                @if ($user->role->outgoing == 1)
                    <li
                        class="{{ request()->is('teacher/surat-keluar') || request()->is('teacher/surat-keluar/*') ? 'active' : '' }} nav-item">
                        <a class="d-flex align-items-center" href="{{ route('teacher.suratkeluar.index') }}">
                            <i data-feather="file-text"></i>
                            <span class="menu-title text-truncate" data-i18n="Surat">Surat Keluar</span>
                        </a>
                    </li>
                @else
                @endif
            </ul>
        </div>
    @endif
    @if ($user->id_role == 'R-02')
        <div class="main-menu-content mt-3">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="{{ request()->is('headmaster/dashboard') ? 'active' : '' }} nav-item">
                    <a class="d-flex align-items-center" href="{{ route('headmaster') }}">
                        <i data-feather="home"></i>
                        <span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span>
                    </a>
                </li>
                <li class=" navigation-header">
                    <span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span>
                    <i data-feather="more-horizontal"></i>
                </li>
                @if ($user->role->incoming == 1)
                    <li
                        class="{{ request()->is('headmaster/surat-masuk') || request()->is('headmaster/surat-masuk/*') ? 'active' : '' }} nav-item">
                        <a class="d-flex align-items-center" href="{{ route('headmaster.suratmasuk.index') }}">
                            <i data-feather="file-text"></i>
                            <span class="menu-title text-truncate" data-i18n="Surat">Surat Masuk</span>
                        </a>
                    </li>
                @else
                @endif
                @if ($user->role->disposition == 1)
                    <li
                        class="{{ request()->is('headmaster/disposisi') || request()->is('headmaster/disposisi/*') ? 'active' : '' }} nav-item">
                        <a class="d-flex align-items-center" href="{{ route('headmaster.disposisi.index') }}">
                            <i data-feather="file-text"></i>
                            <span class="menu-title text-truncate" data-i18n="Surat">Disposisi</span>
                        </a>
                    </li>
                @else
                @endif
                @if ($user->role->outgoing == 1)
                    <li
                        class="{{ request()->is('headmaster/surat-keluar') || request()->is('headmaster/surat-keluar/*') ? 'active' : '' }} nav-item">
                        <a class="d-flex align-items-center" href="{{ route('headmaster.suratkeluar.index') }}">
                            <i data-feather="file-text"></i>
                            <span class="menu-title text-truncate" data-i18n="Surat">Surat Keluar</span>
                        </a>
                    </li>
                @else
                @endif
                @if ($user->role->outgoing == 1)
                    <li
                        class="{{ request()->is('headmaster/perbaikan-surat') || request()->is('headmaster/perbaikan-surat/*') ? 'active' : '' }} nav-item">
                        <a class="d-flex align-items-center" href="{{ route('headmaster.perbaikansurat.index') }}">
                            <i data-feather="file-text"></i>
                            <span class="menu-title text-truncate" data-i18n="Surat">Perbaikan Surat</span>
                        </a>
                    </li>
                @else
                @endif
            </ul>
        </div>
    @endif
    @if ($user->id_role == 'R-03')
        <div class="main-menu-content mt-3">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }} nav-item">
                    <a class="d-flex align-items-center" href="{{ route('admin') }}">
                        <i data-feather="home"></i>
                        <span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span>
                    </a>
                </li>
                <li class=" navigation-header">
                    <span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span>
                    <i data-feather="more-horizontal"></i>
                </li>
                @if ($user->role->incoming == 1)
                    <li
                        class="{{ request()->is('admin/surat-masuk') || request()->is('admin/surat-masuk/*') ? 'active' : '' }} nav-item">
                        <a class="d-flex align-items-center" href="{{ route('admin.suratmasuk.index') }}">
                            <i data-feather="file-text"></i>
                            <span class="menu-title text-truncate" data-i18n="Surat">Surat Masuk</span>
                        </a>
                    </li>
                @else
                @endif
                @if ($user->role->disposition == 1)
                    <li
                        class="{{ request()->is('admin/disposisi') || request()->is('admin/disposisi/*') ? 'active' : '' }} nav-item">
                        <a class="d-flex align-items-center" href="{{ route('admin.disposisi.index') }}">
                            <i data-feather="file-text"></i>
                            <span class="menu-title text-truncate" data-i18n="Surat">Disposisi</span>
                        </a>
                    </li>
                @else
                @endif
                @if ($user->role->outgoing == 1)
                    <li
                        class="{{ request()->is('admin/surat-keluar') || request()->is('admin/surat-keluar/*') ? 'active' : '' }} nav-item">
                        <a class="d-flex align-items-center" href="{{ route('admin.suratkeluar.index') }}">
                            <i data-feather="file-text"></i>
                            <span class="menu-title text-truncate" data-i18n="Surat">Surat Keluar</span>
                        </a>
                    </li>
                @else
                @endif
                @if ($user->role->outgoing == 1)
                    <li
                        class="{{ request()->is('admin/perbaikan-surat') || request()->is('admin/perbaikan-surat/*') ? 'active' : '' }} nav-item">
                        <a class="d-flex align-items-center" href="{{ route('admin.perbaikansurat.index') }}">
                            <i data-feather="file-text"></i>
                            <span class="menu-title text-truncate" data-i18n="Surat">Perbaikan surat</span>
                        </a>
                    </li>
                @else
                @endif
            </ul>
        </div>
    @endif
    @if ($user->id_role == 'R-04')
        <div class="main-menu-content mt-3">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="{{ request()->is('student/dashboard') ? 'active' : '' }} nav-item">
                    <a class="d-flex align-items-center" href="{{ route('student') }}">
                        <i data-feather="home"></i>
                        <span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span>
                    </a>
                </li>
                <li class=" navigation-header">
                    <span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span>
                    <i data-feather="more-horizontal"></i>
                </li>
                @if ($user->role->outgoing == 1)
                    <li
                        class="{{ request()->is('student/perbaikan-surat') || request()->is('student/perbaikan-surat/*') ? 'active' : '' }} nav-item">
                        <a class="d-flex align-items-center" href="{{ route('student.perbaikansurat.index') }}">
                            <i data-feather="file-text"></i>
                            <span class="menu-title text-truncate" data-i18n="Surat">Perbaikan Surat</span>
                        </a>
                    </li>
                @else
                @endif

            </ul>
        </div>
    @endif
    @if ($user->id_role == 'R-05')
        <div class="main-menu-content mt-3">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="{{ request()->is('superadmin/dashboard') ? 'active' : '' }} nav-item">
                    <a class="d-flex align-items-center" href="{{ route('superadmin') }}">
                        <i data-feather="home"></i>
                        <span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span>
                    </a>
                </li>
                <li class=" navigation-header">
                    <span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span>
                    <i data-feather="more-horizontal"></i>
                </li>
                <li
                    class="{{ request()->is('superadmin/role') || request()->is('superadmin/role/*') ? 'active' : '' }} nav-item">
                    <a class="d-flex align-items-center" href="{{ route('superadmin.role.index') }}">
                        <i data-feather="file-text"></i>
                        <span class="menu-title text-truncate" data-i18n="Surat">Role dan Permission</span>
                    </a>
                </li>
            </ul>
        </div>
    @endif
    @if ($user->id_role == 'R-06')
        <div class="main-menu-content mt-3">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="{{ request()->is('staff/dashboard') ? 'active' : '' }} nav-item">
                    <a class="d-flex align-items-center" href="{{ route('staff') }}">
                        <i data-feather="home"></i>
                        <span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span>
                    </a>
                </li>
                <li class=" navigation-header">
                    <span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span>
                    <i data-feather="more-horizontal"></i>
                </li>
                @if ($user->role->incoming == 1)
                    <li
                        class="{{ request()->is('staff/surat-masuk') || request()->is('staff/surat-masuk/*') ? 'active' : '' }} nav-item">
                        <a class="d-flex align-items-center" href="{{ route('staff.suratmasuk.index') }}">
                            <i data-feather="file-text"></i>
                            <span class="menu-title text-truncate" data-i18n="Surat">Surat Disposisi</span>
                        </a>
                    </li>
                @else
                @endif
                @if ($user->role->outgoing == 1)
                    <li
                        class="{{ request()->is('staff/surat-keluar') || request()->is('staff/surat-keluar/*') ? 'active' : '' }} nav-item">
                        <a class="d-flex align-items-center" href="{{ route('staff.suratkeluar.index') }}">
                            <i data-feather="file-text"></i>
                            <span class="menu-title text-truncate" data-i18n="Surat">Surat Keluar</span>
                        </a>
                    </li>
                @else
                @endif
            </ul>
        </div>
    @endif
</div>
