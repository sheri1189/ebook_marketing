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
    <section id="main-banner-page" class="position-relative page-header sign-up-header parallax section-nav-smooth">
        <div class="overlay overlay-dark opacity-8 z-index-1"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="page-titles whitecolor text-center padding_top padding_bottom">
                        <h2 class="font-xlight">Create The</h2>
                        <h2 class="font-bold">Account To Unlock</h2>
                        <h2 class="font-xlight">Unlimited</h2>
                        <h3 class="font-light pt-2">Offers And Facilities Provided By Us</h3>
                    </div>
                </div>
            </div>
            <div class="gradient-bg title-wrap">
                <div class="row">
                    <div class="col-lg-12 col-md-12 whitecolor">
                        <h3 class="float-start">Signup</h3>
                        <ul class="breadcrumb top10 bottom10 float-end">
                            <li class="breadcrumb-item hover-light"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item hover-light">Signup</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header ends -->
    <!-- Main sign-up section starts -->
    <section id="ourfaq" class="bglight position-relative padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center wow fadeIn" data-wow-delay="300ms">
                    <h2 class="heading bottom40 darkcolor font-light2"><span class="font-normal">Sign</span> Up
                        <span class="divider-center"></span>
                    </h2>
                    <div class="col-md-8 offset-md-2 heading_space">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A dolores explicabo laudantium,
                            omnis provident quam reiciendis voluptatum?</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 pe-lg-0 whitebox">
                    <div class="widget logincontainer">
                        <h3 class="darkcolor bottom35 text-center text-md-start">Create Your account </h3>
                        <form id="form_submit" class="getin_form border-form">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group bottom35">
                                        <label for="registerFirstName" class="d-none"></label>
                                        <input class="form-control" type="text" name="first_name"
                                            placeholder="First Name:">
                                        <span class="text-danger fw-bold" id="first_name"></span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group bottom35">
                                        <label for="registerLastName" class="d-none"></label>
                                        <input class="form-control" type="text" name="last_name"
                                            placeholder="Last Name:">
                                        <span class="text-danger fw-bold" id="last_name"></span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group bottom35">
                                        <label for="registerEmail" class="d-none"></label>
                                        <input class="form-control" type="email" name="email"
                                            placeholder="Email:">
                                        <span class="text-danger fw-bold" id="email"></span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group bottom35">
                                        <label for="registerPass" class="d-none"></label>
                                        <input class="form-control" type="password" name="password"
                                            placeholder="Password:">
                                        <span class="text-danger fw-bold" id="password"></span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group bottom35">
                                        <label for="registerPassConfirm" class="d-none"></label>
                                        <input class="form-control" type="password" name="password_confirmation"
                                            placeholder="Confirm Password:">
                                        <span class="text-danger fw-bold" id="password_confirmation"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <button type="button" class="button gradient-btn w-100" id="submitBtn">
                                        Register
                                        <span class="spinner-border spinner-border-sm ml-2" role="status"
                                            aria-hidden="true" style="display: none;"></span>
                                    </button>
                                    <p class="top20 log-meta"> Already have an account? &nbsp;<a
                                            href="{{ url('/login') }}" class="defaultcolor">Sign In</a> </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block ps-lg-0">
                    <div class=" image login-image h-100">
                        <img src="{{ asset('/user/images/register-section.jpg') }}" alt=""
                            class="h-100">
                    </div>
                </div>
            </div>
        </div>
    </section>
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
    <script>
        $(document).ready(function() {
            $(document).on("click", "#submitBtn", function(event) {
                event.preventDefault();
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                });
                var formData = new FormData(form_submit);
                const button = document.getElementById("submitBtn");
                button.innerHTML =
                    "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Processing...";
                button.setAttribute("disabled", "disabled");
                $.ajax({
                    url: "{{ route('authentication.register.submit') }}",
                    method: "POST",
                    contentType: false,
                    processData: false,
                    data: formData,
                    dataType: "json",
                    success: function(response) {
                        if (response.message == 200) {
                            $(".text-danger").text("");
                            Swal.fire({
                                toast: true,
                                icon: "success",
                                title: "Registeration Successfully..!",
                                animation: false,
                                position: "top-right",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                            $("form").trigger("reset");
                            button.removeAttribute("disabled");
                            button.innerHTML = "Register";
                            window.location.href="{{ route('authentication.login') }}";
                        } else {
                            button.removeAttribute("disabled");
                            button.innerHTML = "Register";
                            Swal.fire({
                                toast: true,
                                icon: "error",
                                title: "There was an error while submit registeration",
                                animation: false,
                                position: "top-right",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                        }
                    },
                    error: function(error) {
                        Swal.fire({
                                toast: true,
                                icon: "error",
                                title: "There was an erros onto the submission of the request solve it..!   ",
                                animation: false,
                                position: "top-right",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                        $(".text-danger").text("");
                        button.removeAttribute("disabled");
                        button.innerHTML = "Register";
                        var error = error.responseJSON;
                        $.each(error.errors, function(index, value) {
                            $("#" + index).html(value);
                        });
                    },
                });
            })
        })
    </script>
</body>

</html>
