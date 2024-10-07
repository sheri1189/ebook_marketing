@extends('layouts.app')
@section('title', 'Rapid Creator')
@section('main-content')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
                <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                        <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                            {{ Str::ucfirst($plan->name) }}
                        </h1>
                    </div>
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                        <a href="{{ url('/plans') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-arrow-left"></i> Go Back
                        </a>
                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content  flex-column-fluid ">
                @if ($errors->any())
                    <div id="kt_app_content_container" class="app-container container-xxl">
                        <div class="row">
                            <div class="col-12 bg-light-danger p-3 rounded mb-5 fw-bold">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- @if (Auth::user()->stripe_id != '')
                    <div id="kt_app_content_container" class="app-container container-xxl">
                        <div class="row">
                            <div class="col-12 bg-light-primary p-3 rounded mb-5 fw-bold">
                                <ul>
                                    <li>{{ __('if you want to purchase a new subscription plan, the already subscription will be cancelled') }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif --}}

                <div id="kt_app_content_container" class="app-container  container-xxl ">
                    <div class="d-flex flex-column flex-lg-row">
                        <div class="flex-lg-row-fluid me-lg-15 order-2 order-lg-1 mb-10 mb-lg-0">
                            <div class="card card-flush pt-3 mb-5 mb-lg-10">
                                <div class="card-header pt-4">
                                    <h3>Enter the Card Details Below</h3>
                                </div>
                                <div class="card-body pt-0">
                                    <form action="{{ url('/plans/process') }}" method="POST" id="subscribe-form"
                                        class="row g-3 needs-validation" novalidate>
                                        @csrf
                                        <div class="col-12">
                                            <label class="form-label">Card Holder(Customer) *</label>
                                            <input type="hidden" name="plan_id" value="{{ $plan->plan_id }}">
                                            <input type="text"
                                                value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}"
                                                name="card_holder" id="card-holder-name" class="form-control"
                                                placeholder="Add Card Holder" required />
                                            <div class="invalid-feedback">
                                                <strong class="text-danger">Please provide a card holder name</strong>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Card Holder Email(Customer) *</label>
                                            <input type="email" value="{{ Auth::user()->email }}" name="card_holder_email"
                                                id="card-holder-email" class="form-control"
                                                placeholder="Add Card Holder Email" required />
                                            <div class="invalid-feedback">
                                                <strong class="text-danger">Please provide a card holder email</strong>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <label class="card-element">Card Details *</label>
                                            <div id="card-element" class="form-control"></div>
                                            <div class="invalid-feedback">
                                                Please provide valid card details.
                                            </div>
                                            <strong class="text-danger" id="card-errors"></strong>
                                        </div>
                                        <strong class="text-danger" id="stripe-errors"></strong>
                                        <div class="col-12 text-start mt-4">
                                            <button id="card-button" data-secret="{{ $intent->client_secret }}"
                                                class="btn btn-primary waves-effect waves-light" type="submit">
                                                Pay {{ "$" . $plan->price }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="flex-column flex-lg-row-auto w-100 w-lg-250px w-xl-300px mb-10 order-1 order-lg-2">
                            <!--begin::Card-->
                            <div class="card card-flush pt-3 mb-0">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>Summary</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->

                                <!--begin::Card body-->
                                <div class="card-body pt-0 fs-6">
                                    <!--begin::Section-->
                                    <div class="mb-7">

                                        <!--begin::Title-->
                                        <h5 class="mb-3">Customer details</h5>
                                        <!--end::Title-->

                                        <!--begin::Details-->
                                        <div class="d-flex align-items-center mb-1">
                                            <!--begin::Name-->
                                            <a href="{{ url('/profile') }}"
                                                class="fw-bold text-gray-800 text-hover-primary me-2">
                                                {{ Str::ucfirst(Auth::user()->first_name) }}
                                                {{ Str::ucfirst(Auth::user()->last_name) }} </a>
                                            <!--end::Name-->

                                            <!--begin::Status-->
                                            <span class="badge badge-light-success">Active</span>
                                            <!--end::Status-->
                                        </div>
                                        <!--end::Details-->

                                        <!--begin::Email-->
                                        <a href="{{ url('#') }}"
                                            class="fw-semibold text-gray-600 text-hover-primary">{{ Auth::user()->email }}</a>
                                        <!--end::Email-->
                                    </div>
                                    <!--end::Section-->

                                    <!--begin::Seperator-->
                                    <div class="separator separator-dashed mb-7"></div>
                                    <!--end::Seperator-->

                                    <!--begin::Section-->
                                    <div class="mb-7">
                                        <!--begin::Title-->
                                        <h5 class="mb-3">Product details</h5>
                                        <!--end::Title-->

                                        <!--begin::Details-->
                                        <div class="mb-0">
                                            <!--begin::Plan-->
                                            <span
                                                class="badge badge-light-info me-2">{{ Str::ucfirst($plan->name) }}</span>
                                            <!--end::Plan-->

                                            <!--begin::Price-->
                                            <span class="fw-semibold text-gray-600">{{ $plan->currency }}
                                                {{ number_format($plan->price, 2) }} / {{ $plan->billing_period }}</span>
                                            <!--end::Price-->
                                        </div>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::Section-->

                                    <!--begin::Seperator-->
                                    <div class="separator separator-dashed mb-7"></div>
                                    <!--end::Seperator-->

                                    <!--begin::Section-->
                                    <div class="mb-10">
                                        <!--begin::Title-->
                                        <h5 class="mb-3">Payment Details</h5>
                                        <!--end::Title-->

                                        <!--begin::Details-->
                                        <div class="mb-0">
                                            <!--begin::Card info-->
                                            <div class="fw-semibold text-gray-600 d-flex align-items-center">
                                                Mastercard

                                                <img src="{{ asset('assets/media/svg/card-logos/mastercard.svg') }}"
                                                    class="w-35px ms-2" alt="">
                                            </div>
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
@section('script')
        <script src="https://js.stripe.com/v3/"></script>
        <script>
            var stripe = Stripe('{{ env('STRIPE_KEY') }}');
            var elements = stripe.elements();
            var style = {
                base: {
                    color: '#32325d',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };

            var card = elements.create('card', {
                hidePostalCode: true,
                style: style
            });
            card.mount('#card-element');

            card.addEventListener('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            const cardHolderName = document.getElementById('card-holder-name');
            const cardButton = document.getElementById('card-button');
            const clientSecret = cardButton.dataset.secret;

            cardButton.addEventListener('click', async (e) => {
                e.preventDefault();

                var form = document.getElementById('subscribe-form');
                if (!form.checkValidity()) {
                    form.classList.add('was-validated');
                    return;
                }

                cardButton.disabled = true;
                cardButton.innerHTML =
                    "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Processing...";

                const {
                    setupIntent,
                    error
                } = await stripe.confirmCardSetup(
                    clientSecret, {
                        payment_method: {
                            card: card,
                            billing_details: {
                                name: cardHolderName.value
                            }
                        }
                    }
                );

                cardButton.disabled = false;
                cardButton.innerHTML = `Pay {{ "$" . $plan->price }}`;

                if (error) {
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = error.message;
                } else {
                    paymentMethodHandler(setupIntent.payment_method);
                }
            });

            function paymentMethodHandler(payment_method) {
                var form = document.getElementById('subscribe-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'payment_method');
                hiddenInput.setAttribute('value', payment_method);
                form.appendChild(hiddenInput);
                form.submit();
            }
        </script>
@endsection
