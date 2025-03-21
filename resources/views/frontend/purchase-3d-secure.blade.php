<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PlusDeal</title>
    <link rel="icon" type="image/png" href="{{asset('assets/images/plusdeal_logo.png')}}">

    <!--Bootstrap-->
    <link rel="stylesheet" href="{{asset('fr_checkout/bootstrap.min.css')}}">

    <!--Custom stylesheet-->
    <link rel="stylesheet" type="text/css" href="{{asset('fr_checkout/styles.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('fr_checkout/all.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('fr_checkout/intlTelInput.css')}}">
    <link rel="stylesheet" href="{{asset('fr_checkout/jquery.qtip.min.css')}}">
    <link rel="stylesheet" href="{{asset('fr_checkout/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('fr_checkout/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('fr_checkout/standardize.css')}}">
    <link rel="stylesheet" href="{{asset('fr_checkout/animate.css')}}">
    <link rel="stylesheet" href="{{asset('fr_checkout/index.css')}}">

    <script type="text/javascript" src="{{asset('fr_checkout/jquery.3.3.1.min.js')}}"></script>
    <script src="{{asset('fr_checkout/bootstrap.min.js')}}"></script>
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

    <style>
    .form-control {
        border-color: #ccc !important;
        border-radius: 10px;
    }
    </style>
</head>

