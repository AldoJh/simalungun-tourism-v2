@extends('front.app')

@section('seo')
  <meta
  name="keywords"
  content="wisata, simalungun, sumut, toba, sidamanik, tourism, destinasi, hotel, festival, restaurant, resto, berita"
  />
  <meta name="author" content="DISPAR Simalungun" />
  <meta name="description" content="{!! \App\Models\Setting::webBase()->description !!}" />

  <!-- Open Graph Meta Tags -->
  <meta property="og:url" content="{{ route('wisata') }}" />
  <meta property="og:title" content="Simalungun | {{$title ?? ''}}" />
  <meta property="og:type" content="article" />
  <meta property="og:image" content="{{ asset('front-assets/meta/wisata.png') }}" />
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
  <meta name="twitter:image" content="{{ asset('front-assets/meta/wisata.png') }}" />

  <!-- Additional SEO Meta Tags -->
  <meta name="distribution" content="global" />
  <meta name="revisit-after" content="7 days" />
  <meta name="rating" content="general" />
  <meta name="language" content="Indonesian" />
  <meta name="geo.region" content="ID" />
  <meta name="geo.placename" content="Simalungun" />

  <!-- Canonical Tag -->
  <link rel="canonical" href="{{ route('wisata') }}" />
@endsection

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
            <a href="#">Wisata</a>
          </span>
        </div>
      </div>
    </div>

    <div class="row pt-10">
      <div class="col-12 d-lg-flex justify-between">
        <h1 class="pageHeader__title">
          @if (request('q'))
            Cari: "{{ request('q') }}"
          @else
            Destinasi Wisata
          @endif
        </h1>
        <div class="dropdown -base -price js-dropdown js-form-dd" data-main-value="">
          <div class="dropdown__button h-50 min-w-auto js-button -outline-dark-1">
            <i class="icon-sort-down text-18 mr-10"></i>
            <span class="js-title">Filter</span>
          </div>

          <form method="GET" action="{{ route('wisata') }}" class="dropdown__menu px-30 py-30 shadow-1 border-1 js-">
            <h5 class="text-18 fw-500">Cari Wisata</h5>
            <input type="hidden" name="page" value="{{ request('page', 1) }}">
            <div class="pt-20">
              <div class="d-flex flex-column y-gap-15">
                <input class="form-control me-2" type="search" placeholder="Search" name="q" value="{{ request('q') }}" aria-label="Search">
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
      @if ($tourism->total() == 0)
          <span class="text-center">
            Data yang kamu cari tidak ditemukan !!
          </span>
      @else
      @foreach ($tourism as $item)
        <div data-anim-child="slide-up delay-3" class="col-lg-3 col-sm-6">
          <a href="{{ route('wisata.show', $item->slug) }}" class="tourCard -type-1 -rounded bg-white shadow-1 overflow-hidden rounded-20 bg-white -hover-shadow">
            <div class="tourCard__header">
              <div class="tourCard__image ratio ratio-28:20">
                @if ($item->is_recomended)
                  <div class="badge tourCard__favorite">
                    <small>Rekomendasi</small>
                  </div>
                @endif
                @if(Storage::disk('public')->exists($item->image))
                  <img src="{{ Storage::url($item->image) }}" alt="image" class="img-ratio">
                @else
                  <img src="{{ asset('front-assets/no-image.png') }}" alt="default image" class="img-ratio">
                @endif
                <div class="tourCard__shape"></div>
              </div>
            </div>
            <div class="tourCard__content px-20 pb-10 shadow">
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
      @endif
    </div>

    <div class="d-flex justify-center flex-column mt-60">
      <div class="pagination justify-center">
  
          @if ($tourism->onFirstPage())
              <button class="pagination__button button mr-15 -prev" disabled>
                  <i class="icon-arrow-left text-15"></i>
              </button>
          @else
              <a href="{{ $tourism->previousPageUrl() }}" class="pagination__button button -accent-1 mr-15 -prev">
                  <i class="icon-arrow-left text-15"></i>
              </a>
          @endif
  
          <div class="pagination__count">
              @php
                  $start = max($tourism->currentPage() - 2, 1);
                  $end = min($start + 2, $tourism->lastPage());
              @endphp
  
              @if ($start > 1)
                  <a href="{{ $tourism->url(1) }}" class="{{ ($tourism->currentPage() == 1) ? ' is-active' : '' }}">1</a>
                  <span>...</span>
              @endif
  
              @foreach ($tourism->getUrlRange($start, $end) as $page => $url)
                  <a href="{{ $url }}" class="{{ ($page == $tourism->currentPage()) ? ' is-active' : '' }}">{{ $page }}</a>
              @endforeach
  
              @if ($end < $tourism->lastPage())
                  <span>...</span>
                  <a href="{{ $tourism->url($tourism->lastPage()) }}" class="{{ ($tourism->currentPage() == $tourism->lastPage()) ? ' is-active' : '' }}">{{ $tourism->lastPage() }}</a>
              @endif
          </div>
  
          @if ($tourism->hasMorePages())
              <a href="{{ $tourism->nextPageUrl() }}" class="pagination__button button -accent-1 ml-15 -next">
                  <i class="icon-arrow-right text-15"></i>
              </a>
          @else
              <button class="pagination__button button ml-15 -next" disabled>
                  <i class="icon-arrow-right text-15"></i>
              </button>
          @endif
  
      </div>
      <div class="text-14 text-center mt-20">Showing results {{ $tourism->firstItem() }}-{{ $tourism->lastItem() }} of {{ $tourism->total() }}</div>
    </div>
  </div>
</section>

@endsection
