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
    <div class="content-header-left col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-6">
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
            <div class="col-6">
                <div class="d-flex col-12 justify-content-end">
                    <div class="col-auto">
                        <input class="form-control" type="text" name="search" id="search">
                    </div>
                    <div class="col-auto ms-2">
                        <button class="btn btn-primary data-submit me-1" onclick="search()">Search</button>
                    </div>
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
    <script>
        function search() {
            var value = $('#search').val();
            if (!value) {
                value = 'null';
            }
            $('.datatables-basic').DataTable().destroy();
            $('.datatables-basic').DataTable({
                paging: true,
                processing: true,
                serverSide: true,
                ajax: "{{ url('api/admin/surat-masuk/index/search=') }}" + value,
                columns: [{
                        data: 'responsive_id',
                        name: 'responsive_id'
                    },
                    {
                        data: 'number'
                    },
                    {
                        data: 'number'
                    },
                    {
                        data: 'date'
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'number_encrypt'
                    },
                    {
                        data: 'letter'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'number_md5'
                    },
                ],
                columnDefs: [{
                        // For Responsive
                        className: 'control',
                        orderable: false,
                        responsivePriority: 2,
                        targets: 0
                    },
                    {
                        // For Checkboxes
                        targets: 1,
                        orderable: false,
                        responsivePriority: 3,
                        render: function(data, type, full, meta) {
                            return (
                                '<div class="form-check"> <input class="form-check-input dt-checkboxes" type="checkbox" value="" id="checkbox' +
                                data +
                                '" /><label class="form-check-label" for="checkbox' +
                                data +
                                '"></label></div>'
                            );
                        },
                        checkboxes: {
                            selectAllRender: '<div class="form-check"> <input class="form-check-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="form-check-label" for="checkboxSelectAll"></label></div>'
                        }
                    },
                    {
                        targets: 2,
                        visible: false
                    },
                    {
                        targets: 5,
                        render: function(data) {
                            return (
                                '<a href="' +
                                read +
                                '/' +
                                data +
                                '" class="btn btn-primary waves-effect waves-float waves-light" target="_blank">' +
                                feather.icons['mail'].toSvg({
                                    class: 'font-small-4'
                                }) +
                                '</a>'
                            )
                        }
                    },
                    {
                        targets: 6,
                        visible: false
                    },
                    {
                        // Label
                        targets: -2,
                        render: function(data, type, full, meta) {
                            var $status_number = full['status'];
                            var $status = {
                                0: {
                                    title: 'Belum Dibaca',
                                    class: 'badge-light-warning'
                                },
                                1: {
                                    title: 'Sudah Dibaca',
                                    class: 'badge-light-success'
                                },
                            };
                            if (typeof $status[$status_number] === 'undefined') {
                                return data;
                            }
                            return (
                                '<span class="badge rounded-pill ' +
                                $status[$status_number].class +
                                '">' +
                                $status[$status_number].title +
                                '</span>'
                            );
                        }
                    },
                    {
                        // Actions
                        targets: -1,
                        title: 'Actions',
                        orderable: false,
                        render: function(data, type, full, meta) {
                            return (
                                '<div class="d-inline-flex">' +
                                '<a class="pe-1 dropdown-toggle hide-arrow text-primary" data-bs-toggle="dropdown">' +
                                feather.icons['more-vertical'].toSvg({
                                    class: 'font-small-4'
                                }) +
                                '</a>' +
                                '<div class="dropdown-menu dropdown-menu-end">' +
                                '<a class="dropdown-item delete-record" onclick="remove(' +
                                '/' +
                                full['number_encrypt'] +
                                '/)">' +
                                feather.icons['trash-2'].toSvg({
                                    class: 'font-small-4 me-50'
                                }) +
                                'Delete</a>' +
                                '</div>' +
                                '</div>' +
                                '<a href="" class="item-edit" data-bs-toggle="modal" data-bs-target="#detail' +
                                data +
                                '">' +
                                feather.icons['info'].toSvg({
                                    class: 'font-small-4'
                                }) +
                                '</a>'
                            );
                        }
                    }
                ],
                order: [
                    [2, 'desc']
                ],
                dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                displayLength: 7,
                lengthMenu: [7, 10, 25, 50, 75, 100],
                buttons: [{
                        extend: 'collection',
                        className: 'btn btn-outline-secondary dropdown-toggle me-2',
                        text: feather.icons['share'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Export',
                        buttons: [{
                                extend: 'print',
                                text: feather.icons['printer'].toSvg({
                                    class: 'font-small-4 me-50'
                                }) + 'Print',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [3, 4, 5, 7]
                                }
                            },
                            {
                                extend: 'csv',
                                text: feather.icons['file-text'].toSvg({
                                    class: 'font-small-4 me-50'
                                }) + 'Csv',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [3, 4, 5, 7]
                                }
                            },
                            {
                                extend: 'excel',
                                text: feather.icons['file'].toSvg({
                                    class: 'font-small-4 me-50'
                                }) + 'Excel',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [3, 4, 5, 7]
                                }
                            },
                            {
                                extend: 'pdf',
                                text: feather.icons['clipboard'].toSvg({
                                    class: 'font-small-4 me-50'
                                }) + 'Pdf',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [3, 4, 5, 7]
                                }
                            },
                            {
                                extend: 'copy',
                                text: feather.icons['copy'].toSvg({
                                    class: 'font-small-4 me-50'
                                }) + 'Copy',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [3, 4, 5, 7]
                                }
                            }
                        ],
                        init: function(api, node, config) {
                            $(node).removeClass('btn-secondary');
                            $(node).parent().removeClass('btn-group');
                            setTimeout(function() {
                                $(node).closest('.dt-buttons').removeClass('btn-group').addClass(
                                    'd-inline-flex');
                            }, 50);
                        }
                    },
                    {
                        text: feather.icons['plus'].toSvg({
                            class: 'me-50 font-small-4'
                        }) + 'Tambah Data',
                        className: 'create-new btn btn-primary',
                        attr: {
                            'data-bs-toggle': 'modal',
                            'data-bs-target': '#modals-slide-in'
                        },
                        init: function(api, node, config) {
                            $(node).removeClass('btn-secondary');
                        }
                    }
                ],
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal({
                            header: function(row) {
                                var data = row.data();
                                return 'Details of ' + data['full_name'];
                            }
                        }),
                        type: 'column',
                        renderer: function(api, rowIdx, columns) {
                            var data = $.map(columns, function(col, i) {
                                return col.title !==
                                    '' // ? Do not show row in modal popup if title is blank (for check box)
                                    ?
                                    '<tr data-dt-row="' +
                                    col.rowIdx +
                                    '" data-dt-column="' +
                                    col.columnIndex +
                                    '">' +
                                    '<td>' +
                                    col.title +
                                    ':' +
                                    '</td> ' +
                                    '<td>' +
                                    col.data +
                                    '</td>' +
                                    '</tr>' :
                                    '';
                            }).join('');

                            return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') :
                                false;
                        }
                    }
                },
                language: {
                    paginate: {
                        // remove previous & next text from pagination
                        previous: '&nbsp;',
                        next: '&nbsp;'
                    }
                }
            });
            $('div.head-label').html('<h6 class="mb-0">Data Surat Masuk</h6>');
        }
    </script>
@endsection
