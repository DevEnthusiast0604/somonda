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
    <script>function sclClickPixelFn() {const url = new URL(document.location.href).searchParams;if (url.get('a')) {const availableParams = ['aff_click_id','sub_id1','sub_id2','sub_id3','sub_id4','sub_id5','aff_param1','aff_param2','aff_param3','aff_param4','aff_param5','idfa','gaid'];const t = new URL('https://nordictraffic.scaletrk.com/click');const r = t.searchParams;r.append('a', url.get('a'));r.append('o', '1');r.append('return', 'click_id');if (availableParams?.length > 0) {availableParams.forEach((key) => {const value = url.get(key);if (value) {r.append(key, value);}});}fetch(t.href).then((e) => e.json()).then((e) => {const c = e.click_id;if (c) {const expiration = 864e5 * 365;const o = new Date(Date.now() + expiration);document.cookie = 'click_id=' + c + ';expires=' + o;}});}}sclClickPixelFn();</script>
</head>
<body class="hompage">
    <div id="support">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col">
                    <h5>Need help? Contact us for everything from plans to refunds</h5>
                </div>
                <div class="col-12 col-md-auto">
                    <a href="mailto:support@somonda.com">support@somonda.com</a>
                </div>
            </div>
        </div>
    </div>
    <!-- <header>
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
            <form action="{{route('membership.checkout')}}" method="post" enctype="multipart/form-data" id="payment-form">
                @csrf
                <div class="text-center d-none d-sm-block">
                    <h1 class="fs-2">@lang('checkout_title')</h1>
                    <h2 class="fs-4 mt-3 text-muted">@lang('checkout_subtitle')</h2>
                </div>
                <div class="row mt-5 pt-sm-4 mt-5">
                    <div class="col">
                        <h5 class="fw-bold mb-sm-4 p-sm-0 py-2 px-3">@lang('personal_information')</h5>
                        <div class="bg-white rounded-3 py-2 px-3 p-sm-4 shadow-lg me-sm-4">
                            <div class="row mt-4">
                                @if(Session::get('error'))
                                <div class="col-12 py-2 mb-3 bg-danger rounded">
                                    <p class="text-light">{{Session::get('error')}}</p>
                                </div>
                                @endif
                                <div class="col-12 col-md">
                                    <label for="card-holder-name" class="form-label">@lang('card_holder_name') <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="card-holder-name" class="form-control border-2" value="" placeholder="@lang('enter_name')" required>
                                </div>
                                <div class="col-12">
                                    <label for="input_email" class="form-label  mt-3">@lang('email_address') <span class="text-danger">*</span></label>
                                    <input type="email" name="email" id="input_email" class="form-control border-2" placeholder="@lang('enter_email')" value="" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <h5 class="fw-bold mb-4 d-none d-sm-block">@lang('your_order')</h5>
                        <div class="bg-white rounded-3 p-4" style="width:460px;max-width:100%;">

                            <div class="row align-items-center d-none d-sm-flex">
                                <div class="col-auto fw-bold py-2">@lang('premium')</div>
                                <div class="col text-end fw-bold">kr65 @lang('30_days')</div>
                            </div>

                            <hr class="d-none d-sm-block">

                            <div class="row mt-sm-4 mb-0">
                                <div class="col">
                                    <h5 class="fw-bold mb-0">@lang('to_pay_now')</h5>
                                </div>
                                <div class="col-auto">
                                    <h4 class="fw-bold text-success text-decoration-underline mb-0">
                                         2.95kr
                                    </h4>
                                </div>
                            </div>
                            <div class="row d-none d-sm-block">
                                <div class="col text-muted">@lang('after_3days'):
                                    kr65
                                </div>
                            </div>
                            <hr class="d-none d-sm-block">

                            <div class="row d-none d-sm-flex">
                                <div class="col text-muted">
                                    @lang('descriptor')
                                </div>
                                <div class="col text-muted text-end">
                                somonda.com
                                </div>
                            </div>
                            <div class="card-paymnet-form">
                                <label class="mb-3">@lang('credit_card_details')</label>
                                <div id="card-element"></div>
                            </div>
                            <div id="card-form-error" class="text-danger"></div>

                            <label class="mt-4">
                                <input type="checkbox" name="terms" class="me-2" />@lang('accept') @lang('checkout_terms')<a href="{{route('terms')}}" target="_blank" class="text-body"><span class="text-danger"> *</a> </span>
                            </label>
                            <button type="submit" id="submit-button" class="btn btn-success btn-lg d-block w-100 text-bold mt-4 fs-4 text-uppercase" style="text-align:middle;">@lang('pay_now') ddd</button>
                        </div>
                    </div>
                </div>
            </form>
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
    
    <script src="https://parsleyjs.org/dist/parsley.js"></script>
    <script src="https://js.stripe.com/v3/"></script>

    <script>
    var style = {
        hidePostalCode: true,
        base: {
            color: '#32325d',
            lineHeight: '18px',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };


    const stripe = Stripe('pk_test_51Ol8uxLBmktPUwsVqDMj5QMCJMEYRxd91NADJQjSxCkX0GFKYe5osqxWI5m37qiVqJP5n8fx632ltsbQYoPD1tTi007oTuLGft', {
        locale: 'en'
    }); // Create a Stripe client.

    const elements = stripe.elements(); // Create an instance of Elements.

    const card = elements.create('card', {
        style: style
    }); // Create an instance of the card Element.


    card.mount('#card-element'); // Add an instance of the card Element into the `card-element` <div>.


    card.addEventListener('change', function (event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });


   // Handle form submission
   var form = document.getElementById('payment-form');
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        // Disable the submit button to prevent multiple submissions
       // document.getElementById('submit-button').disabled = true;

        // Create a payment method using the card Element
        stripe.createPaymentMethod({
            type: 'card',
            card: card,
            mode : "sandbox",
        }).then(function (result) {
            if (result.error) {
                // Display error message to the user
                var errorElement = document.getElementById('card-errors');
                errorElement.textpayment_methodsontent = result.error.message;

                // Enable the submit button
                document.getElementById('submit-button').disabled = false;
            } else {
                // Add the payment method to the form and submit
                var paymentMethodInput = document.createElement('input');
                paymentMethodInput.setAttribute('type', 'hidden');
                paymentMethodInput.setAttribute('name', 'payment_method');
                paymentMethodInput.setAttribute('value', result.paymentMethod.id);
                form.appendChild(paymentMethodInput);
                form.submit();
            }
        });
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