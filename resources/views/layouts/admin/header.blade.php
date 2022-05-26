<nav
    class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
    <div class="navbar-container d-flex content">
        <ul class="nav navbar-nav align-items-center ms-auto">

            <li class="nav-item d-none d-lg-block">
                <a class="nav-link nav-link-style">
                    <i class="ficon" data-feather="moon"></i>
                </a>
            </li>
            @if ($user->id_role == 1)
                <li class="nav-item dropdown dropdown-notification me-25">
                    <a class="nav-link" href="#" data-bs-toggle="dropdown">
                        <i class="ficon" data-feather="bell"></i>
                        @if ($incoming->count != 0)
                            <span class="badge rounded-pill bg-danger badge-up">{{ $incoming->count }}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
                        <li class="dropdown-menu-header">
                            <div class="dropdown-header d-flex">
                                <h4 class="notification-title mb-0 me-auto">Notifikasi</h4>
                                @if ($incoming->count != 0)
                                    <div class="badge rounded-pill badge-light-primary">{{ $incoming->count }} New
                                    </div>
                                @endif
                            </div>
                        </li>
                        <li class="scrollable-container media-list">
                            @if ($incoming->count != 0)
                                <a class="d-flex" href="#">
                                    <div class="list-item d-flex align-items-start">
                                        <div class="me-1">
                                            <div class="avatar bg-light-warning">
                                                <div class="avatar-content">
                                                    <i class="avatar-icon" data-feather="file-text"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-item-body flex-grow-1">
                                            <p class="media-heading"><span class="fw-bolder">Terdapat
                                                    {{ $incoming->count }} surat baru</p>
                                            <small class="notification-text"> Silahkan dibuka pada menu surat
                                                baru</small>
                                        </div>
                                    </div>
                                </a>
                            @else
                                <a class="d-flex" href="#">
                                    <div class="list-item d-flex align-items-start">
                                        <div class="me-1">
                                            <div class="avatar bg-light-success">
                                                <div class="avatar-content">
                                                    <i class="avatar-icon" data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-item-body flex-grow-1">
                                            <p class="media-heading">
                                                <span class="fw-bolder">Tidak ada surat baru
                                            </p>
                                            <small class="notification-text">Saat ini belum ada surat baru untuk
                                                anda</small>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        </li>
                        @if ($incoming->count != 0)
                            <li class="dropdown-menu-footer">
                                <a class="btn btn-primary w-100" href="{{ route('teacher.suratmasuk.index') }}">Buka
                                    Surat</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if ($user->id_role == 2)
                <li class="nav-item dropdown dropdown-notification me-25">
                    <a class="nav-link" href="#" data-bs-toggle="dropdown">
                        <i class="ficon" data-feather="bell"></i>
                        @if ($incoming->count != 0 || $outgoing->count != 0)
                            <span
                                class="badge rounded-pill bg-danger badge-up">{{ $incoming->count + $outgoing->count }}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
                        <li class="dropdown-menu-header">
                            <div class="dropdown-header d-flex">
                                <h4 class="notification-title mb-0 me-auto">Notifikasi</h4>
                                @if ($incoming->count != 0 || $outgoing->count != 0)
                                    <div class="badge rounded-pill badge-light-primary">
                                        {{ $incoming->count + $outgoing->count }} New
                                    </div>
                                @endif
                            </div>
                        </li>
                        <li class="scrollable-container media-list">
                            @if ($incoming->count != 0)
                                <a class="d-flex" href="#">
                                    <div class="list-item d-flex align-items-start">
                                        <div class="me-1">
                                            <div class="avatar bg-light-warning">
                                                <div class="avatar-content">
                                                    <i class="avatar-icon" data-feather="file-text"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-item-body flex-grow-1">
                                            <p class="media-heading"><span class="fw-bolder">Terdapat
                                                    {{ $incoming->count }} surat masuk baru</p>
                                            <small class="notification-text"> Silahkan dibuka pada menu surat masuk
                                                baru</small>
                                        </div>
                                    </div>
                                </a>
                            @else
                                <a class="d-flex" href="#">
                                    <div class="list-item d-flex align-items-start">
                                        <div class="me-1">
                                            <div class="avatar bg-light-success">
                                                <div class="avatar-content">
                                                    <i class="avatar-icon" data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-item-body flex-grow-1">
                                            <p class="media-heading">
                                                <span class="fw-bolder">Tidak ada surat masuk baru
                                            </p>
                                            <small class="notification-text">Saat ini belum ada surat masuk baru untuk
                                                anda</small>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        </li>
                        <li class="scrollable-container media-list">
                            @if ($outgoing->count != 0)
                                <a class="d-flex" href="#">
                                    <div class="list-item d-flex align-items-start">
                                        <div class="me-1">
                                            <div class="avatar bg-light-info">
                                                <div class="avatar-content">
                                                    <i class="avatar-icon" data-feather="file-text"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-item-body flex-grow-1">
                                            <p class="media-heading"><span class="fw-bolder">Terdapat
                                                    {{ $outgoing->count }} surat keluar baru</p>
                                            <small class="notification-text"> Silahkan dibuka pada menu surat keluar
                                                baru</small>
                                        </div>
                                    </div>
                                </a>
                            @else
                                <a class="d-flex" href="#">
                                    <div class="list-item d-flex align-items-start">
                                        <div class="me-1">
                                            <div class="avatar bg-light-success">
                                                <div class="avatar-content">
                                                    <i class="avatar-icon" data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-item-body flex-grow-1">
                                            <p class="media-heading">
                                                <span class="fw-bolder">Tidak ada surat keluar baru
                                            </p>
                                            <small class="notification-text">Saat ini belum ada surat keluar baru untuk
                                                anda</small>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        </li>
                        @if ($incoming->count != 0 || $outgoing->count != 0)
                            <li class="dropdown-menu-footer">
                                <div class="row justify-content-between mx-1">
                                    <a class="btn btn-primary col-5"
                                        href="{{ route('headmaster.suratmasuk.index') }}">
                                        Surat Masuk</a>
                                    <a class="btn btn-primary col-5"
                                        href="{{ route('headmaster.suratkeluar.index') }}">
                                        Surat Keluar</a>
                                </div>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if ($user->id_role == 3)
                <li class="nav-item dropdown dropdown-notification me-25">
                    <a class="nav-link" href="#" data-bs-toggle="dropdown">
                        <i class="ficon" data-feather="bell"></i>
                        @if ($count != 0)
                            <span class="badge rounded-pill bg-danger badge-up">{{ $count }}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
                        <li class="dropdown-menu-header">
                            <div class="dropdown-header d-flex">
                                <h4 class="notification-title mb-0 me-auto">Notifikasi</h4>
                                @if ($count != 0)
                                    <div class="badge rounded-pill badge-light-primary">{{ $count }} New
                                    </div>
                                @endif
                            </div>
                        </li>
                        <li class="scrollable-container media-list">
                            @if ($count != 0)
                                <a class="d-flex" href="#">
                                    <div class="list-item d-flex align-items-start">
                                        <div class="me-1">
                                            <div class="avatar bg-light-warning">
                                                <div class="avatar-content">
                                                    <i class="avatar-icon" data-feather="file-text"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-item-body flex-grow-1">
                                            <p class="media-heading"><span class="fw-bolder">Terdapat
                                                    {{ $count }} surat perlu diverifikasi</p>
                                            <small class="notification-text"> Silahkan dibuka pada menu surat
                                                keluar</small>
                                        </div>
                                    </div>
                                </a>
                            @else
                                <a class="d-flex" href="#">
                                    <div class="list-item d-flex align-items-start">
                                        <div class="me-1">
                                            <div class="avatar bg-light-success">
                                                <div class="avatar-content">
                                                    <i class="avatar-icon" data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-item-body flex-grow-1">
                                            <p class="media-heading">
                                                <span class="fw-bolder">Tidak ada surat baru
                                            </p>
                                            <small class="notification-text">Saat ini belum ada surat baru untuk
                                                anda</small>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        </li>
                        @if ($count != 0)
                            <li class="dropdown-menu-footer">
                                <a class="btn btn-primary w-100" href="{{ route('admin.suratkeluar.index') }}">Buka
                                    Surat</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if ($user->id_role == 4)
                <li class="nav-item dropdown dropdown-notification me-25">
                    <a class="nav-link" href="#" data-bs-toggle="dropdown">
                        <i class="ficon" data-feather="bell"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
                        <li class="dropdown-menu-header">
                            <div class="dropdown-header d-flex">
                                <h4 class="notification-title mb-0 me-auto">Notifikasi</h4>
                            </div>
                        </li>
                        <li class="scrollable-container media-list">
                            <a class="d-flex" href="#">
                                <div class="list-item d-flex align-items-start">
                                    <div class="me-1">
                                        <div class="avatar bg-light-success">
                                            <div class="avatar-content">
                                                <i class="avatar-icon" data-feather="check"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-item-body flex-grow-1">
                                        <p class="media-heading">
                                            <span class="fw-bolder">Tidak ada surat baru
                                        </p>
                                        <small class="notification-text">Saat ini belum ada surat baru untuk
                                            anda</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            @if ($user->id_role == 5)
                <li class="nav-item dropdown dropdown-notification me-25">
                    <a class="nav-link" href="#" data-bs-toggle="dropdown">
                        <i class="ficon" data-feather="bell"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
                        <li class="dropdown-menu-header">
                            <div class="dropdown-header d-flex">
                                <h4 class="notification-title mb-0 me-auto">Notifikasi</h4>
                            </div>
                        </li>
                        <li class="scrollable-container media-list">
                            <a class="d-flex" href="#">
                                <div class="list-item d-flex align-items-start">
                                    <div class="me-1">
                                        <div class="avatar bg-light-success">
                                            <div class="avatar-content">
                                                <i class="avatar-icon" data-feather="check"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-item-body flex-grow-1">
                                        <p class="media-heading">
                                            <span class="fw-bolder">Tidak ada surat baru
                                        </p>
                                        <small class="notification-text">Saat ini belum ada surat baru untuk
                                            anda</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            @if ($user->id_role == 6)
                <li class="nav-item dropdown dropdown-notification me-25">
                    <a class="nav-link" href="#" data-bs-toggle="dropdown">
                        <i class="ficon" data-feather="bell"></i>
                        @if ($incoming->count != 0)
                            <span class="badge rounded-pill bg-danger badge-up">{{ $incoming->count }}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
                        <li class="dropdown-menu-header">
                            <div class="dropdown-header d-flex">
                                <h4 class="notification-title mb-0 me-auto">Notifikasi</h4>
                                @if ($incoming->count != 0)
                                    <div class="badge rounded-pill badge-light-primary">{{ $incoming->count }} New
                                    </div>
                                @endif
                            </div>
                        </li>
                        <li class="scrollable-container media-list">
                            @if ($incoming->count != 0)
                                <a class="d-flex" href="#">
                                    <div class="list-item d-flex align-items-start">
                                        <div class="me-1">
                                            <div class="avatar bg-light-warning">
                                                <div class="avatar-content">
                                                    <i class="avatar-icon" data-feather="file-text"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-item-body flex-grow-1">
                                            <p class="media-heading"><span class="fw-bolder">Terdapat
                                                    {{ $incoming->count }} surat baru</p>
                                            <small class="notification-text"> Silahkan dibuka pada menu surat
                                                baru</small>
                                        </div>
                                    </div>
                                </a>
                            @else
                                <a class="d-flex" href="#">
                                    <div class="list-item d-flex align-items-start">
                                        <div class="me-1">
                                            <div class="avatar bg-light-success">
                                                <div class="avatar-content">
                                                    <i class="avatar-icon" data-feather="check"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-item-body flex-grow-1">
                                            <p class="media-heading">
                                                <span class="fw-bolder">Tidak ada surat baru
                                            </p>
                                            <small class="notification-text">Saat ini belum ada surat baru untuk
                                                anda</small>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        </li>
                        @if ($incoming->count != 0)
                            <li class="dropdown-menu-footer">
                                <a class="btn btn-primary w-100" href="{{ route('staff.suratmasuk.index') }}">Buka
                                    Surat</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            <li class="nav-item dropdown dropdown-user">
                <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if ($user->id_role == 1)
                        <div class="user-nav d-sm-flex d-none">
                            <span class="user-name fw-bolder">{{ $user->teacher->name }}</span>
                            <span class="user-status">Guru</span>
                        </div>
                        <span class="avatar bg-light-primary">
                            <span class="avatar-content">{{ substr($user->teacher->name, 0, 1) }}</span>
                            <span class="avatar-status-online">
                            </span>
                        </span>
                    @endif
                    @if ($user->id_role == 2)
                        <div class="user-nav d-sm-flex d-none">
                            <span class="user-name fw-bolder">{{ $user->headmaster->name }}</span>
                            <span class="user-status">Kepala Sekolah</span>
                        </div>
                        <span class="avatar bg-light-primary">
                            <span class="avatar-content">{{ substr($user->headmaster->name, 0, 1) }}</span>
                            <span class="avatar-status-online">
                            </span>
                        </span>
                    @endif
                    @if ($user->id_role == 3)
                        <div class="user-nav d-sm-flex d-none">
                            <span class="user-name fw-bolder">{{ $user->admin->name }}</span>
                            <span
                                class="user-status">{{ $user->admin->status == 1 ? 'Kepala TU' : 'Admin' }}</span>
                        </div>
                        <span class="avatar bg-light-primary">
                            <span class="avatar-content">{{ substr($user->admin->name, 0, 1) }}</span>
                            <span class="avatar-status-online">
                            </span>
                        </span>
                    @endif
                    @if ($user->id_role == 4)
                        <div class="user-nav d-sm-flex d-none">
                            <span class="user-name fw-bolder">{{ $user->student->name }}</span>
                            <span class="user-status">Siswa</span>
                        </div>
                        <span class="avatar bg-light-primary">
                            <span class="avatar-content">{{ substr($user->student->name, 0, 1) }}</span>
                            <span class="avatar-status-online">
                            </span>
                        </span>
                    @endif
                    @if ($user->id_role == 5)
                        <div class="user-nav d-sm-flex d-none">
                            <span class="user-name fw-bolder">{{ $user->superadmin->name }}</span>
                            <span class="user-status">Superadmin</span>
                        </div>
                        <span class="avatar bg-light-primary">
                            <span class="avatar-content">{{ substr($user->superadmin->name, 0, 1) }}</span>
                            <span class="avatar-status-online">
                            </span>
                        </span>
                    @endif
                    @if ($user->id_role == 6)
                        <div class="user-nav d-sm-flex d-none">
                            <span class="user-name fw-bolder">{{ $user->staff->name }}</span>
                            <span class="user-status">Staff
                                {{ $user->staff->type->name }}</span>
                        </div>
                        <span class="avatar bg-light-primary">
                            <span class="avatar-content">{{ substr($user->staff->name, 0, 1) }}</span>
                            <span class="avatar-status-online">
                            </span>
                        </span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                    @if ($user->id_role == 1)
                        <a class="dropdown-item" href="{{ route('teacher.profil.index') }}">
                            <i class="me-50" data-feather="user"> </i>
                            Profile
                        </a>
                    @endif
                    @if ($user->id_role == 2)
                        <a class="dropdown-item" href="{{ route('headmaster.profil.index') }}">
                            <i class="me-50" data-feather="user"> </i>
                            Profile
                        </a>
                    @endif
                    @if ($user->id_role == 3)
                        <a class="dropdown-item" href="{{ route('admin.profil.index') }}">
                            <i class="me-50" data-feather="user"> </i>
                            Profile
                        </a>
                    @endif
                    @if ($user->id_role == 4)
                        <a class="dropdown-item" href="{{ route('student.profil.index') }}">
                            <i class="me-50" data-feather="user"> </i>
                            Profile
                        </a>
                    @endif
                    @if ($user->id_role == 5)
                        <a class="dropdown-item" href="{{ route('superadmin.profil.index') }}">
                            <i class="me-50" data-feather="user"> </i>
                            Profile
                        </a>
                    @endif
                    @if ($user->id_role == 6)
                        <a class="dropdown-item" href="{{ route('staff.profil.index') }}">
                            <i class="me-50" data-feather="user"> </i>
                            Profile
                        </a>
                    @endif
                    <div class="dropdown-divider"></div>
                    @if ($user->id_role == 3)
                        <a class="dropdown-item" href="{{ route('admin.pengaturan.index') }}">
                            <i class="me-50" data-feather="settings"></i>
                            Settings</a>
                    @endif
                    <a class="dropdown-item" href="{{ route('end') }}">
                        <i class="me-50" data-feather="power"></i>
                        Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
