@extends('layouts.dashboard.app')
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
                            <h5 class="breadcrumbs-title mt-0 mb-0"><span>Sub Services List</span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Sub Services</a>
                                </li>
                                <li class="breadcrumb-item active">Sub Services List
                                </li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col s12">
                <div class="container">
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
                    <!-- users list start -->
                    <section class="users-list-wrapper section">
                        <div class="users-list-filter">
                            <div class="card-panel">
                                <div class="row">
                                    <form>
                                        <div class="col s12 m6 l3">

                                        </div>
                                        <div class="col s12 m6 l3">

                                        </div>
                                        <div class="col s12 m6 l3">

                                        </div>
                                        <div class="col s12 m6 l3 display-flex align-items-center show-btn">

                                            <a href="{{ route('dashboard.sub-services.create') }}"
                                                class="mb-6 btn waves-effect waves-light red accent-2">Create Sub
                                                Service</a>


                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="users-list-table">
                            <div class="card">
                                <div class="card-content">
                                    <!-- datatable start -->
                                    <div class="responsive-table">
                                        <table id="users-list-datatable" class="table">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>id</th>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Service</th>
                                                    <th>Sort Order</th>
                                                    <th>Status</th>
                                                    <th>edit</th>
                                                    <th>delete</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($subServices))
                                                    @foreach ($subServices as $value)
                                                        <tr>
                                                            <td></td>
                                                            <td> @isset($value->id)
                                                                    {!! $value->id !!}
                                                                @endisset
                                                            </td>
                                                            <td><a href="page-users-view.html">
                                                                    @isset($value->name)
                                                                        {!! $value->name !!}
                                                                    @endisset
                                                                </a>
                                                            </td>
                                                            <td> @isset($value->description)
                                                                {!!substr($value->description,0,50) !!}
                                                            @endisset
                                                            </td>
                                                            <td>

                                                                @isset($value->getService->name)
                                                                    {!! $value->getService->name !!}
                                                                @endisset
                                                            <td>
                                                                @isset($value->sort_order)
                                                                    {!! $value->sort_order !!}
                                                                @endisset
                                                            </td>

                                                            <td>

                                                                @isset($value->is_active)
                                                                    <div class="switch">
                                                                        @if ($value->is_active == 1)
                                                                            <label>
                                                                                <input type="checkbox" checked=""
                                                                                    id="active_value" name="active_value"
                                                                                    value="{{ $value->id }}"
                                                                                    onClick="javascript:toggleStatus({{ $value->id }})">
                                                                                <span class="lever"></span>
                                                                            </label>
                                                                        @else
                                                                            <label>
                                                                                <input type="checkbox" id="active_value"
                                                                                    name="active_value"
                                                                                    value="{{ $value->id }}"
                                                                                    onClick="javascript:toggleStatus({{ $value->id }})">
                                                                                <span class="lever"></span>
                                                                            </label>
                                                                        @endif

                                                                    </div>
                                                                @endisset

                                                            </td>


                                                            <td>

                                                                <a
                                                                    href="{{ route('dashboard.sub-services.edit', $value->id) }}"><i
                                                                        class="material-icons">edit</i></a>

                                                            </td>


                                                            <td>

                                                                <a
                                                                    href="{{ route('dashboard.delete-sub-service', $value->id) }}"><i
                                                                        class="material-icons">delete</i></a>

                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                @endif


                                            </tbody>
                                        </table>
                                        @if ($subServices->hasPages())
                                            <ul class="pagination" style="text-align:right">
                                                {{-- Previous Page Link --}}
                                                @if ($subServices->onFirstPage())
                                                    <li class="disabled waves-effect"><span>«prev</span></li>
                                                @else
                                                    <li class="waves-effect"><a href="{{ $subServices->previousPageUrl() }}"
                                                            rel="prev">«prev</a></li>
                                                @endif

                                                @if ($subServices->currentPage() > 3)
                                                    <li class="hidden-xs waves-effect"><a
                                                            href="{{ $subServices->url(1) }}">1</a></li>
                                                @endif
                                                @if ($subServices->currentPage() > 4)
                                                    <li class="waves-effect"><span>...</span></li>
                                                @endif
                                                @foreach (range(1, $subServices->lastPage()) as $i)
                                                    @if ($i >= $subServices->currentPage() - 2 && $i <= $subServices->currentPage() + 2)
                                                        @if ($i == $subServices->currentPage())
                                                            <li class="active waves-effect"
                                                                style="font-size: 1.2rem; line-height: 30px;display: inline-block; padding: 0 10px;">
                                                                <span>{{ $i }}</span>
                                                            </li>
                                                        @else
                                                            <li class="waves-effect"><a
                                                                    href="{{ $subServices->url($i) }}">{{ $i }}</a>
                                                            </li>
                                                        @endif
                                                    @endif
                                                @endforeach
                                                @if ($subServices->currentPage() < $subServices->lastPage() - 3)
                                                    <li class="waves-effect"><span>...</span></li>
                                                @endif
                                                @if ($subServices->currentPage() < $subServices->lastPage() - 2)
                                                    <li class="hidden-xs waves-effect"><a
                                                            href="{{ $subServices->url($subServices->lastPage()) }}">{{ $subServices->lastPage() }}</a>
                                                    </li>
                                                @endif

                                                {{-- Next Page Link --}}
                                                @if ($subServices->hasMorePages())
                                                    <li class="waves-effect"> <a href="{{ $subServices->nextPageUrl() }}"
                                                            rel="next">Next»</a></li>
                                                @else
                                                    <li class="disabled waves-effect"><span>Next»</span></li>
                                                @endif
                                            </ul>
                                        @endif
                                    </div>
                                    <!-- datatable ends -->
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- users list ends --><!-- START RIGHT SIDEBAR NAV -->


                </div>
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
    </div>
    <!-- END: Page Main-->

@endsection
@section('java_script')
    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('app-assets/js/vendors.min.js') }}"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{ asset('app-assets/vendors/data-tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}">
    </script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="{{ asset('app-assets/js/plugins.js') }}"></script>
    <script src="{{ asset('app-assets/js/search.js') }}"></script>
    <script src="{{ asset('app-assets/js/custom/custom-script.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/customizer.js') }}"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ asset('app-assets/js/scripts/page-users.js') }}"></script>

    <script type="text/javascript">
        function toggleStatus(id) {

            $.ajax({
                url: 'sub-services/change_status/' + id,
                type: "GET",

                success: function(data) {
                    console.log(data);
                    return data;
                },
                error: function(response) {
                    $('#commentErrorMsg').text(response.responseJSON.errors.comment);

                },
            });
        }
    </script>
    <!-- END PAGE LEVEL JS-->
@endsection
