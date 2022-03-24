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
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/plugins/forms/pickers/form-flat-pickr.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/plugins/forms/pickers/form-pickadate.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/vendors/css/pickers/flatpickr/flatpickr.min.css">
    @csrf
@endsection

@section('title')
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Surat Keluar</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('teacher') }}">Dashboard</a>
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
                                <th>Tanggal Pengajuan</th>
                                <th>Kode Nomor Agenda</th>
                                <th>Di Kirim Ke</th>
                                <th>Surat</th>
                                <th>Link Surat</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal to add new record -->
        <div class="modal modal-slide-in fade" id="modals-slide-in">
            <div class="modal-dialog sidebar-sm">
                <form class="add-new-record modal-content pt-0" action="{{ route('student.suratkeluar.create') }}"
                    method="POST">
                    @csrf
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                    <div class="modal-header mb-1">
                        <h5 class="modal-title" id="exampleModalLabel">Data Baru</h5>
                    </div>
                    <div class="modal-body flex-grow-1">
                        <div class="mb-1">
                            <label class="form-label" for="to">Di Kirim Ke</label>
                            <input type="text" class="form-control dt-full-name" id="to" name="to" placeholder="Wali Murid"
                                aria-label="Wali Murid" />
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="detail">Isi Pokok Surat</label>
                            <textarea class="form-control" id="detail" name="detail" rows="3" placeholder="Textarea"></textarea>
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="id_type">Jenis Surat</label>
                            <select class="select2" id="id_type" name="id_type">
                                @foreach ($type as $data_type)
                                    <option value={{ $data_type->id }}>{{ $data_type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="keterangan" class="">
                            <hr>
                            <div class="mb-1">Keperluan Surat
                            </div>
                            <div class="mb-1">
                                Data yang Diperlukan Sudah Cukup
                            </div>
                        </div>
                        <div id="mutasi" class="d-none">
                            <hr>
                            <div class="mb-1">Keperluan Surat
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="masuk_mutasi">Tanggal Masuk</label>
                                <input type="text" id="masuk_mutasi" name="masuk_mutasi"
                                    class="form-control flatpickr-basic flatpickr-input " placeholder="YYYY-MM-DD" />
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="keluar_mutasi">Tanggal Keluar</label>
                                <input type="text" id="keluar_mutasi" name="keluar_mutasi"
                                    class="form-control flatpickr-basic flatpickr-input " placeholder="YYYY-MM-DD" />
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="alasan_mutasi">Mutasi / Pindah Karena</label>
                                <textarea class="form-control" id="alasan_mutasi" name="alasan_mutasi" rows="3"
                                    placeholder="Pindah ke SMPN 1 xxxx"></textarea>
                            </div>
                        </div>
                        <div id="sih" class="d-none">
                            <hr>
                            <div class="mb-1">Keperluan Surat
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="ayahsih">Nama Ayah</label>
                                <input type="text" class="form-control dt-full-name" id="ayahsih" name="ayahsih"
                                    placeholder="Nama Ayah" aria-label="SMP N 1 Slahung" />
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="ibusih">Nama Ibu</label>
                                <input type="text" class="form-control dt-full-name" id="ibusih" name="ibusih"
                                    placeholder="Nama Ibu" />
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="no_ijazahsih">Nomor Ijazah</label>
                                <input type="text" class="form-control dt-full-name" id="no_ijazahsih" name="no_ijazahsih"
                                    placeholder="DN – xx xx xxxxxxx" />
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="tahun_ajaransih">Tahun Ajaran</label>
                                <input type="text" class="form-control dt-full-name" id="tahun_ajaransih"
                                    name="tahun_ajaransih" placeholder="xxxx/xxxx" />
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="polseksih">Kantor Polsek
                                    Polsek</label>
                                <input type="text" class="form-control dt-full-name" id="polseksih" name="polseksih"
                                    placeholder="Polsek xxxxxx" />
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="tanggal_surat_laporsih">Tanggal Surat Lapor dari
                                    Polsek</label>
                                <input type="text" id="tanggal_surat_laporsih" name="tanggal_surat_laporsih"
                                    class="form-control flatpickr-basic flatpickr-input " placeholder="YYYY-MM-DD" />
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="no_suratsih">Nomor Surat</label>
                                <input type="text" class="form-control dt-full-name" id="no_suratsih" name="no_suratsih"
                                    placeholder="STLKB/xxx/xx/xxxx/POLSEK" />
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary data-submit me-1">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        @foreach ($outgoing as $item)
            <div class="modal fade" id="detail{{ $item->id }}" tabindex="-1" aria-labelledby="detailTitle"
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
                                <h5 class="mb-75">Tanggal Pengajuan</h5>
                                <p class="card-text">{{ $item->date }}</p>
                            </div>
                            <div class="mt-2">
                                <h5 class="mb-75">Kode Nomor Agenda</h5>
                                <p class="card-text">{{ $item->number }}</p>
                            </div>
                            <div class="mt-2">
                                <h5 class="mb-75">Di Kirim Ke</h5>
                                <p class="card-text">{{ $item->to }}</p>
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

    <script src="{{ asset('assets') }}/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="{{ asset('assets') }}/vendors/js/pickers/pickadate/picker.date.js"></script>
    <script src="{{ asset('assets') }}/vendors/js/pickers/pickadate/picker.time.js"></script>
    <script src="{{ asset('assets') }}/vendors/js/pickers/pickadate/legacy.js"></script>
    <script src="{{ asset('assets') }}/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <script src="{{ asset('assets') }}/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <script src="{{ asset('assets') }}/js/scripts/forms/pickers/form-pickers.js"></script>

    <script src="{{ asset('assets/js/scripts/tables/student/table-student-outgoing-datatables.js') }}"></script>
    <script>
        var type = $('#id_type');
        var undangan = $('#undangan');
        var keterangan = $('#keterangan');
        var sih = $('#sih');
        var mutasi = $('#mutasi');
        type.change(
            function() {
                if (type.val() == 3) {
                    keterangan.removeClass('d-none');
                    mutasi.addClass('d-none');
                    sih.addClass('d-none');
                } else if (type.val() == 4) {
                    keterangan.addClass('d-none');
                    mutasi.removeClass('d-none');
                    sih.addClass('d-none');
                } else if (type.val() == 6) {
                    keterangan.addClass('d-none');
                    mutasi.addClass('d-none');
                    sih.removeClass('d-none');
                }
            }
        )
    </script>
@endsection
