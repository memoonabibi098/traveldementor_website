<header id="header" class="header d-flex align-items-center fixed-top">
  <div
    class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

    <a href="{{ route('homepage') }}" class="logo d-flex align-items-center me-auto me-xl-0">
      <!-- Uncomment the line below if you also wish to use an image logo -->
      <img src="{{ asset('images/website_images/home/dark-logo.webp') }}" alt="">
      {{-- <h1 class="sitename">TheProperty</h1> --}}
    </a>

    <nav id="navmenu" class="navmenu me-lg-4">
      <ul class="header-size">
        <li><a href="{{ route('homepage') }}" class="active">Home</a></li>
        <li><a href="">About us</a></li>
        <li><a href="">Services</a></li>
        <li><a href="">Visa Status</a></li>
        <li><a href="">FAQs</a></li>
        <li><a href="">Contact us</a></li>
      </ul>
      <i class="mobile-nav-toggle d-lg-none bi bi-list"></i>
    </nav>
    {{-- <a class="btn-getstarted" href="{{ route('login-signup') }}">Login/SignUp</a> --}}
    {{-- If NOT logged in --}}
    @guest
      <a class="btn-getstarted" href="">Login/Signup</a>
    @endguest
    {{-- @guest

<a class="btn-getstarted coming-soon-btn" href="javascript:void(0)" title="Coming Soon">
    Login / SignUp
</a>

@endguest --}}


    {{-- If logged in --}}
    {{-- @auth
      <div class="dropdown">
        <button class="profile-btn" id="userMenu" data-bs-toggle="dropdown">
          <img src="{{ !empty(Auth::user()->profile_image) && file_exists(public_path(Auth::user()->profile_image))
      ? asset(Auth::user()->profile_image)
      : asset('images/website_images/default-avatar-1.png') }}" alt="profile" class="profile-avatar">


        </button>

        <ul class="dropdown-menu dropdown-menu-end">
          <li><a class="dropdown-item" href="{{ route('profile') }}">My Profile</a></li>
          <li>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button class="dropdown-item text-danger">Sign Out</button>
            </form>
          </li>
        </ul>
      </div>
    @endauth --}}

  </div>
</header>