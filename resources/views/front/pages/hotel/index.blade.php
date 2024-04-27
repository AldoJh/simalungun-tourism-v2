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
            <a href="#">Hotel</a>
          </span>
        </div>
      </div>
    </div>

    <div class="row pt-10">
      <div class="col-12 d-lg-flex justify-between">
        <h1 class="pageHeader__title">Destinasi Hotel</h1>
        <div class="dropdown -base -price js-dropdown js-form-dd" data-main-value="">
          <div class="dropdown__button h-50 min-w-auto js-button -outline-dark-1">
            <i class="icon-sort-down text-18 mr-10"></i>
            <span class="js-title">Filter</span>
          </div>

          <form class="dropdown__menu px-30 py-30 shadow-1 border-1 js-">
            <h5 class="text-18 fw-500">Cari Hotel</h5>
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

<section data-anim-wrap class="layout-pb-xl">
  <div class="container">
    <div class="row y-gap-30 pt-30">
      <div data-anim-child="slide-up delay-3" class="col-lg-3 col-sm-6">
        <a href="#" class="tourCard -type-1 -rounded bg-white shadow-1 overflow-hidden rounded-20 bg-white -hover-shadow">
          <div class="tourCard__header">
            <div class="tourCard__image ratio ratio-28:20">
              <img src="{{ asset('front-assets/') }}/img/tourCards/1/1.png" alt="image" class="img-ratio">
              <div class="tourCard__shape"></div>
            </div>
          </div>
          <div class="tourCard__content px-20 pb-10 shadow">
            <h3 class="tourCard__title text-16 fw-500">
              <span>Danau Toba</span>
            </h3>
            <div class="tourCard__rating text-13 mt-5">
              <div class="d-flex items-center">
                <div class="d-flex x-gap-5 pr-10">
                  <i class="icon-star text-10 text-yellow-2"></i>
                  <i class="icon-star text-10 text-yellow-2"></i>
                  <i class="icon-star text-10 text-yellow-2"></i>
                  <i class="icon-star text-10 text-yellow-2"></i>
                  <i class="icon-star text-10 text-yellow-2"></i>
                </div>
                <span class="text-dark-1 text-13">4.8 (269)</span>
              </div>
            </div>
          </div>
        </a>
      </div>

      <div data-anim-child="slide-up delay-3" class="col-lg-3 col-sm-6">
        <a href="#" class="tourCard -type-1 -rounded bg-white shadow-1 overflow-hidden rounded-20 bg-white -hover-shadow">
          <div class="tourCard__header">
            <div class="tourCard__image ratio ratio-28:20">
              <img src="{{ asset('front-assets/') }}/img/tourCards/1/1.png" alt="image" class="img-ratio">
              <div class="tourCard__shape"></div>
            </div>
          </div>
          <div class="tourCard__content px-20 pb-10 shadow">
            <h3 class="tourCard__title text-16 fw-500">
              <span>Danau Toba</span>
            </h3>
            <div class="tourCard__rating text-13 mt-5">
              <div class="d-flex items-center">
                <div class="d-flex x-gap-5 pr-10">
                  <i class="icon-star text-10 text-yellow-2"></i>
                  <i class="icon-star text-10 text-yellow-2"></i>
                  <i class="icon-star text-10 text-yellow-2"></i>
                  <i class="icon-star text-10 text-yellow-2"></i>
                  <i class="icon-star text-10 text-yellow-2"></i>
                </div>
                <span class="text-dark-1 text-13">4.8 (269)</span>
              </div>
            </div>
          </div>
        </a>
      </div>

      <div data-anim-child="slide-up delay-3" class="col-lg-3 col-sm-6">
        <a href="#" class="tourCard -type-1 -rounded bg-white shadow-1 overflow-hidden rounded-20 bg-white -hover-shadow">
          <div class="tourCard__header">
            <div class="tourCard__image ratio ratio-28:20">
              <img src="{{ asset('front-assets/') }}/img/tourCards/1/1.png" alt="image" class="img-ratio">
              <div class="tourCard__shape"></div>
            </div>
          </div>
          <div class="tourCard__content px-20 pb-10 shadow">
            <h3 class="tourCard__title text-16 fw-500">
              <span>Danau Toba</span>
            </h3>
            <div class="tourCard__rating text-13 mt-5">
              <div class="d-flex items-center">
                <div class="d-flex x-gap-5 pr-10">
                  <i class="icon-star text-10 text-yellow-2"></i>
                  <i class="icon-star text-10 text-yellow-2"></i>
                  <i class="icon-star text-10 text-yellow-2"></i>
                  <i class="icon-star text-10 text-yellow-2"></i>
                  <i class="icon-star text-10 text-yellow-2"></i>
                </div>
                <span class="text-dark-1 text-13">4.8 (269)</span>
              </div>
            </div>
          </div>
        </a>
      </div>

      <div data-anim-child="slide-up delay-3" class="col-lg-3 col-sm-6">
        <a href="#" class="tourCard -type-1 -rounded bg-white shadow-1 overflow-hidden rounded-20 bg-white -hover-shadow">
          <div class="tourCard__header">
            <div class="tourCard__image ratio ratio-28:20">
              <img src="{{ asset('front-assets/') }}/img/tourCards/1/1.png" alt="image" class="img-ratio">
              <div class="tourCard__shape"></div>
            </div>
          </div>
          <div class="tourCard__content px-20 pb-10 shadow">
            <h3 class="tourCard__title text-16 fw-500">
              <span>Danau Toba</span>
            </h3>
            <div class="tourCard__rating text-13 mt-5">
              <div class="d-flex items-center">
                <div class="d-flex x-gap-5 pr-10">
                  <i class="icon-star text-10 text-yellow-2"></i>
                  <i class="icon-star text-10 text-yellow-2"></i>
                  <i class="icon-star text-10 text-yellow-2"></i>
                  <i class="icon-star text-10 text-yellow-2"></i>
                  <i class="icon-star text-10 text-yellow-2"></i>
                </div>
                <span class="text-dark-1 text-13">4.8 (269)</span>
              </div>
            </div>
          </div>
        </a>
      </div>

      <div data-anim-child="slide-up delay-3" class="col-lg-3 col-sm-6">
        <a href="#" class="tourCard -type-1 -rounded bg-white shadow-1 overflow-hidden rounded-20 bg-white -hover-shadow">
          <div class="tourCard__header">
            <div class="tourCard__image ratio ratio-28:20">
              <img src="{{ asset('front-assets/') }}/img/tourCards/1/1.png" alt="image" class="img-ratio">
              <div class="tourCard__shape"></div>
            </div>
          </div>
          <div class="tourCard__content px-20 pb-10 shadow">
            <h3 class="tourCard__title text-16 fw-500">
              <span>Danau Toba</span>
            </h3>
            <div class="tourCard__rating text-13 mt-5">
              <div class="d-flex items-center">
                <div class="d-flex x-gap-5 pr-10">
                  <i class="icon-star text-10 text-yellow-2"></i>
                  <i class="icon-star text-10 text-yellow-2"></i>
                  <i class="icon-star text-10 text-yellow-2"></i>
                  <i class="icon-star text-10 text-yellow-2"></i>
                  <i class="icon-star text-10 text-yellow-2"></i>
                </div>
                <span class="text-dark-1 text-13">4.8 (269)</span>
              </div>
            </div>
          </div>
        </a>
      </div>

      <div data-anim-child="slide-up delay-3" class="col-lg-3 col-sm-6">
        <a href="#" class="tourCard -type-1 -rounded bg-white shadow-1 overflow-hidden rounded-20 bg-white -hover-shadow">
          <div class="tourCard__header">
            <div class="tourCard__image ratio ratio-28:20">
              <img src="{{ asset('front-assets/') }}/img/tourCards/1/1.png" alt="image" class="img-ratio">
              <div class="tourCard__shape"></div>
            </div>
          </div>
          <div class="tourCard__content px-20 pb-10 shadow">
            <h3 class="tourCard__title text-16 fw-500">
              <span>Danau Toba</span>
            </h3>
            <div class="tourCard__rating text-13 mt-5">
              <div class="d-flex items-center">
                <div class="d-flex x-gap-5 pr-10">
                  <i class="icon-star text-10 text-yellow-2"></i>
                  <i class="icon-star text-10 text-yellow-2"></i>
                  <i class="icon-star text-10 text-yellow-2"></i>
                  <i class="icon-star text-10 text-yellow-2"></i>
                  <i class="icon-star text-10 text-yellow-2"></i>
                </div>
                <span class="text-dark-1 text-13">4.8 (269)</span>
              </div>
            </div>
          </div>
        </a>
      </div>

      <div data-anim-child="slide-up delay-3" class="col-lg-3 col-sm-6">
        <a href="#" class="tourCard -type-1 -rounded bg-white shadow-1 overflow-hidden rounded-20 bg-white -hover-shadow">
          <div class="tourCard__header">
            <div class="tourCard__image ratio ratio-28:20">
              <img src="{{ asset('front-assets/') }}/img/tourCards/1/1.png" alt="image" class="img-ratio">
              <div class="tourCard__shape"></div>
            </div>
          </div>
          <div class="tourCard__content px-20 pb-10 shadow">
            <h3 class="tourCard__title text-16 fw-500">
              <span>Danau Toba</span>
            </h3>
            <div class="tourCard__rating text-13 mt-5">
              <div class="d-flex items-center">
                <div class="d-flex x-gap-5 pr-10">
                  <i class="icon-star text-10 text-yellow-2"></i>
                  <i class="icon-star text-10 text-yellow-2"></i>
                  <i class="icon-star text-10 text-yellow-2"></i>
                  <i class="icon-star text-10 text-yellow-2"></i>
                  <i class="icon-star text-10 text-yellow-2"></i>
                </div>
                <span class="text-dark-1 text-13">4.8 (269)</span>
              </div>
            </div>
          </div>
        </a>
      </div>

      <div data-anim-child="slide-up delay-3" class="col-lg-3 col-sm-6">
        <a href="#" class="tourCard -type-1 -rounded bg-white shadow-1 overflow-hidden rounded-20 bg-white -hover-shadow">
          <div class="tourCard__header">
            <div class="tourCard__image ratio ratio-28:20">
              <img src="{{ asset('front-assets/') }}/img/tourCards/1/1.png" alt="image" class="img-ratio">
              <div class="tourCard__shape"></div>
            </div>
          </div>
          <div class="tourCard__content px-20 pb-10 shadow">
            <h3 class="tourCard__title text-16 fw-500">
              <span>Danau Toba</span>
            </h3>
            <div class="tourCard__rating text-13 mt-5">
              <div class="d-flex items-center">
                <div class="d-flex x-gap-5 pr-10">
                  <i class="icon-star text-10 text-yellow-2"></i>
                  <i class="icon-star text-10 text-yellow-2"></i>
                  <i class="icon-star text-10 text-yellow-2"></i>
                  <i class="icon-star text-10 text-yellow-2"></i>
                  <i class="icon-star text-10 text-yellow-2"></i>
                </div>
                <span class="text-dark-1 text-13">4.8 (269)</span>
              </div>
            </div>
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
