@extends('front.app')

@section('seo')
  <meta
  name="keywords"
  content="wisata, simalungun, sumut, toba, sidamanik, tourism, destinasi, hotel, festival, restaurant, resto, berita"
  />
  <meta name="author" content="DISBUDPAREKRAF Simalungun" />
  <meta name="description" content="{!! \App\Models\Setting::webBase()->description !!}" />

  <!-- Open Graph Meta Tags -->
  <meta property="og:url" content="{{ route('home') }}" />
  <meta property="og:title" content="Simalungun | {{$title ?? ''}}" />
  <meta property="og:type" content="article" />
  <meta property="og:image" content="{{ asset('front-assets/meta/berita.png') }}" />
  <meta
    property="og:description"
    content="{!! \App\Models\Setting::webBase()->description !!}"
  />
  <meta property="og:locale" content="id_ID" />

  <!-- Twitter Card Meta Tags -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="Simalungun | {{$title ?? ''}}" />
  <meta
    name="twitter:description"
    content="{!! \App\Models\Setting::webBase()->description !!}"
  />
  <meta name="twitter:image" content="{{ asset('front-assets/meta/berita.png') }}" />

  <!-- Additional SEO Meta Tags -->
  <meta name="distribution" content="global" />
  <meta name="revisit-after" content="7 days" />
  <meta name="rating" content="general" />
  <meta name="language" content="Indonesian" />
  <meta name="geo.region" content="ID" />
  <meta name="geo.placename" content="Simalungun" />

  <!-- Canonical Tag -->
  <link rel="canonical" href="{{ route('home') }}" />
@endsection

@section('content')

<section data-anim-wrap class="hero -type-7">
  <div class="hero__shape"></div>

  <div data-anim-child="slide-up delay-2" class="hero__slider js-section-slider" data-gap="0" data-slider-cols="xl-1 lg-1 md-1 sm-1 base-1" data-nav-prev="js-sliderHero-prev" data-nav-next="js-sliderHero-next">
    <div class="swiper-wrapper">

      <div class="swiper-slide">
        <div class="hero__bg">
          <img src="{{ asset('front-assets/img/danau-toba.jpg') }}" alt="background">
        </div>

        <div class="container">
          <div class="row justify-center">
            <div class="col-lg-8 col-md-10">
              <div class="hero__content text-center">
                <div class="hero__subtitle text-white mb-20 md:mb-10">
                  Explore Simalungun
                </div>

                <h1 class="hero__title text-white">
                  Danau Toba
                </h1>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="swiper-slide">
        <div class="hero__bg">
          <img src="{{ asset('front-assets/img/kebun-teh.jpg') }}" alt="background">
        </div>

        <div class="container">
          <div class="row justify-center">
            <div class="col-lg-8 col-md-10">
              <div class="hero__content text-center">
                <div class="hero__subtitle text-white mb-20 md:mb-10">
                  Explore Keindahan Simalungun
                </div>

                <h1 class="hero__title text-white pb-30">
                  Kebun Teh Sidamanik
                </h1>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="hero__nav d-flex mt-40">
      <button class="button -outline-white rounded-full size-72 flex-center text-white js-sliderHero-prev">
        <i class="icon-arrow-left text-20"></i>
      </button>

      <button class="button -outline-white rounded-full size-72 flex-center text-white ml-10 js-sliderHero-next">
        <i class="icon-arrow-right text-20"></i>
      </button>
    </div>
  </div>
</section>

<section class="pb-50 bg-accent-1-05">
  <div data-anim-wrap class="container">
    <div class="tabs -pills-4 js-tabs">
      <div data-anim-child="slide-up" class="row y-gap-10 justify-between items-end y-gap-10">
        <div class="col-auto">
          <h2 class="text-30">Destinasi <br>Terpopuler </h2>
        </div>

        <div class="col-auto">
          <div class="tabs__controls row x-gap-10 y-gap-10 js-tabs-controls">

            <div class="col-auto">
              <button class="tabs__button text-14 px-15 py-5 fw-500 rounded-200 js-tabs-button is-tab-el-active" data-tab-target=".-tab-item-1">Wisata</button>
            </div>

            <div class="col-auto">
              <button class="tabs__button text-14 px-15 py-5 fw-500 rounded-200 js-tabs-button " data-tab-target=".-tab-item-2">Hotel</button>
            </div>

            <div class="col-auto">
              <button class="tabs__button text-14 px-15 py-5 fw-500 rounded-200 js-tabs-button " data-tab-target=".-tab-item-3">Restaurant</button>
            </div>

          </div>
        </div>
      </div>

      <div data-anim-child="slide-up delay-2" class="tabs__content pt-40 sm:pt-20 js-tabs-content">

        <div class="tabs__pane -tab-item-1 is-tab-el-active">
          <div class="js-section-slider" data-gap="30" data-slider-cols="xl-4 lg-3 md-2 sm-1 base-1" data-nav-prev="js-slider1-prev" data-nav-next="js-slider1-next">
            <div class="swiper-wrapper">

              @foreach ($tourism as $item)
              <div class="swiper-slide">
                <a href="{{ route('wisata.show', $item->slug) }}" class="tourCard -type-1 -rounded bg-white hover-shadow-1 overflow-hidden rounded-20 bg-white -hover-shadow">
                  <div class="tourCard__header">
                    <div class="tourCard__image ratio ratio-28:20">
                      @if(Storage::disk('public')->exists($item->image))
                        <img src="{{ Storage::url($item->image) }}" alt="image" class="img-ratio">
                      @else
                        <img src="{{ asset('front-assets/no-image.png') }}" alt="default image" class="img-ratio">
                      @endif
                      <div class="tourCard__shape"></div>
                    </div>
                  </div>
                  <div class="tourCard__content px-20 pb-10 h-100">
                    <h3 class="tourCard__title text-16 fw-500">
                      <span>{{ $item->name }}</span>
                    </h3>
                    <div class="tourCard__rating text-13 mt-5">
                      @if (count($item->tourismReview) > 0)
                          <div class="d-flex items-center">
                            <div class="d-flex x-gap-5 pr-10">
                              @for($i = 0; $i < round($item->tourismReview->average('rating'), 0); $i++)
                                <i class="flex-center icon-star text-yellow-2 text-12"></i>
                              @endfor
                            </div>
                            <span class="text-dark-1 text-13">{{ round($item->tourismReview->average('rating'), 1) }} ({{ count($item->tourismReview) }})</span>
                          </div>
                      @else
                        <div class="d-flex items-center align-items-center">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star text-yellow-2 text-12" viewBox="0 0 16 16">
                            <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                          </svg>
                          <span class="ml-10">Tidak ada rating</span>
                        </div>
                      @endif
                    </div>
                  </div>
                </a>
              </div>
              @endforeach

              <div class="swiper-slide">
                <a href="{{ route('wisata') }}" class="  -rounded bg-warning hover-shadow-1 overflow-hidden rounded-20 bg-white -hover-shadow">
                  <div class="tourCard__content">
                    <h3 class="tourCard__title text-16 fw-500 ">
                      <span>
                        Lihat Lainnya
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
                        </svg>
                      </span>
                    </h3>
                  </div>
                </a>
              </div>

            </div>
          </div>

          <div class="d-flex mt-40">
            <button class="button -dark-1 rounded-full size-72 flex-center bg-white js-slider1-prev">
              <i class="icon-arrow-left text-20"></i>
            </button>

            <button class="button -dark-1 rounded-full size-72 flex-center bg-white ml-10 js-slider1-next">
              <i class="icon-arrow-right text-20"></i>
            </button>
          </div>
        </div>

        <div class="tabs__pane -tab-item-2 ">
          <div class="js-section-slider" data-gap="30" data-slider-cols="xl-4 lg-3 md-2 sm-1 base-1" data-nav-prev="js-slider1-prev" data-nav-next="js-slider1-next">
            <div class="swiper-wrapper">

              @foreach ($hotel as $item)
              <div class="swiper-slide">
                <a href="{{ route('hotel.show', $item->slug) }}" class="tourCard -type-1 -rounded bg-white hover-shadow-1 overflow-hidden rounded-20 bg-white -hover-shadow">
                  <div class="tourCard__header">
                    <div class="tourCard__image ratio ratio-28:20">
                      @if(Storage::disk('public')->exists($item->image))
                        <img src="{{ Storage::url($item->image) }}" alt="image" class="img-ratio">
                      @else
                        <img src="{{ asset('front-assets/no-image.png') }}" alt="default image" class="img-ratio">
                      @endif
                      <div class="tourCard__shape"></div>
                    </div>
                  </div>
                  <div class="tourCard__content px-20 pb-10 h-100">
                    <h3 class="tourCard__title text-16 fw-500">
                      <span>{{ $item->name }}</span>
                    </h3>
                    <div class="tourCard__rating text-13 mt-5">
                      @if (count($item->hotelReview) > 0)
                          <div class="d-flex items-center">
                            <div class="d-flex x-gap-5 pr-10">
                              @for($i = 0; $i < round($item->hotelReview->average('rating'), 0); $i++)
                                <i class="flex-center icon-star text-yellow-2 text-12"></i>
                              @endfor
                            </div>
                            <span class="text-dark-1 text-13">{{ round($item->hotelReview->average('rating'), 1) }} ({{ count($item->hotelReview) }})</span>
                          </div>
                      @else
                        <div class="d-flex items-center align-items-center">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star text-yellow-2 text-12" viewBox="0 0 16 16">
                            <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                          </svg>
                          <span class="ml-10">Tidak ada rating</span>
                        </div>
                      @endif
                    </div>
                  </div>
                </a>
              </div>
              @endforeach

              <div class="swiper-slide">
                <a href="{{ route('hotel') }}" class="  -rounded bg-warning hover-shadow-1 overflow-hidden rounded-20 bg-white -hover-shadow">
                  <div class="tourCard__content">
                    <h3 class="tourCard__title text-16 fw-500 ">
                      <span>
                        Lihat Lainnya
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
                        </svg>
                      </span>
                    </h3>
                  </div>
                </a>
              </div>

            </div>
          </div>

          <div class="d-flex mt-40">
            <button class="button -dark-1 rounded-full size-72 flex-center bg-white js-slider1-prev">
              <i class="icon-arrow-left text-20"></i>
            </button>

            <button class="button -dark-1 rounded-full size-72 flex-center bg-white ml-10 js-slider1-next">
              <i class="icon-arrow-right text-20"></i>
            </button>
          </div>
        </div>

        <div class="tabs__pane -tab-item-3 ">
          <div class="js-section-slider" data-gap="30" data-slider-cols="xl-4 lg-3 md-2 sm-1 base-1" data-nav-prev="js-slider1-prev" data-nav-next="js-slider1-next">
            <div class="swiper-wrapper">

              @foreach ($restaurant as $item)
              <div class="swiper-slide">
                <a href="{{ route('restoran.show', $item->slug) }}" class="tourCard -type-1 -rounded bg-white hover-shadow-1 overflow-hidden rounded-20 bg-white -hover-shadow">
                  <div class="tourCard__header">
                    <div class="tourCard__image ratio ratio-28:20">
                      <div class="badge tourCard__favorite">
                        @if ($item->label)
                            <small> Halal</small>
                        @else
                          <small>Non-Halal</small>
                        @endif
                    </div>
                      @if(Storage::disk('public')->exists($item->image))
                        <img src="{{ Storage::url($item->image) }}" alt="image" class="img-ratio">
                      @else
                        <img src="{{ asset('front-assets/no-image.png') }}" alt="default image" class="img-ratio">
                      @endif
                      <div class="tourCard__shape"></div>
                    </div>
                  </div>
                  <div class="tourCard__content px-20 pb-10 h-100">
                    <h3 class="tourCard__title text-16 fw-500">
                      <span>{{ $item->name }}</span>
                    </h3>
                    <div class="tourCard__rating text-13 mt-5">
                      @if (count($item->restaurantReview) > 0)
                          <div class="d-flex items-center">
                            <div class="d-flex x-gap-5 pr-10">
                              @for($i = 0; $i < round($item->restaurantReview->average('rating'), 0); $i++)
                                <i class="flex-center icon-star text-yellow-2 text-12"></i>
                              @endfor
                            </div>
                            <span class="text-dark-1 text-13">{{ round($item->restaurantReview->average('rating'), 1) }} ({{ count($item->restaurantReview) }})</span>
                          </div>
                      @else
                        <div class="d-flex items-center align-items-center">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star text-yellow-2 text-12" viewBox="0 0 16 16">
                            <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                          </svg>
                          <span class="ml-10">Tidak ada rating</span>
                        </div>
                      @endif
                    </div>
                  </div>
                </a>
              </div>
              @endforeach

              <div class="swiper-slide">
                <a href="{{ route('restoran') }}" class="  -rounded bg-warning hover-shadow-1 overflow-hidden rounded-20 bg-white -hover-shadow">
                  <div class="tourCard__content">
                    <h3 class="tourCard__title text-16 fw-500 ">
                      <span>
                        Lihat Lainnya
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
                        </svg>
                      </span>
                    </h3>
                  </div>
                </a>
              </div>

            </div>
          </div>

          <div class="d-flex mt-40">
            <button class="button -dark-1 rounded-full size-72 flex-center bg-white js-slider1-prev">
              <i class="icon-arrow-left text-20"></i>
            </button>

            <button class="button -dark-1 rounded-full size-72 flex-center bg-white ml-10 js-slider1-next">
              <i class="icon-arrow-right text-20"></i>
            </button>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<section class="layout-pt-xl layout-pb-xl">
  <div data-anim-wrap class="container">
    <div data-anim-child="slide-up" class="row justify-between items-end y-gap-10">
      <div class="col-auto">
        <h2 class="text-30 md:text-24">Simalungun <br> Festival</h2>
      </div>

      <div class="col-auto">

        <a href="{{ route('festival') }}" class="buttonArrow d-flex items-center ">
          <span>Lihat Semua</span>
          <i class="icon-arrow-top-right text-16 ml-10"></i>
        </a>

      </div>
    </div>

    <div data-anim-child="slide-up delay-2" class="row y-gap-30 justify-between pt-40 sm:pt-20 mobile-css-slider -w-300">
      @foreach ($event as $item)
        <div class="col-lg-3 col-md-6">
          <a href="{{ route('festival.show', $item->slug) }}" class="tourCard -type-1 -rounded bg-white hover-shadow-1 overflow-hidden rounded-20 shadow-1 -hover-shadow">
            <div class="tourCard__header">
              <div class="tourCard__image ratio ratio-28:20">
                <img src="{{ Storage::url($item->image) }}" alt="image" class="img-ratio">
                <div class="tourCard__shape"></div>
              </div>
            </div>
            <div class="tourCard__content px-20 pb-10 pt-2">
              <h3 class="tourCard__title text-16 fw-500">
                <span>{{ $item->name }}</span>
              </h3>
              <div class="tourCard__location d-flex text-13 text-light-2 mt-5">
                <i class="icon-pin d-flex text-16 text-light-2 mr-5 mt-1"></i>
                {{ $item->address }}
              </div>
              <div class="d-flex justify-between items-center border-1-top text-13 text-dark-1 pt-10 mt-10">
                <div class="d-flex items-center">
                  <i class="icon-clock text-16 mr-5"></i>
                  {{ Carbon\Carbon::parse($item->date)->translatedFormat('j F Y') }}
                </div>
                <div><span class="text-16 fw-500">
                  @if ($item->price == 0)
                      Gratis
                  @else
                      Rp. {{ number_format($item->price) }}
                  @endif
                </span></div>
              </div>
            </div>
          </a>
        </div>
      @endforeach
    </div>
  </div>
</section>

<section data-anim="slide-up" class="cta -type-1">
  <div class="cta__bg">
    <img src="{{ asset('front-assets/') }}/img/cta/14/bg.png" alt="image">
  </div>
  <div class="container">
    <div class="row justify-between">
      <div class="col-xl-5 col-lg-6">
        <div class="cta__content">
          <h2 class="text-40 md:text-24 lh-13 text-white pb-5 mb-5">
            Unduh aplikasi<br class="lg:d-none">
            Simalungun Tourism
          </h2>
          <div class="mt-10">
            <div class="singleInput -type-2 row x-gap-10 y-gap-10">
              <a href="{{ \App\Models\Setting::webBase()->playstore }}" class="col-md-auto col-12">
                <img src="{{ asset('front-assets/img/playstore.png') }}" alt="">
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="cta__image">
          <img src="{{ asset('front-assets/') }}/img/cta/14/1.png" alt="image">
        </div>
      </div>
    </div>
  </div>
</section>

<section class="layout-pt-xl layout-pb-xl">
  <div data-anim-wrap class="container">
    <div data-anim-child="slide-up" class="row justify-between items-end y-gap-10">
      <div class="col-auto">
        <h2 class="text-30 md:text-24">Berita Terbaru</h2>
      </div>
      <div class="col-auto">
        <a href="{{ route('berita') }}"  class="buttonArrow d-flex items-center ">
          <span>Lihat Semua</span>
          <i class="icon-arrow-top-right text-16 ml-10"></i>
        </a>
      </div>
    </div>

    <div data-anim-child="slide-up delay-2" class="row y-gap-30 pt-40 sm:pt-20">
      @foreach ($news as $item)     
      <div class="col-lg-4 col-md-6 mb-15">
        <a href="{{ route('berita.show', $item->slug) }}" class="blogCard -type-1">
          <div class="blogCard__image ratio ratio-41:30">
            <img src="{{ Storage::url($item->image) }}" alt="image" class="img-ratio rounded-12">
          </div>
          <div class="blogCard__content mt-30">
            <div class="blogCard__info text-14">
              <div class="lh-13">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $item->date )->format('d F Y') }}</div>
              <div class="blogCard__line"></div>
              <div class="lh-13">{{ $item->user->name ?? '-' }}</div>
            </div>
            <h3 class="blogCard__title text-18 fw-500 mt-10">{{ $item->title }}</h3>
          </div>
        </a>
      </div>
      @endforeach
    </div>
  </div>
</section>

@endsection
