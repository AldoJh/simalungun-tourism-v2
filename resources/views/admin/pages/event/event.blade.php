@extends('admin.layouts.app')

@section('content')

  <div class="row g-5 g-xl-8">
    <div class="col-xl-12 mb-8">
      <div class="card card-flush">
        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
          <div class="card-title">
            <h3 class="card-title align-items-start flex-column">
              <span class="card-label fw-bold fs-3 mb-1">Festival</span>
              <span class="text-muted fw-semibold fs-7">Data Festival</span>
            </h3>
          </div>
          <div class="card-toolbar">
            <form method="GET" action="{{ route('admin.festival.festival') }}" class="card-title">
              <input type="hidden" name="page" value="{{ request('page', 1) }}">
              <div class="input-group d-flex align-items-center position-relative my-1">
                <input type="text"  class="form-control form-control-solid  ps-5 rounded-0" name="q" value="{{ request('q') }}" placeholder="Cari festival" />
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
            <a href="{{ route('admin.festival.festival.add') }}" class="btn btn-primary d-flex align-items-center"><i class="ki-duotone ki-plus fs-2"></i>
              Tambah
            </a>
          </div>
        </div>
        <div class="card-body pt-0">
          <div class="table-responsive">
            <table class="table table-row-dashed fs-6 gy-5">
              <thead>
                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                  <th class="min-w-200px">Festival</th>
                  <th class="text-center min-w-125px">Harga</th>
                  <th class="text-center min-w-125px">Tanggal</th>
                  <th class="text-center">Viewer</th>
                  <th class="text-center">Pengunjung</th>
                  <th class="text-end">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @if ($event->total() == 0)
                  <tr class="max-w-10px">
                    <td colspan="6" class="text-center">
                      No data available in table
                    </td>
                  </tr>
                @else
                  @foreach ($event as $item)     
                    <tr>
                      <td>
                        <div class="d-flex align-items-center">
                          <a href="#" class="symbol symbol-50px">
                            <span class="symbol-label" style="background-image:url('{{ Storage::url($item->image) }}');"></span>
                          </a>
                          <div class="ms-5">
                            <a href="{{ route('festival.show', $item->slug) }}" target="_blank" class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1">{{ $item->name }}</a>
                            <div class="text-muted fs-7 fw-bold">{{ $item->address }}</div>                    
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="text-center">
                          <div class="fs-6 fw-bold">@if ($item->price == 0) Free @else {{ number_format($item->price) }} @endif</div>
                        </div>
                      </td>
                      <td>
                        <div class="text-center">
                          <div class="fs-6 fw-bold">{{ $item->date }}</div>
                        </div>
                      </td>
                      <td>
                        <div class="text-center">
                          <div class="fs-6 fw-bold">{{ count($item->eventViewer) }}</div>
                        </div>
                      </td>
                      <td>
                        <div class="text-center">
                          <div class="fs-6 fw-bold">{{ $item->eventVisitor->sum('visitor') }}</div>
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
                            <a href="{{ route('admin.festival.festival.pengunjung', $item->id) }}" class="menu-link px-3">Pengunjung</a>
                          </div>
                          <div class="menu-item px-3">
                            <a href="{{ route('admin.festival.festival.galeri', $item->id) }}" class="menu-link px-3">Galeri</a>
                          </div>
                          <div class="menu-item px-3">
                            <a href="{{ route('admin.festival.festival.atribut', $item->id) }}" class="menu-link px-3">Atribut</a>
                          </div>
                          <div class="menu-item px-3">
                            <a href="{{ route('admin.festival.festival.admin', $item->id) }}" class="menu-link px-3">Admin</a>
                          </div>
                          <div class="menu-item px-3">
                            <a href="{{ route('admin.festival.festival.edit', $item->id) }}" class="menu-link px-3">Edit</a>
                          </div>
                          <div class="menu-item px-3">
                            <a id="{{ route('admin.festival.festival.destroy', $item->id) }}" class="menu-link px-3 btn-del">Hapus</a>
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
                Showing {{ $event->firstItem() }} to {{ $event->lastItem() }} of {{ $event->total() }}  records
            </div>
            <ul class="pagination">
                @if ($event->onFirstPage())
                    <li class="page-item previous">
                        <a href="#" class="page-link"><i class="previous"></i></a>
                    </li>
                @else
                    <li class="page-item previous">
                        <a href="{{ $event->previousPageUrl() }}" class="page-link bg-light"><i class="previous"></i></a>
                    </li>
                @endif
        
                @php
                    // Menghitung halaman pertama dan terakhir yang akan ditampilkan
                    $start = max($event->currentPage() - 2, 1);
                    $end = min($start + 4, $event->lastPage());
                @endphp
        
                @if ($start > 1)
                    <!-- Menampilkan tanda elipsis jika halaman pertama tidak termasuk dalam tampilan -->
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                @endif
        
                @foreach ($event->getUrlRange($start, $end) as $page => $url)
                    <li class="page-item{{ ($page == $event->currentPage()) ? ' active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
        
                @if ($end < $event->lastPage())
                    <!-- Menampilkan tanda elipsis jika halaman terakhir tidak termasuk dalam tampilan -->
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                @endif
        
                @if ($event->hasMorePages())
                    <li class="page-item next">
                        <a href="{{ $event->nextPageUrl() }}" class="page-link bg-light"><i class="next"></i></a>
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