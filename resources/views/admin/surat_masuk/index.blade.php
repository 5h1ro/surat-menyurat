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
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/plugins/forms/pickers/form-flat-pickr.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/plugins/forms/pickers/form-pickadate.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/vendors/css/pickers/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/plugins/extensions/ext-component-toastr.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/vendors/css/extensions/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets') }}/css/plugins/extensions/ext-component-sweet-alerts.css">
    @csrf
@endsection

@section('title')
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Surat Masuk</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a>
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
        <input type="hidden" id="read" value="{{ $read }}" />
        <input type="hidden" id="delete" value="{{ $delete }}" />
        <div class=" row">
            <div class="col-12">
                <div class="card">
                    <table class="datatables-basic table">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>ID</th>
                                <th>Tanggal Masuk</th>
                                <th>Nama dan Alamat</th>
                                <th>Surat</th>
                                <th>Link Surat</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal to add new record -->
        <div class="modal fade text-start" id="modals-slide-in" tabindex="-1" aria-labelledby="myModalLabel33"
            aria-hidden="true">
            <div class="modal-dialog sidebar-sm">
                <form class="add-new-record modal-content pt-0" method="POST"
                    action="{{ route('admin.suratmasuk.create') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-header mb-1">
                        <h5 class="modal-title" id="exampleModalLabel">Data Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body flex-grow-1">
                        <div class="mb-1">
                            <label class="form-label" for="letter_number">Nomor Surat</label>
                            <input required type="text" id="letter_number" name="letter_number" class="form-control"
                                placeholder="xxx/xxx/xx.xxx/xxxx" />
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="letter_date">Tanggal Surat</label>
                            <input required type="text" id="letter_date" name="letter_date"
                                class="form-control flatpickr-basic" placeholder="YYYY-MM-DD" />
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="from">Asal Surat</label>
                            <input required type="text" id="from" name="from" class="form-control"
                                placeholder="Dinas ..." />
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="title">Nama & Alamat</label>
                            <input required type="text" id="title" name="title" class="form-control"
                                placeholder="Surat ..." />
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="detail">Isi Pokok Surat</label>
                            <textarea required class="form-control" id="detail" name="detail" rows="3" placeholder="Textarea"></textarea>
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="fk_type">Tipe</label>
                            <select required class="form-select" id="fk_type" name="fk_type">
                                @foreach ($type as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-1" id="headmaster">
                            <label class="form-label" for="fk_headmaster">Nama Kepala Sekolah</label>
                            <select class="form-select" id="fk_headmaster" name="fk_headmaster">
                                @foreach ($headmaster as $item)
                                    <option value="{{ $item->nip }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="information">Jenis Surat</label>
                            <select class="form-select" id="information" name="information">
                                <option value="1">Rahasia</option>
                                <option value="2">Penting</option>
                                <option value="3">Rutin</option>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="letter">Scan Surat</label>
                            <input required class="form-control" type="file" id="letter" name="letter"
                                accept="application/pdf">
                        </div>
                        <button type="submit" class="btn btn-primary data-submit me-1">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        @foreach ($incoming as $item)
            <div class="modal fade" id="detail{{ md5($item->number) }}" tabindex="-1" aria-labelledby="detailTitle"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailTitle">Detail Surat</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <h5 class="mb-75">Tanggal Masuk</h5>
                                <p class="card-text">{{ $item->date }}</p>
                            </div>
                            <div class="mt-2">
                                <h5 class="mb-75">Nomor Agenda</h5>
                                <p class="card-text">{{ $item->number }}</p>
                            </div>
                            <div class="mt-2">
                                <h5 class="mb-75">Nama dan Alamat</h5>
                                <p class="card-text">{{ $item->title }}</p>
                            </div>
                            <div class="mt-2">
                                <h5 class="mb-75">Asal</h5>
                                <p class="card-text">{{ $item->from }}</p>
                            </div>
                            <div class="mt-2">
                                <h5 class="mb-75">Nomor Surat</h5>
                                <p class="card-text">{{ $item->letter_number }}</p>
                            </div>
                            <div class="mt-2">
                                <h5 class="mb-75">Tanggal Surat</h5>
                                <p class="card-text">{{ $item->letter_date }}</p>
                            </div>
                            <div class="mt-2">
                                <h5 class="mb-75">Isi Pokok Surat</h5>
                                <p class="card-text">{{ $item->detail }}</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>
    <!--/ Basic table -->
@endsection

@section('script')
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

    <script src="{{ asset('assets') }}/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="{{ asset('assets') }}/vendors/js/pickers/pickadate/picker.date.js"></script>
    <script src="{{ asset('assets') }}/vendors/js/pickers/pickadate/picker.time.js"></script>
    <script src="{{ asset('assets') }}/vendors/js/pickers/pickadate/legacy.js"></script>
    <script src="{{ asset('assets') }}/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <script src="{{ asset('assets') }}/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <script src="{{ asset('assets') }}/js/scripts/forms/pickers/form-pickers.js"></script>

    <script src="{{ asset('assets') }}/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="{{ asset('assets/js/scripts/tables/admin/table-admin-incoming-datatables.js') }}"></script>

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
    <script>
        function remove(params) {
            var str = params.toString();
            Swal.fire({
                title: 'Apa anda yakin?',
                text: "Saat data dihapus, data tidak bisa dikembalikan lagi",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ms-1'
                },
                buttonsStyling: false
            }).then(function(result) {
                if (result.isConfirmed) {
                    location.href = "{{ $delete }}/" + str.slice(1, -1);
                } else {
                    Swal.fire({
                        text: "Data tidak dihapus",
                        icon: 'info'
                    });
                }
            });
        }
    </script>
@endsection
