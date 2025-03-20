<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="title" content="N2touch - Ads space for you">
    <meta name="keywords"
        content="n2touch, classified, ads, classified ads, listing, business, directory, jobs, marketing, portal, advertising, local, posting, ad listing, ad posting,">
    <title>N2touch</title>
    <link rel="icon" href="images/logo.png">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900|Montserrat:300,400,500,600,700,800,900" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/fonts/feather/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/fonts/simple-line-icons/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/fonts/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/perfect-scrollbar.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/prism.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/chartist.min.css')}}">
    <!-- END VENDOR CSS-->
    <!-- BEGIN APEX CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/app.css')}}">
</head>
<body data-col="1-column" class=" 1-column  blank-page">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="wrapper">
        <div class="main-panel">
        <!-- BEGIN : Main Content-->
            <div class="main-content">
                <div class="content-wrapper"><!--Login Page Starts-->
                    <section id="login" style="background-image: url('../images/bg/01.jpg')">
                        <div class="container-fluid">
                            <div class="row full-height-vh m-0">
                                <div class="col-12 d-flex align-items-center justify-content-center">
                                    <div class="card col-lg-8" style="border: 1px solid #c1aa1a;box-shadow: 2px 1px 13px 6px;">
                                        <div class="card-content">

                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-3 d-lg-block py-2 text-center align-middle">
                                                        <a href="{{url('/')}}">
                                                            <img src="{{asset('images/logo.png')}}" alt="" class="img-fluid " width="60%" height="auto">
                                                        </a>
                                                    </div>
                                                     <div class="col-lg-9 col-md-12 bg-white px-4 pt-3">
                                                         <div class="card-title">{{ __('Verify Your Email Address') }}</div>
                                                        @if (session('resent'))
                                                        <div class="alert alert-success" role="alert">
                                                            {{ __('A fresh verification link has been sent to your email address.') }}
                                                        </div>
                                                        @endif

                                                        {{ __('Before proceeding, please check your email for a verification link.') }}
                                                        {{ __('If you did not receive the email') }},
                                                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                                            @csrf
                                                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                                                        </form>
                                                     </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

 <!-- BEGIN VENDOR JS-->
    <script src="{{asset('app-assets/vendors/js/core/jquery-3.2.1.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/core/popper.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/core/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/prism.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/jquery.matchHeight-min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/screenfull.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/pace/pace.min.js')}}" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN APEX JS-->
    <script src="{{asset('app-assets/js/app-sidebar.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/js/notification-sidebar.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/js/customizer.js')}}" type="text/javascript"></script>
    <!-- END APEX JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->
  </body>
  <!-- END : Body-->
</html>
