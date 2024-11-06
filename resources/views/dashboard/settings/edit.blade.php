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
                            <h5 class="breadcrumbs-title mt-0 mb-0"><span>Settings</span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Edit Settings
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
                                                    action="{{ route('dashboard.settings.update', $edit->id) }}">
                                                    @csrf

                                                    @method('PUT')


                                                    <div class="col s12">

                                                        <div class="input-field col s6">

                                                            <input id="email"
                                                                type="text" @error('email') is-invalid @enderror
                                                                name="email"  value="{{ $edit->email }}">
                                                            <label for="email"> Email <span
                                                                    style="color:red">*</span></label>
                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong style="color: #ff4081">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="input-field col s6">

                                                            <input id="mobile"
                                                                type="text" @error('mobile') is-invalid @enderror
                                                                name="mobile"  value="{{ $edit->mobile }}">
                                                            <label for="mobile"> Mobile <span
                                                                    style="color:red">*</span></label>
                                                            @error('mobile')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong style="color: #ff4081">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="input-field col s6">

                                                            <input id="address"
                                                                type="text" @error('address') is-invalid @enderror
                                                                name="address"  value="{{ $edit->address }}">
                                                            <label for="address"> Address <span
                                                                    style="color:red">*</span></label>
                                                            @error('address')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong style="color: #ff4081">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <div class="input-field col s6">

                                                            <input id="linkedin_link"
                                                                type="text" 
                                                                name="linkedin_link"  value="{{ $edit->linkedin_link }}">
                                                            <label for="linkedin_link"> linkedin link </label>
                                              
                                                        </div>

                                                        <div class="input-field col s6">

                                                            <input id="youtube_link"
                                                                type="text" 
                                                                name="youtube_link"  value="{{ $edit->youtube_link }}">
                                                            <label for="youtube_link"> Youtube link </label>
                                               
                                                        </div>
                                                        <div class="input-field col s6">

                                                            <input id="facebook_link"
                                                                type="text" 
                                                                name="facebook_link"  value="{{ $edit->facebook_link }}">
                                                            <label for="facebook_link"> Facebook link </label>
                                                    
                                                        </div>
                                                        <div class="input-field col s6">

                                                            <input id="instagram_link"
                                                                type="text"
                                                                name="instagram_link"  value="{{ $edit->instagram_link }}">
                                                            <label for="instagram_link"> Instagram link </label>
                                             
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
