@extends('admin.layouts.app')

@section('content')

<div class="row g-5 g-xl-8">
  <div class="card">
    <div class="card-header border-0 py-6 d-flex align-content-center">
      <h2 class="fw-bold card-title">Ubah Profil</h2>
    </div>
    <div class="card-body pt-0">
      <div id="kt_account_profile_details">
        <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data" class="form">
          @csrf
          <div class="card-body border-top">
            <div class="row mb-6">
              <label class="col-lg-4 col-form-label fw-bold fs-6">Foto</label>
              <div class="col-lg-8">
                <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url(assets/media/avatars/blank.png)">
                  <div class="image-input-wrapper w-125px h-125px" style="background-image: url('@if(Auth::user()->photo) {{ Storage::url(Auth::user()->photo) }} @else https://ui-avatars.com/api/?background=E79024&color=fff&name={{ Auth::user()->name }} @endif')"></div>
                  <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                    <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                    <input type="hidden" name="avatar_remove" />
                    <span class="svg-icon svg-icon-primary svg-icon-1x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Design/Edit.svg-->
                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <defs/>
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>
                            <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>
                        </g>
                    </svg>
                  </span>                    
                  </label>
                </div>
                @error('image')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
                <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
              </div>
            </div>
            <div class="row mb-6">
              <label class="col-lg-4 col-form-label required fw-bold fs-6">Nama</label>
              <div class="col-lg-8 fv-row">
                <input type="text" class="form-control form-control-lg form-control-solid  @error('name') is-invalid @enderror" name="name" placeholder="Nama Lengkap" value="{{ Auth::user()->name }}" />
                @error('name')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="row mb-6">
              <label class="col-lg-4 col-form-label required fw-bold fs-6">No. Telp</label>
              <div class="col-lg-8 fv-row">
                <input type="text" class="form-control form-control-lg form-control-solid  @error('phone') is-invalid @enderror" name="phone" placeholder="Nomor Telepon" value="{{ Auth::user()->phone }}" />
                @error('phone')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="row mb-6">
              <label class="col-lg-4 col-form-label required fw-bold fs-6">role</label>
              <div class="col-lg-8 fv-row">
                <input type="email" class="form-control form-control-lg form-control-solid" name="email" placeholder="Email" value="{{ Auth::user()->role }}" disabled />
              </div>
            </div>
            <div class="row mb-6">
              <label class="col-lg-4 col-form-label required fw-bold fs-6">Email</label>
              <div class="col-lg-8 fv-row">
                <input type="email" class="form-control form-control-lg form-control-solid" name="email" placeholder="Email" value="{{ Auth::user()->email }}" disabled />
              </div>
            </div>
            <div class="text-end">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="row g-5 g-xl-8 mt-2">
  <div class="card">
    <div class="card-header border-0 py-6 d-flex align-content-center">
      <h2 class="fw-bold card-title">Ubah Password</h2>
    </div>
    <div class="card-body pt-0">
      <div id="kt_account_profile_details">
        <form action="{{ route('admin.profil.change') }}" method="POST"  class="form">
          @csrf
          <div class="card-body border-top">
            <div class="row mb-6">
              <label class="col-lg-4 col-form-label required fw-bold fs-6">Password Lama</label>
              <div class="col-lg-8 fv-row">
                <input type="password" class="form-control form-control-lg form-control-solid  @error('oldPassword') is-invalid @enderror" name="oldPassword" placeholder="********" required  />
                @error('oldPassword')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="row mb-6">
              <label class="col-lg-4 col-form-label required fw-bold fs-6">Password baru</label>
              <div class="col-lg-8 fv-row">
                <input type="password" class="form-control form-control-lg form-control-solid  @error('newPassword') is-invalid @enderror" name="newPassword" placeholder="********" required />
                @error('newPassword')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="text-end">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
@endsection