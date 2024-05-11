@extends('admin.layouts.app')

@section('content')

  <div class="row g-5 g-xl-8">
    <div class="col-xl-12 mb-8">
      <div class="card card-flush">
        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
          <div class="card-title">
            <h3 class="card-title align-items-start flex-column">
              <span class="card-label fw-bold fs-3 mb-1">Wisata</span>
              <span class="text-muted fw-semibold fs-7">Data wisata</span>
            </h3>
          </div>
          <div class="card-toolbar">
            <form method="GET" action="{{ route('admin.wisata.wisata') }}" class="card-title">
              <input type="hidden" name="page" value="{{ request('page', 1) }}">
              <div class="input-group d-flex align-items-center position-relative my-1">
                <input type="text"  class="form-control form-control-solid  ps-5 rounded-0" name="q" value="{{ request('q') }}" placeholder="Cari wisata" />
                <button class="btn btn-primary btn-icon" type="submit" id="button-addon2">
                  <span class="svg-icon svg-icon-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                      <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                    </svg>
                  </span>
                </button>
              </div>
              <!--end::Search-->
            </form>
            <a href="{{ route('admin.wisata.wisata.add') }}" class="btn btn-primary d-flex align-items-center"><i class="ki-duotone ki-plus fs-2"></i>
              Tambah
            </a>
          </div>
        </div>
        <div class="card-body pt-0">
          <div class="table-responsive">
            <table class="table table-row-dashed fs-6 gy-5">
              <thead>
                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                  <th class="min-w-300px">wisata</th>
                  <th class="min-w-125px">Kategori</th>
                  <th class="min-w-150px">Rating</th>
                  <th class="text-center">Pengunjung</th>
                  <th class="text-center">Viewer</th>
                  <th class="text-end">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @if ($tourism->total() == 0)
                  <tr class="max-w-10px">
                    <td colspan="6" class="text-center">
                      No data available in table
                    </td>
                  </tr>
                @else
                  @foreach ($tourism as $item)     
                    <tr>
                      <td>
                        <div class="d-flex align-items-center">
                          <a href="#" class="symbol symbol-50px">
                            @if(Storage::disk('public')->exists($item->image))
                                <span class="symbol-label" style="background-image:url('{{ Storage::url($item->image) }}');"></span>
                              @else
                              <span class="symbol-label" style="background-image:url('{{ asset('front-assets/no-image.png') }}');"></span>
                              @endif
                          </a>
                          <div class="ms-5">
                            <a href="{{ route('wisata.show', $item->slug) }}" target="_blank" class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1">
                              {{ $item->name }}
                              @if ($item->is_recomended) <span class="badge bg-light-success text-success">Recomended</span> @endif
                            </a>
                            <div class="text-muted fs-7 fw-bold">{{ $item->address }}</div>                    
                          </div>
                        </div>
                      </td>
                      <td>
                        <div>
                          <div class="fs-6 fw-bold">{{ $item->tourismCategory->name }}</div>
                        </div>
                      </td>
                      <td>
                        <div class="text-center">
                          <div class="fs-6 fw-bold d-flex align-items-center">
                            @if (count($item->tourismReview) > 0)
                              @for($i = 0; $i < round($item->tourismReview->average('rating'), 0); $i++)
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill text-warning" viewBox="0 0 16 16">
                                  <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                              @endfor
                              <span class="ms-2">{{ round($item->tourismReview->average('rating'), 1) }} ({{ count($item->tourismReview) }})</span>
                            @else
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star text-warning" viewBox="0 0 16 16">
                                <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                              </svg>
                              <span class="ms-2">Tidak ada rating</span>
                            @endif
                        </div>
                      </td>
                      <td>
                        <div class="text-center">
                          <div class="fs-6 fw-bold">{{ $item->tourismVisitor->sum('visitor') }}</div>
                        </div>
                      </td>
                      <td>
                        <div class="text-center">
                          <div class="fs-6 fw-bold">{{ count($item->tourismViewer) }}</div>
                        </div>
                      </td>
                      <td class="text-end">
                        <a href="#" class="btn btn-sm btn-light btn-active-light-primary btn-flex btn-center" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                          Actions
                          <span class="svg-icon fs-5 m-0 ps-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="currentColor" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                              </g>
                            </svg>
                          </span>
                        </a>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                          <div class="menu-item px-3">
                            <a href="{{ route('admin.wisata.wisata.pengunjung', $item->id) }}" class="menu-link px-3">Detail</a>
                          </div>
                          <div class="menu-item px-3">
                            <a href="{{ route('admin.wisata.wisata.edit', $item->id) }}" class="menu-link px-3">Edit</a>
                          </div>
                          <div class="menu-item px-3">
                            <a id="{{ route('admin.wisata.wisata.destroy', $item->id) }}" class="menu-link px-3 btn-del">Hapus</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                @endif
              </tbody>
            </table>
          </div>
          <div class="d-flex flex-stack flex-wrap my-3">
            <div class="fs-6 fw-semibold text-gray-700">
                Showing {{ $tourism->firstItem() }} to {{ $tourism->lastItem() }} of {{ $tourism->total() }}  records
            </div>
            <ul class="pagination">
                @if ($tourism->onFirstPage())
                    <li class="page-item previous">
                        <a href="#" class="page-link"><i class="previous"></i></a>
                    </li>
                @else
                    <li class="page-item previous">
                        <a href="{{ $tourism->previousPageUrl() }}" class="page-link bg-light"><i class="previous"></i></a>
                    </li>
                @endif
        
                @php
                    // Menghitung halaman pertama dan terakhir yang akan ditampilkan
                    $start = max($tourism->currentPage() - 2, 1);
                    $end = min($start + 4, $tourism->lastPage());
                @endphp
        
                @if ($start > 1)
                    <!-- Menampilkan tanda elipsis jika halaman pertama tidak termasuk dalam tampilan -->
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                @endif
        
                @foreach ($tourism->getUrlRange($start, $end) as $page => $url)
                    <li class="page-item{{ ($page == $tourism->currentPage()) ? ' active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
        
                @if ($end < $tourism->lastPage())
                    <!-- Menampilkan tanda elipsis jika halaman terakhir tidak termasuk dalam tampilan -->
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                @endif
        
                @if ($tourism->hasMorePages())
                    <li class="page-item next">
                        <a href="{{ $tourism->nextPageUrl() }}" class="page-link bg-light"><i class="next"></i></a>
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
<script>
  $("#kt_datatable_zero_configuration").DataTable();
</script>
@endsection