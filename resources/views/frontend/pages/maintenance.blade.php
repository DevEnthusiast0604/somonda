<!DOCTYPE html>
<html lang="en">
<head>
    <title>Festum | Eventi | Maintenance</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/themewar-icons.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/linea-weather-icons.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/magro-icons.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/preset.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/ignore_for_wp.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/lightcase.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/owl.carousel.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/owl.theme.default.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/animate.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/theme.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/responsive.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/toastr.css')}}">

    <link rel="icon" type="image/png" href="{{asset('assets/images/plusdeal_logo.png')}}">

</head>

<body>
    @if (\Session::has('doneMessage'))
    <input type="hidden" id="donemessage" value="{{ \Session::get('doneMessage')}}">
    @endif
    <div class="preloader text-center">
        <div class="la-ball-scale-multiple la-2x">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>


    <section class="coming_soon_2">
        <div class="cs_center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="content_coming_soon">
                            <a href="{{route('login')}}"><img src="{{asset('assets/images/logo.png')}}" width="50%" alt="" /></a>
                            <img class="sign" src="{{asset('assets/images/sign.png')}}" alt="" />
                            <p>We are still working on it!</p>
                            <div id="countdown_dashboard" class="clearfix" data-day="{{date('d', strtotime(is_maintenance()->period))}}" data-month="{{date('m', strtotime(is_maintenance()->period))}}"
                                data-year="{{date('Y', strtotime(is_maintenance()->period))}}"></div>
                            <form method="post" action="{{route('user.subscribe')}}">
                                @csrf
                                <input type="email" name="email" placeholder="Enter Your Email" required>
                                <button type="submit"><i class="twi-angle-right"></i></button>
                            </form>
                            <div class="coming_social">
                                <a href="#"><i class="twi-twitter"></i></a>
                                <a href="#"><i class="twi-dribbble"></i></a>
                                <a href="#"><i class="twi-instagram"></i></a>
                                <a href="#"><i class="twi-linkedin-in"></i></a>
                                <a href="#"><i class="twi-facebook-square"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="{{asset('assets/js/jquery.js')}}"></script>
    <script>
    $(document).ready(function() {
       
        var donemessage = $('#donemessage').val();
        if (donemessage != null) {
            toastr.success(donemessage, {
                "closeButton": true
            });
        }
    });
    </script>
     <script src="{{asset('app-assets/vendors/js/toastr.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/js/toastr.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/jquery-ui.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.js')}}"></script>
    <script src="{{asset('assets/js/lightcase.js')}}"></script>
    <script src="{{asset('assets/js/jquery.plugin.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.countdown.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.appear.js')}}"></script>
    <script src="{{asset('assets/js/slick.js')}}"></script>
    <script src="{{asset('assets/js/gmaps.js')}}"></script>
    <script src="{{asset('assets/js/jquery.shuffle.min.js')}}"></script>
    <script src="{{asset('assets/js/stickyfill.min.js')}}"></script>
    <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/js/theme.js')}}"></script>
</body>
</html>