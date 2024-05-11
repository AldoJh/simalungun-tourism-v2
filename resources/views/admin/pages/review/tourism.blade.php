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
                        <a href="{{ route('my-review.wisata') }}" class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-80px h-85px pt-5 pb-2 active" >
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
                        <a href="{{ route('my-review.hotel') }}" class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-80px h-85px pt-5 pb-2" >
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
                        <a href="{{ route('my-review.restoran') }}" class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-80px h-85px pt-5 pb-2" >
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
            </ul>             

            <div class="mt-10">
                @if ($tourism->count() > 0)
                    @foreach ($tourism as $item)
                        <div class="d-flex justify-content-between align-items-center mb-7">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-100px me-5">                                                   
                                        <img src="{{ Storage::url($item->tourism->image) }}" class="" alt="">                                                    
                                </div>
                                <div class="d-flex justify-content-start flex-column">
                                    <span class="text-gray-800 fw-bold text-hover-primary mb-1 fs-4">{{ $item->tourism->name }}</span>
                                    <span class="text-gray-500 fw-semibold d-block fs-7">{{ $item->created_at }}</span>
                                    <div class="py-2 mt-1">
                                        @for($i = 0; $i < $item->rating; $i++)
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill text-warning fs-7" viewBox="0 0 16 16">
                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                            </svg>
                                        @endfor
                                    </div>
                                    <span class="text-gray-700 fw-semibold d-block fs-6">{{ $item->comment }}</span>
                                </div>
                            </div> 
                            <div>
                                <a id="{{ route('my-review.wisata.destroy', $item->id) }}" class="btn btn-del btn-sm btn-light btn-active-light-primary btn-flex btn-center btn-icon">
                                    <span class="svg-icon fs-5 m-0 ">
                                        <i class="ki-duotone ki-trash">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                        </i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    @endforeach    
                @else
                <div class="text-center py-5">
                    <span class="mt-md-20 mb-20 text-gray-500 text-center">~ Tidak ada data ~</span>
                </div>
                @endif
            </div>   
        </div>
    </div>
</div>

@endsection
