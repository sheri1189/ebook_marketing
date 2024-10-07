@extends('layouts.app')
@section('title', 'Rapid Creator')
@section('main-content')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
                <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                        <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                            Plans
                        </h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ url('/dashbaord') }}" class="text-muted text-hover-primary">
                                    Home </a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-500 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">
                                Plan Deatils </li>
                        </ul>
                    </div>
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-arrow-left"></i> Go Back
                        </a>
                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content  flex-column-fluid ">
                <div id="kt_app_content_container" class="app-container  container-xxl ">
                    <div class="row g-10">
                        <div class="col-xl-6 mx-auto">
                            <div class="d-flex h-100 align-items-center">
                                <div
                                    class="w-100 d-flex flex-column flex-center rounded-3 bg-secondary bg-opacity-75 py-15 px-10">
                                    <div class="mb-7 text-center">
                                        <h1 class="text-gray-900 mb-5 fw-bolder">
                                            {{ Str::ucfirst($plans->name) }}</h1>
                                        <div class="text-gray-600 fw-semibold mb-5">
                                            {{ $plans->description }}
                                        </div>
                                        <div class="text-center">
                                            <span class="mb-2 text-primary">{{ $plans->currency }}</span>
                                            <span class="fs-3x fw-bold text-primary">
                                                {{ $plans->price }} </span>
                                            <span class="fs-7 fw-semibold opacity-50">/
                                                <span
                                                    data-kt-element="period">{{ Str::ucfirst($plans->billing_period) }}</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="w-100 mb-10">
                                        @php
                                            $unserializeslugs = unserialize($plans->slug);
                                        @endphp
                                        @foreach ($unserializeslugs as $unserslugs)
                                            <div class="d-flex align-items-center mb-5">
                                                <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">
                                                    {{ Str::ucfirst($unserslugs) }} </span>
                                                <i class="fas fa-check-circle fs-3 text-success"><span
                                                        class="path1"></span><span class="path2"></span></i>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="kt_app_footer" class="app-footer mt-5 bg-white">
            <div class="app-container  container-fluid py-3 ">
                <div class="text-gray-900 order-2 order-md-1">
                    <div class="row">
                        <div class="col-12 text-center">
                            <span class="text-muted fw-semibold me-1">© Copyright {{ date('Y') }} <a
                                    href="https://ibexstack.com/live/" target="_blank">Ibexstack</a>. All rights
                                reserved.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
