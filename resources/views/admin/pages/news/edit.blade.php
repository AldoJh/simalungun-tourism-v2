@extends('admin.layouts.app')

@section('content')

  <form action="{{ route('admin.berita.berita.update', $news->id) }}" enctype="multipart/form-data" method="post" class="row g-5 g-xl-8">
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
              <div class="image-input-wrapper w-200px h-150px" style="background-image: url('{{ Storage::url( $news->image) }}')"></div>
              <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Change thumbnail">
                  <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>
                  <input type="file" name="thumbnail" accept=".png, .jpg, .jpeg/>
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
              <label for="exampleFormControlInput1" class="col-form-label required fw-bold fs-6">Penulis</label>
              <input type="text" class="form-control form-control-solid" disabled value="{{ $news->user->name }}"/>
            </div>
            <div>
              <label for="exampleFormControlInput1" class="col-form-label required fw-bold fs-6">Meta Deskripsi</label>
              <textarea class="form-control form-control-solid @error('description') is-invalid @enderror" rows="5" name="description" placeholder="Tulis deskripsi singkat..." required>{{ old('description') ??  $news->description }}</textarea>
              @error('description')
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
          <a href="{{ route('admin.berita.berita') }}" class="btn btn-light-primary">Batal</a>
          <button type="submit" class="btn btn-primary mt-4">Publish</button>
        </div>
      </div>
    </div>
    <div class="col-xl-9 mb-8">
      <div class="row">
        <div class="card card-flush">
          <div class="card-body pt-0">
            <div class="mb-3 mt-9">
              <label for="exampleFormControlInput1" class="col-form-label required fw-bold fs-6">Judul</label>
              <input type="text" name="title" class="form-control form-control-solid @error('title') is-invalid @enderror" value="{{ old('title') ?? $news->title }}" placeholder="Judul Berita" required/>
              @error('title')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-5">
              <label for="exampleFormControlInput1" class="col-form-label required fw-bold fs-6">Lokasi</label>
              <input type="text" name="location" class="form-control form-control-solid @error('location') is-invalid @enderror" value="{{ old('location') ??  $news->address }}" placeholder="Lokasi" required/>
              @error('location')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-5">
              <label for="exampleFormControlInput1" class="col-form-label required fw-bold fs-6">Isi Berita</label>
              <textarea name="content" id="kt_docs_ckeditor_classic" required>
                {{ old('content') ??  $news->content }}
              </textarea>
              @error('content')
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
<script>
  var myDropzone = new Dropzone("#kt_dropzonejs_example_1", {
    url: "https://keenthemes.com/scripts/void.php", // Set the url for your upload script location
    paramName: "file", // The name that will be used to transfer the file
    maxFiles: 10,
    maxFilesize: 10, // MB
    addRemoveLinks: true,
    accept: function(file, done) {
        if (file.name == "wow.jpg") {
            done("Naha, you don't.");
        } else {
            done();
        }
    }
});
</script>
@endsection