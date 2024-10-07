@extends('layouts.app')
@section('title', 'Rapid Creator')
@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Subscription</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('subscriptions') }}">Subscriptions</a></li>
                            <li class="breadcrumb-item active">Details</li>
                        </ol>
                    </div>

                </div>
            </div>
            <div class="col-12 d-flex justify-content-end mb-3">
                <a href="{{ url('/subscriptions') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Go Back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <h5 class="card-title flex-grow-1 mb-0">Customer Details</h5>
                            <div class="flex-shrink-0">
                                <span class="badge bg-info">Ends At:
                                    {{ date('d M, Y H:i', strtotime($subscription->trial_ends_at)) }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0 vstack gap-3">
                            <li>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset($subscription->picture) }}" alt=""
                                            class="avatar-sm rounded">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="fs-14 mb-1">{{ Str::ucfirst($subscription->first_name) }} {{ Str::ucfirst($subscription->first_name) }} <span class="badge bg-{{ $subscription->is_active==1?"success":"danger" }}">{{ $subscription->is_active==1?"Active":"In-active" }}</span></h6>
                                        <p class="text-muted mb-0">{{ $subscription->is_admin==1?"Admin":"User" }}</p>
                                    </div>
                                </div>
                            </li>
                            <li><i class="ri-mail-line me-2 align-middle text-muted fs-16"></i>{{ $subscription->email }}</li>
                            <li><i class="ri-phone-line me-2 align-middle text-muted fs-16"></i>{{ $subscription->contact_no }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <h5 class="card-title flex-grow-1 mb-0">Product Details</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-0">
                            <span class="badge bg-info me-2">{{ Str::ucfirst($subscription->name) }}</span>
                            <span class="fw-semibold text-gray-600">{{ __("$") }}
                                {{ number_format($subscription->price, 2) }} /
                                {{ Str::ucfirst($subscription->billing_period) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <h5 class="card-title flex-grow-1 mb-0">Payment Details</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-0">
                            <div class="fw-semibold text-gray-600 d-flex align-items-center">
                                Mastercard &nbsp;
                                <img src="{{ asset('user/images/card-logos/mastercard.svg') }}"
                                    class="avatar-sm" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h5 class="card-title flex-grow-1 mb-0">{{ Str::ucfirst($subscription->name) }}</h5>
                            <div class="flex-shrink-0">
                                <span
                                class="badge bg-{{ $subscription->ends_at == '' ? 'success' : 'danger' }}">{{ $subscription->ends_at == '' ? 'Active' : 'Cancle' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-card">
                            <table class="table table-nowrap align-middle table-borderless mb-0">
                                <thead class="table-light text-muted">
                                    <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td>{{ Str::ucfirst($subscription->name) }}</td>
                                                <td class="dt-type-numeric">{{ $subscription->quantity }}
                                                </td>
                                                <td> <span
                                                        class="fw-semibold text-gray-600">{{ __("$") }}
                                                        {{ number_format($subscription->price, 2) }} /
                                                        {{ Str::ucfirst($subscription->billing_period) }}</span>
                                                </td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
