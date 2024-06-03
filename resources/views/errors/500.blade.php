@extends('front.app')
@section('content')
@php
    $title = $title ?? '500';
@endphp
<section class="nopage mt-header">
  <div class="container">
    <div class="row y-gap-30 justify-center items-center">
      <div class="col-xl-5 col-lg-6">
        <div class="nopage__content pr-30 lg:pr-0">
          <h1>500</h1>
          <h2 class="text-30 md:text-24 fw-700">Oops! Something went wrong.</h2>
          <p>The server encountered an internal error and couldn't complete your request. Please try again later or contact the administrator if the problem persists.</p>

          <a href="{{ route('home') }}" class="button -md -dark-1 bg-accent-1 text-white mt-25 col-lg-8 col-md-6 col-10">
            Go back to homepage
            <i class="icon-arrow-top-right ml-10"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection