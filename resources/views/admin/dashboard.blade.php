@extends('admin.layouts.app')

@section('content')

<div class="row g-5 g-xl-8">
  <div class="col-xl-12 mb-8">
    <div class="card border-transparent bgi-no-repeat bgi-position-x-end bgi-size-cover " data-bs-theme="light" style="background-size: auto 100%; background-image: url({{ asset('admin-assets/media/illustrations/bg.png') }})">
      <div class="card-body d-flex ps-xl-15">          
          <div class="m-0">
              <div class="position-relative fs-2x z-index-2 fw-bold my-7">
                  <span class="me-2">
                      Halo, <br>
                      <span class="position-relative d-inline-block text-danger">
                          <span class="text-danger opacity-75-hover">{{ Auth::user()->name }}</span>    
                      </span>                     
                  </span>                                             
              </div>
          </div>
      </div>
    </div>
  </div>
</div>

@if (Auth::user()->role != 'user') 
  <div class="row g-5 g-xl-8">
    <div class="col-xl-3">
      <a href="{{ route('admin.wisata.wisata') }}" class="card bg-danger hoverable card-xl-stretch mb-xl-8">
        <div class="card-body">
          <i class="ki-duotone ki-map text-white fs-2x ms-n1">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
          </i>
          <div class="text-white fw-bold fs-2 mb-2 mt-5">{{ $tourismCount }}</div>
          <div class="fw-semibold text-white ">Wisata</div>
        </div>
      </a>
    </div>
    <div class="col-xl-3">
      <a href="{{ route('admin.hotel.hotel') }}" class="card bg-primary hoverable card-xl-stretch mb-xl-8">
        <div class="card-body">
          <i class="ki-duotone ki-bank text-white fs-2x ms-n1">
            <span class="path1"></span>
            <span class="path2"></span>
          </i>
          <div class="text-white fw-bold fs-2 mb-2 mt-5">{{ $hotelCount }}</div>
          <div class="fw-semibold text-white">Hotel</div>
        </div>
      </a>
    </div>
    <div class="col-xl-3">
      <a href="{{ route('admin.restoran.restoran') }}" class="card bg-dark hoverable card-xl-stretch mb-5 mb-xl-8">
        <div class="card-body">
          <i class="ki-duotone ki-coffee text-gray-100 fs-2x ms-n1">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
            <span class="path4"></span>
            <span class="path5"></span>
            <span class="path6"></span>
          </i>
          <div class="text-gray-100 fw-bold fs-2 mb-2 mt-5">{{ $restaurantCount }}</div>
          <div class="fw-semibold text-gray-100">Restoran</div>
        </div>
      </a>
    </div>
    <div class="col-xl-3">
      <a href="{{ route('admin.festival.festival') }}" class="card bg-success hoverable card-xl-stretch mb-5 mb-xl-8">
        <div class="card-body">
          <i class="ki-duotone ki-flag text-gray-100 fs-2x ms-n1">
            <span class="path1"></span>
            <span class="path2"></span>
          </i>
          <div class="text-gray-100 fw-bold fs-2 mb-2 mt-5">{{ $eventCount }}</div>
          <div class="fw-semibold text-gray-100">Festival</div>
        </div>
      </a>
    </div>
  </div>

  <div class="row g-5 g-xl-8">
    <div class="col-xl-12 mb-8">
      <form method="GET" class="d-md-flex flex-row-fluid justify-content-end align-items-center gap-5">
        <label class="fw-bold fs-5" for="">Filter:</label>
        <select name="tahun" class="form-control form-select  w-100 mw-250px">
          <option value="" disabled>Pilih Tahun</option>
          @foreach ($year as $item)
            <option value="{{ $item }}" @if (request('tahun') == $item) selected @endif >{{ $item }}</option>
          @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Terapkan</button>
      </form>
    </div>
  </div>


  <div class="row g-5 g-xl-8">
    <div class="col-xl-12">
      <div class="card card-xl-stretch mb-5 mb-xl-8">
        <div class="card-header border-0 pt-5">
          <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold fs-3 mb-1">Pengguna</span>
            <span class="text-muted fw-semibold fs-7">Statistik Pengguna Terdaftar</span>
          </h3>
        </div>
        <div class="card-body p-10">
          <canvas id="userChart" width="400" height="120"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="row g-5 g-xl-8">
    <div class="col-xl-12">
      <div class="card card-xl-stretch mb-5 mb-xl-8">
        <div class="card-header border-0 pt-5">
          <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold fs-3 mb-1">Wisata</span>
            <span class="text-muted fw-semibold fs-7">Statistik Pengunjung wisata</span>
          </h3>
        </div>
        <div class="card-body">
          <canvas id="tourismChart" width="400" height="120"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="row g-5 g-xl-8">
    <div class="col-xl-12">
      <div class="card card-xl-stretch mb-5 mb-xl-8">
        <div class="card-header border-0 pt-5">
          <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold fs-3 mb-1">Hotel</span>
            <span class="text-muted fw-semibold fs-7">Statistik Pengunjung Hotel</span>
          </h3>
        </div>
        <div class="card-body">
          <canvas id="hotelChart" width="400" height="120"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="row g-5 g-xl-8">
    <div class="col-xl-12">
      <div class="card card-xl-stretch mb-5 mb-xl-8">
        <div class="card-header border-0 pt-5">
          <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold fs-3 mb-1">Restoran</span>
            <span class="text-muted fw-semibold fs-7">Statistik Pengunjung Restoran</span>
          </h3>
        </div>
        <div class="card-body">
          <canvas id="restaurantChart" width="400" height="120"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="row g-5 g-xl-8">
    <div class="col-xl-12">
      <div class="card card-xl-stretch mb-5 mb-xl-8">
        <div class="card-header border-0 pt-5">
          <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold fs-3 mb-1">Festival</span>
            <span class="text-muted fw-semibold fs-7">Statistik Pengunjung Festival</span>
          </h3>
        </div>
        <div class="card-body">
          <canvas id="eventChart" width="400" height="120"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="row g-5 g-xl-8">
    <div class="col-xl-6">
      <div class="card card-xl-stretch mb-5 mb-xl-8">
        <div class="card-header border-0 pt-5">
          <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold fs-3 mb-1">Fitur</span>
            <span class="text-muted fw-semibold fs-7">Statistik Viewer Feature</span>
          </h3>
        </div>
        <div class="card-body">
          <canvas id="featureChart" width="400" height="120"></canvas>
        </div>
      </div>
    </div>
    <div class="col-xl-6">
      <div class="card card-xl-stretch mb-5 mb-xl-8">
        <div class="card-header border-0 pt-5">
          <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold fs-3 mb-1">app</span>
            <span class="text-muted fw-semibold fs-7">Statistik Viewer app</span>
          </h3>
        </div>
        <div class="card-body">
          <canvas id="websiteChart" width="400" height="120"></canvas>
        </div>
      </div>
    </div>
  </div>
