@extends('admin.layouts.app')

@section('content')

  <div class="row g-5 g-xl-8">
    <div class="col-xl-12 mb-8">
      <div class="card card-flush">
        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
          <div class="card-title">
            <h3 class="card-title align-items-start flex-column">
              <span class="card-label fw-bold fs-3 mb-1">Review</span>
              <span class="text-muted fw-semibold fs-7">Review Restaurant</span>
            </h3>
          </div>
        </div>
        <div class="card-body pt-0">
          <div class="table-responsive">
            <table class="table table-row-dashed fs-6 gy-5">
              <thead>
                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                  <th class="min-w-200px">Review</th>
                  <th class="min-w-125px">Restaurant</th>
                  <th class="min-w-125px">Tanggal</th>
                  <th class="text-end">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @if ($review->total() == 0)
                  <tr class="max-w-10px">
                    <td colspan="4" class="text-center">
                      No data available in table
                    </td>
                  </tr>
                @else
                  @foreach ($review as $item)     
                    <tr>
                      <td>
                        <div class="d-flex">
                          <a href="#" class="symbol symbol-35px">
                            <span class="symbol-label" style="background-image:url('@if($item->user->photo) {{ Storage::url($item->user->photo) }} @else https://ui-avatars.com/api/?background=E79024&color=fff&name={{ $item->user->name }} @endif');"></span>
                          </a>
                          <div class="ms-5">
                            <span class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1">{{ $item->user->name }}</span>
                            <div class="py-2">
                              @for($i = 0; $i < $item->rating; $i++)
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill text-warning fs-7" viewBox="0 0 16 16">
                                  <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                              @endfor
                            </div>
                            <div class="text-muted fs-7 fw-bold">{{ $item->comment }}</div>                    
                          </div>
                        </div>
                      </td>
                      <td>
                        <div>
                          <div class="fs-6 fw-bold">{{ $item->restaurant->name }}</div>
                          <span class="text-muted text-10">{{ $item->restaurant->slug }}</span>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex">
                          <div class="fs-6 fw-bold">{{ $item->created_at }}</div>
                        </div>
                      </td>
                      <td class="text-end">
                        <a id="{{ route('admin.restoran.review.destroy', $item->id) }}" class="btn btn-del btn-sm btn-light btn-active-light-primary btn-flex btn-center btn-icon">
                          <span class="svg-icon fs-5 m-0 ">
                            <i class="ki-duotone ki-trash">
                              <span class="path1"></span>
                              <span class="path2"></span>
                              <span class="path3"></span>
                              <span class="path4"></span>
                              <span class="path5"></span>
                            </i>
                          </span>
                        </a>
                      </td>
                    </tr>
                  @endforeach
                @endif
              </tbody>
            </table>
          </div>
          <div class="d-flex flex-stack flex-wrap my-3">
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
    </div>
  </div>

@endsection

@section('script')
@endsection