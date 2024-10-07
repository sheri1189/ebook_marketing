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
    <section id="main-banner-page" class="position-relative page-header reset-header parallax section-nav-smooth">
        <div class="overlay overlay-dark opacity-8 z-index-1"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="page-titles whitecolor text-center padding_top padding_bottom">
                        <h2 class="font-xlight">Let's Reset</h2>
                        <h2 class="font-bold">Forgotten Password</h2>
                        <h2 class="font-xlight">To Use Our</h2>
                        <h3 class="font-light pt-2">The Latest Ultimated Offers And Facilities</h3>
                    </div>
                </div>
            </div>
            <div class="gradient-bg title-wrap">
                <div class="row">
                    <div class="col-lg-12 col-md-12 whitecolor">
                        <h3 class="float-start">Reset Password</h3>
                        <ul class="breadcrumb top10 bottom10 float-end">
                            <li class="breadcrumb-item hover-light"><a href="{{ url("/") }}">Home</a></li>
                            <li class="breadcrumb-item hover-light">Reset Password</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header ends -->
    <!-- reset password -->
    <section id="sign-in" class="bglight position-relative padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center wow fadeIn" data-wow-delay="300ms">
                    <h2 class="heading bottom40 darkcolor font-light2">Reset<span class="font-normal"> Password</span>
                        <span class="divider-center"></span>
                    </h2>
                    <div class="col-md-8 offset-md-2 heading_space">
                        <p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A dolores explicabo laudantium, omnis provident quam reiciendis voluptatum?</p>
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-sm-10 offset-sm-1 whitebox">
                    <div class="widget logincontainer shadow text-center text-md-start">
                        <h3 class="darkcolor bottom35">Reset Password </h3>
                        <form class="getin_form border-form" id="ResetPassword">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group bottom35">
                                        <label for="loginEmail" class="mb-3 ps-0">Please enter Email or Username you remember!</label>
                                        <input class="form-control" type="email" placeholder="Username or Email" required id="loginEmail">
                                    </div>
                                </div>
                                <div class="col-sm-12 forget-buttons">
                                    <button type="submit" class="button btn-primary">Reset</button>
                                    <button type="button" class="button btn-dark ms-2">Cancel</button>
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
                                        <input class="form-control" type="text" placeholder="First Name:" required id="userName" name="userName">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="form-group">
                                        <label for="companyName" class="d-none"></label>
                                        <input class="form-control" type="tel" placeholder="Company Name"  id="companyName" name="companyName">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="form-group">
                                        <label for="email" class="d-none"></label>
                                        <input class="form-control" type="email" placeholder="Email:" required id="email" name="email">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <button type="submit" class="button gradient-btn w-100" id="submit_btn">subscribe</button>
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
</body>

</html>
