@extends('layouts.app')
@section('title', 'Plans & Pricing')
@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Plans & Pricing</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('plans') }}">Plans</a></li>
                            <li class="breadcrumb-item active">Manage</li>
                        </ol>
                    </div>

                </div>
            </div>
            <div class="col-12 d-flex justify-content-end">
                <a href="{{ url('/plans/create') }}" class="btn btn-primary">+ Add Plans</a>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-lg-5">
                <div class="text-center mb-4">
                    <h4 class="fw-semibold fs-22">Choose Your Plan</h4>
                    <p class="text-muted mb-4 fs-15">If you need more info about our pricing, please contact to Admin.</p>
                    <div class="d-inline-flex">
                        <ul class="nav nav-pills arrow-navtabs plan-nav rounded mb-3 p-1" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link fw-semibold active" data-kt-plan="month" id="monthPlan"
                                    data-bs-toggle="pill" data-bs-target="#month" type="button" role="tab"
                                    aria-selected="true">Monthly
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link fw-semibold" data-kt-plan="year" id="yearPlan"
                                    data-bs-toggle="pill" data-bs-target="#annual" type="button" role="tab"
                                    aria-selected="true" tabindex="-1">Yearly</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-10" id="allPlansData">
            @forelse ($allplans as $plans)
                <div class="col-lg-6">
                    <div class="card pricing-box ribbon-box ribbon-fill text-center">
                        <div class="ribbon ribbon-primary">New</div>
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body h-100">
                                    <div>
                                        <h5 class="mb-1">{{ Str::ucfirst($plans->name) }}</h5>
                                        <p class="text-muted">{{ $plans->description }}</p>
                                    </div>

                                    <div class="py-4">
                                        <h2><sup><small>{{ __("$") }}</small></sup>{{ $plans->price }} <span
                                                class="fs-13 text-muted">/Per
                                                {{ Str::ucfirst($plans->billing_period) }}</span>
                                        </h2>
                                    </div>

                                    <div class="text-center plan-btn mt-2">
                                        <button class="btn btn-soft-danger waves-effect waves-light  delete"
                                            data-del="{{ $plans->id }}"><i class="fas fa-trash"></i> Delete</button>
                                        <a href="{{ url('/plans/edit/' . $plans->id) }}"
                                            class="btn btn-soft-primary waves-effect waves-light"><i
                                                class="fas fa-edit"></i> Edit</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card-body border-start mt-4 mt-lg-0">
                                    <div class="card-header bg-light">
                                        <h5 class="fs-15 mb-0">Plan Features:</h5>
                                    </div>
                                    <div class="card-body pb-0">
                                        <ul class="list-unstyled vstack gap-3 mb-0">
                                            @php
                                                $features = unserialize($plans->slug);
                                            @endphp
                                            @foreach ($features as $feature)
                                                <li><span class="text-success fw-semibold">{{ $feature }}</span></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-6 mx-auto">
                    <div class="card-body d-flex flex-center flex-column">
                        <img src="{{ asset('admin/images/no-data.png') }}" alt="img" class="img-fluid">
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $(document).on("click", "#monthPlan, #yearPlan", function(event) {
                event.preventDefault();
                var value = $(this).attr("data-kt-plan");

                $.ajax({
                    url: `{{ url('/plans_filteration/${value}') }}`,
                    method: "GET",
                    success: function(response) {
                        $("#allPlansData").fadeOut().empty();
                        var baseURL = `{{ url('') }}`;

                        if (response.allplans.length === 0) {
                            var noDataHtml = `
                <div class="col-6 mx-auto">
                    <div class="card-body d-flex flex-center flex-column">
                        <img src="{{ asset('admin/images/no-data.png') }}" alt="No Data" class="img-fluid">
                    </div>
                </div>`;
                            $("#allPlansData").append(noDataHtml);
                        } else {
                            response.allplans.forEach(function(plan) {
                                var features = response.plan_slugs[plan.id].map(
                                    feature =>
                                    `<li><span class="text-success fw-semibold">${feature}</span></li>`
                                ).join('');

                                var html = `
                    <div class="col-lg-6">
                        <div class="card pricing-box ribbon-box ribbon-fill text-center">
                            <div class="ribbon ribbon-primary">New</div>
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="card-body h-100">
                                        <div>
                                            <h5 class="mb-1">${plan.name}</h5>
                                            <p class="text-muted">${plan.description}</p>
                                        </div>
                                        <div class="py-4">
                                            <h2>
                                                <sup><small>$</small></sup>${plan.price}
                                                <span class="fs-13 text-muted">/Per ${plan.billing_period}</span>
                                            </h2>
                                        </div>
                                        <div class="text-center plan-btn mt-2">
                                            <button class="btn btn-soft-danger waves-effect waves-light delete" data-del="${plan.id}">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                             <a href="${baseURL}/plans/edit/${plan.id}" class="btn btn-soft-primary waves-effect waves-light mt-2">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card-body border-start mt-4 mt-lg-0">
                                        <div class="card-header bg-light">
                                            <h5 class="fs-15 mb-0">Plan Features:</h5>
                                        </div>
                                        <div class="card-body pb-0">
                                            <ul class="list-unstyled vstack gap-3 mb-0">
                                                ${features}
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;

                                $("#allPlansData").append(html);
                            });
                        }
                        $("#allPlansData").fadeIn();
                    }
                });
            });


            $(document).on("click", ".delete", function(event) {
                event.preventDefault();
                var id = $(this).data("del");
                var button = $(this);

                button.html(
                    "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Processing..."
                );
                button.prop("disabled", true);
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `{{ url('/plans/delete/${id}') }}`,
                            method: "DELETE",
                            success: function(response) {
                                if (response.message == 200) {
                                    button.html(
                                        "<i class='fas fa-trash me-2'></i> Delete");
                                    button.prop("disabled", false);
                                    Swal.fire({
                                        toast: true,
                                        icon: "success",
                                        title: "Plan Deleted Successfully..!",
                                        animation: false,
                                        position: "top-right",
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true,
                                    });
                                    location.reload(true);
                                } else {
                                    button.html(
                                        "<i class='fas fa-trash me-2'></i> Delete");
                                    button.prop("disabled", false);
                                    Swal.fire({
                                        toast: true,
                                        icon: "error",
                                        title: "Something Went Wrong..!",
                                        animation: false,
                                        position: "top-right",
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true,
                                    });
                                }
                            },
                            error: function(error) {
                                console.log("Error deleting item: ", error);
                                button.html("<i class='fas fa-trash me-2'></i> Delete");
                                button.prop("disabled", false);
                            }
                        })
                    } else if (result.dismiss === Swal.DismissReason.cancel)
                        button.html("<i class='fas fa-trash me-2'></i> Delete");
                    button.prop("disabled", false);
                });
            })
        })
    </script>
@endsection
