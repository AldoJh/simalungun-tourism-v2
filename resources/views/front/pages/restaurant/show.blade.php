
@extends('front.app')

@section('seo')
  <meta
  name="keywords"
  content="wisata, simalungun, sumut, toba, sidamanik, tourism, destinasi, hotel, festival, restaurant, resto, berita"
  />
  <meta name="author" content="Dispar" />
  <meta name="description" content="{{ $restaurant->excerpt }}" />

  <!-- Open Graph Meta Tags -->
  <meta property="og:url" content="{{ route('restoran.show', $restaurant->slug) }}" />
  <meta property="og:title" content="{{$restaurant->name ?? ''}}" />
  <meta property="og:type" content="article" />
  <meta property="og:image" content="{{url(Storage::url($restaurant->image))}}" />
  <meta
    property="og:description"
    content="{{ $restaurant->excerpt }}"
  />
  <meta property="og:locale" content="id_ID" />

  <!-- Twitter Card Meta Tags -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="{{$restaurant->name}}" />
  <meta
    name="twitter:description"
    content="{{ $restaurant->excerpt }}"
  />
  <meta name="twitter:image" content="{{url(Storage::url($restaurant->image))}}" />

  <!-- Additional SEO Meta Tags -->
  <meta name="distribution" content="global" />
  <meta name="revisit-after" content="7 days" />
  <meta name="rating" content="general" />
  <meta name="language" content="Indonesian" />
  <meta name="geo.region" content="ID" />
  <meta name="geo.placename" content="Simalungun" />

  <!-- Canonical Tag -->
  <link rel="canonical" href="{{ route('restoran.show', $restaurant->slug) }}" />
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{ asset('front-assets/css/fontawesome-stars.css') }}">
@endsection

@section('content')


<div data-anim="fade" class="container">
  <div class="row justify-between py-30 mt-80">
    <div class="col-12">
      <div class="text-14">Home > Restoran > {{ $restaurant->slug }}</div>
    </div>
    <div class="col-12">
      <h2 class="text-40 sm:text-30 lh-14 mt-20">
        {{ $restaurant->name }}
      </h2>
      <div class="row x-gap-20 y-gap-20 items-center d-flex justify-between pt-20">
        @if (count($restaurant->restaurantReview) > 0)
          <div class="col-auto">
            <div class="d-flex items-center">
              <div class="d-flex x-gap-5 pr-10">
                @for($i = 0; $i < round($restaurant->restaurantReview->average('rating'), 0); $i++)
                  <i class="flex-center icon-star text-yellow-2 text-12"></i>
                @endfor
              </div>
              {{ round($restaurant->restaurantReview->average('rating'), 1) }} ({{ count($restaurant->restaurantReview) }})
            </div>
          </div>
        @else
        <div class="col-auto">
          <div class="d-flex items-center align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star text-yellow-2 text-12" viewBox="0 0 16 16">
              <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
            </svg>
            <span class="ml-10">Tidak ada rating</span>
          </div>
        </div>
        @endif
        <div class="col-auto">
          <div class="d-flex x-gap-30 y-gap-10">
            <div class="dropdown -base -price js-dropdown js-form-dd" data-main-value="">
              <div class="d-flex align-content-center h-50 min-w-auto js-button -outline-dark-1">
                <i class="icon-share text-16 mt-5 mr-10"></i>
                <span class="js-title">share</span>
              </div>
    
              <div class="dropdown__menu px-30 py-30 shadow-1 border-1 js-">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('restoran.show', $restaurant->slug) }}" target="_blank" class="dropdown__button h-50 min-w-auto js-button -outline-dark-1">
                  <div class="d-flex flex-center text-16 ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                      <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                    </svg>
                    <span class="js-title ml-10">Facebook</span>
                  </div>
                </a>
                <a href=" http://www.linkedin.com/shareArticle?mini=true&url={{ route('restoran.show', $restaurant->slug) }}" target="_blank" class="dropdown__button h-50 min-w-auto js-button -outline-dark-1 mt-10">
                  <div class="d-flex flex-center text-16 ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                      <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"/>
                    </svg>
                    <span class="js-title ml-10">Linkedin</span>
                  </div>
                </a>
                <a href="https://api.whatsapp.com/send?&text={{ route('restoran.show', $restaurant->slug) }}" target="_blank" class="dropdown__button h-50 min-w-auto js-button -outline-dark-1 mt-10">
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
</div>

