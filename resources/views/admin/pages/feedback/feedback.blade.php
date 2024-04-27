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
            <table id="kt_datatable_zero_configuration" class="table table-row-dashed fs-6 gy-5">
              <thead>
                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                  <th>Tanggal</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>No. Telp</th>
                  <th>Usia</th>
                  <th>Jawaban</th>
                  <th>Saran</th>
                  <th class="text-end">Aksi</th>
                </tr>
              </thead>
              <tbody>
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
                      <a href="#" id="{{ route('admin.kapal.destroy', $item->id) }}" class="btn btn-sm btn-light btn-active-light-primary btn-icon btn-flex btn-center" >
                        <span class="svg-icon fs-2 m-0 ">
                          <i class="ki-duotone ki-trash fs-2">
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