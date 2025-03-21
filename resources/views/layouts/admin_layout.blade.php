<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="loading">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Deal | Admin Dashboard</title>
    <link rel="icon" type="image/png" href="{{asset('assets/images/plusdeal_logo.png')}}">
    <link
        href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900|Montserrat:300,400,500,600,700,800,900"
        rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/fonts/feather/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/fonts/simple-line-icons/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/fonts/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/perfect-scrollbar.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/prism.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/pickadate/pickadate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/dragula.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/toastr.css')}}">
    <link rel="stylesheet" type="text/css"
        href="{{asset('app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/switchery.min.css')}}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/app.css')}}">
    <script src="{{asset('app-assets/vendors/js/core/jquery-3.2.1.min.js')}}" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"
        integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="{{asset('app-assets/vendors/js/datatable/datatables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/datatable/dataTables.buttons.min.js')}}" type="text/javascript">
    </script>
    <script src="{{asset('app-assets/vendors/js/datatable/buttons.flash.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/datatable/jszip.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/datatable/pdfmake.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/datatable/vfs_fonts.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/datatable/buttons.html5.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/datatable/buttons.print.min.js')}}" type="text/javascript"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/popup.css')}}">
    <script src="{{asset('assets/js/popup.min.js')}}" type="text/javascript"></script>
    <style>
    .ck-editor__editable_inline {
        min-height: 200px;
    }
    </style>

</head>
<!-- END : Head-->
<!-- BEGIN : Body-->