@endif

@endsection

@section('script')
@if (Auth::user()->role != 'user') 
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    var ctx = document.getElementById('tourismChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar', // Mengubah tipe grafik menjadi bar
        data: {
            labels: {!! json_encode($tourismChart->pluck('name')) !!}, // Menggunakan nama tempat wisata sebagai label
            datasets: [{
                label: 'Pengunjung',
                data: {!! json_encode($tourismChart->pluck('value')) !!}, // Menggunakan jumlah pengunjung
                backgroundColor: 'rgba(235, 102, 43, 1)',
                borderColor: 'rgba(235, 102, 43, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
  </script>
  <script>
    var ctx = document.getElementById('hotelChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar', // Mengubah tipe grafik menjadi bar
        data: {
            labels: {!! json_encode($hotelChart->pluck('name')) !!}, // Menggunakan nama tempat wisata sebagai label
            datasets: [{
                label: 'Pengunjung',
                data: {!! json_encode($hotelChart->pluck('value')) !!}, // Menggunakan jumlah pengunjung
                backgroundColor: 'rgba(235, 102, 43, 1)',
                borderColor: 'rgba(235, 102, 43, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
  </script>
  <script>
    var ctx = document.getElementById('restaurantChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar', // Mengubah tipe grafik menjadi bar
        data: {
            labels: {!! json_encode($restaurantChart->pluck('name')) !!}, // Menggunakan nama tempat wisata sebagai label
            datasets: [{
                label: 'Pengunjung',
                data: {!! json_encode($restaurantChart->pluck('value')) !!}, // Menggunakan jumlah pengunjung
                backgroundColor: 'rgba(235, 102, 43, 1)',
                borderColor: 'rgba(235, 102, 43, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
  </script>
  <script>
    var ctx = document.getElementById('eventChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar', // Mengubah tipe grafik menjadi bar
        data: {
            labels: {!! json_encode($eventChart->pluck('name')) !!}, // Menggunakan nama tempat wisata sebagai label
            datasets: [{
                label: 'Pengunjung',
                data: {!! json_encode($eventChart->pluck('value')) !!}, // Menggunakan jumlah pengunjung
                backgroundColor: 'rgba(235, 102, 43, 1)',
                borderColor: 'rgba(235, 102, 43, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
  </script>
  <script>
    var featureViewer = {!! json_encode($featureChart) !!}; 
    var ctx = document.getElementById('featureChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Wisata', 'Hotel', 'Restoran', 'Festival'],
            datasets: [{
                label: 'Viewer',
                data: [featureViewer.tourismViewer, featureViewer.hotelViewer, featureViewer.restaurantViewer, featureViewer.eventViewer],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
  </script>
  <script>
    var webViewer = {!! json_encode($webChart) !!}; 
    var ctx = document.getElementById('websiteChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Tamu', 'Pengguna'],
            datasets: [{
                label: 'Viewer',
                data: [webViewer.guest, webViewer.user],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
  </script>
  <script>
    var data = {!! json_encode($userChart) !!}; 
    var ctx = document.getElementById('userChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei' , 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'], // Membuat label dari panjang data
            datasets: [{
                label: 'Pengguna Terdaftar',
                data: data, 
                backgroundColor: 'rgba(235, 102, 43, 1)',
                borderColor: 'rgba(235, 102, 43, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
  </script>
@endif
@endsection