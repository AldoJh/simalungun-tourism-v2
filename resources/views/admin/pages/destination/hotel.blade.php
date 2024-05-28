@extends('admin.layouts.app')

@section('content')

<div class="row g-5 g-xl-8">
    <div class="card card-flush h-xl-100">
        <div class="card-header pt-5">
            <h3 class="card-title align-items-start flex-column">			
                <span class="card-label fw-bold text-gray-800">Destinasi</span>
                
                <span class="text-gray-500 mt-1 fw-semibold fs-6">Admin Destinasi</span>
            </h3>
        </div>
        <div class="card-body pt-6">
            <ul class="nav nav-pills nav-pills-custom mb-3" role="tablist">
                    <li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
                        <a href="{{ route('admin.admin-destinasi.wisata') }}" class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-80px h-85px pt-5 pb-2" >
                            <div class="nav-icon mb-3">        
                                <i class="ki-duotone ki-map fs-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </div>
                            <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">
                                Wisata                    
                            </span> 
                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                        </a>
                    </li> 
                    <li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
                        <a href="{{ route('admin.admin-destinasi.hotel') }}" class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-80px h-85px pt-5 pb-2  active" >
                            <div class="nav-icon mb-3">  
                                <i class="ki-duotone ki-bank fs-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>      
                            </div>
                            <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">
                                Hotel                      
                            </span> 
                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                        </a>
                    </li>
                    <li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
                        <a href="{{ route('admin.admin-destinasi.restoran') }}" class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-80px h-85px pt-5 pb-2" >
                            <div class="nav-icon mb-3">  
                                <i class="ki-duotone ki-coffee fs-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                </i>      
                            </div>
                            <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">
                                Restoran                    
                            </span> 
                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                        </a>
                    </li>
                    <li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
                        <a href="{{ route('admin.admin-destinasi.festival') }}" class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-80px h-85px pt-5 pb-2" >
                            <div class="nav-icon mb-3">  
                                <i class="ki-duotone ki-flag fs-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </div>
                            <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">
                                Festival                    
                            </span> 
                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                        </a>
                    </li>
            </ul>             

            <div class="mt-10">
                <div class="table-responsive">
                    <table class="table table-row-dashed fs-6 gy-5">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-200px">hotel</th>
                            <th class="min-w-150px">Kategori</th>
                            <th class="min-w-200px">Rating</th>
                            <th class="text-center">Pengunjung</th>
                            <th class="text-center">Viewer</th>
                            <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($hotel->count() == 0)
                            <tr class="max-w-10px">
                                <td colspan="6" class="text-center">
                                No data available in table
                                </td>
                            </tr>
                            @else
                            @foreach ($hotel as $item)     
                                <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                    <a href="#" class="symbol symbol-50px">
                                        <span class="symbol-label" style="background-image:url('{{ Storage::url($item->hotel->image) }}');"></span>
                                    </a>
                                    <div class="ms-5">
                                        <a href="{{ route('hotel.show', $item->hotel->slug) }}" target="_blank" class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1">
                                        {{ $item->hotel->name }}
                                        @if ($item->hotel->is_verified) <span class="badge text-white bg-success">Terverifikasi</span>  @endif 
                                        </a>
                                        <div class="text-muted fs-7 fw-bold">{{ $item->hotel->address }}</div>                    
                                    </div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                    <div class="fs-6 fw-bold">{{ $item->hotel->hotelCategory->name }}</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                    <div class="fs-6 fw-bold d-flex align-items-center">
                                        @if (count($item->hotel->hotelReview) > 0)
                                        @for($i = 0; $i < round($item->hotel->hotelReview->average('rating'), 0); $i++)
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill text-warning" viewBox="0 0 16 16">
                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                            </svg>
                                        @endfor
                                        <span class="ms-2">{{ round($item->hotel->hotelReview->average('rating'), 1) }} ({{ count($item->hotel->hotelReview) }})</span>
                                        @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star text-warning" viewBox="0 0 16 16">
                                            <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                                        </svg>
                                        <span class="ms-2">Tidak ada rating</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                    <div class="fs-6 fw-bold">{{ $item->hotel->hotelVisitor->sum('visitor') }}</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                    <div class="fs-6 fw-bold">{{ count($item->hotel->hotelViewer) }}</div>
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
                                            <a href="{{ route('admin.hotel.hotel.pengunjung', $item->hotel->id) }}" class="menu-link px-3">Pengunjung</a>
                                          </div>
                                          <div class="menu-item px-3">
                                            <a href="{{ route('admin.hotel.hotel.review', $item->hotel->id) }}" class="menu-link px-3">Review</a>
                                          </div>
                                          <div class="menu-item px-3">
                                            <a href="{{ route('admin.hotel.hotel.galeri', $item->hotel->id) }}" class="menu-link px-3">Galeri</a>
                                          </div>
                                          <div class="menu-item px-3">
                                            <a href="{{ route('admin.hotel.hotel.admin', $item->hotel->id) }}" class="menu-link px-3">Admin</a>
                                          </div>
                                    </div>
                                </td>
                                </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>   
        </div>
    </div>
</div>

@endsection
