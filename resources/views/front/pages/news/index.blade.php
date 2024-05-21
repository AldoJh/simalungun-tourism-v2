@extends('front.app')

@section('seo')
  <meta
  name="keywords"
  content="wisata, simalungun, sumut, toba, sidamanik, tourism, destinasi, hotel, festival, restaurant, resto, berita"
  />
  <meta name="author" content="DISBUDPAREKRAF Simalungun" />
  <meta name="description" content="{!! \App\Models\Setting::webBase()->description !!}" />

  <!-- Open Graph Meta Tags -->
  <meta property="og:url" content="{{ route('berita') }}" />
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
  <link rel="canonical" href="{{ route('berita') }}" />
@endsection

@section('content')

<section data-anim="fade" class="pageHeader -type-3">
  <div class="container">
    <div class="row justify-between">
      <div class="col-auto">
        <div class="breadcrumbs">
          <span class="breadcrumbs__item">
            <a href="{{ route('home') }}">Home</a>
          </span>
          <span>></span>
          <span class="breadcrumbs__item">
            <a href="{{ route('berita') }}">Berita</a>
          </span>
        </div>
      </div>
    </div>
    <div class="row pt-10">
      <div class="col-12 d-lg-flex justify-between">
        <h1 class="pageHeader__title">Berita Terpopuler</h1>
      </div>
    </div>
  </div>
</section>

<section>
  <div data-anim-wrap class="container">
    <div class="grid -type-2 pt-10 sm:pt-20">

      @foreach ($tranding as $item)
      <a href="{{ route('berita.show', $item->slug) }}" data-anim-child="slide-up delay-1" class="featureCard -type-1 overflow-hidden rounded-12 px-30 py-30 -hover-image-scale">
        <div class="featureCard__image -hover-image-scale__image">
          @if(Storage::disk('public')->exists($item->image))
            <img src="{{ Storage::url($item->image) }}" alt="image" class="img-ratio">
          @else
            <img src="{{ asset('front-assets/no-image.png') }}" alt="default image" class="img-ratio">
          @endif
        </div>
        <div class="featureCard__content d-block">
          <h4 class="text-white d-block text-14">
            {{ $item->title }}
          </h4>
          <div class="blogCard__info text-13 text-white-50 d-flex">
            <div class="lh-13">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $item->date )->format('d F Y') }}</div>
          </div>
        </div>
      </a>
      @endforeach

    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="row pt-40 mt-30">
      <div class="col-12 d-lg-flex justify-between">
        <h1 class="pageHeader__title">
          @if (request('q'))
              Cari: "{{ request('q') }}"
          @else
              Berita Terbaru
          @endif
        </h1>
        <div class="dropdown -base -price js-dropdown js-form-dd" data-main-value="">
          <div class="dropdown__button h-50 min-w-auto js-button -outline-dark-1">
            <i class="icon-sort-down text-18 mr-10"></i>
            <span class="js-title">Filter</span>
          </div>

          <form  method="GET" action="{{ route('berita') }}" class="dropdown__menu px-30 py-30 shadow-1 border-1 js-">
            <h5 class="text-18 fw-500">Cari Berita</h5>
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
  <div class="container mt-20">
    <div class="row y-gap-30">
      @if ($news->total() == 0)
          <span class="text-center">
            Data yang kamu cari tidak ditemukan !!
          </span>
      @else
        @foreach ($news as $item)     
        <div class="col-lg-4 col-md-6 mb-15">
          <a href="{{ route('berita.show', $item->slug) }}" class="blogCard -type-1">
            <div class="blogCard__image ratio ratio-41:30">
              @if(Storage::disk('public')->exists($item->image))
                <img src="{{ Storage::url($item->image) }}" alt="image" class="img-ratio rounded-12">
              @else
                <img src="{{ asset('front-assets/no-image.png') }}" alt="default image" class="img-ratio rounded-12">
              @endif
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
      @endif
    </div>

    <div class="d-flex justify-center flex-column mt-60">
      <div class="pagination justify-center">
  
          @if ($news->onFirstPage())
              <button class="pagination__button button mr-15 -prev" disabled>
                  <i class="icon-arrow-left text-15"></i>
              </button>
          @else
              <a href="{{ $news->previousPageUrl() }}" class="pagination__button button -accent-1 mr-15 -prev">
                  <i class="icon-arrow-left text-15"></i>
              </a>
          @endif
  
          <div class="pagination__count">
              @php
                  $start = max($news->currentPage() - 2, 1);
                  $end = min($start + 2, $news->lastPage());
              @endphp
  
              @if ($start > 1)
                  <a href="{{ $news->url(1) }}" class="{{ ($news->currentPage() == 1) ? ' is-active' : '' }}">1</a>
                  <span>...</span>
              @endif
  
              @foreach ($news->getUrlRange($start, $end) as $page => $url)
                  <a href="{{ $url }}" class="{{ ($page == $news->currentPage()) ? ' is-active' : '' }}">{{ $page }}</a>
              @endforeach
  
              @if ($end < $news->lastPage())
                  <span>...</span>
                  <a href="{{ $news->url($news->lastPage()) }}" class="{{ ($news->currentPage() == $news->lastPage()) ? ' is-active' : '' }}">{{ $news->lastPage() }}</a>
              @endif
          </div>
  
          @if ($news->hasMorePages())
              <a href="{{ $news->nextPageUrl() }}" class="pagination__button button -accent-1 ml-15 -next">
                  <i class="icon-arrow-right text-15"></i>
              </a>
          @else
              <button class="pagination__button button ml-15 -next" disabled>
                  <i class="icon-arrow-right text-15"></i>
              </button>
          @endif
  
      </div>
      <div class="text-14 text-center mt-20">Showing results {{ $news->firstItem() }}-{{ $news->lastItem() }} of {{ $news->total() }}</div>
    </div>
  </div>
</section>

@endsection