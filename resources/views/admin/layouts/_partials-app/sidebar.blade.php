<div id="kt_aside" class="aside" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
  <div class="aside-toolbar flex-column-auto" id="kt_aside_toolbar">
    <div class="aside-user d-flex align-items-sm-center justify-content-center py-5">
      <div class="symbol symbol-50px">
        <img src="@if(Auth::user()->photo) {{ Storage::url(Auth::user()->photo) }} @else https://ui-avatars.com/api/?background=E79024&color=fff&name={{ Auth::user()->name }} @endif" alt="" />
      </div>
      <div class="aside-user-info flex-row-fluid flex-wrap ms-5">
        <div class="d-flex align-items-center">
          <div class="flex-grow-1 me-2">
            <a href="#" class="text-white text-hover-primary fs-6 fw-bold">{{ Auth::user()->name }}</a>
            <span class="text-gray-600 fw-semibold d-block fs-8 mb-1">{{ Auth::user()->email }}</span>
            <div class="d-flex align-items-center text-success fs-9">
              {{ Auth::user()->role }}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="aside-search"> </div>
  </div>

  <div class="aside-menu flex-column-fluid">
    <div class="hover-scroll-overlay-y px-2 my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="{default: '#kt_aside_toolbar, #kt_aside_footer', lg: '#kt_header, #kt_aside_toolbar, #kt_aside_footer'}" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="5px">
      <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
        
        <div class="menu-item @if ($title == 'Dashboard') here @endif">
          <a class="menu-link" href="{{ route('dashboard') }}">
            <span class="menu-icon">
              <i class="ki-duotone ki-element-11 fs-2">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
                <span class="path4"></span>
              </i>
            </span>
            <span class="menu-title">Dashboard</span>
          </a>
        </div>

        <div class="menu-item @if ($title == 'Dashboard') here @endif">
          <a class="menu-link" href="{{ route('dashboard') }}">
            <span class="menu-icon">
              <i class="ki-duotone ki-star fs-2"></i>
            </span>
            <span class="menu-title">Review Saya</span>
          </a>
        </div>

        @if (Auth::user()->role == 'admin')
          <div class="menu-item @if ($title == 'Dashboard') here @endif">
            <a class="menu-link" href="{{ route('dashboard') }}">
              <span class="menu-icon">
                <i class="ki-duotone ki-geolocation fs-2">
                  <span class="path1"></span>
                  <span class="path2"></span>
                </i>
              </span>
              <span class="menu-title">Admin Destinasi</span>
            </a>
          </div>
        @endif

        @if (Auth::user()->role == 'superadmin')
          <div class="menu-item pt-5">
            <div class="menu-content">
              <span class="menu-heading fw-bold text-uppercase fs-7">Menu </span>
            </div>
          </div>
          
          <div data-kt-menu-trigger="click" class="menu-item menu-accordion  @if ($title == 'Data Master') here show @endif">
            <span class="menu-link">
              <span class="menu-icon">
                <i class="ki-duotone ki-external-drive fs-2">
                  <span class="path1"></span>
                  <span class="path2"></span>
                  <span class="path3"></span>
                  <span class="path4"></span>
                  <span class="path5"></span>
                </i>
              </span>
              <span class="menu-title">Data Master</span>
              <span class="menu-arrow"></span>
            </span>
            <div class="menu-sub menu-sub-accordion">
              <div class="menu-item @if ($subTitle == 'Fasilitas') here @endif">
                <a class="menu-link" href="{{ route('admin.data-master.fasilitas') }}">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Fasilitas</span>
                </a>
              </div>
              <div class="menu-item  @if ($subTitle == 'Kategori Wisata') here @endif">
                <a class="menu-link" href="{{ route('admin.data-master.kategori-wisata') }}">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Kategori Wisata</span>
                </a>
              </div>
              <div class="menu-item @if ($subTitle == 'Kategori Hotel') here @endif">
                <a class="menu-link" href="{{ route('admin.data-master.kategori-hotel') }}">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Kategori Hotel</span>
                </a>
              </div>
            </div>
          </div>

          <div data-kt-menu-trigger="click" class="menu-item menu-accordion @if ($title == 'Wisata') here show @endif">
            <span class="menu-link">
              <span class="menu-icon">
                <i class="ki-duotone ki-map fs-2">
                  <span class="path1"></span>
                  <span class="path2"></span>
                  <span class="path3"></span>
                </i>
              </span>
              <span class="menu-title">Wisata</span>
              <span class="menu-arrow"></span>
            </span>
            <div class="menu-sub menu-sub-accordion">
              <div class="menu-item @if ($subTitle == 'Data Wisata') here @endif">
                <a class="menu-link" href="{{ route('admin.wisata.wisata') }}">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Data Wisata</span>
                </a>
              </div>
              <div class="menu-item @if ( ($title == 'Wisata') AND ($subTitle == 'Review')) here @endif">
                <a class="menu-link" href="{{ route('admin.wisata.review') }}">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Review</span>
                </a>
              </div>
              <div class="menu-item @if (($title == 'Wisata') AND ($subTitle == 'Pengunjung')) here @endif">
                <a class="menu-link" href="{{ route('admin.wisata.pengunjung') }}">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Pengunjung</span>
                </a>
              </div>
            </div>
          </div>

          <div data-kt-menu-trigger="click" class="menu-item menu-accordion @if ($title == 'Hotel') here show @endif">
            <span class="menu-link">
              <span class="menu-icon">
                <i class="ki-duotone ki-bank fs-2">
                  <span class="path1"></span>
                  <span class="path2"></span>
                </i>
              </span>
              <span class="menu-title">Hotel</span>
              <span class="menu-arrow"></span>
            </span>
            <div class="menu-sub menu-sub-accordion">
              <div class="menu-item @if ($subTitle == 'Data Hotel') here @endif">
                <a class="menu-link" href="{{ route('admin.hotel.hotel') }}">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Data Hotel</span>
                </a>
              </div>
              <div class="menu-item @if (($title == 'Hotel') AND ($subTitle == 'Review')) here @endif">
                <a class="menu-link" href="{{ route('admin.hotel.review') }}">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Review</span>
                </a>
              </div>
              <div class="menu-item @if (($title == 'Hotel') AND ($subTitle == 'Pengunjung')) here @endif">
                <a class="menu-link" href="{{ route('admin.hotel.pengunjung') }}">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Pengunjung</span>
                </a>
              </div>
            </div>
          </div>

          <div data-kt-menu-trigger="click" class="menu-item menu-accordion @if ($title == 'Restoran') here show @endif">
            <span class="menu-link">
              <span class="menu-icon">
                <i class="ki-duotone ki-coffee fs-2">
                  <span class="path1"></span>
                  <span class="path2"></span>
                  <span class="path3"></span>
                  <span class="path4"></span>
                  <span class="path5"></span>
                  <span class="path6"></span>
                </i>
              </span>
              <span class="menu-title">Restoran</span>
              <span class="menu-arrow"></span>
            </span>
            <div class="menu-sub menu-sub-accordion menu-active-bg">
              <div class="menu-item @if ($subTitle == 'Data Restoran') here @endif">
                <a class="menu-link" href="{{ route('admin.restoran.restoran') }}">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Data Restoran</span>
                </a>
              </div>
              <div class="menu-item @if (($title == 'Restoran') AND ($subTitle == 'Review')) here @endif">
                <a class="menu-link" href="{{ route('admin.restoran.review') }}">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Review</span>
                </a>
              </div>
              <div class="menu-item @if (($title == 'Restoran') AND ($subTitle == 'Pengunjung')) here @endif">
                <a class="menu-link" href="{{ route('admin.restoran.pengunjung') }}">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Pengunjung</span>
                </a>
              </div>
            </div>
          </div>

          <div data-kt-menu-trigger="click" class="menu-item menu-accordion @if ($title == 'Festival') here show @endif">
            <span class="menu-link">
              <span class="menu-icon">
                <i class="ki-duotone ki-flag fs-2">
                  <span class="path1"></span>
                  <span class="path2"></span>
                </i>
              </span>
              <span class="menu-title">Festival</span>
              <span class="menu-arrow"></span>
            </span>
            <div class="menu-sub menu-sub-accordion menu-active-bg">
              <div class="menu-item @if ($subTitle == 'Data Festival') here @endif">
                <a class="menu-link" href="{{ route('admin.festival.festival') }}">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Data Festival</span>
                </a>
              </div>
              <div class="menu-item @if (($title == 'Festival') AND ($subTitle == 'Pengunjung')) here @endif">
                <a class="menu-link" href="{{ route('admin.festival.pengunjung') }}">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Pengunjung</span>
                </a>
              </div>
            </div>
          </div>

          <div data-kt-menu-trigger="click" class="menu-item menu-accordion @if ($title == 'Berita') here show @endif">
            <span class="menu-link">
              <span class="menu-icon">
                <i class="ki-duotone ki-note-2 fs-2">
                  <span class="path1"></span>
                  <span class="path2"></span>
                  <span class="path3"></span>
                  <span class="path4"></span>
                </i>
              </span>
              <span class="menu-title">Berita</span>
              <span class="menu-arrow"></span>
            </span>
            <div class="menu-sub menu-sub-accordion menu-active-bg">
              <div class="menu-item @if ($subTitle == 'Data Berita') here @endif">
                <a class="menu-link" href="{{ route('admin.berita.berita') }}">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Data Berita</span>
                </a>
              </div>
              <div class="menu-item @if ($subTitle == 'Komentar') here @endif">
                <a class="menu-link" href="{{ route('admin.berita.komentar') }}">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Komentar</span>
                </a>
              </div>
            </div>
          </div>

          <div class="menu-item @if ($title == 'Kapal') here @endif">
            <a class="menu-link" href="{{ route('admin.kapal') }}">
              <span class="menu-icon">
                <i class="ki-duotone ki-ship fs-2">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
              </i>
              </span>
              <span class="menu-title">Kapal</span>
            </a>
          </div>

          <div class="menu-item @if ($title == 'Kuisioner') here @endif">
            <a class="menu-link" href="{{ route('admin.kuisioner') }}">
              <span class="menu-icon">
                <i class="ki-duotone ki-message-text fs-2">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
              </i>
              </span>
              <span class="menu-title">Kuisioner</span>
            </a>
          </div>

          <div class="menu-item @if ($title == 'Pengguna') here @endif">
            <a class="menu-link" href="{{ route('admin.pengguna') }}">
              <span class="menu-icon">
                <i class="ki-duotone ki-address-book fs-2">
                  <span class="path1"></span>
                  <span class="path2"></span>
                  <span class="path3"></span>
                </i>
              </span>
              <span class="menu-title">Pengguna</span>
            </a>
          </div>

          <div class="menu-item @if ($title == 'Pengaturan') here @endif">
            <a class="menu-link" href="{{ route('admin.pengaturan') }}">
              <span class="menu-icon">
                <i class="ki-duotone ki-setting-2 text-muted fs-1">
                  <span class="path1"></span>
                  <span class="path2"></span>
                </i>
              </span>
              <span class="menu-title">Pengaturan</span>
            </a>
          </div>
        @endif

          <div class="menu-item pt-5">
            <div class="menu-content">
              <span class="menu-heading fw-bold text-uppercase fs-7">Account</span>
            </div>
          </div>

          <div class="menu-item @if ($title == 'Profil') here @endif">
            <a class="menu-link" href="{{ route('admin.profil') }}">
              <span class="menu-icon">
                <i class="ki-duotone ki-profile-circle fs-2">
                  <span class="path1"></span>
                  <span class="path2"></span>
                  <span class="path3"></span>
                </i>
              </span>
              <span class="menu-title">Profil</span>
            </a>
          </div>
          
          <div class="menu-item">
            <a class="menu-link" href="{{ route('logout') }}">
              <span class="menu-icon">
                <i class="ki-duotone ki-entrance-right fs-2">
                  <span class="path1"></span>
                  <span class="path2"></span>
                </i>
              </span>
              <span class="menu-title">Logout</span>
            </a>
          </div>
      </div>
    </div>
  </div>

  <div class="aside-footer flex-column-auto py-5" id="kt_aside_footer">
    <a href="{{ route('home') }}" class="btn btn-flex btn-custom btn-primary w-100 d-flex align-items-center">
      <i class="ki-duotone ki-black-left"></i>
      <span class="btn-label">Halaman Utama</span>
    </a>
  </div>
</div>