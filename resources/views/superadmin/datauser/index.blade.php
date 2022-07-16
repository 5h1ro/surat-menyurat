@extends('layouts.admin.master')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets') }}/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets') }}/vendors/css/tables/datatable/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets') }}/vendors/css/tables/datatable/buttons.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets') }}/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/vendors/css/pickers/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/core/menu/menu-types/vertical-menu.css">
    @csrf
@endsection

@section('title')
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Data User</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('superadmin') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Index
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <!-- Basic table -->
    <section id="basic-datatable">
        <input type="hidden" id="link" value="{{ $data }}" />
        <div class=" row">
            <div class="col-12">
                <div class="card">
                    <table class="datatables-basic table">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Email</th>
                                <th>ID-ROLE</th>
                                <th>ID-ROLE</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        {{-- Modalto add user --}}
        <div class="modal fade text-start" id="modals-slide-in" tabindex="-1" aria-labelledby="myModalLabel33"
            aria-hidden="true">
            <div class="modal-dialog sidebar-sm">
                <form class="add-new-record modal-content pt-0" method="POST"
                    action="{{ route('superadmin.datauser.create') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-header mb-1">
                        <h5 class="modal-title" id="exampleModalLabel">Data Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body flex-grow-1">
                        <div class="mb-1">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control" type="email" id="email" name="email"
                                value="">
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="typerole">Tipe Role</label>
                            <select class="form-select" id="typerole" name="id_role">
                                <option selected disabled>Pilih Jenis</option>
                                <option value="1">Guru</option>
                                <option value="2">Staff</option>
                                <option value="3">Siswa</option>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input type="password" class="form-control form-control-merge" id="password"
                                    name="password" tabindex="2"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="password">Password Confirmation</label>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input type="password" class="form-control form-control-merge" id="password_confirmation"
                                     tabindex="2"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                        </div>
                        <label class="form-label" for="password" id="message"></label>
                        <div>
                            <button type="submit" class="btn btn-primary data-submit me-1" id="btn_submit"
                                disabled>Submit</button>
                            <button type="reset" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
            </div>
            </form>
        </div>
        </div>
        {{-- edit --}}
        <div class="modal modal-slide-in fade" id="edit">
            <div class="modal-dialog sidebar-sm">
                <form class="add-new-record modal-content pt-0" action="" method="POST">
                    @csrf
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                    <div class="modal-header mb-1">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                    </div>
                    <div class="modal-body flex-grow-1">
                        <div class="mb-1">
                            <label class="form-label" for="name">Nama Role</label>
                            <input type="text" class="form-control dt-full-name" id="name" name="name" />
                        </div>
                        <div class="mb-1">
                            <div class="row">
                                <div class="col-4">
                                    <label class="form-label mb-50" for="incoming">Surat Masuk</label>
                                    <div class="form-check form-switch form-check-success">
                                        <input type="hidden" name="incoming" id="incomingoff" value="off">
                                        <input type="checkbox" class="form-check-input" name="incoming"
                                            id="incoming" />
                                        <label class="form-check-label" for="incoming">
                                            <span class="switch-icon-left"><i data-feather="check"></i></span>
                                            <span class="switch-icon-right"><i data-feather="x"></i></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label class="form-label mb-50" for="outgoing">Surat Keluar</label>
                                    <div class="form-check form-switch form-check-success">
                                        <input type="hidden" name="outgoing" id="outgoingoff" value="off">
                                        <input type="checkbox" class="form-check-input" name="outgoing"
                                            id="outgoing" />
                                        <label class="form-check-label" for="outgoing">
                                            <span class="switch-icon-left"><i data-feather="check"></i></span>
                                            <span class="switch-icon-right"><i data-feather="x"></i></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label class="form-label mb-50" for="disposition">Disposisi</label>
                                    <div class="form-check form-switch form-check-success">
                                        <input type="hidden" name="disposition" id="dispositionoff" value="off">
                                        <input type="checkbox" class="form-check-input" name="disposition" />
                                        <label class="form-check-label" for="disposition">
                                            <span class="switch-icon-left"><i data-feather="check"></i></span>
                                            <span class="switch-icon-right"><i data-feather="x"></i></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary data-submit me-1">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!--/ Basic table -->
@endsection

@section('script')
    <script src="{{ asset('assets') }}/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="{{ asset('assets') }}/js/scripts/forms/form-select2.js"></script>
    <script src="{{ asset('assets') }}/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/vendors/js/tables/datatable/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('assets') }}/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="{{ asset('assets') }}/vendors/js/tables/datatable/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('assets') }}/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
    <script src="{{ asset('assets') }}/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="{{ asset('assets') }}/vendors/js/tables/datatable/jszip.min.js"></script>
    <script src="{{ asset('assets') }}/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="{{ asset('assets') }}/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="{{ asset('assets') }}/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="{{ asset('assets') }}/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="{{ asset('assets') }}/vendors/js/tables/datatable/dataTables.rowGroup.min.js"></script>
    <script src="{{ asset('assets') }}/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>

    <script src="{{ asset('assets/js/scripts/tables/superadmin/table-superadmin-list_user-datatables.js') }}"></script>

    <script>
        if (document.getElementById("incoming").checked) {
            document.getElementById('incomingoff').disable = true;
        }
        if (document.getElementById("outgoing").checked) {
            document.getElementById('outgoingoff').disable = true;
        }
        if (document.getElementById("disposition").checked) {
            document.getElementById('dispositionoff').disable = true;
        }
    </script>
    <script>
        $('#password, #password_confirmation').on('keyup', function() {
            if ($('#password').val() == $('#password_confirmation').val()) {
                $('#message').html('Sandi sesuai').css('color', 'green');
                $('#btn_submit').removeAttr('disabled');
            } else {
                $('#message').html('Sandi tidak sesuai').css('color', 'red');
                $('#btn_submit').attr('disabled', 'disabled');
            }
        });
    </script>
@endsection