<body class="body page-index" data-aos-easing="ease" data-aos-duration="400" data-aos-delay="0">
    <div class="overlay"></div>
    <section class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="phonesbox clearfix">
                        <div class="badge clearfix animated jackInTheBox text-white"
                            style="background: linear-gradient(#6AA4FD, #3974E4)!important;">
                            <p class="price">
                                <span class="sub-text">@lang('your_total')</span>
                                <span>
                                    @if(app()->getLocale() == 'sv')
                                        {{$data->se_wholesalePrice}} Kr
                                    @elseif(app()->getLocale() == 'no')
                                        {{$data->no_wholesalePrice}} Kr
                                    @else
                                        kr{{$data->wholesalePrice}}
                                    @endif
                                </span>
                            </p>
                        </div>
                        <ul class="bxslider" data-mode="fade" data-slide-margin="0" data-min-slides="1"
                            data-move-slides="1" data-pager="true" data-pager-custom="#bx-pager" data-controls="false">
                            <li class="phone green animated zoomIn active">
                                <!-- <img src="/fr_checkout/product.jpeg"> -->
                                @if($data->custom == 1)
                                <div class="image_inner">
                                    <img src="{{asset('uploads/products')}}/{{$data->image}}">
                                </div>
                                @else
                                <div class="image_inner">
                                    <img src="{{$data->image}}">
                                </div>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="main_lef text-center">
                        <p class="above-title">@lang('first_claim')</p>
                        <h2 class="py-0">
                            <span>PlusDeal</span>
                            // <small class="text-body">/ {{$product['name']}}</small>
                        </h2>
                        <!-- <p class="sub-title">Et puis il y en avait 13.</p> -->

                        <div class="expire-text mt-3">
                            <span class="mb-0">@lang('offer_expires') :</span>
                            <span id="countdown" style="font-weight:600;font-size:1.1rem">04 min and 05 sec</span>
                        </div>

                        <div class="column is-6 is-offset-3 alert-messages">
                        </div>
                        <!-- signup -->
                        <div class="formcontainer signup_form clearfix" id="scroll-form">
                            <hr class="invisible m-0" id="scroll">
                            <div class="column is-6 is-offset-3 p-body payment-form" style="display:none;">
                            </div>
                            <div class="info-form px-3">
                                <div class="row">
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
                                
                                <div class="row mt-3 p-2 terms-container">
                                    <div class="col-sm-12 cardbox">
                                        <h4 style="font-size: 14px;text-align: left;">@lang('pay_with_card')</h4>
                                        <div class="row mt-3">
                                            <div class="col-sm-3 col-xs-3">
                                                <img style="width:70%" src="{{asset('fr_checkout/maestro.png')}}">
                                            </div>
                                            <div class="col-sm-3 col-xs-3">
                                                <img style="width:70%" src="{{asset('fr_checkout/master_card.png')}}">
                                            </div>
                                            <div class="col-sm-3 col-xs-3">
                                                <img style="width:70%" src="{{asset('fr_checkout/visa.png')}}">
                                            </div>
                                            <div class="col-sm-3 col-xs-3">
                                                <img style="width:70%" src="{{asset('fr_checkout/visa2.png')}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="specs clearfix">
        <div class="specs_in clearfix">
            <div class="_14 clearfix">
                <p class="spec_ile"> <i class="fas fa-hand-holding-heart"></i></p>
                <p class="specs_fac">@lang('benefit_three')</p>
            </div>
            <div class="_14 clearfix">
                <p class="spec_ile"><i class="fas fa-circle-check"></i></p>
                <p class="specs_fac">@lang('benefit_two')</p>
            </div>
            
            <div class="_14l clearfix">
                <p class="spec_ile spec_ile-4"><i class="fas fa-truck-fast"></i></p>
                <p class="specs_fac">@lang('in_stock_delivery')</p>
            </div>
        </div>
    </div>

    <section>
        <div class="container  text-center">
            <div class="row">
                @if($data->images)
                @foreach(unserialize($data->images) as $key=>$image)
                    <div class="col-md-2">
                    @if($data->custom == 1)
                    <div class="image_inner">
                        <img src="{{asset('uploads/products')}}/{{$image}}" >
                    </div>
                    @else
                    <div class="image_inner">
                        <img src="{{$image}}">
                    </div>
                    @endif
                    </div>
                @endforeach
                @endif
            </div>
        </div>
    </section>
    <style>
        .steps-section {
            background-color: #f8f9fa;
            color: black;
        }

        .svg-icons {
            background-size: contain;
            margin: .5rem auto;
            font-size: 25px;
            font-weight: bold;
            height: 70px;
            width: 70px;
            text-align: center;
            opacity: 0.7;
            filter: invert(100%) sepia(0%) saturate(1%) hue-rotate(63deg) brightness(103%) contrast(101%);
        }

        .svg-icons.giftcard {
            background-image: url(/fr_checkout/gift_card.png);
        }

        .svg-icons.prize {
            background-image: url(/fr_checkout/price.png);
        }

        .svg-icons.discount {
            background-image: url(/fr_checkout/discount.png);
        }

        .bubble-icon {
            width: 100px;
            height: 100px;
            background: rgb(0 0 0 / 20%);
            margin: 0 auto;
            border-radius: 25%;
            margin-bottom: 30px;
            padding-top: 10px;
        }
    </style>

    <section class="py-5 steps-section">
        <div class="container py-5">
            <h2 class="text-uppercase text-center pb-5">@lang('how_registration_works')</h2>
            <div class="row mt-5">
                <div class="col-md-4 text-center text-inline aos-init" data-aos="slide-up" data-aos-duration="750">
                    <div class="bubble-icon">
                        <div class="svg-icons giftcard"></div>
                    </div>
                    <p class="text-uppercase" style="font-size: 20px; margin-bottom: 20px;">
                        <b>@lang('registration_step_1')</b>
                    </p>
                    <p style="font-size: 16px; max-width: 250px; margin: auto">@lang('registration_step_1_description')</p>
                </div>
                <div class="col-md-4 text-center text-inline aos-init" data-aos="slide-up" data-aos-duration="1500">
                    <div class="bubble-icon">
                        <div class="svg-icons prize"></div>
                    </div>
                    <p class="text-uppercase" style="font-size: 20px; margin-bottom: 20px;">
                        <b>@lang('registration_step_2')</b>
                    </p>
                    <p style="font-size: 16px; max-width: 250px; margin: auto"> @lang('registration_step_2_description') {{$product['name']}}.</p>
                </div>
                <div class="col-md-4 text-center text-inline aos-init" data-aos="slide-up" data-aos-duration="2250">
                    <div class="bubble-icon">
                        <div class="svg-icons discount"></div>
                    </div>
                    <p class="text-uppercase" style="font-size: 20px; margin-bottom: 20px;">
                        <b>@lang('registration_step_3')</b>
                    </p>
                    <p style="font-size: 16px; max-width: 250px; margin: auto">
                         @lang('registration_step_3_description') </p>
                </div>
            </div>
        </div>
    </section>
    <section class="my-5 container aos-init" data-aos="zoom-in">
        <div class="container py-5 text-center">
            <h2 class="text-uppercase">@lang('about_reading_experience')</h2>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <img class="img-fluid" src="/fr_checkout/shopping.jpg" loading="lazy" width="800px" alt="shopping">
                </div>
            </div>
        </div>
    </section>
    <section class="my-5 py-5 all-media aos-init" data-aos="zoom-in">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-12">
                    <h3 class="mb-5">
                        <b>@lang('discover_reading')</b>
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3 p-3">
                    <h5 class="mb-3">
                        <i class="fas fa-heart"></i>
                        <b>@lang('discover_reading_1')</b>
                    </h5>
                    <p>@lang('discover_reading_1_description')</p>
                </div>
                <div class="col-md-4 mb-3 p-3">
                    <h5 class="mb-3">
                        <i class="fas fa-search"></i>
                        <b>@lang('discover_reading_2')</b>
                    </h5>
                    <p>@lang('discover_reading_2_description')</p>
                </div>
                <div class="col-md-4 mb-3 p-3">
                    <h5 class="mb-3">
                        <i class="far fa-star"></i>
                        <b>@lang('discover_reading_3')</b>
                    </h5>
                    <p>@lang('discover_reading_3_description')</p>
                </div>
                <div class="col-md-4 mb-3 p-3">
                    <h5 class="mb-3">
                        <i class="fas fa-check"></i>
                        <b>@lang('discover_reading_4')</b>
                    </h5>
                    <p>@lang('discover_reading_4_description')</p>
                </div>
            </div>
        </div>
    </section>
    <div style="color: white;background-color: #595BFF">
        <div class="container">
            <div class="row py-5 align-items-center">
                <div class="col-12 col-md-12 text-center">
                    <h2>&copy; {{date('Y')}} PlusDeal. All Rights Reserved</h2>
                    <p class="mb-0 pt-2 small">
                         @lang('purchase_footer')
                    </p>
                </div>

                <div class="col-md-12 mt-4 mt-md-4 text-center">
                    <img src="/fr_checkout/cards.png" width="100%" style="max-width: 150px">
                </div>
            </div>
        </div>
    </div>

    <!-- <script src="{{asset('fr_checkout/aos.js')}}"></script> -->
    <script>
    $('html, body').animate({
        scrollTop: $('#scroll-form').offset().top
    }, 100);

    // AOS.init();

    function startTimer(duration, display) {
        var timer = duration,
            minutes,
            seconds;
        setInterval(function() {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + " min and " + seconds + " sec";

            if (--timer < 0) {
                timer = duration;
            }
        }, 1000);
    }

    window.onload = function() {
        var fiveMinutes = 60 * 5,
            display = document.querySelector("#countdown");
        startTimer(fiveMinutes, display);
    };
    </script>
 
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
                    url: "/purchase_checkout/process/success",
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
</body>

</html>