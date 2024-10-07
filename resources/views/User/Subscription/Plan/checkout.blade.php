<!DOCTYPE html>
<html lang="en">
{{-- =============user header files=========== --}}
<x-user-header-files />
{{-- =============user header files=========== --}}

<body>
    <div class="loader">
        <div class="loader-inner">
            <div class="cssload-loader"></div>
        </div>
    </div>
    {{-- =============user navbar=========== --}}
    <x-user-navbar-two />
    {{-- =============user navbar=========== --}}
    <section id="main-banner-page" class="position-relative page-header sign-in-header parallax section-nav-smooth">
        <div class="overlay overlay-dark opacity-7 z-index-1"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="page-titles whitecolor text-center padding_top padding_bottom">
                        <h2 class="font-xlight">Checkout Plan</h2>
                        <h2 class="font-bold">Your Account To</h2>
                        <h2 class="font-xlight">Use Best</h2>
                        <h3 class="font-light pt-2">Offers And Facilities Provided By Us</h3>
                    </div>
                </div>
            </div>
            <div class="gradient-bg title-wrap">
                <div class="row">
                    <div class="col-lg-12 col-md-12 whitecolor">
                        <h3 class="float-start">Sign In</h3>
                        <ul class="breadcrumb top10 bottom10 float-end">
                            <li class="breadcrumb-item hover-light"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item hover-light">Sign-in</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header ends -->
    <!-- sign-in -->
    <section id="sign-in" class="bglight position-relative padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center wow fadeIn" data-wow-delay="300ms">
                    <h2 class="heading bottom30 darkcolor font-light2"><span class="font-normal">Checkout</span> Plan
                        <span class="divider-center"></span>
                    </h2>
                    <div class="col-md-8 offset-md-2 heading_space">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A dolores explicabo laudantium,
                            omnis provident quam reiciendis voluptatum?</p>
                    </div>
                </div>
                <div class="col-lg-6 ps-lg-0 col-md-12 whitebox">
                    <div class="widget logincontainer">
                        @if ($errors->any())
                            <div class="row">
                                <div class="col-12 bg-danger p-3 rounded mb-5 fw-bold text-white">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        <h3 class="darkcolor bottom30 text-center text-lg-start">Stripe Checkout </h3>
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
                                    id="card-holder-email" class="form-control" placeholder="Add Card Holder Email"
                                    required />
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
                <div class="col-lg-6 pe-lg-0 col-md-12 d-none d-lg-flex">
                    <div class="card card-flush pt-3 mb-0 w-100">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Summary</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0 fs-6">
                            <div class="mb-7">
                                <h5 class="mb-3">Customer details</h5>
                                <div class="d-flex align-items-center mb-1">
                                    <a href="{{ url('/profile') }}"
                                        class="fw-bold text-gray-800 text-hover-primary me-2">
                                        {{ Str::ucfirst(Auth::user()->first_name) }}
                                        {{ Str::ucfirst(Auth::user()->last_name) }} </a>
                                    <span class="badge badge-light-success">Active</span>
                                </div>
                                <a href="{{ url('#') }}"
                                    class="fw-semibold text-gray-600 text-hover-primary">{{ Auth::user()->email }}</a>
                            </div>
                            <div class="separator separator-dashed mb-7"></div>
                            <div class="mb-7">
                                <h5 class="mb-3">Product details</h5>
                                <div class="mb-0">
                                    <span class="badge badge-light-info me-2">{{ Str::ucfirst($plan->name) }}</span>
                                    <span class="fw-semibold text-gray-600">{{ $plan->currency }}
                                        {{ number_format($plan->price, 2) }} / {{ $plan->billing_period }}</span>
                                </div>
                            </div>
                            <div class="separator separator-dashed mb-7"></div>
                            <div class="mb-10">
                                <h5 class="mb-3">Payment Details</h5>
                                <div class="mb-0">
                                    <div class="fw-semibold text-gray-600 d-flex align-items-center">
                                        Mastercard
                                        <img src="{{ asset('/user/images/card-logos/mastercard.svg') }}"
                                            class="w-35px ms-2" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- sign-in ends -->
    <!-- Contact US -->
    <section id="stayconnect" class="bglight position-relative">
        <div class="container">
            <div class="contactus-wrapp">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="heading-title wow fadeInUp text-center text-md-start" data-wow-delay="300ms">
                            <h3 class="darkcolor bottom20">Stay Connected</h3>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <form class="getin_form wow fadeInUp" data-wow-delay="400ms" onsubmit="return false;">
                            <div class="row">
                                <div class="col-md-12 col-sm-12" id="result"></div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="form-group">
                                        <label for="userName" class="d-none"></label>
                                        <input class="form-control" type="text" placeholder="First Name:" required
                                            id="userName" name="userName">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="form-group">
                                        <label for="companyName" class="d-none"></label>
                                        <input class="form-control" type="tel" placeholder="Company Name"
                                            id="companyName" name="companyName">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="form-group">
                                        <label for="email" class="d-none"></label>
                                        <input class="form-control" type="email" placeholder="Email:" required
                                            id="email" name="email">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <button type="submit" class="button gradient-btn w-100"
                                        id="submit_btn">subscribe</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- =============user footer=========== --}}
    <x-user-footer />
    {{-- =============user footer=========== --}}
    {{-- =============user footer files --}}
    <x-footer-files />
    {{-- =============user footer files --}}
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
</body>

</html>
