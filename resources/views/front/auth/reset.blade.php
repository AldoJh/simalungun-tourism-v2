@extends('front.app')
@section('content')

<section class="mt-header layout-pt-lg layout-pb-lg">
  <div class="container">
    <div data-anim="slide-up" class="row justify-center">
      <div class="col-xl-6 col-lg-7 col-md-9">
        <div class="text-center mb-60 md:mb-30">
          <h1 class="text-30">Reset Password</h1>
          <div class="text-18 fw-500 mt-20 md:mt-15">Buat Password baru akun anda</div>
        </div>
        <form method="POST" action="{{ route('reset.submit', $token) }}" class="contactForm border-1 rounded-12 px-60 py-60 md:px-25 md:py-30">
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
                  <span class="fw-bold">{{ session('error') }}</span>
              </div>
            </div>
          @endif
          <div class="form-input ">
            <input type="email" name="email" class="@error('email') is-invalid @enderror" value="{{$user->email }}" placeholder="Email Address" required readonly>
          </div>
          <div class="form-input mt-30">
            <input type="password" name="password" class="@error('password') is-invalid @enderror" placeholder="Masukan Password Baru" required autocomplete="off">
          </div>
          @error('password')
            <div class="invalid-feedback text-red-1">
              {{ $message }}
            </div>
          @enderror
          <button type="submit" class="button -md -dark-1 bg-accent-1 text-white col-12 mt-30">
            Ubah Password
          </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection