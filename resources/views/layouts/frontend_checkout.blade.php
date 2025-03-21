<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PlusDeal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="icon" type="image/png" href="{{asset('assets/images/plusdeal_logo.png')}}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;300;400;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/OwlCarousel/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/OwlCarousel/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <link rel="stylesheet" href="{{asset('new-style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/toastr.css')}}">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/popup.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/fonts/feather/style.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/preloader.css')}}">
         <!-- Facebook Pixel Code Added 2024 -->
         <script>
                        !function(f,b,e,v,n,t,s)
                        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
                        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
                        n.queue=[];t=b.createElement(e);t.async=!0;
                        t.src=v;s=b.getElementsByTagName(e)[0];
                        s.parentNode.insertBefore(t,s)}(window, document,'script',
                        'https://connect.facebook.net/en_US/fbevents.js');
                        fbq('init', '1804480500032151');
                        fbq('track', 'Pageview');
                </script>

                <noscript>
                    <img height="1" width="1" style="display:none" 
                    src="https://www.facebook.com/tr?id=1804480500032151&ev=Pageview&noscript=1"/>
                </noscript>

    <!-- End Facebook Pixel Code -->
</head>

<body @if(Request::is('login')) class="login-page" @endif>
    <noscript>
        <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=2419370404933990&ev=PageView&noscript=1"/>
    </noscript>
    <noscript>
        <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=1632919927189675&ev=PageView&noscript=1"/>
    </noscript>
    <noscript>
        <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=613698397065206&ev=PageView&noscript=1"/>
    </noscript>
    @if (\Session::has('success'))
    <input type="hidden" id="cart_active" value="@lang(\Session::get('cart'))">
    @endif
    <!-- preloader start -->
    <div id="preloader">
        <div id="status"><img src="{{asset('assets/images/preloader.gif')}}" alt="preloader"></div>
    </div>
    @include('components.aside')
    @yield('content')
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            if ($.cookie('pop') == null) {
                $('#popup').modal('show');
                // $.cookie('pop', '7');
            }

            var cart_active = $('#cart_active').val();
            if (cart_active != null) {
                $("#side_cart_bar").addClass("active");
            }
        });
    </script>
    <script src="
    https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js
    "></script>
    <script src="{{asset('assets/js/popup.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/toastr.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/js/toastr.min.js')}}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="{{asset('assets/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/OwlCarousel/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>
   
</body>

</html>