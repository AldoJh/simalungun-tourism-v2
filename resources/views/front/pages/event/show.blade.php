@extends('front.app')

@section('seo')
  <meta
  name="keywords"
  content="wisata, simalungun, sumut, toba, sidamanik, tourism, destinasi, hotel, festival, hotel, resto, berita"
  />
  <meta name="author" content="DISBUDPAREKRAF" />
  <meta name="description" content="{{ $event->excerpt }}" />

  <!-- Open Graph Meta Tags -->
  <meta property="og:url" content="{{ route('festival.show', $event->slug) }}" />
  <meta property="og:title" content="{{$event->name ?? ''}}" />
  <meta property="og:type" content="article" />
  <meta property="og:image" content="{{url(Storage::url($event->image))}}" />
  <meta
    property="og:description"
    content="{{ $event->description }}"
  />
  <meta property="og:locale" content="id_ID" />

  <!-- Twitter Card Meta Tags -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="{{$event->name}}" />
  <meta
    name="twitter:description"
    content="{{ $event->description }}"
  />
  <meta name="twitter:image" content="{{url(Storage::url($event->image))}}" />

  <!-- Additional SEO Meta Tags -->
  <meta name="distribution" content="global" />
  <meta name="revisit-after" content="7 days" />
  <meta name="rating" content="general" />
  <meta name="language" content="Indonesian" />
  <meta name="geo.region" content="ID" />
  <meta name="geo.placename" content="Simalungun" />

  <!-- Canonical Tag -->
  <link rel="canonical" href="{{ route('festival.show', $event->slug) }}" />
@endsection

@section('content')


<div data-anim="fade" class="container">
  <div class="row justify-between pt-30 mt-80">
    <div class="col-auto">
      <div class="breadcrumbs">
        <span class="breadcrumbs__item">
          <a href="{{ route('home') }}">Home</a>
        </span>
        <span>></span>
        <span class="breadcrumbs__item">
          <a href="{{ route('festival') }}">Festival</a>
        </span>
        <span>></span>
        <span class="breadcrumbs__item">
          <a href="{{ route('festival.show', $event->slug ) }}">{{ $event->slug }}</a>
        </span>
      </div>
    </div>
  </div>
</div>

