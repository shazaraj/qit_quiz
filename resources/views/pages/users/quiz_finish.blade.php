@extends('layouts.app')

@push('plugin-styles')
  <!-- Plugin css import here -->
@endpush

<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <div class="sidebar-header">
                <a href="#" class="sidebar-brand">
                  QIT-<span>QUIZ</span>
                </a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                <ul>
                    <a id="navbarDropdown" class="nav-link" href="#" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                </ul>
                <ul>
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form></ul>
            </div>
        </div>
    </nav>
</div>
@section('content')

<div class="page-content d-flex align-items-center justify-content-center" style="margin-top:25px; ">

    <div class="row w-100 mx-0 auth-page">
      <div class="col-md-8 col-xl-6 mx-auto">
        <div class="card">
          <div class="row">
            <div class="col-md-4 pe-md-0">
              <div class="auth-side-wrapper" style="background-image: {{ asset('/login.png') }})">

              </div>
            </div>
            <div class="col-md-8 ps-md-0">
              <div class="auth-form-wrapper px-4 py-5">
                <a href="#" class="noble-ui-logo d-block mb-2">Welcome<span> Here</span></a>

                {{-- <form method="" action="#"> --}}
                  @csrf

                  <div class="table-wrapper" style="width: 50%; hight: 50% ;background:url(assets('assets/images/log.png'))">

                    <div class="row">
                        <label>Correct Answer :<small> {{ $quiz->correct_ans }}</small></label>
                        <label>Wrong Answer :<small>{{ $quiz->wrong_ans }}</small></label>
                        <label>Result :<small> {{ $quiz->correct_ans }}/ {{ $ques }} --<span>  {{ $quiz->result }}</span></small></label>
                    </div>

                </div>
                <div class="auth-form-wrapper px-4 py-5">
                          <button type="" class="btn btn-primary me-2 mb-2 mb-md-0">
                            Ok
                          </button>
                      </div>
                {{-- </form> --}}
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

@push('plugin-scripts')
  <!-- Plugin js import here -->
@endpush

@push('custom-scripts')
  <!-- Custom js here -->
@endpush
