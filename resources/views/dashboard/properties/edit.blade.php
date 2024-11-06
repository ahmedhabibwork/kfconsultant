@extends('layouts.dashboard.app')
<!-- BEGIN: Page Main-->
@section('content')
    <!-- BEGIN: Page Main-->
    <div id="main">
        <div class="row">
            <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
            <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
                <!-- Search for small screen-->
                <div class="container">
                    <div class="row">
                        <div class="col s10 m6 l6">
                            <h5 class="breadcrumbs-title mt-0 mb-0"><span>@isset($title) {{ $title }} @endisset</span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Edit @isset($title) {{ $title }} @endisset
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12">
                <div class="container">
                    <!-- Input Fields -->
                    <div class="row">
                        <div class="col s12">
                            <div id="input-fields" class="card card-tabs">
                                <div class="card-content">

                                    <div id="view-input-fields">
                                        <div class="row">

                                            <div class="col s12">
                                                @if (session()->has('message'))
                                                    <div class="card-alert card green">
                                                        <div class="card-content white-text">
                                                            <p> {{ session('message') }}</p>
                                                        </div>
                                                        <button type="button" class="close white-text" data-dismiss="alert"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                @endif
                                                <br>
                                                <form class="login-row" method="post" enctype="multipart/form-data"
                                                    action="{{ route('dashboard.'.$routeName.'.update', $edit->id) }}">
                                                    @csrf

                                                    @method('PUT')


                                                    <div class="col s12">
                                                        <div class="row">
                                                        <div class="input-field col s6">

                                                            <input id="name"
                                                                type="text" @error('name') is-invalid @enderror
                                                                name="name"  value="{{ $edit->name }}">
                                                            <label for="name"> Name <span
                                                                    style="color:red">*</span></label>
                                                            @error('name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong style="color: #ff4081">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="input-field col s6">

                                                            <input id="sort_order"
                                                                type="text"
                                                                name="sort_order" value="{{$edit->sort_order }}">
                                                            <label for="sort_order"> Sort Order </label>
                                                     
                                                        </div>
                                          
                                                        </div>
                              
                                                    </div>
                                                        <div class="col s6">
                                                            <p>
                                                                <label>
                                                                    <input class="with-gap" name="is_active"
                                                                        type="checkbox" value="1"
                                                                        @if ($edit->is_active == 1) checked @endif />
                                                                    <span> Is Active ? </span>
                                                                </label>

                                                            </p>
                                                        </div>
                                                    </div>



                                            </div>


                                            <div class="col s12">
                                                <div class="col s12 display-flex justify-content-end mt-3">
                                                    <button type="submit" class="btn indigo">
                                                        Save changes
                                                    </button>

                                                    <button type="button" class="btn btn-light">Cancel</button>
                                                </div>
                                            </div>

                                            </form>


                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
    </div>
    <!-- END: Page Main-->
@endsection
@section('java_script')
    {{-- <script src="{{ asset('app-assets/js/scripts/ui-alerts.js') }}"></script> --}}
    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('app-assets/js/vendors.min.js') }}"></script>
    <!-- BEGIN VENDOR JS-->
    {{-- <script src="{{ asset('app-assets/vendors/select2/select2.full.min.js') }}"></script> --}}
    <!-- BEGIN THEME  JS-->
    <script src="{{ asset('app-assets/js/plugins.js') }}"></script>
    <script src="{{ asset('app-assets/js/search.js') }}"></script>
    <script src="{{ asset('app-assets/js/custom/custom-script.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/customizer.js') }}"></script>
    <!-- END THEME  JS-->



    {{-- <script src="{{ asset('app-assets/js/scripts/form-select2.js') }}"></script>
 --}}



   

    <!-- END PAGE LEVEL JS-->
@endsection