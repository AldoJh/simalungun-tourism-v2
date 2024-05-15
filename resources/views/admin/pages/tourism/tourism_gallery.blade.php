@extends('admin.layouts.app')

@section('content')

<div class="row g-6 g-xl-6">
  <div class="card bgi-no-repeat bgi-position-x-end bgi-size-cover"  >
    <div class="card-body pt-9 pb-0">
      <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
        <div class="me-7 mb-4">
          <div class="position-relative">
              <img class="h-150px w-100 rounded" src="{{ Storage::url($tourism->image) }}" alt="image">
          </div>
        </div>
        <div class="flex-grow-1">
          <div class="d-md-flex justify-content-between align-items-start mb-2">
            <div class="d-flex flex-column">
              <div class="d-flex align-items-center mb-2">
                <span class="text-gray-900 text-hover-primary fs-1 fw-bolder me-1">{{ $tourism->name }}
                </span>
              </div>
              <div class="fs-6 fw-bold d-flex align-items-center mb-2">
                @if (count($tourism->tourismReview) > 0)
                  @for($i = 0; $i < round($tourism->tourismReview->average('rating'), 0); $i++)
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill text-warning" viewBox="0 0 16 16">
                      <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                    </svg>
                  @endfor
                  <span class="ms-2">{{ round($tourism->tourismReview->average('rating'), 1) }} ({{ count($tourism->tourismReview) }})</span>
                @else
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star text-warning" viewBox="0 0 16 16">
                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                  </svg>
                  <span class="ms-2">Tidak ada rating</span>
                @endif
              </div>
              <div class="fs-6 mb-4 pe-2">
                <span class="fw-bold d-flex align-items-center text-gray-400 me-5 mb-2">
                  {{ $tourism->address }} 
                </span>
              </div>
            </div>
            <div class="d-flex my-4">
              <a href="{{ route('wisata.show', $tourism->slug) }}" target="_blank" class="btn btn-sm btn-light me-2" id="kt_user_follow_button">
                Lihat
              </a>
                @if (Auth::user()->role == 'superadmin')           
                <a href="{{ route('admin.wisata.wisata.edit', $tourism->id) }}" class="btn btn-sm btn-primary me-3">
                  Edit
                </a>
              @endif
            </div>
          </div>
          <div class="d-flex flex-wrap flex-stack">
            <div class="d-flex flex-column flex-grow-1 pe-8">
                <div class="d-flex flex-wrap">
                    <div class="border border-gray-300 border-dashed rounded min-w-md-100px py-3 px-4 me-6 mb-3">
                      <div class="d-flex align-items-center">
                        <div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="80" data-kt-initialized="1">{{ count($tourism->tourismViewer) }}</div>
                      </div>  
                      <div class="fw-semibold fs-6 text-gray-500">Viewer</div>
                    </div>
                    <div class="border border-gray-300 border-dashed rounded min-w-md-100px py-3 px-4 me-6 mb-3">
                      <div class="d-flex align-items-center">
                        <div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="80" data-kt-initialized="1">{{ $tourism->tourismVisitor->sum('visitor') }}</div>
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
            <a href="{{ route('admin.wisata.wisata.pengunjung', $tourism->id) }}" class="nav-link text-active-primary me-6">Pengunjung</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.wisata.wisata.review', $tourism->id) }}" class="nav-link text-active-primary me-6">Review</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.wisata.wisata.galeri', $tourism->id) }}" class="nav-link text-active-primary me-6 active">Galeri</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.wisata.wisata.admin', $tourism->id) }}" class="nav-link text-active-primary me-6">Admin</a>
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
            <a href="{{ route('admin.wisata.wisata.galeri.destroy', ['id' => $tourism->id, 'idGallery' => $item->id]) }}" class="btn-del">
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
      <form method="POST" action="{{ route('admin.wisata.wisata.galeri.store', $tourism->id) }}" enctype="multipart/form-data" class="modal-content">
        @csrf
          <div class="modal-header">
              <h3 class="modal-title">Upload Gambar</h3>
              <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                  <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
              </div>
          </div>
          <div class="modal-body">
            <input type="file" name="image" class="form-control form-control-solid">
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