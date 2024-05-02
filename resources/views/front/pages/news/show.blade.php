@extends('front.app')
@section('content')

<div data-anim="fade" class="container">
  <div class="row justify-between py-30 mt-80">
    <div class="col-auto">
      <div class="text-14">Home > Berita >{{ $news->slug }}</div>
    </div>
  </div>
</div>

<section class="">
  <div data-anim-wrap class="container">
    <div data-anim-child="slide-up delay-2" class="tourSingleGrid -type-1">
      <div class="tourSingleGrid__grid mobile-css-slider-2">
        @foreach ($news->newsImage->take(4) as $item)
        <img src="{{ Storage::url($item->image) }}" alt="image">
      @endforeach
      </div>
      <div class="tourSingleGrid__button">
        <a href="{{ Storage::url($news->newsImage[0]->image) }}" class="js-gallery" data-gallery="gallery1">
          <span class="button -accent-1 py-10 px-20 rounded-200 bg-dark-1 lh-16 text-white">Lihat semua Foto</span>
        </a>
        @foreach ($news->newsImage as $item)
        @if ($loop->iteration > 1)
          <a href="{{ Storage::url($item->image) }}" class="js-gallery" data-gallery="gallery1"></a>
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
            {{ \Carbon\Carbon::createFromFormat('Y-m-d', $news->date )->format('d F Y') }} by {{ $news->user->name }}
          </div>
        </div>
        <div class="col-auto">
          <div class="d-flex x-gap-30 y-gap-10">
            <a href="#" class="d-flex">
              <i class="icon-share flex-center text-16 mr-10"></i>
              Share
            </a>
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
                  <div class="text-14 text-light-2"> {{ $item->created_at }}</div>
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
            <a href="{{ route('login') }}" class="text-accent-1">
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
                  <h2 class="text-18">Tranding</h2>
                </div>
                @foreach ($tranding as $item)
                  <div class="col-12 mt-20">
                    <a href="{{ route('berita.show', $item->slug) }}" class="d-flex items-center -hover-image-scale">
                      <div class="size-100 relative rounded-12 -hover-image-scale__image">
                        <img src="{{ Storage::url($item->image) }}" alt="image" class="img-ratio rounded-12">
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