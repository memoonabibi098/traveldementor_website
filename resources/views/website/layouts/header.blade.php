


<header id="header" class="header d-flex align-items-center fixed-top">
  <div class="header-container container-fluid container-xl d-flex align-items-center justify-content-between">

    {{-- Logo --}}
    <a href="{{ route('homepage') }}" class="logo d-flex align-items-center me-auto">
      <img src="{{ $header && $header->logo 
          ? asset('uploads/header/'.$header->logo) 
          : asset('images/website_images/home/dark-logo.webp') }}" alt="">
    </a>

    {{-- Menu --}}
    <nav id="navmenu" class="navmenu me-lg-4">
      <ul class="header-size">
        @if(!empty($menus))
          @foreach($menus as $menu)
            <li>
              <a href="{{ url($menu['url']) }}">
                {{ $menu['title'] }}
              </a>
            </li>
          @endforeach
        @endif
      </ul>
      <i class="mobile-nav-toggle d-lg-none bi bi-list"></i>
    </nav>

    {{-- Button --}}
    @guest
      <a class="btn-getstarted" href="{{ $header->button_url ?? '#' }}">
        {{ $header->button_text ?? 'Login / Signup' }}
      </a>
    @endguest

  </div>
</header>
