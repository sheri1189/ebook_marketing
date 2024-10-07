@extends('layouts.app')
@section('title', 'Subscriptions')
@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Subscriptions</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('subscriptions') }}">Subscriptions</a></li>
                            <li class="breadcrumb-item active">Manage</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="card-title mb-0">All Customers</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="example2" class="table table-striped table-bordered" style="width:100%">
                            <thead class="text-muted table-light">
                                <tr>
                                    <th data-ordering="false">Sr No</th>
                                    <th>Customer</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Billing</th>
                                    <th>Product</th>
                                    <th>Ends At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $num = 1;
                                @endphp
                                @forelse ($allsubscriptions as $subscriptions)
                                    <tr>
                                        <td>{{ $num++ }}</td>
                                        <td>{{ Str::ucfirst($subscriptions->first_name) }}
                                            {{ Str::ucfirst($subscriptions->last_name) }}</td>
                                        <td><span class="badge bg-primary">{{ Str::ucfirst($subscriptions->type) }}</span>
                                        </td>
                                        <td><span
                                                class="badge bg-{{ $subscriptions->ends_at == '' ? 'success' : 'danger' }}">{{ $subscriptions->ends_at == '' ? Str::ucfirst($subscriptions->stripe_status) : 'Cancle' }}</span>
                                        </td>
                                        <td>{{ __("$") }}
                                            {{ number_format($subscriptions->price, 2) }}
                                        </td>
                                        <td>{{ Str::ucfirst($subscriptions->name) }}</td>
                                        <td>{{ date('d M, Y H:i', strtotime($subscriptions->trial_ends_at)) }}</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a href="{{ url('subscription/details/' . $subscriptions->user_id) }}"
                                                            class="dropdown-item edit-item-btn" style="cursor: pointer;"><i
                                                                class="fas fa-eye me-2 text-muted"></i>
                                                            View Details</a></li>
                                                    <li>
                                                        @if (Auth::user()->is_admin != 1)
                                                            <a class="dropdown-item remove-item-btn renew"
                                                                data-renew="{{ $subscriptions->trial_ends_at }}"
                                                                style="cursor: pointer;">
                                                                <i class="fas fa-sync me-2 text-muted"></i>
                                                                {{ __('Renew') }}
                                                            </a>
                                                        @endif
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center fw-bold">
                                        <th colspan="8"> <img src="{{ asset('admin/images/no-data.png') }}"
                                                alt="img" class="img-fluid"></th>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $(document).on("click", ".renew", function(event) {
                event.preventDefault();
                var trial_ends_at = $(this).attr("data-renew");
                var formData = new FormData();
                formData.append("trial_ends_at", trial_ends_at),
                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                    });
                $.ajax({
                    url: `{{ url('/subscription/renew/${trial_ends_at}') }}`,
                    method: "POST",
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(response) {
                        if (response.message == 200) {
                            Swal.fire({
                                toast: true,
                                icon: "success",
                                title: "New Subscription Added Successfully..!",
                                animation: false,
                                position: "top-right",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                            location.reload(true);
                        } else {
                            Swal.fire({
                                toast: true,
                                icon: "error",
                                title: "Subscription not Added Successfully..!",
                                animation: false,
                                position: "top-right",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                        }
                    },
                });
            });
        });
    </script>
@endsection
