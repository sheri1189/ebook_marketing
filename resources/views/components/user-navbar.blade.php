<header class="site-header" id="header">
    <nav class="navbar navbar-expand-lg transparent-bg static-nav">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('/user/images/logo-transparent.png') }}" alt="logo" class="logo-default">
                <img src="{{ asset('/user/images/logo.png') }}" alt="logo" class="logo-scrolled">
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mx-auto ms-xl-auto me-xl-0">
                    <li class="nav-item">
                        <a class="nav-link active pagescroll" href="{{ url('#home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pagescroll scrollupto" href="{{ url('#about') }}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pagescroll" href="{{ url('#featured-ebooks') }}">Featured eBooks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pagescroll" href="{{ url('#pricing') }}">Our Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pagescroll" href="{{ url('#services') }}">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pagescroll" href="{{ url('#contact') }}">Contact Us</a>
                    </li>
                    <li class="nav-item dropdown position-relative">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"> Management </a>
                        <div class="dropdown-menu">
                            @if (Auth::check() && Auth::user())
                                <a class="dropdown-item" href="{{ url('dashboard') }}">Dashboard</a>
                                <a class="dropdown-item" href="{{ route('authentication.logout') }}">Logout</a>
                            @else
                                <a class="dropdown-item" href="{{ route('authentication.login') }}">Login</a>
                            @endif
                        </div>
                    </li>
                    @if (Auth::check() && Auth::user())
                        <li class="nav-item">
                            <a class="nav-link button gradient-btn w-100 ms-3" href="{{ url('/online/tutor') }}"><i
                                    class="fas fa-user"></i> Online Tutor</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <a href="javascript:void(0);" class="d-inline-block sidemenu_btn" id="sidemenu_toggle">
            <span></span> <span></span> <span></span>
        </a>
    </nav>
    <div class="side-menu opacity-0 gradient-bg">
        <div class="overlay"></div>
        <div class="inner-wrapper">
            <span class="btn-close btn-close-no-padding" id="btn_sideNavClose"><i></i><i></i></span>
            <nav class="side-nav w-100">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link  pagescroll" href="{{ url('#home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pagescroll scrollupto" href="{{ url('#about') }}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pagescroll" href="{{ url('#featured-ebooks') }}">Featured eBooks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pagescroll" href="{{ url('#pricing') }}">Our Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pagescroll" href="{{ url('#services') }}">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pagescroll" href="{{ url('#contact') }}">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/login') }}">Login</a>
                    </li>
                    @if (Auth::check() && Auth::user())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('authentication.logout') }}">Logout</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/online/tutor') }}">Online Tutor</a>
                        </li>
                    @endif
                </ul>
            </nav>
            <div class="side-footer w-100">
                <ul class="social-icons-simple white top40">
                    <li><a href="javascript:void(0);" class="facebook"><i class="fab fa-facebook-f"></i> </a>
                    </li>
                    <li><a href="javascript:void(0);" class="twitter"><i class="fab fa-twitter"></i>
                        </a> </li>
                    <li><a href="javascript:void(0);" class="insta"><i class="fab fa-instagram"></i> </a> </li>
                </ul>
                <p class="whitecolor">&copy; <span id="year"></span> eBook Marketing Mastery by
                    ibexstack
                </p>
            </div>
        </div>
    </div>
    <div id="close_side_menu" class="tooltip"></div>
</header>
