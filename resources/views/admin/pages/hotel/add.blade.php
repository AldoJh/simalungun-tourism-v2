@extends('admin.layouts.app')

@section('content')

  <form action="{{ route('admin.hotel.hotel.store') }}" enctype="multipart/form-data" method="post" class="row g-5 g-xl-8">
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
              <label for="exampleFormControlInput1" class="col-form-label required fw-bold fs-6">Pemilik</label>
              <input type="text" class="form-control form-control-solid @error('owner') is-invalid @enderror" name="owner" placeholder="Nama Pemilik" value="{{ old('owner') }}" required/>
              @error('owner')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="col-form-label required fw-bold fs-6">Meta Deskripsi</label>
              <textarea class="form-control form-control-solid @error('meta') is-invalid @enderror" rows="5" name="meta" placeholder="Tulis deskripsi singkat..." required>{{ old('meta') }}</textarea>
              @error('meta')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div>
              <label for="exampleFormControlInput1" class="col-form-label required fw-bold fs-6">Verifikasi</label>
              <div class="form-check form-switch form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" name="verified" @if (old('verified')) checked @endif id="flexSwitchDefault"/>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-5">
        <div class="card card-flush py-5 d-flex">
          <a href="{{ route('admin.hotel.hotel') }}" class="btn btn-light-primary">Batal</a>
          <button type="submit" class="btn btn-primary mt-4">Publish</button>
        </div>
      </div>
    </div>
    <div class="col-xl-9 mb-8">
      <div class="row">
        <div class="card card-flush">
          <div class="card-body pt-0">
            <div class="row">
              <div class="col-8 mb-3 mt-9">
                <label for="exampleFormControlInput1" class="col-form-label required fw-bold fs-6">Nama</label>
                <input type="text" name="name" class="form-control form-control-solid @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Nama Hotel" required/>
                @error('name')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="col-4 mb-3 mt-9">
                <label for="exampleFormControlInput1" class="col-form-label required fw-bold fs-6">Kategori</label>
                <select name="category" class="form-control form-select form-control-solid @error('category') is-invalid @enderror" required>
                  <option value="" disabled selected>Pilih Kategori</option>
                  @foreach ($category as $item)
                    <option @if (old('category') == $item->id) selected  @endif value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach
                </select>
                @error('category')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
              </div>
            </div>
            <div class="mb-5">
              <label for="exampleFormControlInput1" class="required col-form-label fw-bold fs-6">No. Telp</label>
              <input type="text" name="phone" class="form-control form-control-solid @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="No. Telepon" required/>
              @error('phone')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="row">
              <div class="col mb-5">
                <label for="exampleFormControlInput1" class="required col-form-label fw-bold fs-6">Kecamatan</label>
                <select name="district" id="kecamatan" class="form-control form-select form-control-solid @error('district') is-invalid @enderror" required>
                  <option value="" disabled selected>Pilih Kecamatan</option>
                  @foreach ($district as $item)
                    <option @if (old('district') ==  $item->id) selected  @endif data-id="{{ $item->code }}" value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach
                </select>
                @error('district')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="col mb-5">
                <label for="kelurahan" class="required col-form-label fw-bold fs-6">Kelurahan</label>
                <select name="village" id="kelurahan" class="form-control form-select form-control-solid @error('village') is-invalid @enderror" required>
                  <option value="" disabled selected>Pilih Kecamatan terlebih dahulu</option>
                </select>
                @error('village')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            </div>
            <div class="row">
              <div class="col mb-5">
                <label for="exampleFormControlInput1" class="required col-form-label fw-bold fs-6">Latitude</label>
                <input type="number" name="lat" class="form-control form-control-solid @error('lat') is-invalid @enderror" value="{{ old('lat') }}" placeholder="Latitude" required/>
                @error('lat')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="col mb-5">
                <label for="exampleFormControlInput1" class="required col-form-label fw-bold fs-6">Longitude</label>
                <input type="number" name="long" class="form-control form-control-solid @error('long') is-invalid @enderror" value="{{ old('long') }}" placeholder="Longitude" required/>
                @error('long')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="mb-5">
              <label for="exampleFormControlInput1" class="required col-form-label fw-bold fs-6">Alamat</label>
              <textarea name="address" class="form-control form-control-solid @error('address') is-invalid @enderror" placeholder="Alamat lengkap" rows="3" required>{{ old('address') }}</textarea>
              @error('address')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-5">
              <label for="exampleFormControlInput1" class="required col-form-label fw-bold fs-6">Fasilitas</label>
              <select class="form-select form-select-solid" data-control="select2" data-close-on-select="false" data-placeholder="Select an option" data-allow-clear="true" multiple="multiple" name="facility[]">
                  @foreach ($facility as $item)
                      <option value="{{ $item->id }}" @if(in_array($item->id, old('facility', []))) selected @endif>{{ $item->name }}</option>
                  @endforeach
              </select>
              @error('facility')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
          </div>
          <div class="mb-5">
            <label for="exampleFormControlInput1" class="required col-form-label fw-bold fs-6">Jumlah Kamar</label>
            <input type="number" name="room" class="form-control form-control-solid @error('room') is-invalid @enderror" value="{{ old('room') }}" placeholder="Jumlah Kamar" required/>
            @error('room')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
            <div class="row">
              <div class="col mb-5">
                <label for="exampleFormControlInput1" class="required col-form-label fw-bold fs-6">Harga Terendah</label>
                <input type="number" name="min" class="form-control form-control-solid @error('min') is-invalid @enderror" value="{{ old('min') }}" placeholder="Rp.0" required/>
                @error('min')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="col mb-5">
                <label for="exampleFormControlInput1" class="required col-form-label fw-bold fs-6">Harga Tertinggi</label>
                <input type="number" name="max" class="form-control form-control-solid @error('max') is-invalid @enderror" value="{{ old('max') }}" placeholder="Rp.0" required/>
                @error('max')
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
<script>
  document.getElementById("kecamatan").addEventListener("change", function () {
    var district_code = this.options[this.selectedIndex].getAttribute('data-id');
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    var data = response.data;
                    var kelurahanSelect = document.getElementById("kelurahan");
                    kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
                    data.forEach(function (item) {
                        var option = document.createElement("option");
                        option.value = item.id;
                        option.textContent = item.name;
                        kelurahanSelect.appendChild(option);
                    });
                } else {
                    console.error("Request failed: " + response.message);
                }
            } else {
                console.error("Request failed: " + xhr.status);
            }
        }
    };
    xhr.open("GET", "/api/kecamatan/" + district_code, true);
    xhr.send();
});
</script>
@endsection