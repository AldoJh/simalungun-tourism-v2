@extends('admin.layouts.app')

@section('content')

<div class="row g-6 g-xl-6">
  <div class="card bgi-no-repeat bgi-position-x-end bgi-size-cover"  >
    <div class="card-body pt-9 pb-0">
      <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
        <div class="me-7 mb-4">
          <div class="position-relative">
              <img class="h-150px w-100 rounded" src="{{ Storage::url($hotel->image) }}" alt="image">
          </div>
        </div>
        <div class="flex-grow-1">
          <div class="d-md-flex justify-content-between align-items-start mb-2">
            <div class="d-flex flex-column">
              <div class="d-flex align-items-center mb-2">
                <span class="text-gray-900 text-hover-primary fs-1 fw-bolder me-1">{{ $hotel->name }}
                </span>
              </div>
              <div class="fs-6 fw-bold d-flex align-items-center mb-2">
                @if (count($hotel->hotelReview) > 0)
                  @for($i = 0; $i < round($hotel->hotelReview->average('rating'), 0); $i++)
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill text-warning" viewBox="0 0 16 16">
                      <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                    </svg>
                  @endfor
                  <span class="ms-2">{{ round($hotel->hotelReview->average('rating'), 1) }} ({{ count($hotel->hotelReview) }})</span>
                @else
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star text-warning" viewBox="0 0 16 16">
                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                  </svg>
                  <span class="ms-2">Tidak ada rating</span>
                @endif
              </div>
              <div class="fs-6 mb-4 pe-2">
                <span class="fw-bold d-flex align-items-center text-gray-400 me-5 mb-2">
                  {{ $hotel->address }} 
                </span>
              </div>
            </div>
            <div class="d-flex my-4">
              <a href="{{ route('hotel.show', $hotel->slug) }}" target="_blank" class="btn btn-sm btn-light me-2" id="kt_user_follow_button">
                Lihat
              </a>
              <a href="{{ route('admin.hotel.hotel.edit', $hotel->id) }}" class="btn btn-sm btn-primary me-3">
                Edit
              </a>
            </div>
          </div>
          <div class="d-flex flex-wrap flex-stack">
            <div class="d-flex flex-column flex-grow-1 pe-8">
                <div class="d-flex flex-wrap">
                    <div class="border border-gray-300 border-dashed rounded min-w-md-100px py-3 px-4 me-6 mb-3">
                      <div class="d-flex align-items-center">
                        <div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="80" data-kt-initialized="1">{{ count($hotel->hotelViewer) }}</div>
                      </div>  
                      <div class="fw-semibold fs-6 text-gray-500">Viewer</div>
                    </div>
                    <div class="border border-gray-300 border-dashed rounded min-w-md-100px py-3 px-4 me-6 mb-3">
                      <div class="d-flex align-items-center">
                        <div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="80" data-kt-initialized="1">{{ $hotel->hotelVisitor->sum('visitor') }}</div>
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
            <a href="{{ route('admin.hotel.hotel.pengunjung', $hotel->id) }}" class="nav-link text-active-primary me-6">Pengunjung</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.hotel.hotel.review', $hotel->id) }}" class="nav-link text-active-primary me-6 active">Review</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.hotel.hotel.galeri', $hotel->id) }}" class="nav-link text-active-primary me-6">Galeri</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.hotel.hotel.admin', $hotel->id) }}" class="nav-link text-active-primary me-6">Admin</a>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <div>
    <div class="table-responsive">
      @if($review->total() > 0)
        @foreach ($review as $item)  
          <div class="d-flex bg-white rounded p-5 mb-3">
            <img src="@if($item->user->photo) {{ Storage::url($item->user->photo) }} @else https://ui-avatars.com/api/?background=E79024&color=fff&name={{ $item->user->name }} @endif" class="rounded-3 h-35px w-35px me-5" alt="user">
            <div class="flex-grow-1 me-2">
              <span class="fw-bold text-gray-800 text-hover-primary fs-6">{{ $item->user->name }}</span>              
              <span class="text-muted fw-semibold d-block">{{ $item->created_at }}</span>
              <div class="my-3">
                @for($i = 0; $i < $item->rating; $i++)
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill text-warning" viewBox="0 0 16 16">
                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                  </svg>
                @endfor
              </div>
              <span class="text-gray-600 fw-semibold d-block fs-6">{{ $item->comment }}</span>
            </div>
          </div>
        @endforeach
      @else
      <div class="text-center">
        <span class="mt-md-20 mb-20 text-gray-500 text-center">~ Tidak ada data ~</span>
      </div>
      @endif
    </div>
    <div class="d-flex flex-stack flex-wrap my-3 mt-5">
      <div class="fs-6 fw-semibold text-gray-700">
          Showing {{ $review->firstItem() }} to {{ $review->lastItem() }} of {{ $review->total() }}  records
      </div>
      <ul class="pagination">
          @if ($review->onFirstPage())
              <li class="page-item previous">
                  <a href="#" class="page-link"><i class="previous"></i></a>
              </li>
          @else
              <li class="page-item previous">
                  <a href="{{ $review->previousPageUrl() }}" class="page-link bg-light"><i class="previous"></i></a>
              </li>
          @endif
  
          @php
              // Menghitung halaman pertama dan terakhir yang akan ditampilkan
              $start = max($review->currentPage() - 2, 1);
              $end = min($start + 4, $review->lastPage());
          @endphp
  
          @if ($start > 1)
              <!-- Menampilkan tanda elipsis jika halaman pertama tidak termasuk dalam tampilan -->
              <li class="page-item disabled">
                  <span class="page-link">...</span>
              </li>
          @endif
  
          @foreach ($review->getUrlRange($start, $end) as $page => $url)
              <li class="page-item{{ ($page == $review->currentPage()) ? ' active' : '' }}">
                  <a class="page-link" href="{{ $url }}">{{ $page }}</a>
              </li>
          @endforeach
  
          @if ($end < $review->lastPage())
              <!-- Menampilkan tanda elipsis jika halaman terakhir tidak termasuk dalam tampilan -->
              <li class="page-item disabled">
                  <span class="page-link">...</span>
              </li>
          @endif
  
          @if ($review->hasMorePages())
              <li class="page-item next">
                  <a href="{{ $review->nextPageUrl() }}" class="page-link bg-light"><i class="next"></i></a>
              </li>
          @else
              <li class="page-item next">
                  <a href="#" class="page-link"><i class="next"></i></a>
              </li>
          @endif
      </ul>
    </div>
  </div>
</div>

@endsection

@section('script')
@endsection