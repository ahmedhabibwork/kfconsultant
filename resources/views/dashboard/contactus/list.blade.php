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
                            <h5 class="breadcrumbs-title mt-0 mb-0"><span>Contact Us List</span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Contact Us </a>
                                </li>
                                <li class="breadcrumb-item active">Contact Us List
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
                                                    <th>Email</th>

                                                    <th>Subject</th>
                                                    <th>Message</th>

                                                    <th>Delete</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($contacts))
                                                    @foreach ($contacts as $value)
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
                                                            <td> @isset($value->email)
                                                                    {!! $value->email !!}
                                                                @endisset
                                                            <td>
                                                                @isset($value->subject)
                                                                    {!! $value->subject !!}
                                                                @endisset
                                                            </td>

                                                            <td>
                                                                @isset($value->email)
                                                                    {!! $value->email !!}
                                                                @endisset

                                                            </td>

                                                            <td>

                                                                <a
                                                                    href="{{ route('dashboard.delete-contact-us', $value->id) }}"><i
                                                                        class="material-icons">delete</i></a>

                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                @endif


                                            </tbody>
                                        </table>
                                        @if ($contacts->hasPages())
                                            <ul class="pagination" style="text-align:right">
                                                {{-- Previous Page Link --}}
                                                @if ($contacts->onFirstPage())
                                                    <li class="disabled waves-effect"><span>«prev</span></li>
                                                @else
                                                    <li class="waves-effect"><a href="{{ $contacts->previousPageUrl() }}"
                                                            rel="prev">«prev</a></li>
                                                @endif

                                                @if ($contacts->currentPage() > 3)
                                                    <li class="hidden-xs waves-effect"><a
                                                            href="{{ $contacts->url(1) }}">1</a></li>
                                                @endif
                                                @if ($contacts->currentPage() > 4)
                                                    <li class="waves-effect"><span>...</span></li>
                                                @endif
                                                @foreach (range(1, $contacts->lastPage()) as $i)
                                                    @if ($i >= $contacts->currentPage() - 2 && $i <= $contacts->currentPage() + 2)
                                                        @if ($i == $contacts->currentPage())
                                                            <li class="active waves-effect"
                                                                style="font-size: 1.2rem; line-height: 30px;display: inline-block; padding: 0 10px;">
                                                                <span>{{ $i }}</span>
                                                            </li>
                                                        @else
                                                            <li class="waves-effect"><a
                                                                    href="{{ $contacts->url($i) }}">{{ $i }}</a>
                                                            </li>
                                                        @endif
                                                    @endif
                                                @endforeach
                                                @if ($contacts->currentPage() < $contacts->lastPage() - 3)
                                                    <li class="waves-effect"><span>...</span></li>
                                                @endif
                                                @if ($contacts->currentPage() < $contacts->lastPage() - 2)
                                                    <li class="hidden-xs waves-effect"><a
                                                            href="{{ $contacts->url($contacts->lastPage()) }}">{{ $contacts->lastPage() }}</a>
                                                    </li>
                                                @endif

                                                {{-- Next Page Link --}}
                                                @if ($contacts->hasMorePages())
                                                    <li class="waves-effect"> <a href="{{ $contacts->nextPageUrl() }}"
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
    <!-- END PAGE LEVEL JS-->
@endsection