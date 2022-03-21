$(document).ready(function () {
    'use strict';

    var dt_basic_table = $('.datatables-basic'),
        assetPath = $('#link').attr('value'),
        read = $('#read').attr('value');

    if (dt_basic_table.length) {
        console.log(assetPath);
        $('.datatables-basic').DataTable({
            paging: true,
            processing: true,
            serverSide: true,
            ajax: assetPath,
            columns: [
                { data: 'responsive_id', name: 'responsive_id' },
                { data: 'id' },
                { data: 'id' },
                { data: 'incoming.title' },
                { data: 'teachers' },
                { data: 'staffs' },
                { data: 'id' },
                { data: 'letter' },
                { data: 'status' },
                { data: 'information' },
                { data: 'letter' },
            ],
            columnDefs: [
                {
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
                    render: function (data, type, full, meta) {
                        return (
                            '<div class="form-check"> <input class="form-check-input dt-checkboxes" type="checkbox" value="" id="checkbox' +
                            data +
                            '" /><label class="form-check-label" for="checkbox' +
                            data +
                            '"></label></div>'
                        );
                    },
                    checkboxes: {
                        selectAllRender:
                            '<div class="form-check"> <input class="form-check-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="form-check-label" for="checkboxSelectAll"></label></div>'
                    }
                },
                {
                    targets: 2,
                    visible: false
                },
                {
                    targets: 4,
                    defaultContent: "Belum Diteruskan",
                },
                {
                    targets: 5,
                    defaultContent: "Belum Diteruskan",
                },
                {
                    targets: 6,
                    render: function (data) {
                        return (
                            '<a href="' +
                            read +
                            '/' +
                            data +
                            '" class="btn btn-primary waves-effect waves-float waves-light" target="_blank">' +
                            feather.icons['mail'].toSvg({ class: 'font-small-4' }) +
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
                    targets: -3,
                    render: function (data, type, full, meta) {
                        var $status_number = full['status'];
                        var $status = {
                            0: { title: 'Belum Diputuskan', class: 'badge-light-warning' },
                            1: { title: 'Diterima', class: 'badge-light-success' },
                            2: { title: 'Tidak Diterima', class: 'badge-light-danger' },
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
                    // Label
                    targets: -2,
                    render: function (data, type, full, meta) {
                        var $status_number = full['information'];
                        var $status = {
                            1: { title: 'Rahasia', class: 'badge-light-danger' },
                            2: { title: 'Penting', class: 'badge-light-warning' },
                            3: { title: 'Rutin', class: 'badge-light-blue' },
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
                    render: function (data, type, full, meta) {
                        var id = full['id'];
                        return (
                            '<a href="' +
                            data +
                            '" class="item-edit pe-1" target="_blank">' +
                            feather.icons['printer'].toSvg({ class: 'font-small-4' }) +
                            '</a>' +
                            '<a href="" class="item-edit" data-bs-toggle="modal" data-bs-target="#update' +
                            id +
                            '">' +
                            feather.icons['plus-circle'].toSvg({ class: 'font-small-4' }) +
                            '</a>'
                        );
                    }
                }
            ],
            order: [[2, 'desc']],
            dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 7,
            lengthMenu: [7, 10, 25, 50, 75, 100],
            buttons: [
                {
                    extend: 'collection',
                    className: 'btn btn-outline-secondary dropdown-toggle me-2',
                    text: feather.icons['share'].toSvg({ class: 'font-small-4 me-50' }) + 'Export',
                    buttons: [
                        {
                            extend: 'print',
                            text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Print',
                            className: 'dropdown-item',
                            exportOptions: { columns: [3, 4, 5, 7] }
                        },
                        {
                            extend: 'csv',
                            text: feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) + 'Csv',
                            className: 'dropdown-item',
                            exportOptions: { columns: [3, 4, 5, 7] }
                        },
                        {
                            extend: 'excel',
                            text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
                            className: 'dropdown-item',
                            exportOptions: { columns: [3, 4, 5, 7] }
                        },
                        {
                            extend: 'pdf',
                            text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
                            className: 'dropdown-item',
                            exportOptions: { columns: [3, 4, 5, 7] }
                        },
                        {
                            extend: 'copy',
                            text: feather.icons['copy'].toSvg({ class: 'font-small-4 me-50' }) + 'Copy',
                            className: 'dropdown-item',
                            exportOptions: { columns: [3, 4, 5, 7] }
                        }
                    ],
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                        $(node).parent().removeClass('btn-group');
                        setTimeout(function () {
                            $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
                        }, 50);
                    }
                },
            ],
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return 'Details of ' + data['full_name'];
                        }
                    }),
                    type: 'column',
                    renderer: function (api, rowIdx, columns) {
                        var data = $.map(columns, function (col, i) {
                            return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                                ? '<tr data-dt-row="' +
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
                                '</tr>'
                                : '';
                        }).join('');

                        return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
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
        $('div.head-label').html('<h6 class="mb-0">Data Disposisi</h6>');
    }

});
