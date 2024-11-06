@extends('layouts.dashboard.app')
@section('style_css')
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/select2/select2.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/select2/select2-materialize.css') }}" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/form-select2.cs') }}">
    <style>
        .quote-imgs-thumbs {
            background: #eee;
            border: 1px solid #ccc;
            border-radius: 0.25rem;
            margin: 1.5rem 0;
            padding: 0.75rem;
        }

        .quote-imgs-thumbs--hidden {
            display: none;
        }

        .img-preview-thumb {
            background: #fff;
            border: 1px solid #777;
            border-radius: 0.25rem;
            box-shadow: 0.125rem 0.125rem 0.0625rem rgba(0, 0, 0, 0.12);
            margin-right: 1rem;
            max-width: 140px;
            padding: 0.25rem;
        }
    </style>
@endsection
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
                            <h5 class="breadcrumbs-title mt-0 mb-0"><span>Project</span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Create Project
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
                                                    id="img-upload-form" action="{{ route('dashboard.projects.store') }}"
                                                    enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="col s12">
                                                        <div class="row">
                                                        <div class="input-field col s6 m6">
                                                            <select class="select2 browser-default"
                                                                @error('category_id') is-invalid @enderror
                                                                name="category_id" id="category_id">
                                                                @isset($categories)
                                                                    @foreach ($categories as $value)
                                                                        <option value="{{ $value->id }}" class="circle">
                                                                            {{ $value->name }}
                                                                        </option>
                                                                    @endforeach
                                                                @endisset
                                                            </select>
                                                            @error('category_id')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong style="color: #ff4081">{{ $message }}</strong>
                                                                </span>
                                                            @enderror

                                                            <label>Categories <span style="color:red">*</span></label>
                                                        </div>

                                                        <div class="input-field col s6">

                                                            <input id="title" type="text"
                                                                @error('title') is-invalid @enderror name="title"
                                                                value="{{ old('title') }}">
                                                            <label for="title"> Title <span
                                                                    style="color:red">*</span></label>
                                                            @error('title')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong style="color: #ff4081">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s6">

                                                            <input id="introduction" type="text"
                                                                @error('introduction') is-invalid @enderror
                                                                name="introduction" value="{{ old('introduction') }}">
                                                            <label for="introduction"> Introduction <span
                                                                    style="color:red">*</span></label>
                                                            @error('introduction')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong style="color: #ff4081">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="input-field col s6">
                                                            <span> <label> Description </label> </span>
                                                            <textarea class="form-control ckeditor" name="description" id="description" rows="8"
                                                                placeholder="Description English">
                                                         {{ old('description') }}
                                                              </textarea>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="input-field col s6 m6">
                                                            <select class="select2 browser-default"
                                                                @error('scope_id') is-invalid @enderror name="scope_id"
                                                                id="scope_id">
                                                                @isset($scopes)
                                                                    @foreach ($scopes as $value)
                                                                        <option value="{{ $value->id }}" class="circle">
                                                                            {{ $value->name }}
                                                                        </option>
                                                                    @endforeach
                                                                @endisset
                                                            </select>
                                                            @error('scope_id')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong style="color: #ff4081">{{ $message }}</strong>
                                                                </span>
                                                            @enderror

                                                            <label>Scopes <span style="color:red">*</span></label>
                                                        </div>

                                                        <div class="input-field col s6 m6">
                                                            <select class="select2 browser-default"
                                                                @error('scale_id') is-invalid @enderror name="scale_id"
                                                                id="scale_id">
                                                                @isset($scales)
                                                                    @foreach ($scales as $value)
                                                                        <option value="{{ $value->id }}" class="circle">
                                                                            {{ $value->name }}
                                                                        </option>
                                                                    @endforeach
                                                                @endisset
                                                            </select>
                                                            @error('scale_id')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong
                                                                        style="color: #ff4081">{{ $message }}</strong>
                                                                </span>
                                                            @enderror

                                                            <label>Scales <span style="color:red">*</span></label>
                                                        </div>
                                                    </div>
                                                        <div class="row">
                                                        <div class="input-field col s6 m6">
                                                            <select class="select2 browser-default"
                                                                @error('status_id') is-invalid @enderror name="status_id"
                                                                id="status_id">
                                                                @isset($status)
                                                                    @foreach ($status as $value)
                                                                        <option value="{{ $value->id }}" class="circle">
                                                                            {{ $value->name }}
                                                                        </option>
                                                                    @endforeach
                                                                @endisset
                                                            </select>
                                                            @error('status_id')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong
                                                                        style="color: #ff4081">{{ $message }}</strong>
                                                                </span>
                                                            @enderror

                                                            <label>Status <span style="color:red">*</span></label>
                                                        </div>
                                                        <div class="input-field col s6 m6">
                                                            <select class="select2 browser-default"
                                                                @error('year_id') is-invalid @enderror name="year_id"
                                                                id="year_id">
                                                                @isset($years)
                                                                    @foreach ($years as $value)
                                                                        <option value="{{ $value->id }}" class="circle">
                                                                            {{ $value->name }}
                                                                        </option>
                                                                    @endforeach
                                                                @endisset
                                                            </select>
                                                            @error('year_id')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong
                                                                        style="color: #ff4081">{{ $message }}</strong>
                                                                </span>
                                                            @enderror

                                                            <label>Years <span style="color:red">*</span></label>
                                                        </div>
                                                    </div>


                                                        <div class="input-field col s6">

                                                            <input id="owner" type="text" name="owner"
                                                                value="{{ old('owner') }}">
                                                            <label for="owner"> Owner </label>

                                                        </div>
                                                        <div class="input-field col s6">

                                                            <input id="location" type="text" name="location"
                                                                value="{{ old('location') }}">
                                                            <label for="location"> Location </label>

                                                        </div>
                                                        <div class="input-field col s6">

                                                            <input id="sort_order" type="text" name="sort_order"
                                                                value="{{ old('sort_order') }}">
                                                            <label for="sort_order"> Sort Order </label>

                                                        </div>


                                                    </div>


                                                    <div class="col s6">

                                                        <p>
                                                            <label>
                                                                <input class="with-gap" name="is_active" type="checkbox"
                                                                    value="1" />
                                                                <span> Is Active ? </span>
                                                            </label>

                                                        </p>


                                                    </div>

                                                    <div class="row">
                                                        <div class="file-field input-field col s12">
                                                            <div class="btn">
                                                                <span>Upload one or more Images</span>
                                                                <p>
            
                                                                    <input type="file" multiple id="upload_imgs"
                                                                        @error('input_img') is-invalid @enderror
                                                                        name="input_img[]" value="{{ old('input_img') }}">
                                                                </p>
                                                            </div>
                                                            <div class="file-path-wrapper">
                                                                <input class="file-path validate" type="text"
                                                                    id="upload_imgs" @error('input_img') is-invalid @enderror
                                                                    name="input_img" value="{{ old('input_img') }}">
                                                            </div>
                                                            @error('input_img')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong style="color: #ff4081">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="quote-imgs-thumbs quote-imgs-thumbs--hidden"
                                                            id="img_preview" aria-live="polite"></div>
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
    <script src="{{ asset('app-assets/vendors/select2/select2.full.min.js') }}"></script>
    <!-- BEGIN THEME  JS-->
    <script src="{{ asset('app-assets/js/plugins.js') }}"></script>
    <script src="{{ asset('app-assets/js/search.js') }}"></script>
    <script src="{{ asset('app-assets/js/custom/custom-script.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/customizer.js') }}"></script>
    <!-- END THEME  JS-->

    <script src="{{ asset('app-assets/js/scripts/form-select2.js') }}"></script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#primery')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        var imgUpload = document.getElementById('upload_imgs'),
            imgPreview = document.getElementById('img_preview'),
            imgUploadForm = document.getElementById('img-upload-form'),
            totalFiles, previewTitle, previewTitleText, img;

        imgUpload.addEventListener('change', previewImgs, false);
        // imgUploadForm.addEventListener('submit', function(e) {
        //     e.preventDefault();
        //     alert('Images Uploaded! (not really, but it would if this was on your website)');
        // }, false);

        function previewImgs(event) {
            totalFiles = imgUpload.files.length;

            if (!!totalFiles) {
                imgPreview.classList.remove('quote-imgs-thumbs--hidden');
                previewTitle = document.createElement('p');
                previewTitle.style.fontWeight = 'bold';
                previewTitleText = document.createTextNode(totalFiles + ' Total Images Selected');
                previewTitle.appendChild(previewTitleText);
                imgPreview.appendChild(previewTitle);
            }

            for (var i = 0; i < totalFiles; i++) {
                img = document.createElement('img');
                img.src = URL.createObjectURL(event.target.files[i]);
                img.classList.add('img-preview-thumb');
                imgPreview.appendChild(img);
            }
        }

        function backToInfoTab() {
            $('#tablist > li:first-child').addClass('active');
            $('#tablist > li:last-child').removeClass('active');

            $('#tabcontent > div:first-child').addClass('active');
            $('#tabcontent > div:last-child').removeClass('active');
        }
    </script>

    <!-- END PAGE LEVEL JS-->
@endsection
