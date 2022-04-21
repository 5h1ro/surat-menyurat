@extends('layouts.admin.master')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css') }}/style.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/plugins/extensions/ext-component-toastr.css">
@endsection

@section('title')
    <h2>Setting</h2>
@endsection

@section('content')
    <div class="row justify-content-center" style="height: 75vh">
        <div class="col-lg-6 align-self-center ">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Setting</h4>
                </div>
                <div class="card-body">
                    <form class="form form-horizontal" method="POST" action="{{ route('admin.pengaturan.edit') }}">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="incoming_start">Awal Surat Masuk</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="number" id="incoming_start" class="form-control"
                                            name="incoming_start" value="{{ $setup->incoming_start }}" min="0">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="outgoing_start">Awal Surat Keluar</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="number" id="outgoing_start" class="form-control"
                                            name="outgoing_start" value="{{ $setup->outgoing_start }}" min="0">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="periode">Periode</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="periode" class="form-control" name="periode"
                                            value="{{ $setup->periode }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit"
                                    class="btn btn-primary me-1 waves-effect waves-float waves-light">Submit</button>
                                <button type="reset" class="btn btn-outline-secondary waves-effect">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
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
