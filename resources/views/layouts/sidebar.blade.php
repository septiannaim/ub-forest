<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-lg bg-white my-3 fixed-start ms-2" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" id="iconSidenav"></i>
        <a class="navbar-brand px-4 py-3 m-0" href="#">
            <img src="{{ asset('landing-page/assets/img/logo-ub-forest.png') }}" class="navbar-brand-img" width="26" height="26" alt="main_logo">
            <span class="ms-1 text-sm text-dark font-weight-bold">UB Forest</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <!-- Dashboard Link -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard') ? 'bg-success text-white' : 'text-dark' }}" href="{{ route('dashboard') }}">
                    <i class="material-symbols-rounded opacity-10 me-2">dashboard</i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>

          <!-- Device & Data Link -->
          <li class="nav-item">
            <a 
                class="nav-link {{ request()->is('devices*') ? 'bg-success text-white' : 'text-dark' }}" 
                href="{{ route('devices.index') }}"
            >
                <i class="material-symbols-rounded opacity-10 me-2">devices</i>
                <span class="nav-link-text">Device & Data</span>
            </a>
        </li>

        <li class="nav-item">
            <a 
                class="nav-link {{ request()->is('logs*') ? 'bg-success text-white' : 'text-dark' }}" 
                href="{{ route('logs.index') }}"
            >
                <i class="material-symbols-rounded opacity-10 me-2">history</i>
                <span class="nav-link-text">Sensor Logs</span>
            </a>
        </li>
        
        
            <!-- Account Pages Section -->
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-muted font-weight-bolder opacity-6">Account Pages</h6>
            </li>
            
            <!-- Profile Link -->
            <li class="nav-item">
                <a class="nav-link text-dark {{ request()->routeIs('profile.edit') ? 'bg-success text-white' : '' }}" href="{{ route('profile.edit') }}">
                    <i class="material-symbols-rounded opacity-5">person</i>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>

           
            <li class="nav-item">
                <a class="nav-link text-dark {{ request()->routeIs('users.index') ? 'bg-success text-white' : '' }}" href="{{ route('users.index') }}">
                    <i class="material-symbols-rounded opacity-5">group</i>
                    <span class="nav-link-text ms-1">Manage Users</span>
                </a>
            </li>
            

            
        </ul>
    </div>

    <!-- Footer Sidebar: Logout -->
    <div class="sidenav-footer position-absolute w-100 bottom-0">
        <div class="mx-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn bg-gradient-danger w-100">
                    <i class="material-symbols-rounded me-2">logout</i> Logout
                </button>
            </form>
        </div>
    </div>
</aside>
