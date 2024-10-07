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
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $num = 1;
                                @endphp
                                @forelse ($allusers as $user)
                                    <tr>
                                        <td>{{ $num++ }}</td>
                                        <td>{{ ucfirst($user->first_name) }} {{ ucfirst($user->last_name) }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->is_admin == 1)
                                                <span class="badge bg-info">Admin</span>
                                            @else
                                                <span class="badge bg-secondary">User</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $user->is_active == 1 ? 'primary' : 'danger' }}"
                                                id="get_status">{{ $user->is_active == 1 ? 'Active' : 'In-active' }}</span>
                                        </td>
                                        <td>
                                            <button
                                                class="btn btn-sm btn-{{ $user->is_active == 0 ? 'primary' : 'danger' }}"
                                                data-id="{{ $user->id }}"
                                                id="changeStatus">{{ $user->is_active == 0 ? 'Active' : 'In-active' }}</button>
                                            <button class="btn btn-danger btn-sm" onclick="deleteData(this, '/delete_user', {{ $user->id }}, 'User')"><i
                                                    class="fas fa-trash"></i> Delete</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center fw-bold">
                                        <th colspan="6"> <img src="{{ asset('admin/images/no-data.png') }}" alt="img"
                                                class="img-fluid"></th>
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
            $(document).on("click", "#changeStatus", function(stop) {
                stop.preventDefault();
                var id = $(this).attr("data-id");
                var button = $(this);
                const getButton = this;
                getButton.innerHTML =
                    "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>";
                getButton.setAttribute("disabled", "disabled");
                $.ajax({
                    url: `{{ url('change_status/${id}') }}`,
                    method: "GET",
                    success: function(response) {
                        if (response.message == 200) {
                            if (response.data.is_active == 0) {
                                getButton.removeAttribute('disabled');
                                button.html("");
                                button.html("Active");
                                button.removeClass("btn-danger").addClass("btn-primary");
                                button.closest("tr").find("#get_status").html("");
                                button.closest("tr").find("#get_status").html("In-active");
                                button.closest("tr").find("#get_status").removeClass(
                                    "bg-primary").addClass("bg-danger");
                            } else {
                                getButton.removeAttribute('disabled');
                                button.html("");
                                button.html("In-active");
                                button.removeClass("btn-primary").addClass("btn-danger");
                                button.closest("tr").find("#get_status").html("");
                                button.closest("tr").find("#get_status").html("Active");
                                button.closest("tr").find("#get_status").removeClass(
                                    "bg-danger").addClass("bg-primary");
                            }
                        }
                    }
                })
            })
        })
    </script>
@endsection
