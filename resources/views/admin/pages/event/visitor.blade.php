@extends('admin.layouts.app')

@section('content')

  <div class="row g-5 g-xl-8">
    <div class="col-xl-12 mb-8">
      <div class="card card-flush">
        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
          <div class="card-title">
            <h3 class="card-title align-items-start flex-column">
              <span class="card-label fw-bold fs-3 mb-1">Pengunjung</span>
              <span class="text-muted fw-semibold fs-7">Pengunjung Festival</span>
            </h3>
          </div>
        </div>
        <div class="card-body pt-0">
          <div class="table-responsive">
            <table class="table table-row-dashed fs-6 gy-5">
              <thead>
                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                  <th class="min-w-200px">Festival</th>
                  <th class="min-w-125px">Tanggal</th>
                  <th>Jumlah Pengunjung</th>
                  <th>Lampiran</th>
                  <th class="text-end">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @if ($visitor->total() == 0)
                  <tr class="max-w-10px">
                    <td colspan="4" class="text-center">
                      No data available in table
                    </td>
                  </tr>
                @else
                  @foreach ($visitor as $item)     
                    <tr>
                      <td>
                        <div>
                          <div class="fs-6 fw-bold">{{ $item->event->name }}</div>
                          <span class="text-muted text-10">{{ $item->event->slug }}</span>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex">
                          <div class="fs-6 fw-bold">{{ $item->date }}</div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex">
                          <div class="fs-6 fw-bold">{{ $item->visitor }}</div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex">
                          <a class="fs-6 fw-bold" href="{{ Storage::url($item->attachment) }}" target="_blank"><u>Lihat</u></a>
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
                      </td>
                    </tr>
                  @endforeach
                @endif
              </tbody>
            </table>
          </div>
          <div class="d-flex flex-stack flex-wrap my-3">
            <div class="fs-6 fw-semibold text-gray-700">
              Showing {{ $visitor->firstItem() }} to {{ $visitor->lastItem() }} of {{ $visitor->total() }}  records
            </div>
              <ul class="pagination">
                @if ($visitor->onFirstPage())
                    <li class="page-item previous">
                        <a href="#" class="page-link"><i class="previous"></i></a>
                    </li>
                @else
                    <li class="page-item previous">
                        <a href="{{ $visitor->previousPageUrl() }}" class="page-link bg-light"><i class="previous"></i></a>
                    </li>
                @endif
    
                @foreach ($visitor->getUrlRange(1, $visitor->lastPage()) as $page => $url)
                    <li class="page-item{{ ($page == $visitor->currentPage()) ? ' active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
    
                @if ($visitor->hasMorePages())
                    <li class="page-item next">
                        <a href="{{ $visitor->nextPageUrl() }}" class="page-link bg-light"><i class="next"></i></a>
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