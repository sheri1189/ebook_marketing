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
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>

                </div>
            </div>
            <div class="col-12 d-flex justify-content-end">
                <a href="{{ url('/plans') }}" class="btn btn-primary">- Manage Plans</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-6 mx-auto">
                <div class="card">
                    <div class="card-header align-items-center d-flex pt-3">
                        <h4 class="card-title mb-0 flex-grow-1">Edit Plan</h4>
                    </div>
                    <div class="card-body">
                        <div class="live-preview">
                            <form id="form_update" class="row g-3 needs-validation" novalidate>
                                @method('PUT')
                                <div class="col-12">
                                    <label class="form-label">Plan Name *</label>
                                    <input type="hidden" id="get_url" value="{{ url('/plans/update') }}">
                                    <input type="hidden" id="id" value="{{ $plan->id }}">
                                    <input type="hidden" id="module_name" value="Plan">
                                    <input type="text" name="name" oninput="NameValidation(this)"
                                        value="{{ $plan->name }}" placeholder="Enter Plan Name" class="form-control"
                                        required autocomplete="off">
                                    <strong class="text-danger" id="name"></strong>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Facilities *</label>
                                    @php
                                        $unserializeslugs = unserialize($plan->slug);
                                        $explodeMessages = explode('-', $unserializeslugs[0]);
                                    @endphp
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="fas fa-envelope-square me-3"></i> Prompt Queries-</span>
                                        <input type="number" min="1" name="prompt_queries"
                                            oninput="FacilityValidation(this)" value="{{ $explodeMessages[1] }}"
                                            placeholder="Enter Prompt Queries" class="form-control" required autocomplete="off"
                                            aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Amount *</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">US $</span>
                                        <input type="number" name="amount" oninput="NumberValidation(this)"
                                            value="{{ $plan->price }}" placeholder="Enter Amount" class="form-control"
                                            required autocomplete="off" aria-label="Username"
                                            aria-describedby="basic-addon1">
                                    </div>
                                    <strong class="text-danger" id="amount"></strong>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Currency *</label>
                                    <input type="text" name="currency" value="{{ $plan->currency }}" class="form-control"
                                        required autocomplete="off" readonly required>
                                    <strong class="text-danger" id="currency"></strong>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Billing Period *</label>
                                    <select class="form-control" name="billing_period" autocomplete="off" required>
                                        <option value="" selected disabled>--Select Period--</option>
                                        <option value="month" {{ $plan->billing_period == 'month' ? 'selected' : '' }}>
                                            Monthly</option>
                                        <option value="year" {{ $plan->billing_period == 'year' ? 'selected' : '' }}>
                                            Yearly</option>
                                    </select>
                                    <strong class="text-danger" id="billing_period"></strong>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Plan Description *</label>
                                    <textarea name="description" rows="3" oninput="AlphaNumericValidation(this)" placeholder="Enter Plan Description"
                                        class="form-control" required autocomplete="off">{{ $plan->description }}</textarea>
                                    <strong class="text-danger" id="description"></strong>
                                </div>
                                <div class="col-6">
                                    <a href="{{ url('/plans') }}" type="submit" id="button_move"
                                        class="btn rounded-pill btn-light text-dark waves-effect waves-light">
                                        < Go back</a>
                                </div>
                                <div class="col-6 text-end">
                                    <button class="btn rounded-pill btn-primary waves-effect waves-light" type="submit"
                                        id="update">Edit Plan > </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function NameValidation(element) {
            let InputText = element.value;
            element.value = InputText.replace(/[^A-za-z0-9,-. ]/, "");
            if (element.value == InputText) {
                element.value = InputText;
            } else {
                Swal.fire({
                    toast: true,
                    icon: 'warning',
                    title: 'Number and Special Character are Not Allowed',
                    animation: false,
                    position: 'top-right',
                    showConfirmButton: false,
                    timer: 2500,
                    timeProgressBar: true,
                })
            }
        }

        function FacilityValidation(element) {
            let InputText = element.value;
            element.value = InputText.replace(/[^A-za-z0-9 ]/, "");
            if (element.value == InputText) {
                element.value = InputText;
            } else {
                Swal.fire({
                    toast: true,
                    icon: 'warning',
                    title: 'Number and Special Character are Not Allowed',
                    animation: false,
                    position: 'top-right',
                    showConfirmButton: false,
                    timer: 2500,
                    timeProgressBar: true,
                })
            }
        }

        function NumberValidation(element) {
            let InputText = element.value;
            element.value = InputText.replace(/[^0-9]/, "");
            if (element.value == InputText) {
                element.value = InputText;
            } else {
                Swal.fire({
                    toast: true,
                    icon: 'warning',
                    title: 'Alphabets and Special Characters are Not Allowed',
                    animation: false,
                    position: 'top-right',
                    showConfirmButton: false,
                    timer: 2500,
                    timeProgressBar: true,
                })
            }
        }

        function AlphaNumericValidation(element) {
            let InputText = element.value;
            element.value = InputText.replace(/[^A-Za-z0-9[$&+,:;=?@#|'<>.^*(){}%"!~\-_\] ]/g, "");
            if (element.value == InputText) {
                element.value = InputText;
            } else {
                Swal.fire({
                    toast: true,
                    icon: 'error',
                    title: 'Some Special Character Not Allowed...!',
                    animation: false,
                    position: 'top-right',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
            }
        }
    </script>
    <script>
        function previewFile(input) {
            var file = $("#file").get(0).files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $("#previewDiv").fadeIn();
                    $("#previewImg").attr("src", event.target.result);
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
