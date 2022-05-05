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
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/plugins/extensions/ext-component-toastr.css">
    @csrf
@endsection

@section('title')
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Perbaikan</h2>
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
                <form class="add-new-record modal-content pt-0" action="{{ route('student.perbaikansurat.create') }}"
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
                        <div id="skki" class="">
                            <hr>
                            <div class="mb-1">Keperluan Surat
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="nomor_ijazah">Ijazah nomor seri</label>
                                <input type="text" class="form-control dt-full-name" id="nomor_ijazah" name="nomor_ijazah"
                                    placeholder="xx – xx xx xxxxxxx" />
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="nomor_peserta">Nomor Peserta</label>
                                <input type="text" class="form-control dt-full-name" id="nomor_peserta" name="nomor_peserta"
                                    placeholder="x – xx – xx – xx – xxx - xxx – x" />
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="tahun_pelajaran">Tahun Pelajaran</label>
                                <input type="text" class="form-control dt-full-name" id="tahun_pelajaran"
                                    name="tahun_pelajaran" placeholder="xxxx/xxxx" />
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="tipe_kesalahan">Jenis Kesalahan</label>
                                <select class="select2" id="tipe_kesalahan" name="tipe_kesalahan">
                                    <option value=1>Nama Siswa</option>
                                    <option value=2>Tempat Lahir</option>
                                    <option value=3>Tanggal Lahir</option>
                                    <option value=4>Nama Wali</option>
                                </select>
                            </div>
                            <div id="nama_siswas" class="">
                                <div class="mb-1">
                                    <label class="form-label" for="nama_benarns">Nama yang Benar</label>
                                    <input type="text" class="form-control dt-full-name" id="nama_benarns"
                                        name="nama_benarns" placeholder="xxxx xxxxx" />
                                </div>
                                <div class="mb-1">
                                    <label class="form-label" for="nama_salahns">Nama yang Salah</label>
                                    <input type="text" class="form-control dt-full-name" id="nama_salahns"
                                        name="nama_salahns" placeholder="xxxx xxxxx" />
                                </div>
                                <div class="mb-1">
                                    <label class="form-label" for="dispendukcapilns">Kantor Dispendukcapil</label>
                                    <input type="text" class="form-control dt-full-name" id="dispendukcapilns"
                                        name="dispendukcapilns" placeholder="Kabupaten Ponorogo" />
                                </div>
                                <div class="mb-1">
                                    <label class="form-label" for="nomor_aktans">Nomor Akta Kelahiran</label>
                                    <input type="text" class="form-control dt-full-name" id="nomor_aktans"
                                        name="nomor_aktans" placeholder="AL 7xxxxxxxxx" />
                                </div>
                                <div class="mb-1">
                                    <label class="form-label" for="tanggal_aktans">Tanggal Akta</label>
                                    <input type="text" id="tanggal_aktans" name="tanggal_aktans"
                                        class="form-control flatpickr-basic flatpickr-input " placeholder="YYYY-MM-DD" />
                                </div>
                                <div class="mb-1">
                                    <label class="form-label" for="nama_sdns">Nama SD</label>
                                    <input type="text" class="form-control dt-full-name" id="nama_sdns" name="nama_sdns"
                                        placeholder="SDN xxxx" />
                                </div>
                                <div class="mb-1">
                                    <label class="form-label" for="sk_sdns">Nomor SK SD</label>
                                    <input type="text" class="form-control dt-full-name" id="sk_sdns" name="sk_sdns"
                                        placeholder="xxx/xx/xxx.xx.x.xxx/xxxx" />
                                </div>
                                <div class="mb-1">
                                    <label class="form-label" for="tanggal_sk_sdns">Tanggal SK</label>
                                    <input type="text" id="tanggal_sk_sdns" name="tanggal_sk_sdns"
                                        class="form-control flatpickr-basic flatpickr-input " placeholder="YYYY-MM-DD" />
                                </div>
                            </div>
                            <div id="tempat_lahirs" class="d-none">
                                <div class="mb-1">
                                    <label class="form-label" for="tempat_lahir_benartl">Tempat Lahir yang
                                        Benar</label>
                                    <input type="text" class="form-control dt-full-name" id="tempat_lahir_benartl"
                                        name="tempat_lahir_benartl" placeholder="Ponorogo" />
                                </div>
                                <div class="mb-1">
                                    <label class="form-label" for="tempat_lahir_salahtl">Tempat Lahir yang
                                        Salah</label>
                                    <input type="text" class="form-control dt-full-name" id="tempat_lahir_salahtl"
                                        name="tempat_lahir_salahtl" placeholder="Madiun" />
                                </div>
                                <div class="mb-1">
                                    <label class="form-label" for="dispendukcapiltl">Kantor Dispendukcapil</label>
                                    <input type="text" class="form-control dt-full-name" id="dispendukcapiltl"
                                        name="dispendukcapiltl" placeholder="Kabupaten Ponorogo" />
                                </div>
                                <div class="mb-1">
                                    <label class="form-label" for="nomor_aktatl">Nomor Akta Kelahiran</label>
                                    <input type="text" class="form-control dt-full-name" id="nomor_aktatl"
                                        name="nomor_aktatl" placeholder="AL 7xxxxxxxxx" />
                                </div>
                                <div class="mb-1">
                                    <label class="form-label" for="tanggal_aktatl">Tanggal Akta</label>
                                    <input type="text" id="tanggal_aktatl" name="tanggal_aktatl"
                                        class="form-control flatpickr-basic flatpickr-input " placeholder="YYYY-MM-DD" />
                                </div>
                            </div>
                            <div id="tanggal_lahirs" class="d-none">
                                <div class="mb-1">
                                    <label class="form-label" for="tanggal_lahir_benartgl">Tanggal Lahir yang
                                        benar</label>
                                    <input type="text" id="tanggal_lahir_benartgl" name="tanggal_lahir_benartgl"
                                        class="form-control flatpickr-basic flatpickr-input " placeholder="YYYY-MM-DD" />
                                </div>
                                <div class="mb-1">
                                    <label class="form-label" for="tanggal_lahir_salahtgl">Tanggal Lahir yang
                                        salah</label>
                                    <input type="text" id="tanggal_lahir_salahtgl" name="tanggal_lahir_salahtgl"
                                        class="form-control flatpickr-basic flatpickr-input " placeholder="YYYY-MM-DD" />
                                </div>
                                <div class="mb-1">
                                    <label class="form-label" for="dispendukcapiltgl">Kantor Dispendukcapil</label>
                                    <input type="text" class="form-control dt-full-name" id="dispendukcapiltgl"
                                        name="dispendukcapiltgl" placeholder="Kabupaten Ponorogo" />
                                </div>
                                <div class="mb-1">
                                    <label class="form-label" for="nomor_aktatgl">Nomor Akta Kelahiran</label>
                                    <input type="text" class="form-control dt-full-name" id="nomor_aktatgl"
                                        name="nomor_aktatgl" placeholder="AL 7xxxxxxxxx" />
                                </div>
                                <div class="mb-1">
                                    <label class="form-label" for="tanggal_aktatgl">Tanggal Akta</label>
                                    <input type="text" id="tanggal_aktatgl" name="tanggal_aktatgl"
                                        class="form-control flatpickr-basic flatpickr-input " placeholder="YYYY-MM-DD" />
                                </div>
                            </div>
                            <div id="nama_walis" class="d-none">
                                <div class="mb-1">
                                    <label class="form-label" for="nama_wali_benarnw">Nama Orang Tua/Wali yang
                                        benar</label>
                                    <input type="text" class="form-control dt-full-name" id="nama_wali_benarnw"
                                        name="nama_wali_benarnw" placeholder="Yusnaidi" />
                                </div>
                                <div class="mb-1">
                                    <label class="form-label" for="nama_wali_salahnw">Nama Orang Tua/Wali yang
                                        salah</label>
                                    <input type="text" class="form-control dt-full-name" id="nama_wali_salahnw"
                                        name="nama_wali_salahnw" placeholder="Jusnaidi" />
                                </div>
                                <div class="mb-1">
                                    <label class="form-label" for="dispendukcapilnw">Kantor Dispendukcapil</label>
                                    <input type="text" class="form-control dt-full-name" id="dispendukcapilnw"
                                        name="dispendukcapilnw" placeholder="Kabupaten Ponorogo" />
                                </div>
                                <div class="mb-1">
                                    <label class="form-label" for="nomor_aktanw">Nomor Akta Kelahiran</label>
                                    <input type="text" class="form-control dt-full-name" id="nomor_aktanw"
                                        name="nomor_aktanw" placeholder="AL 7xxxxxxxxx" />
                                </div>
                                <div class="mb-1">
                                    <label class="form-label" for="tanggal_aktanw">Tanggal Akta</label>
                                    <input type="text" id="tanggal_aktanw" name="tanggal_aktanw"
                                        class="form-control flatpickr-basic flatpickr-input " placeholder="YYYY-MM-DD" />
                                </div>
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
        @foreach ($fixing as $item)
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

    <script src="{{ asset('assets/js/scripts/tables/student/table-student-fixing-datatables.js') }}"></script>
    <script>
        var type = $('#id_type');
        var skki = $('#skki');
        var sih = $('#sih');
        var tipe_kesalahan = $('#tipe_kesalahan');
        var nama_siswa = $('#nama_siswas');
        var tempat_lahir = $('#tempat_lahirs');
        var tanggal_lahir = $('#tanggal_lahirs');
        var nama_wali = $('#nama_walis');
        type.change(
            function() {
                if (type.val() == 1) {
                    skki.removeClass('d-none');
                    sih.addClass('d-none');
                } else if (type.val() == 2) {
                    skki.addClass('d-none');
                    sih.removeClass('d-none');
                }
            }
        )
        tipe_kesalahan.change(
            function() {
                if (tipe_kesalahan.val() == 1) {
                    nama_siswa.removeClass('d-none');
                    tempat_lahir.addClass('d-none');
                    tanggal_lahir.addClass('d-none');
                    nama_wali.addClass('d-none');
                } else if (tipe_kesalahan.val() == 2) {
                    nama_siswa.addClass('d-none');
                    tempat_lahir.removeClass('d-none');
                    tanggal_lahir.addClass('d-none');
                    nama_wali.addClass('d-none');
                } else if (tipe_kesalahan.val() == 3) {
                    nama_siswa.addClass('d-none');
                    tempat_lahir.addClass('d-none');
                    tanggal_lahir.removeClass('d-none');
                    nama_wali.addClass('d-none');
                } else if (tipe_kesalahan.val() == 4) {
                    nama_siswa.addClass('d-none');
                    tempat_lahir.addClass('d-none');
                    tanggal_lahir.addClass('d-none');
                    nama_wali.removeClass('d-none');
                }
            }
        )
    </script>
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
@endsection
