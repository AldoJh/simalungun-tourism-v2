@extends('admin.layouts.app')

@section('content')

<div class="row g-6 g-xl-6">
  <div class="card bgi-no-repeat bgi-position-x-end bgi-size-cover"  >
    <div class="card-body pt-9 pb-0">
      <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
        <div class="me-7 mb-4">
          <div class="position-relative">
              <img class="h-150px w-100 rounded" src="{{ Storage::url($event->image) }}" alt="image">
          </div>
        </div>
        <div class="flex-grow-1">
          <div class="d-md-flex justify-content-between align-items-start mb-2">
            <div class="d-flex flex-column">
              <div class="d-flex align-items-center mb-2">
                <span class="text-gray-900 text-hover-primary fs-1 fw-bolder me-1">{{ $event->name }}</span>
              </div>
              <div class="fs-6 mb-4 pe-2">
                <span class="fw-bold d-flex align-items-center text-gray-400 me-5 mb-2">
                  {{ $event->date }} <br> {{ $event->address }} 
                </span>
              </div>
            </div>
            <div class="d-flex my-4">
              <a href="{{ route('festival.show', $event->slug) }}" target="_blank" class="btn btn-sm btn-light me-2" id="kt_user_follow_button">
                Lihat
              </a>         
              <a href="{{ route('admin.festival.festival.edit', $event->id) }}" class="btn btn-sm btn-light-primary me-3">
                Rute
              </a> 
              <a href="{{ route('admin.festival.festival.edit', $event->id) }}" class="btn btn-sm btn-primary me-3">
                Edit
              </a>
            </div>
          </div>
          <div class="d-flex flex-wrap flex-stack">
            <div class="d-flex flex-column flex-grow-1 pe-8">
                <div class="d-flex flex-wrap">
                    <div class="border border-gray-300 border-dashed rounded min-w-md-100px py-3 px-4 me-6 mb-3">
                      <div class="d-flex align-items-center">
                        <div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="80" data-kt-initialized="1">{{ count($event->eventViewer) }}</div>
                      </div>  
                      <div class="fw-semibold fs-6 text-gray-500">Viewer</div>
                    </div>
                    <div class="border border-gray-300 border-dashed rounded min-w-md-100px py-3 px-4 me-6 mb-3">
                      <div class="d-flex align-items-center">
                        <div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="80" data-kt-initialized="1">{{ $event->eventVisitor->sum('visitor') }}</div>
                      </div>  
                        <div class="fw-semibold fs-6 text-gray-500">Pengunjung</div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="d-flex overflow-auto h-55px">
        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
          <li class="nav-item">
            <a href="{{ route('admin.festival.festival.pengunjung', $event->id) }}" class="nav-link text-active-primary me-6 ">Pengunjung</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.festival.festival.galeri', $event->id) }}" class="nav-link text-active-primary me-6 active">Galeri</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.festival.festival.atribut', $event->id) }}" class="nav-link text-active-primary me-6">Atribut</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.festival.festival.admin', $event->id) }}" class="nav-link text-active-primary me-6">Admin</a>
          </li>
        </ul>
      </div>
    </div>
  </div>

  
  <div class="row mb-6 mt-10">
    @if($gallery->count() > 0)
      @foreach ($gallery as $item)  
        <div class="col-auto">
          <div class="image-input image-input-outline">
            <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ Storage::url($item->image) }}')"></div>
            <a href="{{ route('admin.festival.festival.galeri.destroy', ['id' => $event->id, 'idGallery' => $item->id]) }}" class="btn-del">
              <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Hapus Gambar">
                <span class="svg-icon svg-icon-primary svg-icon-1x">
                  <i class="ki-duotone ki-cross fs-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                  </i>
                </span>                    
              </label>
            </a>
          </div>
        </div>
      @endforeach
    @else
        <span class="mt-md-20 mb-20 text-gray-500 text-center">~ Tidak ada data ~</span>
    @endif
  </div>
</div>

<button data-bs-toggle="modal" data-bs-target="#upload" class="btn btn-primary btn-icon btn-lg rounded-pill" style="position:absolute;bottom:10%;right:10%;">
  <i class="ki-duotone ki-file-up fs-1">
    <span class="path1"></span>
    <span class="path2"></span>
  </i>
</button>


<div class="modal fade" tabindex="-1" id="upload">
  <div class="modal-dialog modal-dialog-centered">
      <form method="POST" action="{{ route('admin.festival.festival.galeri.store', $event->id) }}" enctype="multipart/form-data" class="modal-content">
        @csrf
          <div class="modal-header">
              <h3 class="modal-title">Upload Gambar</h3>
              <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                  <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
              </div>
          </div>
          <div class="modal-body">
            <input type="file" accept=".png, .jpg, .jpeg" name="image" class="form-control form-control-solid">
            <small class="text-muted ms-2 pt-2">File yang diizinkan: *.png, *.jpg, *.jpeg. Maksimal 2mb</small>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
      </form>
  </div>
</div>

@endsection

@section('script')
@endsection