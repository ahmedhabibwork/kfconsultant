@php $route_name= Illuminate\Support\Facades\Route::currentRouteName(); @endphp
<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square">
    <div class="brand-sidebar">
        <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="{{ url('/') }}"><img
                    class="show-on-medium-and-down hide-on-med-and-up" src="LogoBig.png" alt="materialize logo" /><span
                    class="logo-text hide-on-med-and-down"><img class="hide-on-med-and-down"
                        src="{{ asset('app-assets/images/logo/logokf.png') }}" alt="materialize logo" /></span></a><a
                class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a></h1>
    </div>
    <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out"
        data-menu="menu-navigation" data-collapsible="menu-accordion">

        <li class=" bold"><a class=" waves-effect waves-cyan " href="{{ url('/') }}"><i
                    class="material-icons">home</i><span class="menu-title" data-i18n="Dashboard">Home</span></a>

        </li>
        <li class="bold  @if (
            $route_name == 'dashboard.categories.index' ||
                $route_name == 'dashboard.categories.create' ||
                $route_name == 'dashboard.categories.edit') active @endif">

            <div class="collapsible-body">

        <li><a class="@if (
            $route_name == 'dashboard.categories.index' ||
                $route_name == 'dashboard.categories.create' ||
                $route_name == 'dashboard.categories.edit') active @endif"
                href="{{ route('dashboard.categories.index') }}"><i
                    class="material-icons">widgets</i><span data-i18n="List">Categories
                </span></a>
        </li>



        </div>
        </li>

        <li class="bold  @if ($route_name == 'dashboard.contact-us.index') active @endif">

            <div class="collapsible-body">

        <li><a class="@if ($route_name == 'dashboard.contact-us.index') active @endif"
                href="{{ route('dashboard.contact-us.index') }}"><i
                    class="material-icons">contact_mail</i><span data-i18n="List">Contact Us
                </span></a>
        </li>



        </div>
        </li>

        </div>

        </li>
        <li class="bold  @if (
            $route_name == 'dashboard.projects.index' ||
                $route_name == 'dashboard.projects.create' ||
                $route_name == 'dashboard.projects.edit') active @endif">

            <div class="collapsible-body">

        <li><a class="@if (
            $route_name == 'dashboard.projects.index' ||
                $route_name == 'dashboard.projects.create' ||
                $route_name == 'dashboard.projects.edit') active @endif" href="{{ route('dashboard.projects.index') }}"><i
                        class="material-icons">view_module</i><span data-i18n="List">Projects
                </span></a>
        </li>



        </div>
        </li>
        <li class="bold  @if (
            $route_name == 'dashboard.clients.index' ||
                $route_name == 'dashboard.clients.create' ||
                $route_name == 'dashboard.clients.edit') active @endif">

            <div class="collapsible-body">

        <li><a class="@if (
            $route_name == 'dashboard.clients.index' ||
                $route_name == 'dashboard.clients.create' ||
                $route_name == 'dashboard.clients.edit') active @endif" href="{{ route('dashboard.clients.index') }}"><i
                    class="material-icons">euro_symbol</i><span data-i18n="List">Clients
                </span></a>
        </li>



        </div>
        </li>

        </li>
        <li class="bold  @if (
            $route_name == 'dashboard.careers.index' ||
                $route_name == 'dashboard.careers.create' ||
                $route_name == 'dashboard.careers.edit') active @endif">

            <div class="collapsible-body">

        <li><a class="@if (
            $route_name == 'dashboard.careers.index' ||
                $route_name == 'dashboard.careers.create' ||
                $route_name == 'dashboard.careers.edit') active @endif" href="{{ route('dashboard.careers.index') }}"><i
                    class="material-icons">work</i><span data-i18n="List">Careers
                </span></a>
        </li>



        </div>
        </li>

        <li class="bold  @if (
            $route_name == 'dashboard.news.index' ||
                $route_name == 'dashboard.news.create' ||
                $route_name == 'dashboard.news.edit') active @endif">

            <div class="collapsible-body">

        <li><a class="@if (
            $route_name == 'dashboard.news.index' ||
                $route_name == 'dashboard.news.create' ||
                $route_name == 'dashboard.news.edit') active @endif" href="{{ route('dashboard.news.index') }}"><i
                    class="material-icons">assignment</i><span data-i18n="List">News
                </span></a>
        </li>



        </div>
        </li>


        <li class="bold  @if (
            $route_name == 'dashboard.teams.index' ||
                $route_name == 'dashboard.teams.create' ||
                $route_name == 'dashboard.teams.edit') active @endif">

            <div class="collapsible-body">

        <li><a class="@if (
            $route_name == 'dashboard.teams.index' ||
                $route_name == 'dashboard.teams.create' ||
                $route_name == 'dashboard.teams.edit') active @endif" href="{{ route('dashboard.teams.index') }}"><i
                    class="material-icons">group</i><span data-i18n="List">Teams
                </span></a>
        </li>



        </div>
        </li>
        <li
            class="bold 
                 @if (
                     $route_name == 'dashboard.services.index' ||
                         $route_name == 'dashboard.services.create' ||
                         $route_name == 'dashboard.services.edit') active
                 @elseif(
                     $route_name == 'dashboard.sub-services.index' ||
                         $route_name == 'dashboard.sub-services.create' ||
                         $route_name == 'dashboard.sub-services.edit')  active @endif">
            <a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i
                    class="material-icons">room_service</i><span class="menu-title"
                    data-i18n="User">Services</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li><a class="@if (
                        $route_name == 'dashboard.services.index' ||
                            $route_name == 'dashboard.services.create' ||
                            $route_name == 'dashboard.services.edit') active @endif"
                            href="{{ route('dashboard.services.index') }}"><i
                                class="material-icons">radio_button_unchecked</i><span data-i18n="List">Services
                            </span></a>
                    </li>
                    <li><a class="@if (
                        $route_name == 'dashboard.sub-services.index' ||
                            $route_name == 'dashboard.sub-services.create' ||
                            $route_name == 'dashboard.sub-services.edit') active @endif"
                            href="{{ route('dashboard.sub-services.index') }}"><i
                                class="material-icons">radio_button_unchecked</i><span data-i18n="List">Sub Services
                            </span></a>
                    </li>

                </ul>
            </div>
        </li>

        </li>
        <li
            class="bold  @if (
                $route_name == 'dashboard.scopes.index' ||
                    $route_name == 'dashboard.scopes.create' ||
                    $route_name == 'dashboard.scopes.edit') active  @elseif(
                $route_name == 'dashboard.scales.index' ||
                    $route_name == 'dashboard.scales.create' ||
                    $route_name == 'dashboard.scales.edit')  active 
                     @elseif(
                         $route_name == 'dashboard.years.index' ||
                             $route_name == 'dashboard.years.create' ||
                             $route_name == 'dashboard.years.edit')  active
                     @elseif(
                         $route_name == 'dashboard.status.index' ||
                             $route_name == 'dashboard.status.create' ||
                             $route_name == 'dashboard.status.edit')  active @endif">
            <a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i
                    class="material-icons">featured_play_list</i><span class="menu-title"
                    data-i18n="User">Properties</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li><a class="@if (
                        $route_name == 'dashboard.scopes.index' ||
                            $route_name == 'dashboard.scopes.create' ||
                            $route_name == 'dashboard.scopes.edit') active @endif"
                            href="{{ route('dashboard.scopes.index') }}"><i
                                class="material-icons">radio_button_unchecked</i><span data-i18n="List">Scopes
                            </span></a>
                    </li>
                    <li><a class="@if (
                        $route_name == 'dashboard.scales.index' ||
                            $route_name == 'dashboard.scales.create' ||
                            $route_name == 'dashboard.scales.edit') active @endif"
                            href="{{ route('dashboard.scales.index') }}"><i
                                class="material-icons">radio_button_unchecked</i><span data-i18n="List">Scales
                            </span></a>
                    </li>
                    <li><a class="@if (
                        $route_name == 'dashboard.years.index' ||
                            $route_name == 'dashboard.years.create' ||
                            $route_name == 'dashboard.years.edit') active @endif"
                            href="{{ route('dashboard.years.index') }}"><i
                                class="material-icons">radio_button_unchecked</i><span data-i18n="List">Years
                            </span></a>
                    </li>


                    <li><a class="@if (
                        $route_name == 'dashboard.status.index' ||
                            $route_name == 'dashboard.status.create' ||
                            $route_name == 'dashboard.status.edit') active @endif"
                            href="{{ route('dashboard.status.index') }}"><i
                                class="material-icons">radio_button_unchecked</i><span
                                data-i18n="List">Status</span></a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="bold  @if ($route_name == 'dashboard.settings.edit') active @endif">

            <div class="collapsible-body">

        <li><a class="@if ($route_name == 'dashboard.settings.edit') active @endif"
                href="{{ route('dashboard.settings.edit', 1) }}"><i
                    class="material-icons">place</i><span data-i18n="List">Settings
                </span></a>
        </li>



        </div>
        </li>
        <li class="bold  @if ($route_name == 'dashboard.about-us.edit') active @endif">

            <div class="collapsible-body">

        <li><a class="@if ($route_name == 'dashboard.about-us.edit') active @endif"
                href="{{ route('dashboard.about-us.edit', 1) }}"><i
                    class="material-icons">perm_device_information</i><span data-i18n="List">About Us
                </span></a>
        </li>



        </div>
        </li>

        <li class="bold  @if (
            $route_name == 'dashboard.admins.index' ||
                $route_name == 'dashboard.admins.create' ||
                $route_name == 'dashboard.admins.edit') active @endif">

            <div class="collapsible-body">

        <li><a class="@if (
            $route_name == 'dashboard.admins.index' ||
                $route_name == 'dashboard.admins.create' ||
                $route_name == 'dashboard.admins.edit') active @endif" href="{{ route('dashboard.admins.index') }}"><i
                    class="material-icons">person</i><span data-i18n="List">Admins
                </span></a>
        </li>



        </div>
        </li>
    </ul>
    <div class="navigation-background"></div><a
        class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only"
        href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside>
