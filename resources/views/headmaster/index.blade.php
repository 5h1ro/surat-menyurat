@extends('layouts.admin.master')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css') }}/style.css">
@endsection

@section('title')
@endsection

@section('content')
    <!-- Dashboard Ecommerce Starts -->
    <section id="dashboard-ecommerce">
        <div class="row match-height">
            <img src="{{ asset('assets/images/dashboard.jpg') }}">
        </div>
    </section>
    <!-- Dashboard Ecommerce ends -->
@endsection

@section('script')
    <script src="{{ asset('assets/js') }}/scripts/pages/dashboard-ecommerce.js"></script>
@endsection
