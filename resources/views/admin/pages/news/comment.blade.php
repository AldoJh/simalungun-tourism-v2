@extends('admin.layouts.app')

@section('content')

  <div class="row g-5 g-xl-8">
    <div class="col-xl-12 mb-8">
      <div class="card card-flush">
        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
          <div class="card-title">
            <h3 class="card-title align-items-start flex-column">
              <span class="card-label fw-bold fs-3 mb-1">Komentar</span>
              <span class="text-muted fw-semibold fs-7">Data Komentar</span>
            </h3>
          </div>
        </div>
        <div class="card-body pt-0">
          <div class="table-responsive">
            <table class="table table-row-dashed fs-6 gy-5">
              <thead>
                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                  <th class="min-w-500px">Komentar</th>
                  <th class="w-lg-25 min-w-200px w-100">Berita</th>
                  <th class="w-lg-25 min-w-200px w-100">Tanggal</th>
                  <th class="text-end">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @if ($comment->total() == 0)
                <tr class="max-w-10px">
                  <td colspan="4" class="text-center">
                    No data available in table
                  </td>
                </tr>
                @else
                  @foreach ($comment as $item)     
                    <tr class="max-w-10px">
                      <td>
                        <div class="d-flex">
                          <a href="#" class="symbol symbol-35px">
                            <span class="symbol-label" style="background-image:url('@if($item->user->photo) {{ Storage::url($item->user->photo) }} @else https://ui-avatars.com/api/?background=E79024&color=fff&name={{ $item->user->name }} @endif');"></span>
                          </a>
                          <div class="ms-5">
                            <span class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1">{{ $item->user->name }}</span>
                            <div class="text-muted fs-7 fw-bold">{{ $item->content }}</div>                    
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex align-items-center">
                          <a href="{{ route('berita.show', $item->news->slug) }}" target="_blank">
                            <span class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1">{{ $item->news->title }}</span>
                            <div class="text-muted fs-7 fw-bold">{{ $item->news->slug }}</div>                    
                          </a>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex">
                          <div class="fs-6 fw-bold">{{ $item->created_at }}</div>
                        </div>
                      </td>
                      <td class="text-end">
                        <a id="{{ route('admin.berita.komentar.destroy', $item->id) }}" class="btn btn-light btn-icon btn-sm btn-del">
                          <i class="ki-duotone ki-trash">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                          </i>
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
              Showing {{ $comment->firstItem() }} to {{ $comment->lastItem() }} of {{ $comment->total() }}  records
            </div>
              <ul class="pagination">
                @if ($comment->onFirstPage())
                    <li class="page-item previous">
                        <a href="#" class="page-link"><i class="previous"></i></a>
                    </li>
                @else
                    <li class="page-item previous">
                        <a href="{{ $comment->previousPageUrl() }}" class="page-link bg-light"><i class="previous"></i></a>
                    </li>
                @endif
    
                @foreach ($comment->getUrlRange(1, $comment->lastPage()) as $page => $url)
                    <li class="page-item{{ ($page == $comment->currentPage()) ? ' active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
    
                @if ($comment->hasMorePages())
                    <li class="page-item next">
                        <a href="{{ $comment->nextPageUrl() }}" class="page-link bg-light"><i class="next"></i></a>
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