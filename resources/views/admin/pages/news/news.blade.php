@extends('admin.layouts.app')

@section('content')

  <div class="row g-5 g-xl-8">
    <div class="col-xl-12 mb-8">
      <div class="card card-flush">
        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
          <div class="card-title">
            <h3 class="card-title align-items-start flex-column">
              <span class="card-label fw-bold fs-3 mb-1">Berita</span>
              <span class="text-muted fw-semibold fs-7">Data Berita</span>
            </h3>
          </div>
          <div class="card-toolbar">
            <a href="{{ route('admin.berita.berita.add') }}" class="btn btn-primary d-flex align-items-center"><i class="ki-duotone ki-plus fs-2"></i>
              Tambah
            </a>
          </div>
        </div>
        <div class="card-body pt-0">
          <div class="table-responsive">
            <table id="kt_datatable_zero_configuration" class="table table-row-dashed fs-6 gy-5">
              <thead>
                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                  <th>Berita</th>
                  <th>Penulis</th>
                  <th>Tanggal Posting</th>
                  <th>Viewer</th>
                  <th>Komentar</th>
                  <th class="text-end">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($news as $item)     
                  <tr>
                    <td>
                      <div class="d-flex align-items-center">
                        <a href="#" class="symbol symbol-50px">
                          <span class="symbol-label" style="background-image:url({{ Storage::url($item->image) }});"></span>
                        </a>
                        <div class="ms-5">
                          <span class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1">{{ $item->title }}</span>
                          <div class="text-muted fs-7 fw-bold">{{ $item->slug }}</div>                    
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex">
                        <div class="fs-6 fw-bold">{{ $item->user->name }}</div>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex">
                        <div class="fs-6 fw-bold">{{ $item->date }}</div>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex">
                        <div class="fs-6 fw-bold">{{ count($item->newsViewer) }}</div>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex">
                        <div class="fs-6 fw-bold">{{ count($item->newsViewer) }}</div>
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
                          <a href="{{ route('admin.berita.berita.komentar', $item->id) }}" class="menu-link px-3">Detail</a>
                        </div>
                        <div class="menu-item px-3">
                          <a href="{{ route('admin.berita.berita.edit', $item->id) }}" class="menu-link px-3">Edit</a>
                        </div>
                        <div class="menu-item px-3">
                          <a id="{{ route('admin.berita.berita.destroy', $item->id) }}" class="menu-link px-3 btn-del">Hapus</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
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