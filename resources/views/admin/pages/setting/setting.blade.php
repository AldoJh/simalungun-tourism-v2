@extends('admin.layouts.app')

@section('content')

<div class="row g-5 g-xl-8">
  <div class="card">
    <div class="card-header border-0 py-6 d-flex align-content-center">
      <h2 class="fw-bold card-title">Ubah Pengaturan</h2>
    </div>
    <div class="card-body pt-0">
      <div id="kt_account_profile_details">
        <form action="{{ route('admin.pengaturan.update') }}" method="POST" enctype="multipart/form-data" class="form">
          @csrf
          <div class="card-body border-top">
            <div class="row mb-6">
              <label class="col-lg-4 col-form-label required fw-bold fs-6">Nama Web</label>
              <div class="col-lg-8 fv-row">
                <input type="text" class="form-control form-control-lg form-control-solid  @error('siteName') is-invalid @enderror" name="siteName" placeholder="Nama Lengkap" value="{{ $setting->site_name }}" />
                @error('siteName')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="row mb-6">
              <label class="col-lg-4 col-form-label required fw-bold fs-6">Deskripsi</label>
              <div class="col-lg-8 fv-row">
                <textarea class="form-control form-control form-control-solid @error('description') is-invalid @enderror" data-kt-autosize="true" name="description">
                  {{ $setting->description }}
                </textarea>
                  @error('description')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
              </div>
            </div>
            <div class="row mb-6">
              <label class="col-lg-4 col-form-label required fw-bold fs-6">Email</label>
              <div class="col-lg-8 fv-row">
                <input type="email" class="form-control form-control-lg form-control-solid  @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ $setting->email }}"  />
                @error('email')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="row mb-6">
              <label class="col-lg-4 col-form-label required fw-bold fs-6">Playstore URL</label>
              <div class="col-lg-8 fv-row">
                <input type="text" class="form-control form-control-lg form-control-solid @error('playstore') is-invalid @enderror" name="playstore" placeholder="playstore" value="{{ $setting->playstore }}" />
                @error('playstore')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
              </div>
            </div>
            <div class="row mb-6">
              <label class="col-lg-4 col-form-label required fw-bold fs-6">Whatsapp</label>
              <div class="col-lg-8 fv-row">
                <input type="text" class="form-control form-control-lg form-control-solid @error('whatsapp') is-invalid @enderror" name="whatsapp" placeholder="Whatsapp" value="{{ $setting->whatsapp }}" />
                @error('whatsapp')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
              </div>
            </div>
            <div class="row mb-6">
              <label class="col-lg-4 col-form-label required fw-bold fs-6">Instagram</label>
              <div class="col-lg-8 fv-row">
                <input type="text" class="form-control form-control-lg form-control-solid @error('instagram') is-invalid @enderror" name="instagram" placeholder="Link Instagram" value="{{ $setting->instagram }}" />
                @error('instagram')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
              </div>
            </div>
            <div class="row mb-6">
              <label class="col-lg-4 col-form-label required fw-bold fs-6">Facebook</label>
              <div class="col-lg-8 fv-row">
                <input type="text" class="form-control form-control-lg form-control-solid @error('facebook') is-invalid @enderror" name="facebook" placeholder="Link Facebook" value="{{ $setting->facebook }}" />
                @error('facebook')
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
<script>
  var quill = new Quill('#kt_docs_quill_basic', {
    modules: {
        toolbar: [
            [{
                header: [1, 2, false]
            }],
            ['bold', 'italic', 'underline'],
            // ['image', 'code-block']
        ]
    },
    placeholder: 'Type your text here...',
    theme: 'snow' // or 'bubble'
});
</script>
@endsection