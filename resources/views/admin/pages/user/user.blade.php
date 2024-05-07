@extends('admin.layouts.app')

@section('content')

  <div class="row g-5 g-xl-8">
    <div class="col-xl-12 mb-8">
      <div class="card card-flush">
        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
          <div class="card-title">
            <h3 class="card-title align-items-start flex-column">
              <span class="card-label fw-bold fs-3 mb-1">Pengguna</span>
              <span class="text-muted fw-semibold fs-7">Data Pengguna</span>
            </h3>
          </div>
          <div class="card-toolbar">
            <button data-bs-toggle="modal" data-bs-target="#add" class="btn btn-primary d-flex align-items-center"><i class="ki-duotone ki-plus fs-2"></i>
              Tambah
            </button>
            <div class="modal fade" tabindex="-1" id="add">
              <div class="modal-dialog">
                  <form method="POST" action="{{ route('admin.pengguna.store') }}" class="modal-content">
                    @csrf
                      <div class="modal-header">
                          <h3 class="modal-title">Tambah Pengguna</h3>
                          <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                              <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                          </div>
                      </div>
                      <div class="modal-body">
                        <div class="mb-3">
                          <label for="exampleFormControlInput1" class="required form-label">Nama</label>
                          <input type="text" name="name" class="form-control form-control-solid @error('name') is-invalid @enderror"  value="{{ old('name') }}" placeholder="Nama" required/>
                          @error('name')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                        <div class="mb-3">
                          <label for="exampleFormControlInput1" class="required form-label">No. Telp</label>
                          <input type="text" name="phone" class="form-control form-control-solid @error('phone') is-invalid @enderror"  value="{{ old('phone') }}" placeholder="No. Telp" required/>
                          @error('phone')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                        <div class="mb-3">
                          <label for="exampleFormControlInput1" class="required form-label">Role</label>
                          <select class="form-select form-select-solid  @error('role') is-invalid @enderror" name="role" aria-label="Select example">
                              <option value="">Pilih Role</option>
                              <option value="superadmin" @if (old('role') == 'superadmin') selected @endif>Super Admin</option>
                              <option value="admin" @if (old('role') == 'admin') selected @endif>admin</option>
                          </select>
                          @error('role')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                        <hr class="py-3">
                        <div class="mb-3">
                          <label for="exampleFormControlInput1" class="required form-label">Email</label>
                          <input type="email" name="email" class="form-control form-control-solid @error('email') is-invalid @enderror"  value="{{ old('email') }}" placeholder="Email" required/>
                          @error('email')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                        <div class="mb-3">
                          <label for="exampleFormControlInput1" class="required form-label">Password</label>
                          <input type="password" name="password" class="form-control form-control-solid"  value="{{ old('password') }}" placeholder="********" required/>
                          @error('password')
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
            <table  class="table table-row-dashed fs-6 gy-5">
              <thead>
                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                  <th>Pengguna</th>
                  <th>No. Telp</th>
                  <th>Role</th>
                  <th>Akses</th>
                  <th class="text-end">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @if ($user->total() == 0)
                  <tr class="max-w-10px">
                    <td colspan="6" class="text-center">
                      No data available in table
                    </td>
                  </tr>
                @else
                  @foreach ($user as $item)     
                    <tr>
                      <td class="d-flex align-items-center">
                        <div class="symbol-group symbol-hover me-3">
                          <div class="symbol symbol-45px symbol-circle" data-bs-toggle="tooltip" title="{{ $item->name }}">
                            <img src="@if($item->photo) {{  Storage::url(Auth::user()->photo) }} @else https://ui-avatars.com/api/?background=000C32&color=fff&name={{ $item->name }} @endif" alt="">
                          </div>
                        </div>
                        <div class="d-flex flex-column">
                          <span class="text-gray-800 fw-bold mb-1">{{ $item->name }}</span>
                          <span class="text-muted fs-7">{{ $item->email }}</span>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex">
                          <div class="fs-6 fw-bold">{{ $item->phone }}</div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex">
                          <div class="fs-6 fw-bold">{{ $item->role }}</div>
                        </div>
                      </td>
                      @if ($item->role == 'superadmin')
                        <td>
                          <div class="d-flex">
                            <div class="fs-6 fw-bold">-</div>
                          </div>
                        </td>
                      @else
                      <td>
                        <div class="d-flex">
                          <div class="fs-7">
                            <ul>
                              <li>Wisata: 0</li>
                              <li>Hotel: 1</li>  
                              <li>Resto: 0</li>
                              <li>festival: 2</li>
                            </ul>  
                          </div>
                        </div>
                      </td>
                      @endif
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
                          @if ($item->role == "admin")
                            <div class="menu-item px-3">
                              <a href="#" data-bs-toggle="modal" data-bs-target="#edit{{$item->id}}" class="menu-link px-3">Akses</a>
                            </div>
                          @endif
                          <div class="menu-item px-3">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#edit{{$item->id}}" class="menu-link px-3">Edit</a>
                          </div>
                          <div class="menu-item px-3">
                            <a id="{{ route('admin.pengguna.destroy', $item->id) }}" class="menu-link px-3 btn-del">Hapus</a>
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
                Showing {{ $user->firstItem() }} to {{ $user->lastItem() }} of {{ $user->total() }}  records
            </div>
            <ul class="pagination">
                @if ($user->onFirstPage())
                    <li class="page-item previous">
                        <a href="#" class="page-link"><i class="previous"></i></a>
                    </li>
                @else
                    <li class="page-item previous">
                        <a href="{{ $user->previousPageUrl() }}" class="page-link bg-light"><i class="previous"></i></a>
                    </li>
                @endif
        
                @php
                    // Menghitung halaman pertama dan terakhir yang akan ditampilkan
                    $start = max($user->currentPage() - 2, 1);
                    $end = min($start + 4, $user->lastPage());
                @endphp
        
                @if ($start > 1)
                    <!-- Menampilkan tanda elipsis jika halaman pertama tidak termasuk dalam tampilan -->
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                @endif
        
                @foreach ($user->getUrlRange($start, $end) as $page => $url)
                    <li class="page-item{{ ($page == $user->currentPage()) ? ' active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
        
                @if ($end < $user->lastPage())
                    <!-- Menampilkan tanda elipsis jika halaman terakhir tidak termasuk dalam tampilan -->
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                @endif
        
                @if ($user->hasMorePages())
                    <li class="page-item next">
                        <a href="{{ $user->nextPageUrl() }}" class="page-link bg-light"><i class="next"></i></a>
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

  @foreach ($user as $item)     
  <div class="modal fade" tabindex="-1" id="edit{{$item->id}}">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.pengguna.update', $item->id) }}" class="modal-content">
          @csrf
            <div class="modal-header">
                <h3 class="modal-title">Edit Pengguna</h3>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>
            <div class="modal-body">
                        <div class="mb-3">
                          <label for="exampleFormControlInput1" class="required form-label">Nama</label>
                          <input type="text" name="name" class="form-control form-control-solid @error('name') is-invalid @enderror"  value="{{ $item->name }}" placeholder="Nama" required/>
                          @error('name')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                        <div class="mb-3">
                          <label for="exampleFormControlInput1" class="required form-label">No. Telp</label>
                          <input type="text" name="phone" class="form-control form-control-solid @error('phone') is-invalid @enderror"  value="{{ $item->phone }}" placeholder="No. Telp" required/>
                          @error('phone')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                        <div class="mb-3">
                          <label for="exampleFormControlInput1" class="required form-label">Role</label>
                          <select class="form-select form-select-solid  @error('role') is-invalid @enderror" name="role" aria-label="Select example">
                              <option value="">Pilih Role</option>
                              <option value="superadmin" @if ($item->role == 'superadmin') selected @endif>Super Admin</option>
                              <option value="admin" @if ($item->role == 'admin') selected @endif>admin</option>
                          </select>
                          @error('role')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                        <hr class="py-3">
                        <div class="mb-3">
                          <label for="exampleFormControlInput1" class="required form-label">Email</label>
                          <input type="email" name="email" class="form-control form-control-solid @error('email') is-invalid @enderror"  value="{{ $item->email }}" placeholder="Email" required/>
                          @error('email')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                        <div class="mb-3">
                          <label for="exampleFormControlInput1" class="form-label">Password</label>
                          <input type="password" name="password" class="form-control form-control-solid"  value="{{ old('password') }}" placeholder="********" />
                          @error('password')
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