<div class="app-menu navbar-menu">
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ url('dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('admin/assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('admin/assets/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ url('dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('admin/assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('admin/assets/images/logo-light.png') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>
    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                @if (Auth::user()->is_admin == 1)
                    <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ url('dashboard') }}">
                            <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboard</span>
                        </a>
                    </li>
                    <li class="menu-title"><span data-key="t-menu">Subscription & Payment</span></li>
                    <li class="nav-item">
                        <a class="nav-link menu-link collapsed" href="#sidebarPlans" data-bs-toggle="collapse"
                            role="button" aria-expanded="false" aria-controls="sidebarPlans">
                            <i class="fas fa-credit-card"></i> <span data-key="t-landing">Plans</span>
                        </a>
                        <div class="menu-dropdown collapse" id="sidebarPlans" style="">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ url('plans/create') }}" class="nav-link" data-key="t-job">Add Plans</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('plans') }}" class="nav-link" data-key="t-job">Manage Plans</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ url('subscriptions') }}">
                            <i class="fas fa-credit-card"></i> <span data-key="t-dashboards">
                                Subscriptions</span>
                        </a>
                    </li>
                    <li class="menu-title"><span data-key="t-menu">Users Management</span></li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ url('users') }}">
                            <i class="fas fa-users"></i> <span data-key="t-dashboards">Manage Users</span>
                        </a>
                    </li>
                @else
                    <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ url('dashboard') }}">
                            <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboard</span>
                        </a>
                    </li>
                    <li class="menu-title"><span data-key="t-menu">Subscription & Payment</span></li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ url('subscriptions') }}">
                            <i class="fas fa-credit-card"></i> <span data-key="t-dashboards">
                                Subscriptions</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    <div class="sidebar-background"></div>
</div>
