@extends('admin.layouts.app')

@section('content')

  <div class="row g-5 g-xl-8">
    <div class="col-xl-4 mb-8">
      <div class="card card-flush">
        <div class="card-body pt-15">
          <div class="d-flex flex-center flex-column mb-5">
              <div class="symbol symbol-150px symbol-circle mb-7">
                  <img src="@if($user->photo) {{  Storage::url(Auth::user()->photo) }} @else https://ui-avatars.com/api/?background=E79024&color=fff&name={{ $user->name }} @endif" alt="image">
              </div>
              <span class="fs-3 text-gray-800 text-hover-primary fw-bold mb-1">
                  {{ $user->name }}            
              </span>
          </div>
          <div class="separator separator-dashed my-3"></div>  
            <div class="pb-5 fs-6">
                  <div class="fw-bold mt-5">Email</div>
                  <div class="text-gray-600">{{ $user->email }}</div>
                  <div class="fw-bold mt-5">No. Telepon</div>
                  <div class="text-gray-600">{{ $user->phone }}</div>
            </div>
        </div>
      </div>
    </div>
    <div class="col-xl-8 mb-8">
      <div class="card card-flush">
        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
          <div class="card-title">
            <h3 class="card-title align-items-start flex-column">
              <span class="card-label fw-bold fs-3 mb-1">Hak Akses</span>
              <span class="text-muted fw-semibold fs-7">Hak Akses Pengguna</span>
            </h3>
          </div>
        </div>
        <div class="card-body pt-0">
          <form action="{{ route('admin.pengguna.akses.update', $user->id)}}" method="POST">
            @csrf
            <div class="mb-5">
              <label for="exampleFormControlInput1" class="required col-form-label fw-bold fs-6">Wisata</label>
              <select class="form-select form-select-solid" data-control="select2" data-close-on-select="false" data-placeholder="Select an option" data-allow-clear="true" multiple="multiple" name="tourism[]">
                  @foreach ($tourism as $item)
                      <option value="{{ $item->id }}" @if(in_array($item->id, $user->tourism->pluck('tourism_id')->toArray())) selected @endif>{{ $item->name }}</option>
                  @endforeach
              </select>
              @error('tourism')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
            </div>
  
            <div class="mb-5">
              <label for="exampleFormControlInput1" class="required col-form-label fw-bold fs-6">Hotel</label>
              <select class="form-select form-select-solid" data-control="select2" data-close-on-select="false" data-placeholder="Select an option" data-allow-clear="true" multiple="multiple" name="hotel[]">
                  @foreach ($hotel as $item)
                      <option value="{{ $item->id }}" @if(in_array($item->id, $user->hotel->pluck('hotel_id')->toArray())) selected @endif>{{ $item->name }}</option>
                  @endforeach
              </select>
              @error('hotel')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
            </div>
  
            <div class="mb-5">
              <label for="exampleFormControlInput1" class="required col-form-label fw-bold fs-6">Restaurant</label>
              <select class="form-select form-select-solid" data-control="select2" data-close-on-select="false" data-placeholder="Select an option" data-allow-clear="true" multiple="multiple" name="restaurant[]">
                  @foreach ($restaurant as $item)
                      <option value="{{ $item->id }}" @if(in_array($item->id, $user->restaurant->pluck('restaurant_id')->toArray())) selected @endif>{{ $item->name }}</option>
                  @endforeach
              </select>
              @error('restaurant')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
            </div>
  
            <div class="mb-5">
              <label for="exampleFormControlInput1" class="required col-form-label fw-bold fs-6">Festival</label>
              <select class="form-select form-select-solid" data-control="select2" data-close-on-select="false" data-placeholder="Select an option" data-allow-clear="true" multiple="multiple" name="event[]">
                  @foreach ($event as $item)
                      <option value="{{ $item->id }}" @if(in_array($item->id, $user->event->pluck('event_id')->toArray())) selected @endif>{{ $item->name }}</option>
                  @endforeach
              </select>
              @error('event')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="text-end">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('script')
@endsection