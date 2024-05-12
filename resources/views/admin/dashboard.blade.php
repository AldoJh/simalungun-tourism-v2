@extends('admin.layouts.app')

@section('content')
{{-- 
  <div class="row g-5 g-xl-8">
    <div class="col-xl-12 mb-8">
      <div class="d-md-flex flex-row-fluid justify-content-end gap-5">
        <input type="month" class="form-control shadow border-0 w-100 mw-250px" value="{{ now()->format('Y-m') }}" />
      </div>
    </div>
  </div>

  <div class="row g-5 g-xl-8">
    <div class="col-xl-3">
      <a href="#" class="card bg-body-white hoverable card-xl-stretch mb-xl-8">
        <div class="card-body">
          <i class="ki-duotone ki-basket text-primary fs-2x ms-n1">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
            <span class="path4"></span>
            </i>
          <div class="text-gray-900 fw-bold fs-2 mb-2 mt-5">56</div>
          <div class="fw-semibold text-gray-400">Item terjual</div>
        </div>
      </a>
    </div>
    <div class="col-xl-3">
      <a href="#" class="card bg-primary hoverable card-xl-stretch mb-xl-8">
        <div class="card-body">
          <i class="ki-duotone ki-element-11 text-white fs-2x ms-n1">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
            <span class="path4"></span>
          </i>
          <div class="text-white fw-bold fs-2 mb-2 mt-5">23</div>
          <div class="fw-semibold text-white">Tansaksi</div>
        </div>
      </a>
    </div>
    <div class="col-xl-3">
      <a href="#" class="card bg-dark hoverable card-xl-stretch mb-5 mb-xl-8">
        <div class="card-body">
          <i class="ki-duotone ki-chart-simple text-gray-100 fs-2x ms-n1">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
            <span class="path4"></span>
          </i>
          <div class="text-gray-100 fw-bold fs-2 mb-2 mt-5">Rp. 2.340.000</div>
          <div class="fw-semibold text-gray-100">Pendapatan	</div>
        </div>
      </a>
    </div>
    <div class="col-xl-3">
      <a href="#" class="card bg-success hoverable card-xl-stretch mb-5 mb-xl-8">
        <div class="card-body">
          <i class="ki-duotone ki-chart-simple text-gray-100 fs-2x ms-n1">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
            <span class="path4"></span>
          </i>
          <div class="text-gray-100 fw-bold fs-2 mb-2 mt-5">Rp. 2.340.000</div>
          <div class="fw-semibold text-gray-100">Pendapatan	</div>
        </div>
      </a>
    </div>
  </div>

  <div class="row g-5 g-xl-8">
    <div class="col-xl-4">
      <div class="card card-xl-stretch mb-xl-8">
        <div class="card-header border-0 pt-5">
          <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold text-dark">Kategori Terlaris</span>
            <span class="text-muted fw-semibold fs-7">Maret 2023</span>
          </h3>
        </div>
        <div class="card-body pt-5">
          <div class="d-flex align-items-center bg-light-warning rounded p-5 mb-7">
            <i class="ki-duotone ki-abstract-26 text-warning fs-1 me-5">
              <span class="path1"></span>
              <span class="path2"></span>
            </i>
            <div class="flex-grow-1 me-2">
              <a href="#" class="fw-bold text-gray-800 text-hover-primary fs-6">Coffee & Drink</a>
              <span class="text-muted fw-semibold d-block">10 Transaksi</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4">
      <div class="card card-xl-stretch mb-xl-8">
        <div class="card-header border-0 pt-5">
          <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold text-dark">Produk Terlaris</span>
            <span class="text-muted fw-semibold fs-7">Maret 2023</span>
          </h3>
        </div>
        <div class="card-body pt-5">
          <div class="d-flex align-items-sm-center mb-7">
            <div class="symbol symbol-60px symbol-2by3 me-4">
              <div class="symbol-label" style="background-image: url('assets/media/stock/600x400/img-20.jpg')"></div>
            </div>
            <div class="d-flex flex-row-fluid flex-wrap align-items-center">
              <div class="flex-grow-1 me-2">
                <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">Teh Hijau</a>
                <span class="text-muted fw-semibold d-block pt-1">14 Item</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4">
      <div class="card card-xl-stretch mb-xl-8">
        <div class="card-header border-0 pt-5">
          <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold text-dark">Jenis Transaksi</span>
            <span class="text-muted fw-semibold fs-7">Maret 2023</span>
          </h3>
        </div>
        <div class="card-body pt-5">
          <canvas id="kt_chartjs_3" class="mh-400px"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="row g-5 g-xl-8">
    <div class="col-xl-12">
      <div class="card card-xl-stretch mb-5 mb-xl-8">
        <div class="card-header border-0 pt-5">
          <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold fs-3 mb-1">Statistik Transaksi</span>
            <span class="text-muted fw-semibold fs-7">Transaksi bulan ini</span>
          </h3>
        </div>
        <div class="card-body">
          <div id="kt_charts_widget_1_chart" style="height: 350px"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="row g-5 g-xl-8">
    <div class="col-xl-12">
      <div class="card card-xl-stretch mb-5 mb-xl-8">
        <div class="card-header border-0 pt-5">
          <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold fs-3 mb-1">Statistik Pendapatan</span>
            <span class="text-muted fw-semibold fs-7">Pendapatan bulan ini</span>
          </h3>
        </div>
        <div class="card-body">
          <div id="kt_charts_widget_1_chart" style="height: 350px"></div>
        </div>
      </div>
    </div>
  </div> --}}

@endsection

@section('script')

  <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
  <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
  <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
  <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
  <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
  <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
  <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
  <script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
  <script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
  <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
  <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>

@endsection