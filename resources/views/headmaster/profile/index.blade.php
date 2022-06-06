@extends('layouts.admin.master')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css') }}/style.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css') }}/pages/page-profile.css">
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
                                        <span class="avatar-content">{{ substr($user->headmaster->name, 0, 1) }}</span>
                                    </span>
                                    </span>
                                </div>
                                <!-- profile title -->
                                <div class="profile-title ms-3">
                                    <h2 class="text-white">{{ $user->headmaster->name }}</h2>
                                    <p class="text-white">{{ $user->headmaster->nip }}</p>
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
                                    {{ $user->headmaster->name }}
                                </p>
                                <div class="mt-2">
                                    <h5 class="mb-75">NIP</h5>
                                    <p class="card-text">{{ $user->headmaster->nip }}</p>
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


    <div class="modal fade text-start" id="update" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog sidebar-sm">
            <form class="add-new-record modal-content pt-0" method="POST"
                action="{{ route('headmaster.profil.edit', $user->email) }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="mb-1">
                        <label class="form-label" for="name">Nama</label>
                        <input class="form-control" type="text" id="name" name="name"
                            value=" {{ $user->headmaster->name }}">
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="nip">NIP</label>
                        <input class="form-control" type="text" id="nip" name="nip"
                            value=" {{ $user->headmaster->nip }}">
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
