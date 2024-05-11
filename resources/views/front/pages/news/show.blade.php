@extends('front.app')

@section('seo')
  <meta
  name="keywords"
  content="wisata, simalungun, sumut, toba, sidamanik, tourism, destinasi, hotel, festival, restaurant, resto, berita"
  />
  <meta name="author" content="{{ $news->user->name?? '' }}" />
  <meta name="description" content="{{ $news->description }}" />

  <!-- Open Graph Meta Tags -->
  <meta property="og:url" content="{{ route('berita.show', $news->slug) }}" />
  <meta property="og:title" content="{{$news->title ?? ''}}" />
  <meta property="og:type" content="article" />
  <meta property="og:image" content="{{url(Storage::url($news->image))}}" />
  <meta
    property="og:description"
    content="{{ $news->description }}"
  />
  <meta property="og:locale" content="id_ID" />

  <!-- Twitter Card Meta Tags -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="{{$news->title}}" />
  <meta
    name="twitter:description"
    content="{{ $news->description }}"
  />
  <meta name="twitter:image" content="{{url(Storage::url($news->image))}}" />

  <!-- Additional SEO Meta Tags -->
  <meta name="distribution" content="global" />
  <meta name="revisit-after" content="7 days" />
  <meta name="rating" content="general" />
  <meta name="language" content="Indonesian" />
  <meta name="geo.region" content="ID" />
  <meta name="geo.placename" content="Simalungun" />

  <!-- Canonical Tag -->
  <link rel="canonical" href="{{ route('berita.show', $news->slug) }}" />
@endsection

@section('content')

<div data-anim="fade" class="container">
  <div class="row justify-between py-30 mt-80">
    <div class="col-auto">
      <div class="text-14">Home > Berita > {{ $news->slug }}</div>
    </div>
  </div>
</div>

<section class="">
  <div data-anim-wrap class="container">
    <div data-anim-child="slide-up delay-2" class="tourSingleGrid -type-1">
      <div class="tourSingleGrid__grid mobile-css-slider-2">
        @foreach ($news->newsImage->take(4) as $item)
          @if(Storage::disk('public')->exists($item->image))
            <img src="{{ Storage::url($item->image) }}" alt="image">
          @else
            <img src="{{ asset('front-assets/no-image.png') }}" alt="default image">
          @endif
        @endforeach
      </div>
      <div class="tourSingleGrid__button">
        <a href="{{ Storage::url($news->newsImage[0]->image) }}" class="js-gallery" data-gallery="gallery1">
          <span class="button -accent-1 py-10 px-20 rounded-200 bg-dark-1 lh-16 text-white">Lihat semua Foto</span>
        </a>
        @foreach ($news->newsImage as $item)
        @if ($loop->iteration > 1)
          @if(Storage::disk('public')->exists($item->image))
            <a href="{{ Storage::url($item->image) }}" class="js-gallery" data-gallery="gallery1"></a>
          @else
            <a href="{{ asset('front-assets/no-image.png') }}" class="js-gallery" data-gallery="gallery1"></a>
          @endif
        @endif
      @endforeach
      </div>
    </div>
  </div>
</section>

{{-- {{ dd($news->newsImage[0]->image) }} --}}

