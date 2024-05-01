@extends('admin.layouts.app')

@section('content')

  <div class="row g-5 g-xl-8">
    <div class="col-xl-12 mb-8">
      <div class="card card-flush">
        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
          <div class="card-title">
            <h3 class="card-title align-items-start flex-column">
              <span class="card-label fw-bold fs-3 mb-1">Kuisioner</span>
              <span class="text-muted fw-semibold fs-7">Tanggapan Kuisioner</span>
            </h3>
          </div>
        </div>
        <div class="card-body pt-0">
          <div class="table-responsive">
            <table class="table table-row-dashed fs-6 gy-5">
              <thead>
                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                  <th class="min-w-150px">Tanggal</th>
                  <th class="min-w-150px">Nama</th>
                  <th class="min-w-125px">Email</th>
                  <th class="min-w-125px">No. Telp</th>
                  <th class="min-w-125px">Usia</th>
                  <th class="min-w-125px">Jawaban</th>
                  <th class="min-w-200px">Saran</th>
                  <th class="text-end">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @if ($feedback->total() == 0)
                  <tr class="max-w-10px">
                    <td colspan="8" class="text-center">
                      No data available in table
                    </td>
                  </tr>
                @else
                  @foreach ($feedback as $item)     
                    <tr>
                      <td>
                        <div class="d-flex">
                          <div class="fs-6 fw-bold">{{ $item->created_at }}</div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex">
                          <div class="fs-6 fw-bold">{{ $item->name }}</div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex">
                          <div class="fs-6 fw-bold">{{ $item->email }}</div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex">
                          <div class="fs-6 fw-bold">{{ $item->phone }}</div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex">
                          <div class="fs-6 fw-bold">{{ $item->age }}</div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex">
                          <div class="fs-6 fw-bold">{{ $item->answer }}</div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex">
                          <div class="fs-6 fw-bold">{{ $item->suggestion }}</div>
                        </div>
                      </td>
                      <td class="text-end">
                        <button id="{{ route('admin.kuisioner.destroy', $item->id) }}" class="btn btn-sm btn-light btn-active-light-primary btn-icon btn-flex btn-center btn-del" >
                          <span class="svg-icon fs-2 m-0 ">
                            <i class="ki-duotone ki-trash fs-2">
                              <span class="path1"></span>
                              <span class="path2"></span>
                              <span class="path3"></span>
                              <span class="path4"></span>
                              <span class="path5"></span>
                            </i>
                          </span>
                        </button>
                      </td>
                    </tr>
                  @endforeach
                @endif
              </tbody>
            </table>
          </div>
          <div class="d-flex flex-stack flex-wrap my-3">
            <div class="fs-6 fw-semibold text-gray-700">
              Showing {{ $feedback->firstItem() }} to {{ $feedback->lastItem() }} of {{ $feedback->total() }}  records
            </div>
              <ul class="pagination">
                @if ($feedback->onFirstPage())
                    <li class="page-item previous">
                        <a href="#" class="page-link"><i class="previous"></i></a>
                    </li>
                @else
                    <li class="page-item previous">
                        <a href="{{ $feedback->previousPageUrl() }}" class="page-link bg-light"><i class="previous"></i></a>
                    </li>
                @endif
    
                @foreach ($feedback->getUrlRange(1, $feedback->lastPage()) as $page => $url)
                    <li class="page-item{{ ($page == $feedback->currentPage()) ? ' active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
    
                @if ($feedback->hasMorePages())
                    <li class="page-item next">
                        <a href="{{ $feedback->nextPageUrl() }}" class="page-link bg-light"><i class="next"></i></a>
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