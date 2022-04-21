@extends('layouts.admin.master')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css') }}/style.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css') }}/pages/page-profile.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css') }}/plugins/extensions/ext-component-toastr.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/vendors/css/pickers/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/plugins/forms/pickers/form-flat-pickr.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/plugins/forms/pickers/form-pickadate.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/vendors/css/pickers/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/plugins/extensions/ext-component-toastr.css">
@endsection

@section('title')
    <h2>Profil</h2>
@endsection

@section('content')
    <div class="content-body">
        <div id="user-profile">
            <!-- profile header -->
            <div class="row">
                <div class="col-12">
                    <div class="card profile-header mb-2">
                        <!-- profile cover photo -->
                        <img class="card-img-top" src="{{ asset('assets') }}/images/profile/user-uploads/timeline.jpg"
                            alt="User Profile Image" />
                        <!--/ profile cover photo -->

                        <div class="position-relative">
                            <!-- profile picture -->
                            <div class="profile-img-container d-flex align-items-center">
                                <div class="profile-img d-flex align-items-center justify-content-center">

                                    <span class="avatar avatar-xl bg-light-primary">
                                        <span class="avatar-content">{{ substr($user->student->name, 0, 1) }}</span>
                                    </span>
                                    </span>
                                </div>
                                <!-- profile title -->
                                <div class="profile-title ms-3">
                                    <h2 class="text-white">{{ $user->student->name }}</h2>
                                    <p class="text-white">{{ $user->student->nisn }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- tabs pill -->
                        <div class="profile-header-nav">
                            <!-- navbar -->
                            <nav
                                class="navbar navbar-expand-md navbar-light justify-content-end justify-content-md-between w-100">
                                <button class="btn btn-icon navbar-toggler" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <i data-feather="align-justify" class="font-medium-5"></i>
                                </button>

                                <!-- collapse  -->
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <div class="profile-tabs d-flex justify-content-end flex-wrap mt-1 mt-md-0">
                                        <!-- edit button -->
                                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" id="onshowbtn"
                                            data-bs-target="#update">
                                            <i data-feather="edit" class="d-block d-md-none"></i>
                                            <span class="fw-bold d-none d-md-block">Edit</span>
                                        </button>
                                    </div>
                                </div>
                                <!--/ collapse  -->
                            </nav>
                            <!--/ navbar -->
                        </div>
                    </div>
                </div>
            </div>
            <!--/ profile header -->

            <!-- profile info section -->
            <section id="profile-info">
                <div class="row">
                    <!-- left profile info section -->
                    <div class="col-12 order-2 order-lg-1">
                        <!-- about -->
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">Tentang</div>
                                <div class="dropdown-divider"></div>
                                <h5 class="mb-75">Nama</h5>
                                <p class="card-text">
                                    {{ $user->student->name }}
                                </p>
                                <div class="mt-2">
                                    <h5 class="mb-75">Tempat Lahir</h5>
                                    <p class="card-text">{{ $user->student->birthplace }}</p>
                                </div>
                                <div class="mt-2">
                                    <h5 class="mb-75">Tanggal Lahir</h5>
                                    <p class="card-text">{{ $user->student->birthday }}</p>
                                </div>
                                <div class="mt-2">
                                    <h5 class="mb-75">Kelas</h5>
                                    <p class="card-text">{{ $user->student->class }}</p>
                                </div>
                                <div class="mt-2">
                                    <h5 class="mb-75">Nomor Induk</h5>
                                    <p class="card-text">{{ $user->student->ni }}</p>
                                </div>
                                <div class="mt-2">
                                    <h5 class="mb-75">NISN</h5>
                                    <p class="card-text">{{ $user->student->nisn }}</p>
                                </div>
                                <div class="mt-2">
                                    <h5 class="mb-75">Email</h5>
                                    <p class="card-text">{{ $user->email }}</p>
                                </div>
                            </div>
                        </div>
                        <!--/ about -->

                    </div>
                    <!--/ left profile info section -->
                </div>
            </section>
            <!--/ profile info section -->
        </div>

    </div>

    <div class="modal modal-slide-in fade" id="update" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog sidebar-sm">
            <form class="add-new-record modal-content pt-0" method="POST"
                action="{{ route('student.profil.edit', $user->id) }}" enctype="multipart/form-data">
                @csrf
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Profil</h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="mb-1">
                        <label class="form-label" for="name">Nama</label>
                        <input class="form-control" type="text" id="name" name="name"
                            value=" {{ $user->student->name }}">
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="birthplace">Tempat Lahir</label>
                        <input class="form-control" type="text" id="birthplace" name="birthplace"
                            value=" {{ $user->student->birthplace }}">
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="birthday">Tanggal</label>
                        <input type="text" id="birthday" name="birthday"
                            class="form-control flatpickr-basic flatpickr-input active"
                            value=" {{ $user->student->birthday }}" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="class">Kelas</label>
                        <input class="form-control" type="text" id="class" name="class"
                            value=" {{ $user->student->class }}">
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="ni">Nomor Induk</label>
                        <input class="form-control" type="text" id="ni" name="ni" value=" {{ $user->student->ni }}">
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="nisn">NISN</label>
                        <input class="form-control" type="text" id="nisn" name="nisn"
                            value=" {{ $user->student->nisn }}">
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="email">Email</label>
                        <input class="form-control" type="email" id="email" name="email" value=" {{ $user->email }}">
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input type="password" class="form-control form-control-merge" id="password" name="password"
                                tabindex="2"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password" />
                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary data-submit me-1">Submit</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets') }}/js/scripts/components/components-modals.js"></script>
    <script src="{{ asset('assets') }}/vendors/js/extensions/toastr.min.js"></script>
    <script src="{{ asset('assets') }}/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>

    <script src="{{ asset('assets') }}/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="{{ asset('assets') }}/vendors/js/pickers/pickadate/picker.date.js"></script>
    <script src="{{ asset('assets') }}/vendors/js/pickers/pickadate/picker.time.js"></script>
    <script src="{{ asset('assets') }}/vendors/js/pickers/pickadate/legacy.js"></script>
    <script src="{{ asset('assets') }}/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <script src="{{ asset('assets') }}/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <script src="{{ asset('assets') }}/js/scripts/forms/pickers/form-pickers.js"></script>
    <script src="{{ asset('assets') }}/vendors/js/extensions/toastr.min.js"></script>
    @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)
                toastr['error']("{{ $error }}", 'Error!', {
                closeButton: true,
                tapToDismiss: false,
                timeOut: 5000,
                });
            @endforeach
        </script>
    @endif
    <script src="{{ asset('assets') }}/js/scripts/extensions/ext-component-toastr.js"></script>
@endsection
