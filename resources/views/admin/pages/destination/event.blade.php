@extends('admin.layouts.app')

@section('content')

<div class="row g-5 g-xl-8">
    <div class="card card-flush h-xl-100">
        <div class="card-header pt-5">
            <h3 class="card-title align-items-start flex-column">			
                <span class="card-label fw-bold text-gray-800">Review</span>
                
                <span class="text-gray-500 mt-1 fw-semibold fs-6">Review Saya</span>
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
                        <a href="{{ route('admin.admin-destinasi.hotel') }}" class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-80px h-85px pt-5 pb-2" >
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
                        <a href="{{ route('admin.admin-destinasi.festival') }}" class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-80px h-85px pt-5 pb-2 active" >
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
                            <th class="min-w-200px">Festival</th>
                            <th class="text-center min-w-125px">Harga</th>
                            <th class="text-center min-w-125px">Tanggal</th>
                            <th class="text-center">Viewer</th>
                            <th class="text-center">Pengunjung</th>
                            <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($event->count() == 0)
                            <tr class="max-w-10px">
                                <td colspan="6" class="text-center">
                                No data available in table
                                </td>
                            </tr>
                            @else
                            @foreach ($event as $item)     
                                <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                    <a href="#" class="symbol symbol-50px">
                                        <span class="symbol-label" style="background-image:url('{{ Storage::url($item->event->image) }}');"></span>
                                    </a>
                                    <div class="ms-5">
                                        <a href="{{ route('festival.show', $item->event->slug) }}" target="_blank" class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1">{{ $item->event->name }}</a>
                                        <div class="text-muted fs-7 fw-bold">{{ $item->event->address }}</div>                    
                                    </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                    <div class="fs-6 fw-bold">@if ($item->event->price == 0) Free @else Rp.{{ number_format($item->event->price) }} @endif</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                    <div class="fs-6 fw-bold">{{ $item->event->date }}</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                    <div class="fs-6 fw-bold">{{ count($item->event->eventViewer) }}</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                    <div class="fs-6 fw-bold">{{ $item->event->eventVisitor->sum('visitor') }}</div>
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
                                        <a href="{{ route('admin.festival.festival.pengunjung', $item->event->id) }}" class="menu-link px-3">Pengunjung</a>
                                    </div>
                                    <div class="menu-item px-3">
                                        <a href="{{ route('admin.festival.festival.galeri', $item->event->id) }}" class="menu-link px-3">Galeri</a>
                                    </div>
                                    <div class="menu-item px-3">
                                        <a href="{{ route('admin.festival.festival.atribut', $item->event->id) }}" class="menu-link px-3">Atribut</a>
                                    </div>
                                    <div class="menu-item px-3">
                                        <a href="{{ route('admin.festival.festival.admin', $item->event->id) }}" class="menu-link px-3">Admin</a>
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
