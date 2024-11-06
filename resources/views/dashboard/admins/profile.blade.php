@extends("layouts.dashboard.app")
@section("style_css")
<link rel="stylesheet" href="{{asset('app-assets/vendors/select2/select2.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('app-assets/vendors/select2/select2-materialize.css')}}" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/form-select2.cs')}}s">
@endsection
<!-- BEGIN: Page Main-->
@section("content")

    <!-- BEGIN: Page Main-->
    <div id="main">
        <div class="row">
            <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
            <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
                <!-- Search for small screen-->
                <div class="container">
                    <div class="row">
                        <div class="col s10 m6 l6">
                            <h5 class="breadcrumbs-title mt-0 mb-0"><span>Profile </span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Edit Profile  @isset($edit->name) {{$edit->name}} @endisset
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12">
                <div class="container">
                    <!-- Input Fields -->
                    @if (session()->has('message'))
                    <div class="card-alert card green">
                        <div class="card-content white-text">
                            <p>SUCCESS : {{ session('message') }}</p>
                        </div>
                        <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                @elseif(session()->has('error'))
                    <div class="card-alert card red">
                        <div class="card-content white-text">
                            <p>DANGER : {{ session('error') }}</p>
                        </div>
                        <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                @endif
                    <div class="row">
                        <div class="col s12">
                            <div id="input-fields" class="card card-tabs">
                                <div class="card-content">

                                    <div id="view-input-fields">
                                        <div class="row">
                                                <form class="login-row" method="post" enctype="multipart/form-data"
                                                      action="{{route('dashboard.profile.updateProfile',$edit->admin_id)}}">
                                                   @csrf

                                                    @method('PUT')

                                                    <div class="col s12">
                                                        <div class="input-field col s6">
                                                        <input id="name" type="text"@error('name') is-invalid @enderror name="name" value="{{$edit->name}}">
                                                            <label for="name">  Name <span style="color:red" >*</span></label>
                                                            @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                              <strong style="color: #ff4081">{{ $message }}</strong>
                                                             </span>
                                                            @enderror
                                                    
                                                        </div>
                                          
                                                        <div   class="input-field col s6">
                                                            <input id="email" type="text" @error('email') is-invalid @enderror name="email" value="{{$edit->email}}">
                                                            <label for="email">Email <span style="color:red" >*</span></label>
                                                            @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                              <strong style="color: #ff4081">{{ $message }}</strong>
                                                             </span>
                                                            @enderror
                                                        </div>
                                                        <div class="file-field input-field col s6">
                                                            <div class="btn">
                                                                <span>Image</span>
                                                                <input type="file" onchange="readURL(this);"   @error('input_img') is-invalid @enderror name="input_img">
    
                                                            </div>
                                                            <div class="file-path-wrapper">
                                                                <input class="file-path validate" type="text" @error('input_img') is-invalid @enderror name="input_img">
                                                            </div>
                                                            @error('input_img')
                                                            <span class="invalid-feedback" role="alert">
                                                      <strong style="color: #ff4081">{{ $message }}</strong>
                                                     </span>
                                                            @enderror
                                                            <div class="file-field input-field col s6">
                                                            <div class="card animate fadeLeft">
                                                                <div class="card-content">
                                                                    <p> Profile Image  </p>
                                                                  <img  id="input_img" src=""
                                                                  class="responsive-img border-radius-4"   alt="NO Upload Profile Image" style=" height:160px;">
                                            
                                                                </div>
                                                              </div>
                                                            </div>
                                                </div>
                                                        <div class="input-field col s6">
                                                            <input id="phone" type="text" @error('phone') is-invalid @enderror name="phone" value="{{$edit->phone}}">
                                                            <label for="phone">Phone <span style="color:red" >*</span></label>
                                                            @error('phone')
                                                            <span class="invalid-feedback" role="alert">
                                                              <strong style="color: #ff4081">{{ $message }}</strong>
                                                             </span>
                                                            @enderror
                                                      </div>

         
                                            <div class="col s12">
                                            <div class="input-field col s6">
                                                <input id="old_password" type="password" @error('old_password') is-invalid @enderror name="old_password">
                                                <label for="password">Old Password </label>
                                                @error('old_password')
                                                <span class="invalid-feedback" role="alert">
                                                  <strong style="color: #ff4081">{{ $message }}</strong>
                                                 </span>
                                                @enderror
                                            </div>
                                        </div>
                                            <div class="col s12">
                                          <div class="input-field col s6">
                                                <input id="password" type="password" @error('password') is-invalid @enderror name="password">
                                                <label for="password">New Password </label>
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                  <strong style="color: #ff4081">{{ $message }}</strong>
                                                 </span>
                                                @enderror
            
                                            </div>
                                        </div>
                                      
                                                        <div class="col s12">
                                                       <div   class="input-field col s6">
                                                            <input id="confirm_password" type="password" @error('confirm_password') is-invalid @enderror name="confirm_password" >
                                                            <label for="confirm_password">Confirm Password <span style="color:red" >*</span></label>
                                                            @error('confirm_password')
                                                            <span class="invalid-feedback" role="alert">
                                                              <strong style="color: #ff4081">{{ $message }}</strong>
                                                             </span>
                                                            @enderror
                                                          </div> 
                                                        </div>
                                                    </div>
                                                    <div class="col s12">
                                                        <div class="col s12 display-flex justify-content-end mt-3">
                                                            <button type="submit" class="btn indigo">
                                                                Save changes
                                                            </button>
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
<script src="{{asset('app-assets/js/scripts/ui-alerts.js')}}"></script>
<!-- BEGIN VENDOR JS-->
<script src="{{asset('app-assets/js/vendors.min.js')}}"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN THEME  JS-->
<script src="{{asset('app-assets/js/plugins.js')}}"></script>
<script src="{{asset('app-assets/js/search.js')}}"></script>
<script src="{{asset('app-assets/js/custom/custom-script.js')}}"></script>
<script src="{{asset('app-assets/js/scripts/customizer.js')}}"></script>
<!-- END THEME  JS-->
<!-- END PAGE LEVEL JS-->
<script>

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#input_img')
                    .attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>
@endsection
