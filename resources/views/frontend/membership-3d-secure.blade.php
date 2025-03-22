<!doctype html>
<html lang="en">
 <meta http-equiv="content-type" content="text/html;charset=UTF-8" /> 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{asset('images/fav.png')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Plusziet | Checkout</title>
    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/checkout.css')}}">
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
<body class="hompage">
    <div id="support">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col">
                    <h5>@lang('Need help? Contact us for everything from plans to refunds')</h5>
                </div>
                <div class="col-12 col-md-auto">
                    <a href="mailto:support@plusdeal.fr">support@plusdeal.fr</a>
                </div>
            </div>
        </div>
    </div>
    <!-- <header class="{{ (request()->is('checkout*')) ? 'mobile_hidden' : '' }}">
        <div class="container">
            <div  class="row d-flex align-items-center">
                <div class="better_logo col ">
                    <a href="{{url('/')}}"><img height="50"  src="{{asset('assets/images/Somonda_Logo_Black.png')}}" /> </a>
                </div>
            </div>
        </div>
    </header> -->
    <div id="form-loader" style="display: none;">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <div class="container">
        <main class="shadow rounded">
            <div class="text-center d-none d-sm-block">
                <h1 class="fs-2">@lang('checkout_title')</h1>
                <h2 class="fs-4 mt-3 text-muted">@lang('checkout_subtitle')</h2>
            </div>
            <div class="row mt-5 pt-sm-4 mt-5">
                <div class="col">
                    <h5 class="fw-bold mb-sm-4 p-sm-0 py-2 px-3">@lang('personal_information')</h5>
                    <div class="bg-white rounded-3 py-2 px-3 p-sm-4 shadow-lg me-sm-4">
                        <div class="row mt-4">
                                <div class="col-sm-12 text-left">
                                    <h4>@lang('3d_secure')</h4>
                                    <label class="mb-3">@lang('3d_secure_note')</label>
                                </div>
                            </div>
                            @if(Session::get('error'))
                                <div class="px-4 py-2 mb-3 bg-danger rounded">
                                    <p class="text-light">{{Session::get('error')}}</p>
                                </div>
                            @endif
                            <div id="payment-authentication">
                                <!-- Display a loading spinner or any other UI element while the authentication is being processed -->
                                <div id="loading-spinner">
                                    <!-- Loading spinner or custom message -->
                                </div>
                            </div>
                    </div>
                </div>
                <div class="col-auto">
                    <h5 class="fw-bold mb-4 d-none d-sm-block">@lang('your_order')</h5>
                    <div class="bg-white rounded-3 p-4" style="width:460px;max-width:100%;">

                        <div class="row align-items-center d-none d-sm-flex">
                            <div class="col-auto fw-bold py-2">@lang('premium')</div>
                            <div class="col text-end fw-bold">€65 @lang('30_days')</div>
                        </div>

                        <hr class="d-none d-sm-block">

                        <div class="row mt-sm-4 mb-0">
                            <div class="col">
                                <h5 class="fw-bold mb-0">@lang('to_pay_now')</h5>
                            </div>
                            <div class="col-auto">
                                <h4 class="fw-bold text-success text-decoration-underline mb-0">
                                        2.95€
                                </h4>
                            </div>
                        </div>
                        <div class="row d-none d-sm-block">
                            <div class="col text-muted">@lang('after_3days'):
                                €65
                            </div>
                        </div>
                        <hr class="d-none d-sm-block">

                        <div class="row d-none d-sm-flex">
                            <div class="col text-muted">
                                @lang('descriptor')
                            </div>
                            <div class="col text-muted text-end">
                            Plusdeal.fr
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <div class="text-center my-4">
            <img width="60" src="{{asset('images/visa_logo.png')}}" style="margin-right:14px;" />
            <img height="40" src="{{asset('images/mastercard_logo.png')}}"/>
            <p class="mt-4 text-black-50">@lang('checkout_description')</p>
            <span class="d-none d-sm-block">
                71-75 SHELTON STREET, COVENT GARDEN
LONDON WC2H 9JQ
            </span>
        </div>
    </div>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Create a Stripe instance
        var stripe = Stripe("{{ env('STRIPE_KEY') }}");
        var token = $("meta[name='csrf-token']").attr("content");
    
        stripe.confirmCardPayment("{{ $clientSecret }}").then(function(confirmResult) {
            if (confirmResult.error) {
                // Handle payment confirmation error
                console.error(confirmResult.error.message);
                $.ajax({
                    url: "/checkout/process/failed",
                    type: 'GET',
                    data: {
                        "user_id": "{{ $user_id }}",
                        "_token": token,
                    },

                    success: function(data) {
                        window.location.href = "{{ route('failed') }}";
                    },

                })
            } else {
                // Redirect to success page or perform further actions
                $.ajax({
                    url: "/membership_checkout/process/success",
                    type: 'GET',
                    data: {
                        "user_id": "{{ $user_id }}",
                        "code" : "{{ $code }}",
                        "user_status" : "{{ $user_status }}",
                        "payment_method" : "{{ $payment_method }}",
                        "_token": token,
                    },

                    success: function(data) {
                        window.location.href = "{{ route('thankyou') }}";
                    },
                })
            }
        });
    </script>

    <!-- <section class="copyright">
        <div class="container">
            <p class="text-center text-white">&copy; Copyright {{date('Y')}} somonda</p>
        </div>
    </section> -->

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="{{asset('js/slick.js')}}"></script>
    <script src="{{asset('js/wow.js')}}"></script>
    <script src="{{asset('js/scrollspy.js')}}"></script>
    <script src="{{asset('js/counter.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>
</body>
</html>