@extends('layouts.admin.master')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css') }}/style.css">
@endsection

@section('title')
@endsection

@section('content')
    <div class="card card-statistics">
        <div class="card-header">
            <h4 class="card-title">Jumlah Surat</h4>
        </div>
        <div class="card-body statistics-body">
            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                    <div class="d-flex flex-row">
                        <div class="me-2">
                            <div>
                                <img src="{{ asset('assets/images/icons/dashboard_icons/disposisi.png') }}"
                                    style="width: 35px" height="35px">
                            </div>
                        </div>
                        <div class="my-auto">
                            <h4 class="fw-bolder mb-0"><span>{{ $surat_masuk }}</span></h4>
                            <p class="card-text font-small-3 mb-0">Surat Disposisi</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                    <div class="d-flex flex-row">
                        <div class="me-2">
                            <div>
                                <img src="{{ asset('assets/images/icons/dashboard_icons/keluar.png') }}"
                                    style="width: 30px" height="30px">
                            </div>
                        </div>
                        <div class="my-auto">
                            <h4 class="fw-bolder mb-0"><span>{{ $surat_keluar }}</span></h4>
                            <p class="card-text font-small-3 mb-0">Surat Keluar</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js') }}/scripts/pages/dashboard-ecommerce.js"></script>
@endsection
