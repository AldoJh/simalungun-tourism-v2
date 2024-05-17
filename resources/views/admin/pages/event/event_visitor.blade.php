@extends('admin.layouts.app')

@section('content')

<div class="row g-6 g-xl-6">
  <div class="card bgi-no-repeat bgi-position-x-end bgi-size-cover"  >
    <div class="card-body pt-9 pb-0">
      <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
        <div class="me-7 mb-4">
          <div class="position-relative">
              <img class="h-150px w-100 rounded" src="{{ Storage::url($event->image) }}" alt="image">
          </div>
        </div>
        <div class="flex-grow-1">
          <div class="d-md-flex justify-content-between align-items-start mb-2">
            <div class="d-flex flex-column">
              <div class="d-flex align-items-center mb-2">
                <span class="text-gray-900 text-hover-primary fs-1 fw-bolder me-1">{{ $event->name }}</span>
              </div>
              <div class="fs-6 mb-4 pe-2">
                <span class="fw-bold d-flex align-items-center text-gray-400 me-5 mb-2">
                  {{ $event->date }} <br> {{ $event->address }} 
                </span>
              </div>
            </div>
            <div class="d-flex my-4">
              <a href="{{ route('festival.show', $event->slug) }}" target="_blank" class="btn btn-sm btn-light me-2" id="kt_user_follow_button">
                Lihat
              </a>         
              @if (Auth::user()->role == 'superadmin')           
                <a href="{{ route('admin.festival.festival.edit', $event->id) }}" class="btn btn-sm btn-primary me-3">
                  Edit
                </a>
              @endif
            </div>
          </div>
          <div class="d-flex flex-wrap flex-stack">
            <div class="d-flex flex-column flex-grow-1 pe-8">
                <div class="d-flex flex-wrap">
                    <div class="border border-gray-300 border-dashed rounded min-w-md-100px py-3 px-4 me-6 mb-3">
                      <div class="d-flex align-items-center">
                        <div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="80" data-kt-initialized="1">{{ count($event->eventViewer) }}</div>
                      </div>  
                      <div class="fw-semibold fs-6 text-gray-500">Viewer</div>
                    </div>
                    <div class="border border-gray-300 border-dashed rounded min-w-md-100px py-3 px-4 me-6 mb-3">
                      <div class="d-flex align-items-center">
                        <div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="80" data-kt-initialized="1">{{ $event->eventVisitor->sum('visitor') }}</div>
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
            <a href="{{ route('admin.festival.festival.pengunjung', $event->id) }}" class="nav-link text-active-primary me-6 active ">Pengunjung</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.festival.festival.galeri', $event->id) }}" class="nav-link text-active-primary me-6">Galeri</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.festival.festival.atribut', $event->id) }}" class="nav-link text-active-primary me-6">Atribut</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.festival.festival.admin', $event->id) }}" class="nav-link text-active-primary me-6">Admin</a>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
      <div class="card-title">
        <h3 class="card-title align-items-start flex-column">
          <span class="card-label fw-bold fs-3 mb-1">Pengunjung</span>
        </h3>
      </div>
      <div class="card-toolbar">
        <button data-bs-toggle="modal" data-bs-target="#add" class="btn btn-primary d-flex align-items-center"><i class="ki-duotone ki-plus fs-2"></i>
          Tambah
        </button>
        <div class="modal fade" tabindex="-1" id="add">
          <div class="modal-dialog">
              <form method="POST" action="{{ route('admin.festival.festival.pengunjung.store', $event->id) }}" class="modal-content" enctype="multipart/form-data">
                @csrf
                  <div class="modal-header">
                      <h3 class="modal-title">Tambah Pengunjung</h3>
                      <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                          <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                      </div>
                  </div>
                  <div class="modal-body">
                    <div class="mb-3">
                      <label for="exampleFormControlInput1" class="required form-label">Tanggal</label>
                      <input type="date" name="date" class="form-control form-control-solid @error('date') is-invalid @enderror"  value="{{ old('date') }}" required/>
                      @error('date')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label for="exampleFormControlInput1" class="required form-label">Jumlah pengunjung</label>
                      <input type="number" name="visitor" class="form-control form-control-solid @error('visitor') is-invalid @enderror"  value="{{ old('visitor') }}" placeholder="Jumlah Pengunjung" required/>
                      @error('visitor')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label for="exampleFormControlInput1" class="required form-label">Lampiran</label>
                      <input type="file" accept=".png, .jpg, .jpeg" name="attachment" class="form-control form-control-solid @error('attachment') is-invalid @enderror"  value="{{ old('attachment') }}" required/>
                      <small class="text-muted ms-2 pt-2">File yang diizinkan: *.png, *.jpg, *.jpeg. Maksimal 2mb</small>
                      @error('attachment')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
              </form>
          </div>
        </div>
      </div>
    </div>
    <div class="card-body pt-0">
      <div class="table-responsive">
        <table class="table table-row-dashed fs-6 gy-5">
          <thead>
            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
              <th>Tanggal</th>
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
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                      <div class="menu-item px-3">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#edit{{$item->id}}" class="menu-link px-3">Edit</a>
                      </div>
                      <div class="menu-item px-3">
                        <a id="{{ route('admin.festival.festival.pengunjung.destroy', ['id' => $event->id, 'idVisitor' => $item->id]) }}" class="menu-link px-3 btn-del">Hapus</a>
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

@foreach ($visitor as $item)     
  <div class="modal fade" tabindex="-1" id="edit{{ $item->id }}">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.festival.festival.pengunjung.update', ['id' => $event->id, 'idVisitor' => $item->id]) }}" class="modal-content" enctype="multipart/form-data">
          @csrf
            <div class="modal-header">
                <h3 class="modal-title">Edit data pengunjung</h3>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="required form-label">Tanggal</label>
                <input type="date" name="date" class="form-control form-control-solid @error('date') is-invalid @enderror"  value="{{ old('date') ?? $item->date }}" required/>
                @error('date')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="required form-label">Jumlah pengunjung</label>
                <input type="number" name="visitor" class="form-control form-control-solid @error('visitor') is-invalid @enderror"  value="{{ old('visitor') ?? $item->visitor }}" placeholder="Jumlah Pengunjung" required/>
                @error('visitor')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Lampiran</label>
                <input type="file" accept=".png, .jpg, .jpeg" name="attachment" class="form-control form-control-solid @error('attachment') is-invalid @enderror"  value="{{ old('attachment') }}"/>
                <small class="text-muted ms-2 pt-2">File yang diizinkan: *.png, *.jpg, *.jpeg. Maksimal 2mb</small>
                @error('attachment')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
  </div>
@endforeach

@endsection

@section('script')
@endsection