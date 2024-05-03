@extends('admin.layouts.app')

@section('content')

  <form action="{{ route('admin.festival.festival.store') }}" enctype="multipart/form-data" method="post" class="row g-5 g-xl-8">
    @csrf
    <div class="col-xl-3 mb-8">
      <div class="row">
        <div class="card card-flush">
          <div class="card-header align-items-center py-5 gap-2 gap-md-5">
            <div class="card-title">
              <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3">Thumbnail</span>
              </h3>
            </div>
          </div>
          <div class="card-body text-center pt-0">
            <div class="image-input image-input-empty" data-kt-image-input="true">
              <div class="image-input-wrapper w-200px h-150px" style="background-image: url('{{ asset('admin-assets/media/svg/files/blank-image.svg') }}')"></div>
              <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Change thumbnail">
                  <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>
                  <input type="file" name="thumbnail" accept=".png, .jpg, .jpeg" required />
                  <input type="hidden" name="avatar_remove" />
              </label>
              <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Cancel thumbnail">
                  <i class="ki-outline ki-cross fs-3"></i>
              </span>
              <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Remove thumbnail">
                  <i class="ki-outline ki-cross fs-3"></i>
              </span>
            </div>
              @error('thumbnail')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            <div class="text-muted fs-7 pt-3">File yang diizinkan: *.png, *.jpg, *.jpeg <br>Maksimal 2mb</div>
          </div>
        </div>
      </div>
      <div class="row mt-5">
        <div class="card card-flush">
          <div class="card-body pt-0">
            <div class="mb-3 mt-9">
              <label for="exampleFormControlInput1" class="col-form-label required fw-bold fs-6">Harga</label>
              <input type="number" name="price" class="form-control form-control-solid @error('price') is-invalid @enderror" value="{{ old('price') ?? 0}}" required/>
              @error('price')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div>
              <label for="exampleFormControlInput1" class="col-form-label required fw-bold fs-6">tanggal</label>
              <input type="date" name="date" class="form-control form-control-solid @error('dae') is-invalid @enderror" value="{{ old('date') }}" required/>
              @error('date')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-5">
        <div class="card card-flush py-5 d-flex">
          <a href="{{ route('admin.festival.festival') }}" class="btn btn-light-primary">Batal</a>
          <button type="submit" class="btn btn-primary mt-4">Publish</button>
        </div>
      </div>
    </div>
    <div class="col-xl-9 mb-8">
      <div class="row">
        <div class="card card-flush">
          <div class="card-body pt-0">
            <div class="mb-3 mt-9">
              <label for="exampleFormControlInput1" class="col-form-label required fw-bold fs-6">Nama</label>
              <input type="text" name="name" class="form-control form-control-solid @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Nama Festival" required/>
              @error('name')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-5">
              <label for="exampleFormControlInput1" class="col-form-label fw-bold fs-6">Lokasi</label>
              <input type="text" name="location" class="form-control form-control-solid @error('location') is-invalid @enderror" value="{{ old('location') }}" placeholder="Lokasi"/>
              @error('location')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="row">
              <div class="col mb-5">
                <label for="exampleFormControlInput1" class="col-form-label fw-bold fs-6">Latitude</label>
                <input type="number" name="lat" class="form-control form-control-solid @error('lat') is-invalid @enderror" value="{{ old('lat') }}" placeholder="Latitude"/>
                @error('lat')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="col mb-5">
                <label for="exampleFormControlInput1" class="col-form-label fw-bold fs-6">Longitude</label>
                <input type="number" name="long" class="form-control form-control-solid @error('long') is-invalid @enderror" value="{{ old('long') }}" placeholder="Longitude"/>
                @error('long')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="mb-5">
              <label for="exampleFormControlInput1" class="col-form-label required fw-bold fs-6">Deskripsi</label>
              <textarea name="description" id="kt_docs_ckeditor_classic" required>
                {{ old('description') }}
              </textarea>
              @error('description')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>

@endsection

@section('script')
<script src="{{ asset('admin-assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}"></script>
<script>
  ClassicEditor
    .create(document.querySelector('#kt_docs_ckeditor_classic'))
    .then(editor => {
        console.log(editor);
    })
    .catch(error => {
        console.error(error);
    });
</script>
@endsection