@extends('admin.layouts.app')

@section('content')

<div class="row g-6 g-xl-6">
  <div class="card bgi-no-repeat bgi-position-x-end bgi-size-cover"  >
    <div class="card-body pt-9 pb-0">
      <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
        <div class="me-7 mb-4">
          <div class="position-relative">
              <img class="h-150px w-100 rounded" src="{{ Storage::url($news->image) }}" alt="image">
          </div>
        </div>
        <div class="flex-grow-1">
          <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
            <div class="d-flex flex-column">
              <div class="d-flex align-items-center mb-2">
                <span class="text-gray-900 text-hover-primary fs-1 fw-bolder me-1">{{ $news->title }}</span>
              </div>
              <div class="fs-6 mb-4 pe-2">
                <span class="fw-bold d-flex align-items-center text-gray-400 me-5 mb-2">
                  Tanggal: {{ $news->date }} | Penulis: {{ $news->user->name }}
                </span>
              </div>
            </div>
            <div class="d-flex my-4">
              <a href="#" class="btn btn-sm btn-light me-2" id="kt_user_follow_button">
                Lihat
              </a>          
              <a href="{{ route('admin.berita.berita.edit', $news->id) }}" class="btn btn-sm btn-primary me-3">
                Edit
              </a>
            </div>
          </div>
          <div class="d-flex flex-wrap flex-stack">
            <div class="d-flex flex-column flex-grow-1 pe-8">
                <div class="d-flex flex-wrap">
                    <div class="border border-gray-300 border-dashed rounded min-w-md-100px py-3 px-4 me-6 mb-3">
                      <div class="d-flex align-items-center">
                        <div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="80" data-kt-initialized="1">{{ count($news->newsViewer) }}</div>
                      </div>  
                      <div class="fw-semibold fs-6 text-gray-500">Viewer</div>
                    </div>
                    <div class="border border-gray-300 border-dashed rounded min-w-md-100px py-3 px-4 me-6 mb-3">
                      <div class="d-flex align-items-center">
                        <div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="80" data-kt-initialized="1">{{ count($news->comment) }}</div>
                      </div>  
                        <div class="fw-semibold fs-6 text-gray-500">Komentar</div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="d-flex overflow-auto h-55px">
        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
          <li class="nav-item">
            <a href="{{ route('admin.berita.berita.komentar', $news->id) }}" class="nav-link text-active-primary me-6 active ">Komentar</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.berita.berita.galeri', $news->id) }}" class="nav-link text-active-primary me-6">Galeri</a>
          </li>
        </ul>
      </div>
    </div>
  </div>

  @if($komentar->count() > 0)
  @foreach ($komentar as $item)  
    <div class="d-flex bg-white rounded p-5">
      <img src="@if($item->user->photo) {{ $item->user->photo }} @else https://ui-avatars.com/api/?background=E79024&color=fff&name={{ $item->user->name }} @endif" class="rounded-3 h-35px w-35px me-5" alt="user">
      <div class="flex-grow-1 me-2">
        <span class="fw-bold text-gray-800 text-hover-primary fs-6">{{ $item->user->name }}</span>
        <span class="text-muted fw-semibold d-block">{{ $item->content }}</span>
      </div>
      <div class="flex-grow-2 me-2">
        <a id="{{ route('admin.berita.berita.komentar.destroy', ['id' => $news->id, 'idComment' => $item->id]) }}" class="btn btn-light btn-icon btn-sm btn-del">
          <i class="ki-duotone ki-trash">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
            <span class="path4"></span>
            <span class="path5"></span>
          </i>
        </a>
      </div>
    </div>
  @endforeach
  @else
    <span class="mt-20 text-gray-500 text-center">~ Tidak ada data ~</span>
  @endif
</div>

@endsection

@section('script')
@endsection