<body data-col="2-columns" class="2-columns">
    @if (\Session::has('success'))
    <input type="hidden" id="success_msg" value="{{ \Session::get('success')}}">
    @endif
    @if (\Session::has('error'))
    <input type="hidden" id="error_msg" value="{{ \Session::get('error')}}">
    @endif
    @if (\Session::has('warning'))
    <input type="hidden" id="warning_msg" value="{{ \Session::get('warning')}}">
    @endif
    <div class="wrapper sidebar-lg">
        <div data-active-color="white" data-background-color="black" data-image="{{asset('assets/images/sidebar.jpg')}}"
            class="app-sidebar">
            <div class="sidebar-header">
                <div class="logo clearfix d-flex justify-content-center pb-0">
                    <a href="{{route('dashboard')}}" class="logo-text d-flex">
                        <span class="text align-middle text-center">
                            <img src="{{asset('assets/images/logo.png')}}" height="35px" style="margin:auto" alt="">
                        </span>
                    </a>
                    <a id="sidebarToggle" href="javascript:;"
                        class="nav-toggle d-none d-sm-none d-md-none d-lg-block"><i data-toggle="expanded"
                            class="toggle-icon ft-toggle-left"></i></a>
                    <a id="sidebarClose" href="javascript:;" class="nav-close d-block d-md-block d-lg-none d-xl-none"><i
                            class="ft-x"></i></a>
                </div>
            </div>
            <div class="sidebar-content">
                <div class="nav-container">
                    <ul id="main-menu-navigation" data-menu="menu-navigation" data-scroll-to-active="true"
                        class="navigation navigation-main">
                        <li class=" nav-item"><a href="{{url('/')}}" target="_blank"><i
                                    class="ft-external-link"></i><span data-i18n="" class="menu-title">@lang('Front Page')</span>
                            </a>
                        </li>
                        <li class="nav-item"><a href="{{route('admin.dashboard')}}"><i class="ft-home"></i><span
                                    data-i18n="" class="menu-title">@lang('Dashboard')</span> </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.customers')}}"><i class="icon-users"></i><span data-i18n="" class="menu-title">Customers</span></a>
                             
                        </li>
                        <li class="nav-item"><a href="{{route('admin.category')}}"><i class="ft-grid"></i><span
                                    data-i18n="" class="menu-title">@lang('Category')</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.products')}}"><i class="ft-shopping-cart"></i><span class="menu-title">@lang('Products')</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.sales')}}"><i class="ft-activity"></i><span class="menu-title">Sales </span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.profile')}}"><i class="icon-user"></i><span class="menu-title">My Account</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.maintenance')}}"><i class="icon-power"></i><span class="menu-title">Site Maintenance</span></a>
                        </li>
                        <li class="nav-item"><a href="{{ route('logout',app()->getLocale()) }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                    class="ft-log-out"></i><span data-i18n="" class="menu-title">@lang('Sign Out')</span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- main menu content-->
            <div class="sidebar-background"></div>
        </div>
        <!-- / main menu-->
        <!-- Navbar (Header) Starts-->
        <nav class="navbar navbar-expand-lg navbar-light bg-faded header-navbar">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" data-toggle="collapse" class="navbar-toggle d-lg-none float-left">
                        <span  class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <span class="d-lg-none navbar-right navbar-collapse-toggle">
                        <a aria-controls="navbarSupportedContent" href="javascript:;" class="open-navbar-container black">
                            <i class="ft-more-vertical"></i>
                        </a>
                    </span>
                </div>
                <div class="navbar-container">
                    <div id="navbarSupportedContent" class="collapse navbar-collapse">
                        <ul class="navbar-nav">
                            
                            <li class="nav-item mr-2 d-none d-lg-block">
                                <a id="navbar-fullscreen" href="javascript:;" class="nav-link apptogglefullscreen">
                                    <i class="ft-maximize font-medium-3 blue-grey darken-4"></i>
                                    <p class="d-none">fullscreen</p>
                                </a>
                            </li>
                            <li class="dropdown nav-item">
                                <a id="dropdownBasic3" href="#" data-toggle="dropdown" class="nav-link position-relative dropdown-toggle">
                                    <i class="icon-user font-medium-3 blue-grey darken-4"></i>
                                    <p class="d-none">User Settings</p>
                                </a>
                                <div ngbdropdownmenu="" aria-labelledby="dropdownBasic3"
                                    class="dropdown-menu text-left dropdown-menu-right">
                                    <a href="{{route('admin.profile')}}" class="dropdown-item py-1"><i
                                            class="ft-edit mr-2"></i><span>My Account</span></a>

                                    <div class="dropdown-divider"></div>
                                    <a href="{{ route('logout',app()->getLocale()) }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                        class="dropdown-item">
                                        <i class="ft-log-out mr-2"></i><span>@lang('Sign Out')</span>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout',app()->getLocale()) }}"
                                        method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Navbar (Header) Ends-->

        <div class="main-panel">

            <!-- BEGIN : Main Content-->
            @yield('content')
            <!-- END : End Main Content-->

            <!-- BEGIN : Footer-->
            <footer class="footer footer-static footer-light">
                <p class="clearfix text-muted text-sm-center px-2 pb-2"><span style="bottom:10px">&copy; Copyright
                        {{date('Y')}} PlusDeal. All Rights Reserved
                    </span></p>
            </footer>
            <!-- End : Footer-->

        </div>
    </div>
    <script>
    var allEditors = document.querySelectorAll('.description');
    for (var i = 0; i < allEditors.length; ++i) {
        ClassicEditor.create(allEditors[i])
            .catch(error => {
                console.error(error);
            });

    }
    $(document).ready(function() {
        $('.category-select').select2();

        $('.image-link').magnificPopup({
            type: 'image'
        });

        $('#phone').keyup(function() {
            var val = this.value.replace(/\D/g, '');
            val = val.replace(/^(\d{3})/, '($1)-');
            val = val.replace(/-(\d{3})/, ' $1-');
            val = val.replace(/(\d)-(\d{4}).*/, '$1-$2');
            this.value = val;
        });
        $('.phone').keyup(function() {
            var val = this.value.replace(/\D/g, '');
            val = val.replace(/^(\d{3})/, '($1)-');
            val = val.replace(/-(\d{3})/, ' $1-');
            val = val.replace(/(\d)-(\d{4}).*/, '$1-$2');
            this.value = val;
        });
        var success_msg = $('#success_msg').val();
        var error_msg = $('#error_msg').val();
        var warning_msg = $('#warning_msg').val();
        if (success_msg != null) {
            toastr.success(success_msg, {
                "closeButton": true
            });
        }
        if (error_msg != null) {
            toastr.error(error_msg, {
                "closeButton": true
            });
        }
        if (warning_msg != null) {
            toastr.warning(warning_msg, {
                "closeButton": true
            });
        }
    });
    </script>
    <script src="{{asset('app-assets/vendors/js/toastr.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/js/toastr.min.js')}}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="{{asset('app-assets/vendors/js/core/popper.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/core/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/prism.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/jquery.matchHeight-min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/screenfull.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/pace/pace.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/moment.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/prism.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/jquery.steps.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/pickadate/picker.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/pickadate/picker.date.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/pickadate/picker.time.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/pickadate/legacy.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/jquery.validate.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/chart.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/js/chartjs.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/jquery-ui.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/js/app-sidebar.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/js/components-modal.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/js/customizer.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/switchery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/js/switch.min.js')}}" type="text/javascript"></script>



</body>

</html>