<nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="#">Pages</a></li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">@yield('title', 'Dashboard')</li>
        </ol>
      </nav>
  
      <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          <div class="input-group input-group-outline">
            <label class="form-label">Search...</label>
            <input type="text" class="form-control">
          </div>
        </div>
  
        <ul class="navbar-nav d-flex align-items-center justify-content-end">
        
          <!-- Profil Pengguna -->
          <li class="nav-item dropdown">
            <a href="#" class="nav-link text-body p-0" id="userDropdown" data-bs-toggle="dropdown">
              <i class="material-symbols-rounded">account_circle</i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end px-2 py-3" aria-labelledby="userDropdown">
              <li>
                <a class="dropdown-item border-radius-md" href="#">
                  <i class="material-symbols-rounded me-2">person</i> Profil
                </a>
              </li>
              <li>
                <a class="dropdown-item border-radius-md" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="material-symbols-rounded me-2">logout</i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  