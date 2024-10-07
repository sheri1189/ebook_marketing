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
                        <h2 class="font-xlight">Sign Into</h2>
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
                    <h2 class="heading bottom30 darkcolor font-light2"><span class="font-normal">Sign</span> In
                        <span class="divider-center"></span>
                    </h2>
                    <div class="col-md-8 offset-md-2 heading_space">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A dolores explicabo laudantium,
                            omnis provident quam reiciendis voluptatum?</p>
                    </div>
                </div>
                <div class="col-lg-6 pe-lg-0 col-md-12 d-none d-lg-flex">
                    <div class=" image login-image h-100">
                        <img src="{{ asset('/user/images/login-section.jpg') }}" alt=""
                            class="w-100 h-100">
                    </div>
                </div>
                <div class="col-lg-6 ps-lg-0 col-md-12 whitebox">
                    <div class="widget logincontainer">
                        <h3 class="darkcolor bottom30 text-center text-lg-start">Sign In </h3>
                        @if (session('error') == 'Unauthorized')
                            <div class="alert alert-danger" role="alert">
                                <a href="#" class="alert-link">Something went wrong. Login is the first
                                    priority!</a>
                            </div>
                        @endif
                        <form id="form_submit" class="getin_form border-form">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group bottom35">
                                        <label for="registerEmail" class="d-none"></label>
                                        <input class="form-control" type="email" name="email" placeholder="Email:">
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
                                    <div class="form-group bottom30 ml-1">
                                        <div class="form-check text-left">
                                            <input class="form-check-input" checked type="checkbox" value=""
                                                id="rememberMe">
                                            <label class="form-check-label" for="rememberMe">
                                                Keep Me Signed In
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <button type="button" id="submitBtn" class="button gradient-btn">Login</button>
                                    <a href="{{ url('/forget') }}" class="ml-2 defaultcolor">Forget
                                        password?</a>
                                    <p class="top30 mb-0"> Don't have an account? &nbsp;<a href="{{ url('/register') }}"
                                            class="defaultcolor">Sign Up Now</a>
                                    </p>
                                </div>
                            </div>
                        </form>
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
                    url: "{{ route('authentication.check') }}",
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
                                title: "Login Successfully..!",
                                animation: false,
                                position: "top-right",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                            $("form").trigger("reset");
                            button.removeAttribute("disabled");
                            button.innerHTML = "Login";
                            window.location.href = "{{ route('home') }}";
                        } else if (response.message == 300) {
                            button.removeAttribute("disabled");
                            button.innerHTML = "Login";
                            Swal.fire({
                                toast: true,
                                icon: "error",
                                title: "Your Email or Password is Wrong.Please use the Valid Credentials..!",
                                animation: false,
                                position: "top-right",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                        } else {
                            button.removeAttribute("disabled");
                            button.innerHTML = "Login";
                            Swal.fire({
                                toast: true,
                                icon: "error",
                                title: "There was an error while submit your request",
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
                        button.innerHTML = "Login";
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
