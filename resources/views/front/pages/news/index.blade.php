@extends('front.app')
@section('content')

<section data-anim="fade" class="pageHeader -type-3">
  <div class="container">
    <div class="row justify-between">
      <div class="col-auto">
        <div class="breadcrumbs">
          <span class="breadcrumbs__item">
            <a href="#">Home</a>
          </span>
          <span>></span>
          <span class="breadcrumbs__item">
            <a href="#">Berita</a>
          </span>
        </div>
      </div>
    </div>

    <div class="row pt-10">
      <div class="col-12 d-lg-flex justify-between">
        <h1 class="pageHeader__title">Berita</h1>
        <div class="dropdown -base -price js-dropdown js-form-dd" data-main-value="">
          <div class="dropdown__button h-50 min-w-auto js-button -outline-dark-1">
            <i class="icon-sort-down text-18 mr-10"></i>
            <span class="js-title">Filter</span>
          </div>

          <form class="dropdown__menu px-30 py-30 shadow-1 border-1 js-">
            <h5 class="text-18 fw-500">Cari Berita</h5>
            <div class="pt-20">
              <div class="d-flex flex-column y-gap-15">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              </div>
            </div>
            <button type="submit" class="button px-25 py-10 lh-12 -accent-1 text-accent-1 bg-accent-1-05 border-accent-1 mt-20">
              Terapkan
              <i class="icon-arrow-top-right text-16 ml-10"></i>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<section>
  <div data-anim-wrap class="container">
    <div class="grid -type-2 pt-20 sm:pt-20">

      <a href="#" data-anim-child="slide-up delay-1" class="featureCard -type-1 overflow-hidden rounded-12 px-30 py-30 -hover-image-scale">
        <div class="featureCard__image -hover-image-scale__image">
          <img src="{{ asset('front-assets/') }}/img/features/2/1.jpg" alt="image">
        </div>

        <div class="featureCard__content d-block">
          <h4 class="text-white d-block">
            SIMALUNGUN CAR FREE DAY 2023 MERIAH
          </h4>
          <div class="blogCard__info text-14 text-white-50 d-flex">
            <div class="lh-13">April 06 2023 </div>
          </div>
        </div>
      </a>

      <a href="#" data-anim-child="slide-up delay-2" class="featureCard -type-1 overflow-hidden rounded-12 px-30 py-30 -hover-image-scale">
        <div class="featureCard__image -hover-image-scale__image">
          <img src="{{ asset('front-assets/') }}/img/features/2/2.jpg" alt="image">
        </div>

        <div class="featureCard__content d-block">
          <h4 class="text-white d-block">
            SIMALUNGUN CAR FREE DAY 2023 MERIAH
          </h4>
          <div class="blogCard__info text-14 text-white-50 d-flex">
            <div class="lh-13">April 06 2023 </div>
          </div>
        </div>
      </a>

      <a href="#" data-anim-child="slide-up delay-3" class="featureCard -type-1 overflow-hidden rounded-12 px-30 py-30 -hover-image-scale">
        <div class="featureCard__image -hover-image-scale__image">
          <img src="{{ asset('front-assets/') }}/img/features/2/3.jpg" alt="image">
        </div>

        <div class="featureCard__content">
          <h4 class="text-white">
            City Tours
          </h4>
        </div>
      </a>

      <a href="#" data-anim-child="slide-up delay-4" class="featureCard -type-1 overflow-hidden rounded-12 px-30 py-30 -hover-image-scale">
        <div class="featureCard__image -hover-image-scale__image">
          <img src="{{ asset('front-assets/') }}/img/features/2/4.jpg" alt="image">
        </div>

        <div class="featureCard__content">
          <h4 class="text-white">
            Museum Tour
          </h4>
        </div>
      </a>

      <a href="#" data-anim-child="slide-up delay-5" class="featureCard -type-1 overflow-hidden rounded-12 px-30 py-30 -hover-image-scale">
        <div class="featureCard__image -hover-image-scale__image">
          <img src="{{ asset('front-assets/') }}/img/features/2/5.jpg" alt="image">
        </div>

        <div class="featureCard__content">
          <h4 class="text-white">
            Food
          </h4>
        </div>
      </a>

      <a href="#" data-anim-child="slide-up delay-6" class="featureCard -type-1 overflow-hidden rounded-12 px-30 py-30 -hover-image-scale">
        <div class="featureCard__image -hover-image-scale__image">
          <img src="{{ asset('front-assets/') }}/img/features/2/6.jpg" alt="image">
        </div>

        <div class="featureCard__content">
          <h4 class="text-white">
            Hiking
          </h4>
        </div>
      </a>

    </div>
  </div>
</section>

<section data-anim-wrap class="layout-pb-xl">
  <div class="container">
    <div class="row y-gap-30 pt-30 mt-30">
      <div class="col-lg-4 col-md-6">
        <a href="#" class="blogCard -type-1">
          <div class="blogCard__image ratio ratio-41:30">
            <img src="{{ asset('front-assets/') }}/img/blogCards/1/1.png" alt="image" class="img-ratio rounded-12">
          </div>
          <div class="blogCard__content mt-30">
            <div class="blogCard__info text-14">
              <div class="lh-13">April 06 2023</div>
              <div class="blogCard__line"></div>
              <div class="lh-13">By Ali Tufan</div>
            </div>
            <h3 class="blogCard__title text-18 fw-500 mt-10">Kenya vs Tanzania Safari: The Better African Safari Experience</h3>
          </div>
        </a>
      </div>

      <div class="col-lg-4 col-md-6">
        <a href="#" class="blogCard -type-1">
          <div class="blogCard__image ratio ratio-41:30">
            <img src="{{ asset('front-assets/') }}/img/blogCards/1/1.png" alt="image" class="img-ratio rounded-12">
          </div>
          <div class="blogCard__content mt-30">
            <div class="blogCard__info text-14">
              <div class="lh-13">April 06 2023</div>
              <div class="blogCard__line"></div>
              <div class="lh-13">By Ali Tufan</div>
            </div>
            <h3 class="blogCard__title text-18 fw-500 mt-10">Kenya vs Tanzania Safari: The Better African Safari Experience</h3>
          </div>
        </a>
      </div>

      <div class="col-lg-4 col-md-6">
        <a href="#" class="blogCard -type-1">
          <div class="blogCard__image ratio ratio-41:30">
            <img src="{{ asset('front-assets/') }}/img/blogCards/1/1.png" alt="image" class="img-ratio rounded-12">
          </div>
          <div class="blogCard__content mt-30">
            <div class="blogCard__info text-14">
              <div class="lh-13">April 06 2023</div>
              <div class="blogCard__line"></div>
              <div class="lh-13">By Ali Tufan</div>
            </div>
            <h3 class="blogCard__title text-18 fw-500 mt-10">Kenya vs Tanzania Safari: The Better African Safari Experience</h3>
          </div>
        </a>
      </div>

      <div class="col-lg-4 col-md-6">
        <a href="#" class="blogCard -type-1">
          <div class="blogCard__image ratio ratio-41:30">
            <img src="{{ asset('front-assets/') }}/img/blogCards/1/1.png" alt="image" class="img-ratio rounded-12">
          </div>
          <div class="blogCard__content mt-30">
            <div class="blogCard__info text-14">
              <div class="lh-13">April 06 2023</div>
              <div class="blogCard__line"></div>
              <div class="lh-13">By Ali Tufan</div>
            </div>
            <h3 class="blogCard__title text-18 fw-500 mt-10">Kenya vs Tanzania Safari: The Better African Safari Experience</h3>
          </div>
        </a>
      </div>

      <div class="col-lg-4 col-md-6">
        <a href="#" class="blogCard -type-1">
          <div class="blogCard__image ratio ratio-41:30">
            <img src="{{ asset('front-assets/') }}/img/blogCards/1/1.png" alt="image" class="img-ratio rounded-12">
          </div>
          <div class="blogCard__content mt-30">
            <div class="blogCard__info text-14">
              <div class="lh-13">April 06 2023</div>
              <div class="blogCard__line"></div>
              <div class="lh-13">By Ali Tufan</div>
            </div>
            <h3 class="blogCard__title text-18 fw-500 mt-10">Kenya vs Tanzania Safari: The Better African Safari Experience</h3>
          </div>
        </a>
      </div>

      <div class="col-lg-4 col-md-6">
        <a href="#" class="blogCard -type-1">
          <div class="blogCard__image ratio ratio-41:30">
            <img src="{{ asset('front-assets/') }}/img/blogCards/1/1.png" alt="image" class="img-ratio rounded-12">
          </div>
          <div class="blogCard__content mt-30">
            <div class="blogCard__info text-14">
              <div class="lh-13">April 06 2023</div>
              <div class="blogCard__line"></div>
              <div class="lh-13">By Ali Tufan</div>
            </div>
            <h3 class="blogCard__title text-18 fw-500 mt-10">Kenya vs Tanzania Safari: The Better African Safari Experience</h3>
          </div>
        </a>
      </div>

    </div>

    <div class="d-flex justify-center flex-column mt-60">
      <div class="pagination justify-center">
        <button class="pagination__button button -accent-1 mr-15 -prev">
          <i class="icon-arrow-left text-15"></i>
        </button>
        <div class="pagination__count">
          <a href="#">1</a>
          <a href="#" class="is-active">2</a>
          <a href="#">3</a>
          <a href="#">4</a>
          <a href="#">5</a>
          <div>...</div>
          <a href="#">20</a>
        </div>
        <button class="pagination__button button -accent-1 ml-15 -next">
          <i class="icon-arrow-right text-15"></i>
        </button>
      </div>
      <div class="text-14 text-center mt-20">Showing results 1-8 of 1,415</div>
    </div>
  </div>
</section>

@endsection
