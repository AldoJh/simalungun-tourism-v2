<!DOCTYPE html>
<head>
  <!-- Required meta tags -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&amp;display=swap" rel="stylesheet">

  <!-- Stylesheets -->
  <link rel="stylesheet" href="{{ asset('front-assets/css/vendors.css') }}">
  <link rel="stylesheet" href="{{ asset('front-assets/css/main.css') }}">

  <title>Simalungun | {{$title ?? ''}}</title>
</head>

<body>
  <button class="toTopButton js-top-button">
    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
      <g clip-path="url(#clip0_83_4004)">
        <path d="M17.8783 0H4.12177C3.59388 0 3.16602 0.42786 3.16602 0.955755C3.16602 1.48365 3.59388 1.91151 4.12177 1.91151H17.8783C18.4062 1.91151 18.834 1.48365 18.834 0.955755C18.834 0.42786 18.4062 0 17.8783 0Z" />
        <path d="M11.6759 4.67546C11.3026 4.30219 10.6975 4.30219 10.3242 4.67546L6.04107 8.95863C5.66779 9.3319 5.66779 9.937 6.04107 10.3103C6.41434 10.6837 7.01955 10.6836 7.39272 10.3103L10.0444 7.6587V21.0443C10.0444 21.5722 10.4723 22 11.0002 22C11.5281 22 11.9559 21.5722 11.9559 21.0443V7.65859L14.6076 10.3102C14.7942 10.4969 15.0389 10.5901 15.2834 10.5901C15.528 10.5901 15.7726 10.4968 15.9593 10.3102C16.3325 9.9369 16.3325 9.3318 15.9593 8.95852L11.6759 4.67546Z" />
      </g>
      <defs>
        <clipPath id="clip0_83_4004">
          <rect width="22" height="22" fill="white" />
        </clipPath>
      </defs>
    </svg>
  </button>

  <main>
    <header class="header -type-1">
      <div data-anim="fade delay-3" class="header__container container">
        <div class="headerMobile__left">
          <div class="header__logo">
            <a href="index.html" class="header__logo">
              <img src="{{ asset('front-assets/img/logo_sipar.png') }}" width="50" alt="logo icon">
            </a>
          </div>
        </div>

        <div class="header__left md:d-none">
          <div class="header__logo">
            <a href="index.html" class="header__logo">
              <img src="{{ asset('front-assets/img/logo_sipar.png') }}" width="50" alt="logo icon">
            </a>
          </div>
        </div>

        <div class="headerMobile__right">
          <button class="header__menuBtn js-menu-button">
            <i class="icon-main-menu @if ($title == 'Home') text-white @endif"></i>
          </button>
        </div>
        <div class="header__right">
          <button class="header__menuBtn ml-30 js-menu-button">
            <i class="icon-main-menu @if ($title == 'Home') text-white @endif"></i>
          </button>
        </div>
      </div>
    </header>

    <div class="menu js-menu">
      <div class="menu__overlay js-menu-button"></div>

      <div class="menu__container">
        <div class="menu__header">
          <h4>Menu</h4>

          <button class="js-menu-button"><i class="icon-cross text-10"></i></button>
        </div>

        <div class="menu__content">
          <ul class="menuNav js-navList">
            <li class="menuNav__item">
              <a href="{{ route('home') }}">
                Home
                <i class="icon-chevron-right"></i>
              </a>
            </li>
            <li class="menuNav__item">
              <a href="{{ route('festival') }}">
                Festival
                <i class="icon-chevron-right"></i>
              </a>
            </li>
            <li class="menuNav__item">
              <a href="{{ route('wisata') }}">
                Wisata
                <i class="icon-chevron-right"></i>
              </a>
            </li>
            <li class="menuNav__item">
              <a href="{{ route('hotel') }}">
                Hotel
                <i class="icon-chevron-right"></i>
              </a>
            </li>
            <li class="menuNav__item">
              <a href="{{ route('restaurant') }}">
                Resto
                <i class="icon-chevron-right"></i>
              </a>
            </li>
            <li class="menuNav__item">
              <a href="{{ route('berita') }}">
                Berita
                <i class="icon-chevron-right"></i>
              </a>
            </li>

            @if (Auth::check())
            <li class="menuNav__item -has-submenu js-has-submenu">
              <a>
                {{ Auth::user()->name }}
                <i class="icon-chevron-right"></i>
              </a>
              <ul class="submenu">
                <li class="submenu__item js-nav-list-back">
                  <a>Back</a>
                </li>
                <li class="submenu__item">
                  <a href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="submenu__item">
                  <a href="{{ route('logout') }}">Logout</a>
                </li>
              </ul>
            </li>
            @else
            <li class="menuNav__item">
              <a href="{{ route('login') }}">
                Login
                <i class="icon-chevron-right"></i>
              </a>
            </li>
            @endif
          </ul>
        </div>


        <div class="menu__footer">
          <i class="icon-headphone text-50"></i>

          <div class="text-15 lh-12 fw-500 mt-20">
            <div class="pb-3">Info Lebih Lanjut</div>
            <div class="text-accent-1">1-800-453-6744</div>
            <div class="text-accent-1">disparbudsimalungun24@gmail.com</div>
          </div>

          <div class="d-flex items-center x-gap-10 pt-30">

            <div>
              <a class="d-block">
                <i class="icon-facebook"></i>
              </a>
            </div>

            <div>
              <a class="d-block">
                <i class="icon-twitter"></i>
              </a>
            </div>

            <div>
              <a class="d-block">
                <i class="icon-instagram"></i>
              </a>
            </div>

            <div>
              <a class="d-block">
                <i class="icon-linkedin"></i>
              </a>
            </div>

          </div>
        </div>
      </div>
    </div>

    @yield('content')


    <div class="row justify-content-center d-flex z-10 position-absolute">
      <div class="col-lg-5">
        <div class="hero__filter" >
          <div class="searchForm -type-1 shadow-1 rounded d-flex justify-between shadow-lg" style="background-image: url('{{ asset('front-assets/img/bg-kuisioner.png') }}') !important;">
            <div class="ms-3">
              <h5>Kuisioner</h5>
              <span class="fs-6 text-muted">Berikan Pendapat Kamu Tentang Simalungun Tourism</span>
            </div>
  
            <div class="searchForm__button">
              <button class="button -dark-1 bg-accent-1 rounded text-white">
                Isi Kuisioner
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="footer -type-1 bg-accent-1-05 position-relative" >
      <div class="footer__main">
        <div class="container">
          <div class="footer__info">
            <div class="row y-gap-20 justify-between">
              <div class="col-auto">
                <div class="row y-gap-20 items-center">
                  <div class="col-auto">
                    <i class="icon-headphone text-50"></i>
                  </div>
                  <div class="col-auto">
                    <div class="text-20 fw-500">
                      Info Lebih Lanjut
                      <span class="text-accent-1">0895-6110-24559</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <div class="footerSocials">
                  <div class="footerSocials__title">
                    Ikuti Kami
                  </div>
                  <div class="footerSocials__icons">
                    <a href="#" class="icon-facebook"></a>
                    <a href="#" class="icon-twitter"></a>
                    <a href="#" class="icon-instagram"></a>
                    <a href="#" class="icon-linkedin"></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="footer__content">
            <div class="row">
              <div class="col-12 text-center">
                <div class="y-gap-10 mt-20">
                  <span class="d-block">Simalungun Tourism adalah website promosi pariwisata Simalungun <br>
                    dikelola oleh Dinas kebudayaan, pariwisata dan ekonomi kreatif Kabupaten Simalungun</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="footer__bottom">
          <div class="row y-gap-5">
            <div class="col-12 text-center">
              <div>© Copyright DISPAR Simalungun 2023</div>
            </div>
          </div>
        </div>
      </div>
    </footer>


  </main>

  <!-- JavaScript -->
  <script src="{{ asset('front-assets/js/vendors.js') }}"></script>
  <script src="{{ asset('front-assets/js/main.js') }}"></script>
</body>

</html>