@extends('front.app')
@section('content')

<section class="mt-header layout-pt-lg layout-pb-lg">
  <div class="container">
    <div data-anim="slide-up" class="row justify-center">
      <div class="col-xl-8 col-lg-6 col-md-9">
        <div class="text-center mb-60 md:mb-30">
          <h1 class="text-30">Kuisioner</h1>
          <div class="text-18 fw-500 mt-20 md:mt-15">Berikan Pendapat Kamu Tentang Simalungun Tourism</div>
        </div>
        <form method="POST" action="{{ route('kuisioner.store') }}" class="contactForm border-1 rounded-12 px-60 py-60 md:px-25 md:py-30">
          @csrf
          @if (session()->has('warning'))
          <div class="alert alert-dismissible bg-accent-1-05 d-flex align-items-center flex-column flex-sm-row p-4 rounded mb-4">
            <div class="d-flex flex-column text-light pe-0">
                <h6 class="mb-2 text-light d-flex align-items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill me-2" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                  </svg>
                  Failed
                </h6>
                <span class="fw-bold">{{ session('warning') }}</span>
            </div>
          </div>
          @elseif (session()->has('error'))
            <div class="alert alert-dismissible bg-accent-1-05 d-flex align-items-center flex-column flex-sm-row p-4 rounded mb-4">
              <div class="d-flex flex-column text-light pe-0">
                  <h6 class="mb-2 text-light  d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill me-2" viewBox="0 0 16 16">
                      <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                    </svg>
                    Failed
                  </h6>
                  <span class="fw-bold">{{ session('error') }}</span>
              </div>
            </div>
            @elseif (session()->has('success'))
            <div class="alert alert-dismissible bg-accent-1-05 d-flex align-items-center flex-column flex-sm-row p-4 rounded mb-4">
              <div class="d-flex flex-column text-light pe-0">
                  <h6 class="mb-2 text-light  d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle me-2" viewBox="0 0 16 16">
                      <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
                      <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
                    </svg>
                    Success
                  </h6>
                  <span class="fw-bold">{{ session('success') }}</span>
              </div>
            </div>
          @endif
          <div class="row y-gap-30">
            <div class="col-md-6">
              <div class="form-input ">
                <input type="text" name="name" class="@error('name') is-invalid @enderror" @if (Auth::check()) value="{{ Auth::user()->name }}" readonly  @else value="{{ old('name') }}" @endif placeholder="Nama Lengkap" required>
              </div>
              @error('name')
                <div class="invalid-feedback text-red-1">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="col-md-6">
              <div class="form-input ">
                <input type="email" name="email" class="@error('email') is-invalid @enderror" @if (Auth::check()) value="{{ Auth::user()->email }}" readonly  @else value="{{ old('email') }}" @endif  placeholder="Almat Email" required>
              </div>
              @error('email')
                <div class="invalid-feedback text-red-1">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>
          <div class="row mt-30">
            <div class="col-md-6">
              <div class="form-input ">
                <input type="text" name="phone" class="@error('phone') is-invalid @enderror" @if (Auth::check()) value="{{ Auth::user()->phone }}" readonly  @else value="{{ old('phone') }}" @endif  placeholder="No. Telp" required>
              </div>
              @error('phone')
                <div class="invalid-feedback text-red-1">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="col-md-6">
              <div class="form-input ">
                <select  name="age" class="@error('age') is-invalid @enderror" required>
                  <option value="" disabled  @if (!old('age')) selected @endif>Usia Kamu</option>
                  <option @if (old('age') == '17 - 26 tahun') selected @endif value="17 - 26 tahun">17 - 26 tahun</option>
                  <option  @if (old('age') == '27 - 34 tahun') selected @endif value="27 - 34 tahun">27 - 34 tahun</option>
                  <option @if (old('age') == '34 - 55 tahun') selected @endif value="34 - 55 tahun">34 - 55 tahun</option>
                  <option  @if (old('age') == '> 55 tahun') selected @endif value="> 55 tahun">> 55 tahun</option>
                </select>
              </div>
              @error('age')
                <div class="invalid-feedback text-red-1">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>
          <div class="form-input mt-30">
            <select name="feedback" class="@error('feedback') is-invalid @enderror" required> 
              <option value="" disabled @if (!old('feedback')) selected @endif>Tanggap Kamu</option>
              <option @if (old('feedback') == 'Sangat Suka') selected @endif value="Sangat Suka">Sangat Suka</option>
              <option @if (old('feedback') == 'Suka') selected @endif value="Suka">Suka</option>
              <option @if (old('feedback') == 'Biasa Saja') selected @endif value="Biasa Saja">Biasa Saja</option>
              <option @if (old('feedback') == 'Tidak Suka') selected @endif value="Tidak Suka">Tidak Suka</option>
            </select>
          </div>
          @error('feedback')
            <div class="invalid-feedback text-red-1">
              {{ $message }}
            </div>
          @enderror
          <div class="form-input mt-30">
            <textarea type="text" name="comment" class="@error('comment') is-invalid @enderror" placeholder="Saran Kamu">{{ old('comment') }}</textarea>
          </div>
          @error('comment')
            <div class="invalid-feedback text-red-1">
              {{ $message }}
            </div>
          @enderror

          <button type="submit" class="button -md -dark-1 bg-accent-1 text-white mt-30">
            Kirim
            <i class="icon-arrow-top-right ml-10"></i>
          </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection