@extends('admin.layouts.app')

@section('content')

  <div class="row g-5 g-xl-8">
    <div class="col-xl-12 mb-8">
      <div class="card card-flush">
        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
          <div class="card-title">
            <h3 class="card-title align-items-start flex-column">
              <span class="card-label fw-bold fs-3 mb-1">Pengunjung</span>
              <span class="text-muted fw-semibold fs-7">Pengunjung Restaurant</span>
            </h3>
          </div>
        </div>
        <div class="card-body pt-0">
          <div class="table-responsive">
            <table class="table table-row-dashed fs-6 gy-5">
              <thead>
                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                  <th class="min-w-200px">Restaurant</th>
                  <th class="min-w-125px">Tanggal</th>
                  <th>Jumlah Pengunjung</th>
                  <th>Lampiran</th>
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
                          <div class="fs-6 fw-bold">{{ $item->restaurant->name }}</div>
                          <span class="text-muted text-10">{{ $item->restaurant->slug }}</span>
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
        
                @php
                    // Menghitung halaman pertama dan terakhir yang akan ditampilkan
                    $start = max($visitor->currentPage() - 2, 1);
                    $end = min($start + 4, $visitor->lastPage());
                @endphp
        
                @if ($start > 1)
                    <!-- Menampilkan tanda elipsis jika halaman pertama tidak termasuk dalam tampilan -->
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                @endif
        
                @foreach ($visitor->getUrlRange($start, $end) as $page => $url)
                    <li class="page-item{{ ($page == $visitor->currentPage()) ? ' active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
        
                @if ($end < $visitor->lastPage())
                    <!-- Menampilkan tanda elipsis jika halaman terakhir tidak termasuk dalam tampilan -->
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                @endif
        
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
@endsection