<div data-anim="fade" class="relative">
  <div class="container">
    <div class="row justify-center">
      <div class="col-lg-8">
        <div class="js-section-slider" data-gap="10" data-slider-cols="xl-1 lg-1 md-1 sm-1 base-1" data-nav-prev="js-sliderMain-prev" data-nav-next="js-sliderMain-next" data-loop>
          <div class="swiper-wrapper">

            @foreach ($restaurant->restaurantImage as $item)
              <div class="swiper-slide">
                @if(Storage::disk('public')->exists($item->image))
                  <img src="{{ Storage::url($item->image) }}" alt="image" class="img-cover rounded-12">
                @else
                  <img src="{{ asset('front-assets/no-image.png') }}" alt="default image" class="img-cover rounded-12">
                @endif
              </div>
            @endforeach

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
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark" viewBox="0 0 16 16">
                  <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z"/>
                </svg>
              </div>
              <div class="ml-10">
                <div class="lh-16">Label</div>
                <div class="text-14 text-light-2 lh-16">
                  @if ($restaurant->label)
                      Halal
                  @else
                      Non-Halal
                  @endif
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="d-flex items-center">
              <div class="flex-center size-50 rounded-12 border-1">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M5.60831 15.8499L6.73081 13.0607C6.80248 12.9013 6.91053 12.7707 7.05498 12.6691C7.19886 12.5668 7.35886 12.5157 7.53498 12.5157H9.58331V8.50489C7.68275 8.46767 6.08831 8.22989 4.79998 7.79156C3.51164 7.35322 2.86803 6.83933 2.86914 6.24989C2.86914 5.61544 3.55886 5.08017 4.93831 4.64406C6.3172 4.2085 8.00442 3.99072 9.99998 3.99072C11.9989 3.99072 13.6872 4.2085 15.065 4.64406C16.4428 5.08017 17.1316 5.61544 17.1316 6.24989C17.1316 6.84989 16.485 7.36656 15.1916 7.79989C13.8983 8.23267 12.3066 8.46767 10.4166 8.50489V12.5157H12.465C12.6378 12.5157 12.7972 12.5668 12.9433 12.6691C13.0894 12.7713 13.198 12.9018 13.2691 13.0607L14.3908 15.8491H13.5258L12.5258 13.3491H7.47414L6.47414 15.8491L5.60831 15.8499ZM9.99998 7.67572C11.4966 7.67572 12.845 7.536 14.045 7.25656C15.245 6.97822 15.9783 6.64239 16.245 6.24906C15.9783 5.85572 15.245 5.51961 14.045 5.24072C12.845 4.96183 11.4966 4.82267 9.99998 4.82322C8.50331 4.82378 7.15498 4.96322 5.95498 5.24156C4.75498 5.51989 4.02164 5.856 3.75498 6.24989C4.02164 6.64322 4.75498 6.97933 5.95498 7.25822C7.15498 7.53656 8.50331 7.67572 9.99998 7.67572Z" fill="black"/>
                </svg>                  
              </div>
              <div class="ml-10">
                <div class="lh-16">Meja</div>
                <div class="text-14 text-light-2 lh-16">{{ $restaurant->table }}</div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="d-flex items-center">
              <div class="flex-center size-50 rounded-12 border-1">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M8.46382 12.1566H7.0109M14.6763 12.1566H12.9555M5.23007 2.57873C5.20937 2.59439 5.19426 2.6163 5.18698 2.64121C5.1797 2.66613 5.18064 2.69272 5.18965 2.71706C6.24632 5.64123 7.79173 10.8771 6.48257 15.5937L6.0284 17.4121C6.01961 17.4472 6.01894 17.4839 6.02644 17.5194C6.03395 17.5549 6.04943 17.5882 6.07172 17.6168C6.094 17.6454 6.12251 17.6685 6.15507 17.6844C6.18763 17.7004 6.2234 17.7087 6.25965 17.7087H6.5659C6.61953 17.7093 6.67212 17.6939 6.717 17.6645C6.76188 17.6351 6.79703 17.5931 6.81798 17.5437C7.14673 16.7758 8.24048 13.54 8.32757 12.2758C8.32906 12.2438 8.34277 12.2136 8.36588 12.1915C8.38898 12.1693 8.41971 12.1568 8.45173 12.1566H13.2434C13.2733 12.1568 13.3022 12.1677 13.3247 12.1874C13.3473 12.207 13.362 12.2341 13.3663 12.2637L13.8463 17.4762C13.8555 17.5409 13.8876 17.6 13.9369 17.6428C13.9863 17.6856 14.0494 17.7092 14.1147 17.7091H14.4255C14.4579 17.7091 14.49 17.7026 14.52 17.6902C14.55 17.6777 14.5772 17.6595 14.6001 17.6365C14.623 17.6135 14.6411 17.5862 14.6535 17.5562C14.6659 17.5262 14.6722 17.4941 14.6722 17.4616V12.1875C14.6724 12.1678 14.6769 12.149 14.6855 12.1312C14.7438 12.0096 14.9584 11.4508 14.6722 10.3062C14.408 9.24873 14.2097 9.24081 13.8797 9.24873C12.6288 9.27831 9.12798 9.46956 8.44715 9.50706C8.41555 9.50871 8.38453 9.49811 8.36055 9.47747C8.33656 9.45682 8.32147 9.42772 8.3184 9.39623C8.22173 8.5604 7.60298 3.49623 6.74673 2.63873C6.65157 2.53443 6.53664 2.45006 6.40861 2.39051C6.28059 2.33097 6.14202 2.29743 6.00094 2.29185C5.85985 2.28627 5.71906 2.30875 5.58674 2.358C5.45441 2.40724 5.33318 2.48227 5.23007 2.57873Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </div>
              <div class="ml-10">
                <div class="lh-16">Kursi</div>
                <div class="text-14 text-light-2 lh-16">{{ $restaurant->chair }}</div>
              </div>
            </div>
          </div>
        </div>

        <div class="mt-20">
          {!! $restaurant->description !!}
          <h6 class="fw-bold">Owner : {{ $restaurant->owner }}</h6>
        </div>

        <div class="line mt-60 mb-60"></div>

        <h2 class="text-30">Fasilitas</h2>

        <div class="row x-gap-130 y-gap-20 pt-20">
          <div class="col-lg-6">
            <div class="y-gap-15">
              @foreach ($restaurant->restaurantFacility as $item)
              @endforeach
              <div class="d-flex">
                <i class="icon-check flex-center text-10 size-24 rounded-full text-green-2 bg-green-1 mr-15"></i>
                {{ $item->facility->name }}
              </div>
            </div>
          </div>
        </div>

        <div class="line mt-60 mb-60"></div>


        <h2 class="text-30">Reviews Teratas</h2>

        @if ($review->isEmpty())
        <div class="text-center">
          <span class="text-center">~ Belum ada review ~</span>
        </div>
        @else
          @foreach ($review as $item)
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
              <div class="d-flex items-center mt-15">
                <div class="d-flex x-gap-5">
                  @for($i = 0; $i < $item->rating; $i++)
                      <i class="icon-star text-yellow-2 text-10"></i>
                  @endfor
                </div>
              </div>
              <p class="mt-10">{{ $item->comment }}</p>
            </div>
          @endforeach
        @endif

        <h2 class="text-30 pt-60">Tulis Review</h2>
        <p>Tulis review kamu unuk destinasi ini</p>
        @if (Auth::check())
        <form method="POST" action="{{ route('restoran.review', $restaurant->id) }}" class="contactForm y-gap-30 pt-20 mb-lg-20 pb-20">
          @csrf
          <div class="row">
            <div class="col-12">
              <div class="pb-20">
                <select id="rate" name="rate" required>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
              </div>
              <div class="form-input ">
                <textarea required rows="5" name="comment"></textarea>
                <label class="lh-1 text-16 text-light-1">Review Destinasi</label>
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
            <a href="{{ route('login') }}?route={{ route('restoran.show', $restaurant->slug) }}" class="text-accent-1">
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
                      <span class="js-first-date">{{ $restaurant->phone }}</span>
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
                      <div class="js-select-control-chosen">{{ $restaurant->address }}</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="line mt-20 mb-20"></div>
            <a href="https://maps.google.com/?q={{ $restaurant->latitude }},{{ $restaurant->longitude }}" target="_blank" class="button -md -dark-1 col-12 bg-accent-1 text-white mt-20">
              Lihat Rute
              <i class="icon-arrow-top-right ml-10"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="{{ asset('front-assets/js/jquery.barrating.min.js') }}"></script>
<script type="text/javascript">
   $(function() {
      $('#rate').barrating({
        theme: 'fontawesome-stars'
      });
   });
</script>
@endsection

