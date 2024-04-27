
@extends('front.app')
@section('content')

<div data-anim="fade" class="container">
  <div class="row justify-between py-30 mt-80">
    <div class="col-12">
      <div class="text-14">Home > Hotel > aryaduta-simalungun</div>
    </div>
    <div class="col-12">
      <h2 class="text-40 sm:text-30 lh-14 mt-20">
        Aryaduta Simalungun
      </h2>
      <div class="row x-gap-20 y-gap-20 items-center d-flex justify-between pt-20">
        <div class="col-auto">
          <div class="d-flex items-center">
            <div class="d-flex x-gap-5 pr-10">
              <i class="flex-center icon-star text-yellow-2 text-12"></i>
              <i class="flex-center icon-star text-yellow-2 text-12"></i>
              <i class="flex-center icon-star text-yellow-2 text-12"></i>
              <i class="flex-center icon-star text-yellow-2 text-12"></i>
              <i class="flex-center icon-star text-yellow-2 text-12"></i>
            </div>
            4.8 (269)
          </div>
        </div>
        <div class="col-auto">
          <div class="d-flex x-gap-30 y-gap-10">
            <a href="#" class="d-flex items-center">
              <i class="icon-share flex-center text-16 mr-10"></i>
              Share
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div data-anim="fade" class="relative">
  <div class="container">
    <div class="row justify-center">
      <div class="col-lg-8">
        <div class="js-section-slider" data-gap="10" data-slider-cols="xl-1 lg-1 md-1 sm-1 base-1" data-nav-prev="js-sliderMain-prev" data-nav-next="js-sliderMain-next" data-loop>
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <img src="{{ asset('front-assets/') }}/img/tourSingle/2/1.png" alt="image" class="img-cover rounded-12">
            </div>

            <div class="swiper-slide">
              <img src="{{ asset('front-assets/') }}/img/tourSingle/2/2.png" alt="image" class="img-cover rounded-12">
            </div>

            <div class="swiper-slide">
              <img src="{{ asset('front-assets/') }}/img/tourSingle/2/3.png" alt="image" class="img-cover rounded-12">
            </div>

          </div>

          <div class="navAbsolute -type-2">
            <button class="navAbsolute__button bg-white js-sliderMain-prev">
              <i class="icon-arrow-left text-14"></i>
            </button>

            <button class="navAbsolute__button bg-white js-sliderMain-next">
              <i class="icon-arrow-right text-14"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<section class="layout-pt-md js-pin-container">
  <div class="container">
    <div class="row y-gap-30">
      <div class="col-lg-8">
        <div class="row y-gap-20 items-center layout-pb-md">

          <div class="col-lg-3 col-6">
            <div class="d-flex items-center">
              <div class="flex-center size-50 rounded-12 border-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                  <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                </svg>
              </div>
              <div class="ml-10">
                <div class="lh-16">Bintang</div>
                <div class="text-14 text-light-2 lh-16">3 </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="d-flex items-center">
              <div class="flex-center size-50 rounded-12 border-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-patch-check" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M10.354 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                  <path d="m10.273 2.513-.921-.944.715-.698.622.637.89-.011a2.89 2.89 0 0 1 2.924 2.924l-.01.89.636.622a2.89 2.89 0 0 1 0 4.134l-.637.622.011.89a2.89 2.89 0 0 1-2.924 2.924l-.89-.01-.622.636a2.89 2.89 0 0 1-4.134 0l-.622-.637-.89.011a2.89 2.89 0 0 1-2.924-2.924l.01-.89-.636-.622a2.89 2.89 0 0 1 0-4.134l.637-.622-.011-.89a2.89 2.89 0 0 1 2.924-2.924l.89.01.622-.636a2.89 2.89 0 0 1 4.134 0l-.715.698a1.89 1.89 0 0 0-2.704 0l-.92.944-1.32-.016a1.89 1.89 0 0 0-1.911 1.912l.016 1.318-.944.921a1.89 1.89 0 0 0 0 2.704l.944.92-.016 1.32a1.89 1.89 0 0 0 1.912 1.911l1.318-.016.921.944a1.89 1.89 0 0 0 2.704 0l.92-.944 1.32.016a1.89 1.89 0 0 0 1.911-1.912l-.016-1.318.944-.921a1.89 1.89 0 0 0 0-2.704l-.944-.92.016-1.32a1.89 1.89 0 0 0-1.912-1.911z"/>
                </svg>
              </div>
              <div class="ml-10">
                <div class="lh-16">Status</div>
                <div class="text-14 text-light-2 lh-16">Terverifikasi</div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="d-flex items-center">
              <div class="flex-center size-50 rounded-12 border-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-houses" viewBox="0 0 16 16">
                  <path d="M5.793 1a1 1 0 0 1 1.414 0l.647.646a.5.5 0 1 1-.708.708L6.5 1.707 2 6.207V12.5a.5.5 0 0 0 .5.5.5.5 0 0 1 0 1A1.5 1.5 0 0 1 1 12.5V7.207l-.146.147a.5.5 0 0 1-.708-.708zm3 1a1 1 0 0 1 1.414 0L12 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l1.854 1.853a.5.5 0 0 1-.708.708L15 8.207V13.5a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 4 13.5V8.207l-.146.147a.5.5 0 1 1-.708-.708zm.707.707L5 7.207V13.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5V7.207z"/>
                </svg>
              </div>
              <div class="ml-10">
                <div class="lh-16">Kamar</div>
                <div class="text-14 text-light-2 lh-16">120</div>
              </div>
            </div>
          </div>
        </div>

        <p class="mt-20">The Phi Phi archipelago is a must-visit while in Phuket, and this speedboat trip whisks you around the islands in one day. Swim over the coral reefs of Pileh Lagoon, have lunch at Phi Phi Leh, snorkel at Bamboo Island, and visit Monkey Beach and Maya Bay, immortalized in "The Beach." Boat transfers, snacks, buffet lunch, snorkeling equipment, and Phuket hotel pickup and drop-off all included.</p>

        <div class="line mt-60 mb-60"></div>

        <h2 class="text-30">Fasilitas</h2>

        <div class="row x-gap-130 y-gap-20 pt-20">
          <div class="col-lg-6">
            <div class="y-gap-15">
              <div class="d-flex">
                <i class="icon-check flex-center text-10 size-24 rounded-full text-green-2 bg-green-1 mr-15"></i>
                Beverages, drinking water, morning tea and buffet lunch
              </div>
              <div class="d-flex">
                <i class="icon-check flex-center text-10 size-24 rounded-full text-green-2 bg-green-1 mr-15"></i>
                Local taxes
              </div>
              <div class="d-flex">
                <i class="icon-check flex-center text-10 size-24 rounded-full text-green-2 bg-green-1 mr-15"></i>
                Hotel pickup and drop-off by air-conditioned minivan
              </div>
              <div class="d-flex">
                <i class="icon-check flex-center text-10 size-24 rounded-full text-green-2 bg-green-1 mr-15"></i>
                InsuranceTransfer to a private pier
              </div>
              <div class="d-flex">
                <i class="icon-check flex-center text-10 size-24 rounded-full text-green-2 bg-green-1 mr-15"></i>
                Soft drinks
              </div>
              <div class="d-flex">
                <i class="icon-check flex-center text-10 size-24 rounded-full text-green-2 bg-green-1 mr-15"></i>
                Tour Guide
              </div>
            </div>
          </div>
        </div>

        <div class="line mt-60 mb-60"></div>


        <h2 class="text-30">Reviews Teratas</h2>

        <div class="pt-30">
          <div class="row justify-between">
            <div class="col-auto">
              <div class="d-flex items-center">
                <div class="size-40 rounded-full">
                  <img src="img/reviews/avatars/1.png" alt="image" class="img-cover">
                </div>
                <div class="text-16 fw-500 ml-20">Ali Tufan</div>
              </div>
            </div>
            <div class="col-auto">
              <div class="text-14 text-light-2">April 2023</div>
            </div>
          </div>

          <div class="d-flex items-center mt-15">
            <div class="d-flex x-gap-5">
              <i class="icon-star text-yellow-2 text-10"></i>
              <i class="icon-star text-yellow-2 text-10"></i>
              <i class="icon-star text-yellow-2 text-10"></i>
              <i class="icon-star text-yellow-2 text-10"></i>
              <i class="icon-star text-yellow-2 text-10"></i>
            </div>
          </div>
          <p class="mt-10">Great for 4-5 hours to explore. Really a lot to see and tons of photo spots. Even have a passport for you to collect all the stamps as a souvenir. Must see for a Harry Potter fan.</p>
        </div>

        <h2 class="text-30 pt-60">Tulis Review</h2>
        <p>Tulis review kamu unuk destinasi ini</p>
        @if (Auth::check())
        <div class="contactForm y-gap-30 pt-30 mb-lg-20 pb-20">
          <div class="row">
            <div class="col-12">
              <div class="form-input ">
                <textarea required rows="5"></textarea>
                <label class="lh-1 text-16 text-light-1">Review Destinasi</label>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <button class="button -md -dark-1 bg-accent-1 text-white">
                Kirim
              </button>
            </div>
          </div>
        </div>
        @else
        <div class="row mt-10">
          <div class="col-12">
            <button class="text-accent-1">
              <u>Masuk Dulu
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z"/>
                  <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                </svg>
              </u>
            </button>
          </div>
        </div>
        @endif
      </div>

      <div class="col-lg-4">
        <div class="d-flex justify-end js-pin-content">
          <div class="tourSingleSidebar">
            <div class="searchForm -type-1 -sidebar mt-20">
              <div class="searchForm__form">
                <div class="searchFormItem js-select-control js-form-dd js-calendar">
                  <div class="searchFormItem__button" data-x-click="calendar">
                    <div class="searchFormItem__icon size-50 rounded-12 bg-light-1 flex-center">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                        <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
                      </svg>
                    </div>
                    <div class="searchFormItem__content">
                      <h5>Telepon</h5>
                      <span class="js-first-date">0895-61110-24559</span>
                    </div>
                  </div>
                </div>

                <div class="searchFormItem js-select-control js-form-dd">
                  <div class="searchFormItem__button" data-x-click="time">
                    <div class="searchFormItem__icon size-50 rounded-12 bg-light-1 flex-center">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                        <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/>
                        <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                      </svg>
                    </div>
                    <div class="searchFormItem__content">
                      <h5>Lokasi</h5>
                      <div class="js-select-control-chosen">Choose time</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="line mt-20 mb-20"></div>

            <div class="text-15 fw-500">Harga:</div>
            <div class="text-18 fw-400">Rp. 1.110.000 - Rp. 8.680.000</div>
            <button class="button -md -dark-1 col-12 bg-accent-1 text-white mt-20">
              Lihat Rute
              <i class="icon-arrow-top-right ml-10"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection