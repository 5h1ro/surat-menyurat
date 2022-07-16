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
    @csrf
@endsection

@section('title')
    <div class="content-header-left col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-6">
                <h2 class="content-header-title float-start mb-0">Perbaikan Surat</h2>
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
        <input type="hidden" id="acc" value="{{ $acc }}" />
        <input type="hidden" id="not_acc" value="{{ $not_acc }}" />
        <div class=" row">
            <div class="col-12">
                <div class="card">
                    <table class="datatables-basic table">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>ID</th>
                                <th>Tanggal Permohonan</th>
                                <th>Kode Nomor Agenda</th>
                                <th>Pemohon</th>
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
        @foreach ($fixing as $item)
            <div class="modal fade" id="detail{{ $item->id }}" tabindex="-1" aria-labelledby="detailTitle"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailTitle">Detail Surat</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                <h5 class="mb-75">Pemohon</h5>
                                <p class="card-text">{{ $item->sender }}</p>
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
        @foreach ($fixing as $item)
            <div class="modal fade text-start" id="update{{ $item->id }}" tabindex="-1"
                aria-labelledby="myModalLabel33" aria-hidden="true">

                <div class="modal-dialog sidebar-sm">
                    <form class="add-new-record modal-content pt-0" method="POST"
                        action="{{ route('admin.perbaikansurat.upload', $item->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header mb-1">
                            <h5 class="modal-title" id="exampleModalLabel">Data Baru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body flex-grow-1">
                            <div class="mb-1">
                                <label class="form-label" for="letter">Scan Surat</label>
                                <input class="form-control" type="file" id="letter" name="letter">
                            </div>
                            <button type="submit" class="btn btn-primary data-submit me-1">Submit</button>
                            <button type="reset" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
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

    <script src="{{ asset('assets/js/scripts/tables/admin/table-admin-fixing-datatables.js') }}"></script>
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
                ajax: "{{ url('api/admin/perbaikan-surat/index/search=') }}" + value + "{{ '/' . $id }}",
                columns: [{
                        data: 'responsive_id',
                        name: 'responsive_id'
                    },
                    {
                        data: 'id'
                    },
                    {
                        data: 'id'
                    },
                    {
                        data: 'date'
                    },
                    {
                        data: 'number'
                    },
                    {
                        data: 'sender'
                    },
                    {
                        data: 'letter'
                    },
                    {
                        data: 'letter'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'id'
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
                        targets: 6,
                        render: function(data) {
                            return (
                                '<a href="' +
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
                        targets: 7,
                        visible: false
                    },
                    {
                        // Label
                        targets: -2,
                        render: function(data, type, full, meta) {
                            var $status_number = full['status'];
                            var $status = {
                                0: {
                                    title: 'Belum Diverifikasi',
                                    class: 'badge-light-warning'
                                },
                                1: {
                                    title: 'Tidak Terverifikasi',
                                    class: 'badge-light-danger'
                                },
                                2: {
                                    title: 'Terverifikasi',
                                    class: 'badge-light-success'
                                },
                                3: {
                                    title: 'Disetujui',
                                    class: 'badge-light-success'
                                },
                                4: {
                                    title: 'Tidak Disetujui',
                                    class: 'badge-light-danger'
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
                            var status = full['admin'];
                            console.log(status);
                            const head = '<div class="d-inline-flex">' +
                                '<a class="pe-1 dropdown-toggle hide-arrow text-primary" data-bs-toggle="dropdown">' +
                                feather.icons['more-vertical'].toSvg({
                                    class: 'font-small-4'
                                }) +
                                '</a>' +
                                '<div class="dropdown-menu dropdown-menu-end">' +
                                '<a href="' +
                                acc +
                                '/' +
                                data +
                                '" class="dropdown-item delete-record">' +
                                feather.icons['check'].toSvg({
                                    class: 'font-small-4 me-50'
                                }) +
                                'Terverifikasi</a>' +
                                '<a href="' +
                                not_acc +
                                '/' +
                                data +
                                '" class="dropdown-item delete-record">' +
                                feather.icons['x'].toSvg({
                                    class: 'font-small-4 me-50'
                                }) +
                                'Tidak Terverifikasi</a>' +
                                '</div>' +
                                '</div>' +
                                '<a href="" class="item-edit pe-1" data-bs-toggle="modal" data-bs-target="#detail' +
                                data +
                                '">' +
                                feather.icons['info'].toSvg({
                                    class: 'font-small-4'
                                }) +
                                '</a>' +
                                '<a href="" class="item-edit" data-bs-toggle="modal" data-bs-target="#update' +
                                data +
                                '">' +
                                feather.icons['plus-circle'].toSvg({
                                    class: 'font-small-4'
                                }) +
                                '</a>';

                            const nonhaead = '<div class="d-inline-flex">' +
                                '<a href="" class="item-edit pe-1" data-bs-toggle="modal" data-bs-target="#detail' +
                                data +
                                '">' +
                                feather.icons['info'].toSvg({
                                    class: 'font-small-4'
                                }) +
                                '</a>' +
                                '<a href="" class="item-edit" data-bs-toggle="modal" data-bs-target="#update' +
                                data +
                                '">' +
                                feather.icons['plus-circle'].toSvg({
                                    class: 'font-small-4'
                                }) +
                                '</a>';

                            if (status == 1) {
                                return (
                                    head
                                );
                            } else {
                                return (
                                    nonhaead
                                );
                            }

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
                }],
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
            $('div.head-label').html('<h6 class="mb-0">Data Perbaikan Surat</h6>');
        }
    </script>
@endsection
