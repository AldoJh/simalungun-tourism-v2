@extends('front.app')
@section('content')

<div data-anim="fade" class="container">
  <div class="row justify-between py-30 mt-80">
    <div class="col-auto">
      <div class="text-14">Home > Tours > Phuket</div>
    </div>
  </div>
</div>

<section class="">
  <div data-anim-wrap class="container">
    <div data-anim-child="slide-up delay-2" class="tourSingleGrid -type-1">
      <div class="tourSingleGrid__grid mobile-css-slider-2">
        <img src="{{ asset('front-assets/') }}/img/tourSingle/1/1.png" alt="image">
        <img src="{{ asset('front-assets/') }}/img/tourSingle/1/2.png" alt="image">
        <img src="{{ asset('front-assets/') }}/img/tourSingle/1/3.png" alt="image">
        <img src="{{ asset('front-assets/') }}/img/tourSingle/1/4.png" alt="image">
      </div>
      <div class="tourSingleGrid__button">
        <a href="img/tourSingle/1/1.png" class="js-gallery" data-gallery="gallery1">
          <span class="button -accent-1 py-10 px-20 rounded-200 bg-dark-1 lh-16 text-white">See all photos</span>
        </a>
        <a href="img/tourSingle/1/2.png" class="js-gallery" data-gallery="gallery1"></a>
        <a href="img/tourSingle/1/3.png" class="js-gallery" data-gallery="gallery1"></a>
        <a href="img/tourSingle/1/4.png" class="js-gallery" data-gallery="gallery1"></a>
      </div>
    </div>
  </div>
</section>

<section class="layout-pt-md js-pin-container">
  <div data-anim-wrap class="container">
    <div data-anim-child="slide-up" class="row y-gap-20 justify-between items-end">
      <div class="col-auto">
        <h2 class="text-40 sm:text-30 lh-14">
          Phi Phi Islands Adventure Day Trip with<br>
          Seaview Lunch
        </h2>
        <div class="row x-gap-20 y-gap-20 items-center pt-20">
          <div class="col-auto">
            <div class="d-flex items-center">
              20 April 2024 by Fajar Rivaldi Chan
            </div>
          </div>
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
  <div class="container">
    <div class="row y-gap-30 justify-between">
      <div class="col-lg-8">
        <p class="mt-20">The Phi Phi archipelago is a must-visit while in Phuket, and this speedboat trip whisks you around the islands in one day. Swim over the coral reefs of Pileh Lagoon, have lunch at Phi Phi Leh, snorkel at Bamboo Island, and visit Monkey Beach and Maya Bay, immortalized in "The Beach." Boat transfers, snacks, buffet lunch, snorkeling equipment, and Phuket hotel pickup and drop-off all included.</p>

        <div class="line mt-60 mb-60"></div>

        <h2 class="text-30">Komentar</h2>

        <div class="pt-30">
          <div class="row justify-between">
            <div class="col-auto">
              <div class="d-flex items-center">
                <div class="size-40 rounded-full">
                  <img src="{{ asset('front-assets/') }}/img/reviews/avatars/1.png" alt="image" class="img-cover">
                </div>
                <div class="text-16 fw-500 ml-20">Ali Tufan</div>
              </div>
            </div>
            <div class="col-auto">
              <div class="text-14 text-light-2">April 2023</div>
            </div>
          </div>
          <p class="mt-10">Great for 4-5 hours to explore. Really a lot to see and tons of photo spots. Even have a passport for you to collect all the stamps as a souvenir. Must see for a Harry Potter fan.</p>
        </div>

        <h2 class="text-30 pt-60">Tulis Komentar</h2>
        <p>Tulis komentar kamu</p>
        @if (Auth::check())
          <div class="contactForm y-gap-30 pt-30">
            <div class="row">
              <div class="col-12">
                <div class="form-input ">
                  <textarea required rows="5"></textarea>
                  <label class="lh-1 text-16 text-light-1">Tulis apa aja...</label>
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
            <div class="contactForm">
              <div class="row">
                <div class="col-12">
                  <div class="form-input ">
                    <input type="text" required>
                    <label class="lh-1 text-16 text-light-1">Search...</label>
                  </div>
                </div>
              </div>
              <div class="line mt-20 mb-20"></div>
              <div class="row mt-20">
                <div class="col-auto">
                  <h2 class="text-18">Tranding</h2>
                </div>
                <div class="col-12 mt-20">
                  <a href="#" class="d-flex items-center -hover-image-scale">
                    <div class="size-100 relative rounded-12 -hover-image-scale__image">
                      <img src="{{ asset('front-assets/') }}/img/destinationCards/2/1.png" alt="image" class="img-ratio rounded-12">
                    </div>
      
                    <div class="ml-10">
                      <h3 class="text-15 fw-500">10 of the Best Solo Travel
                        Destinations for Women</h3>
                      <p class="text-14">20 April 2024</p>
                    </div>
                  </a>
                </div>
                <div class="col-12 mt-20">
                  <a href="#" class="d-flex items-center -hover-image-scale">
                    <div class="size-100 relative rounded-12 -hover-image-scale__image">
                      <img src="{{ asset('front-assets/') }}/img/destinationCards/2/1.png" alt="image" class="img-ratio rounded-12">
                    </div>
      
                    <div class="ml-10">
                      <h3 class="text-15 fw-500">10 of the Best Solo Travel
                        Destinations for Women</h3>
                      <p class="text-14">20 April 2024</p>
                    </div>
                  </a>
                </div>
                <div class="col-12 mt-20">
                  <a href="#" class="d-flex items-center -hover-image-scale">
                    <div class="size-100 relative rounded-12 -hover-image-scale__image">
                      <img src="{{ asset('front-assets/') }}/img/destinationCards/2/1.png" alt="image" class="img-ratio rounded-12">
                    </div>
      
                    <div class="ml-10">
                      <h3 class="text-15 fw-500">10 of the Best Solo Travel
                        Destinations for Women</h3>
                      <p class="text-14">20 April 2024</p>
                    </div>
                  </a>
                </div>
                <div class="col-12 mt-20">
                  <a href="#" class="d-flex items-center -hover-image-scale">
                    <div class="size-100 relative rounded-12 -hover-image-scale__image">
                      <img src="{{ asset('front-assets/') }}/img/destinationCards/2/1.png" alt="image" class="img-ratio rounded-12">
                    </div>
      
                    <div class="ml-10">
                      <h3 class="text-15 fw-500">10 of the Best Solo Travel
                        Destinations for Women</h3>
                      <p class="text-14">20 April 2024</p>
                    </div>
                  </a>
                </div>
                <div class="col-12 mt-20">
                  <a href="#" class="d-flex items-center -hover-image-scale">
                    <div class="size-100 relative rounded-12 -hover-image-scale__image">
                      <img src="{{ asset('front-assets/') }}/img/destinationCards/2/1.png" alt="image" class="img-ratio rounded-12">
                    </div>
      
                    <div class="ml-10">
                      <h3 class="text-15 fw-500">10 of the Best Solo Travel
                        Destinations for Women</h3>
                      <p class="text-14">20 April 2024</p>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection