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
            <a href="#">Festival</a>
          </span>
        </div>
      </div>
    </div>

    <div class="row pt-10">
      <div class="col-12 d-lg-flex justify-between">
        <h1 class="pageHeader__title">Simalungun Festival</h1>
      </div>
    </div>
  </div>
</section>

<section class="layout-pb-xl">
  <div class="container">
    <div class="row pt-lg-30">
      <div class="col-xl-3 col-lg-4 mb-20">
        <div class="">
          <div class="sidebar -type-1 rounded-12">
            <div class="sidebar__header bg-accent-1">
              <div class="text-15 text-white fw-500">Cari Festival</div>

              <div class="mt-10">
                <div class="searchForm -type-1 -col-1 -narrow">
                  <div class="searchForm__form">
                    <div class="form-input pt-10 ">
                      <input type="text" class="ps-3" required placeholder="Search...">
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="sidebar__content">
              <div class="sidebar__item">
                <div class="accordion -simple-2 js-accordion">
                  <div class="accordion__item js-accordion-item-active">
                    <div class="accordion__button d-flex items-center justify-between">
                      <h5 class="text-18 fw-500">Filter</h5>
                      <div class="accordion__icon flex-center">
                        <i class="icon-chevron-down"></i>
                        <i class="icon-chevron-down"></i>
                      </div>
                    </div>
                    <div class="accordion__content">
                      <div class="pt-15">
                        <div class="d-flex flex-column y-gap-15">
                          <div>
                            <div class="d-flex items-center">
                              <div class="form-checkbox ">
                                <input type="checkbox" name="name">
                                <div class="form-checkbox__mark">
                                  <div class="form-checkbox__icon">
                                    <svg width="10" height="8" viewBox="0 0 10 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M9.29082 0.971021C9.01235 0.692189 8.56018 0.692365 8.28134 0.971021L3.73802 5.51452L1.71871 3.49523C1.43988 3.21639 0.987896 3.21639 0.709063 3.49523C0.430231 3.77406 0.430231 4.22604 0.709063 4.50487L3.23309 7.0289C3.37242 7.16823 3.55512 7.23807 3.73783 7.23807C3.92054 7.23807 4.10341 7.16841 4.24274 7.0289L9.29082 1.98065C9.56965 1.70201 9.56965 1.24984 9.29082 0.971021Z" fill="white" />
                                    </svg>
                                  </div>
                                </div>
                              </div>
                              <div class="lh-11 ml-10">Festival Hari Ini</div>
                            </div>
                          </div>
                          <div>
                            <div class="d-flex items-center">
                              <div class="form-checkbox ">
                                <input type="checkbox" name="name">
                                <div class="form-checkbox__mark">
                                  <div class="form-checkbox__icon">
                                    <svg width="10" height="8" viewBox="0 0 10 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M9.29082 0.971021C9.01235 0.692189 8.56018 0.692365 8.28134 0.971021L3.73802 5.51452L1.71871 3.49523C1.43988 3.21639 0.987896 3.21639 0.709063 3.49523C0.430231 3.77406 0.430231 4.22604 0.709063 4.50487L3.23309 7.0289C3.37242 7.16823 3.55512 7.23807 3.73783 7.23807C3.92054 7.23807 4.10341 7.16841 4.24274 7.0289L9.29082 1.98065C9.56965 1.70201 9.56965 1.24984 9.29082 0.971021Z" fill="white" />
                                    </svg>
                                  </div>
                                </div>
                              </div>
                              <div class="lh-11 ml-10">Festival Minggu Ini</div>
                            </div>
                          </div>
                          <div>
                            <div class="d-flex items-center">
                              <div class="form-checkbox ">
                                <input type="checkbox" name="name">
                                <div class="form-checkbox__mark">
                                  <div class="form-checkbox__icon">
                                    <svg width="10" height="8" viewBox="0 0 10 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M9.29082 0.971021C9.01235 0.692189 8.56018 0.692365 8.28134 0.971021L3.73802 5.51452L1.71871 3.49523C1.43988 3.21639 0.987896 3.21639 0.709063 3.49523C0.430231 3.77406 0.430231 4.22604 0.709063 4.50487L3.23309 7.0289C3.37242 7.16823 3.55512 7.23807 3.73783 7.23807C3.92054 7.23807 4.10341 7.16841 4.24274 7.0289L9.29082 1.98065C9.56965 1.70201 9.56965 1.24984 9.29082 0.971021Z" fill="white" />
                                    </svg>
                                  </div>
                                </div>
                              </div>
                              <div class="lh-11 ml-10">Festival Bulan Ini</div>
                            </div>
                          </div>
                          <div>
                            <div class="d-flex items-center">
                              <div class="form-checkbox ">
                                <input type="checkbox" name="name">
                                <div class="form-checkbox__mark">
                                  <div class="form-checkbox__icon">
                                    <svg width="10" height="8" viewBox="0 0 10 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M9.29082 0.971021C9.01235 0.692189 8.56018 0.692365 8.28134 0.971021L3.73802 5.51452L1.71871 3.49523C1.43988 3.21639 0.987896 3.21639 0.709063 3.49523C0.430231 3.77406 0.430231 4.22604 0.709063 4.50487L3.23309 7.0289C3.37242 7.16823 3.55512 7.23807 3.73783 7.23807C3.92054 7.23807 4.10341 7.16841 4.24274 7.0289L9.29082 1.98065C9.56965 1.70201 9.56965 1.24984 9.29082 0.971021Z" fill="white" />
                                    </svg>
                                  </div>
                                </div>
                              </div>
                              <div class="lh-11 ml-10">Segera Hadir</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div data-anim="slide-up delay-2" class="col-xl-9 col-lg-8">
        <div class="row y-gap-30">

          <div class="col-12">
            <div class="tourCard -type-2">
              <div class="tourCard__image">
                <img src="{{ asset('front-assets/') }}/img/tourCards/3/1.png" alt="image">
                <div class="tourCard__badge">
                  <div class="bg-accent-1 rounded-12 text-white lh-11 text-13 px-15 py-10">
                    Gratis
                  </div>
                </div>
              </div>

              <div class="tourCard__content">
                <h3 class="tourCard__title mt-5">
                  <span>Phi Phi Islands Adventure Day Trip with Seaview Lunch by V. Marine Tour</span>
                </h3>
                <div class="row x-gap-20 y-gap-5">
                  <div class="col-auto">
                    <div class="text-14 text-accent-1">
                      34 April 2024
                    </div>
                  </div>
                </div>
                <div class="tourCard__location pt-5">
                  <i class="icon-pin"></i>
                  Pantai Bebas Parapat, Danau Toba, Danau Toba, Jalan Sisingamangaraja, Tiga Raja, Kabupaten Simalungun, Sumatera Utara, Indonesia
                </div>
                <button class="button -outline-accent-1 text-accent-1 px-20 py-10 mt-30">
                  Lihat Details
                  <i class="icon-arrow-top-right ml-10"></i>
                </button>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="tourCard -type-2">
              <div class="tourCard__image">
                <img src="{{ asset('front-assets/') }}/img/tourCards/3/1.png" alt="image">
                <div class="tourCard__badge">
                  <div class="bg-accent-1 rounded-12 text-white lh-11 text-13 px-15 py-10">
                    Rp. 20.000
                  </div>
                </div>
              </div>

              <div class="tourCard__content">
                <h3 class="tourCard__title mt-5">
                  <span>Phi Phi Islands Adventure Day Trip with Seaview Lunch by V. Marine Tour</span>
                </h3>
                <div class="row x-gap-20 y-gap-5">
                  <div class="col-auto">
                    <div class="text-14 text-accent-1">
                      34 April 2024
                    </div>
                  </div>
                </div>
                <div class="tourCard__location pt-5">
                  <i class="icon-pin"></i>
                  Pantai Bebas Parapat, Danau Toba, Danau Toba, Jalan Sisingamangaraja, Tiga Raja, Kabupaten Simalungun, Sumatera Utara, Indonesia
                </div>
                <button class="button -outline-accent-1 text-accent-1 px-20 py-10 mt-30">
                  View Details
                  <i class="icon-arrow-top-right ml-10"></i>
                </button>
              </div>
            </div>
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

          <div class="text-14 text-center mt-20">Showing results 1-30 of 1,415</div>

        </div>
      </div>
    </div>
  </div>
</section>

@endsection