<section class="pt-30 js-pin-container mb-50">
  <div class="container">
    <div class="row y-gap-30 justify-between">
      <div data-anim="slide-up delay-1" class="col-lg-8">
        <div class="">

          <h2 class="text-40 sm:text-30 lh-14">
            {{ $event->name }}
          </h2>

          <div class="row y-gap-20 justify-between pt-20">
            <div class="col-auto">
              <div class="col-auto">
                <div class="d-flex x-gap-30 y-gap-10">
                  <div class="dropdown -base -price js-dropdown js-form-dd" data-main-value="">
                    <div class="d-flex align-content-center h-50 min-w-auto js-button -outline-dark-1">
                      <i class="icon-share text-16 mt-5 mr-10"></i>
                      <span class="js-title">share</span>
                    </div>
          
                    <div class="dropdown__menu px-30 py-30 shadow-1 border-1 js-">
                      <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('festival.show', $event->slug) }}" target="_blank" class="dropdown__button h-50 min-w-auto js-button -outline-dark-1">
                        <div class="d-flex flex-center text-16 ">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                          </svg>
                          <span class="js-title ml-10">Facebook</span>
                        </div>
                      </a>
                      <a href=" http://www.linkedin.com/shareArticle?mini=true&url={{ route('festival.show', $event->slug) }}" target="_blank" class="dropdown__button h-50 min-w-auto js-button -outline-dark-1 mt-10">
                        <div class="d-flex flex-center text-16 ">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                            <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"/>
                          </svg>
                          <span class="js-title ml-10">Linkedin</span>
                        </div>
                      </a>
                      <a href="https://api.whatsapp.com/send?&text={{ route('festival.show', $event->slug) }}" target="_blank" class="dropdown__button h-50 min-w-auto js-button -outline-dark-1 mt-10">
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

        <div class="row justify-center pt-0">
          <div class="col-12">
            <div class="relative overflow-hidden js-section-slider" data-gap="10" data-slider-cols="xl-1 lg-1 md-1 sm-1 base-1" data-nav-prev="js-sliderMain-prev" data-nav-next="js-sliderMain-next" data-loop>
              <div class="swiper-wrapper">

                @foreach ($event->eventImage as $item)
                  <div class="swiper-slide">
                    <img src="{{ Storage::url($item->image) }}" alt="image" class="img-cover rounded-12">
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

        <div class="mt-20">
          {!! $event->description !!}
        </div>

        <div class="row mt-40">
          <div class="col-md mb-20">
            <h2 class="text-24">Statistik <br> Pengunjung</h2>
          </div>
          <div class="col-md mb-20">
            <div class="row contactForm">
                <form method="GET" class="d-flex flex-row flex-lg-row-auto form-input">
                  <select name="tahun" class=" @error('tahun') is-invalid @enderror" required>
                    <option  disabled>Pilih Tahun</option>
                    @foreach ($tahun as $item)
                        <option @if ( request('tahun') == $item ) selected  @endif value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                  </select>
                  <button type="submit" class="button px-20 py-15 lh-12 -accent-1 text-accent-1 bg-accent-1-05 border-accent-1 ml-20">
                    <i class="icon-arrow-top-right text-16"></i>
                  </button>
                </form>
            </div>
          </div>
        </div>
        <canvas id="lineChart" width="400" height="150"></canvas>

        <div class="line mt-60 mb-60"></div>

        <h2 class="text-30">Atribut Festival</h2>

        <div class="overallRating mt-30">
          <div class="overallRating__list">
            @if ($event->eventAttribute->isEmpty() )
            <div class="text-center">
              <span class="text-center">~ Tidak ada atribut khusus ~</span>
            </div>
            @else
            @foreach ($event->eventAttribute as $item)
              <div class="overallRating__item">
                <div class="overallRating__content">
                  <div class="overallRating__icon size-50 relative rounded-12 -hover-image-scale__image">
                    @if(Storage::disk('public')->exists($item->image))
                      <img src="{{ Storage::url($item->image) }}" alt="image" class="img-ratio rounded-12">
                    @else
                      <img src="{{ asset('front-assets/no-image.png') }}" alt="default image" class="img-ratio rounded-12">
                    @endif
                  </div>
                  <div class="overallRating__info">
                    <h5 class="text-16 fw-500">{{ $item->name }}</h5>
                    <div class="lh-15">{{ $item->description }}</div>
                  </div>
                </div>

                <div class="overallRating__rating d-flex items-center">
                  <i class="icon-star text-yellow-2 text-16"></i>
                  {{ $item->value }}
                </div>
              </div>
            @endforeach
            @endif
          </div>
        </div>

      </div>

      <div class="col-lg-4">
        <div class="d-flex justify-end js-pin-content">
          <div class="tourSingleSidebar">
            <div class="searchForm -type-1 -sidebar mt-20">
              <div class="searchForm__form">
                <div class="searchFormItem js-select-control js-form-dd js-calendar">
                  <div class="searchFormItem__button">
                    <div class="searchFormItem__icon size-50 rounded-12 bg-light-1 flex-center">
                      <i class="text-20 icon-calendar"></i>
                    </div>
                    <div class="searchFormItem__content">
                      <h5>Tanggal</h5>
                      <div>
                        <span class="js-first-date">                       
                          {{ Carbon\Carbon::parse($event->date)->translatedFormat('j F Y') }}
                        </span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="searchFormItem js-select-control js-form-dd">
                  <div class="searchFormItem__button">
                    <div class="searchFormItem__icon size-50 rounded-12 bg-light-1 flex-center">
                      <i class="text-20 icon-clock"></i>
                    </div>
                    <div class="searchFormItem__content">
                      <h5>Lokasi</h5>
                      <div class="js-select-control-chosen">{{ $event->address }}</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="line mt-20 mb-20"></div>

            <div class="d-flex items-center justify-between">
              <div class="text-18 fw-500">Tiket:</div>
              <div class="text-18 fw-500">
                @if ($event->price == 0)
                    Gratis
                @else
                    Rp. {{ number_format($event->price) }}
                @endif
              </div>
            </div>

            <a href="https://maps.google.com/?q={{ $event->latitude }},{{ $event->longitude }}" class="button -md -dark-1 col-12 bg-accent-1 text-white mt-20">
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  var data = {!! json_encode($visitor) !!}; 
  var ctx = document.getElementById('lineChart').getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei' , 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'], // Membuat label dari panjang data
          datasets: [{
              label: 'Total Pengunjung',
              data: data, 
              backgroundColor: 'rgba(235, 102, 43, 1)',
              borderColor: 'rgba(235, 102, 43, 1)',
              borderWidth: 1
          }]
      },
      options: {
          scales: {
              y: {
                  beginAtZero: true
              }
          }
      }
  });
</script>
@endsection