<section class="layout-pt-md js-pin-container">
  <div data-anim-wrap class="container">
    <div class="row y-gap-20 justify-between items-end">
      <div class="col-auto">
        <h2 class="text-30 sm:text-20 lh-14">
          {{ $news->title }}
        </h2>
      </div>
      <div class="row d-flex justify-content-between x-gap-20 y-gap-20 items-center">
        <div class="col-auto">
          <div class="d-flex items-center">
            {{ \Carbon\Carbon::createFromFormat('Y-m-d', $news->date )->format('d F Y') }} by {{ $news->user->name ?? '-' }}
          </div>
        </div>
        <div class="col-auto">
          <div class="d-flex x-gap-30 y-gap-10">
            <div class="dropdown -base -price js-dropdown js-form-dd" data-main-value="">
              <div class="d-flex align-content-center h-50 min-w-auto js-button -outline-dark-1">
                <i class="icon-share text-16 mt-5 mr-10"></i>
                <span class="js-title">share</span>
              </div>
    
              <div class="dropdown__menu px-30 py-30 shadow-1 border-1 js-">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('berita.show', $news->slug) }}" target="_blank" class="dropdown__button h-50 min-w-auto js-button -outline-dark-1">
                  <div class="d-flex flex-center text-16 ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                      <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                    </svg>
                    <span class="js-title ml-10">Facebook</span>
                  </div>
                </a>
                <a href=" http://www.linkedin.com/shareArticle?mini=true&url={{ route('berita.show', $news->slug) }}" target="_blank" class="dropdown__button h-50 min-w-auto js-button -outline-dark-1 mt-10">
                  <div class="d-flex flex-center text-16 ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                      <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"/>
                    </svg>
                    <span class="js-title ml-10">Linkedin</span>
                  </div>
                </a>
                <a href="https://api.whatsapp.com/send?&text={{ route('berita.show', $news->slug) }}" target="_blank" class="dropdown__button h-50 min-w-auto js-button -outline-dark-1 mt-10">
                  <div class="d-flex flex-center text-16">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                      <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                    </svg>
                    <span class="js-title ml-10">Whatsapp</span>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row y-gap-30 justify-between">
      <div class="col-lg-8 mb-30">
        <div class="mt-20">
          {!! $news->content !!}
        </div>

        <div class="line mt-60 mb-60"></div>

        <h2 class="text-30">Komentar</h2>

        @if ($news->comment->isEmpty())
        <div class="text-center">
          <span class="text-center">~ Belum ada komentar ~</span>
        </div>
        @else
          @foreach ($news->comment as $item)
            <div class="pt-30">
              <div class="row justify-between">
                <div class="col-auto">
                  <div class="d-flex items-center">
                    <div class="size-40 rounded-full">
                      <img src="@if($item->user->photo) {{ Storage::url($item->user->photo) }} @else https://ui-avatars.com/api/?background=E79024&color=fff&name={{ $item->user->name }} @endif" alt="image" class="img-cover rounded">
                    </div>
                    <div class="text-16 fw-500 ml-20">{{ $item->user->name }}</div>
                  </div>
                </div>
                <div class="col-auto">
                  <div class="text-14 text-light-2">{{ Carbon\Carbon::parse($item->created_at)->translatedFormat('j F Y') }}</div>
                </div>
              </div>
              <p class="mt-10">{{ $item->content }}</p>
            </div>
          @endforeach
        @endif

        <h2 class="text-30 pt-60">Tulis Komentar</h2>

        
        <p>Tulis komentar kamu</p>
        @if (Auth::check())
          <form method="POST" action="{{ route('berita.comment', $news->id) }}" class="contactForm y-gap-30 pt-30">
            @csrf
            <div class="row">
              <div class="col-12">
                <div class="form-input ">
                  <textarea required rows="5" required name="comment"></textarea>
                  <label class="lh-1 text-16 text-light-1">Tulis komentar kamu...</label>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <button type="submit" class="button -md -dark-1 bg-accent-1 text-white">
                  Kirim
                </button>
              </div>
            </div>
          </form>
        @else
        <div class="row mt-10">
          <div class="col-12">
            <a href="{{ route('login') }}?route={{ route('berita.show', $news->slug) }}" class="text-accent-1">
              <u>Masuk Dulu
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z"/>
                  <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                </svg>
              </u>
            </a>
          </div>
        </div>
        @endif
      </div>

      <div class="col-lg-4 mb-30">
        <div class="d-flex justify-end js-pin-content">
          <div class="tourSingleSidebar">
            <div class="contactForm">
              <div class="row">
                <div class="col-auto">
                  <h2 class="text-18">Terpopuler</h2>
                </div>
                @foreach ($tranding as $item)
                  <div class="col-12 mt-20">
                    <a href="{{ route('berita.show', $item->slug) }}" class="d-flex items-center -hover-image-scale">
                      <div class="size-100 relative rounded-12 -hover-image-scale__image">
                        @if(Storage::disk('public')->exists($item->image))
                          <img src="{{ Storage::url($item->image) }}" alt="image" class="img-ratio rounded-12">
                        @else
                          <img src="{{ asset('front-assets/no-image.png') }}" alt="default image" class="img-ratio rounded-12">
                        @endif
                      </div>
        
                      <div class="ml-10">
                        <h6 class="text-14 fw-500">{{ $item->title }}</h6>
                        <p class="text-13"> {{ \Carbon\Carbon::createFromFormat('Y-m-d', $news->date )->format('d F Y') }}</p>
                      </div>
                    </a>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection