@extends('layouts.frontend')
@section('content')
<section class="cart">
    <!-- start .cart -->
    <div class="container">
        <div class="cart-area py-5">
            <div class="row">
                <div class="col-lg-7">
                    <div class="cart-form">
                        <h4>@lang('payment_information')</h4>
                        @if (\Session::has('success'))
                        <div class="alert alert-fill alert-success alert-dismissible fade show" role="alert">
                             <strong>Success</strong> {{ \Session::get('success')}}   
                             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @elseif (\Session::has('error'))
                        <div class="alert alert-fill alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error</strong> {{ \Session::get('error')}}  
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                         
                        <form action="" id="payment-form" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="name"   placeholder="@lang('Enter your full name')" required>
                                </div>
                                <div class="col-md-12">
                                    <input type="email" class="form-control" name="email" placeholder="@lang('Enter your email address')" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="card-paymnet-form my-3">
                                    <div id="card-element"></div>
                                </div>
                                <div id="card-form-error" class="text-danger"></div>
                                <input type="hidden" name="pmkey" id="329r2j9id29hj39" />

                            </div>
                            <div class="form-check clearfix mt-3">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault_term"
                                    required>
                                <label class="form-check-label" for="flexCheckDefault_term">
                                    @lang('terms')
                                </label>
                            </div>
                            <button type="submit">@lang('Register')</button>
                            
                            <div class="text-center mt-4 mb-2">
                                <span>@lang('If You already have an account,') <a href="{{route('login')}}" style="color: #1c75bc;font-weight: 600;">@lang('Login now')</a></span>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center m-auto">
                                    <div class="d-flex justify-content-center my-2">
                                        <img src="{{asset('assets/images/card.png')}}" width="180" alt="">
                                    </div>

                                    <label>@lang('payment_letter') <br>
                                        <strong>128 City Road LONDON EC1V 2NX | CC EUROPE LTD Co no.
                                        15652312</strong>
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php 
                    $sek_rate = Currency::convert()->from('EUR')->to('SEK')->get();
                    $nok_rate = Currency::convert()->from('EUR')->to('NOK')->get();
                ?>
                <div class="col-lg-4 offset-lg-1">
                    <div class="cart-form">
                        <h4>@lang('pluszeit_membership')</h4>
                        <div class="cart-view bg-white">
                            <div class="top">
                                <div class="item">
                                    <div class="d-flex">
                                        <figure>
                                            <img src="{{asset('assets/images/bag.png')}}" alt="">
                                        </figure>
                                        <div class="px-3 pt-2">
                                            <h5 class="px-3">@lang('membership')</h5>
                                            @if(app()->getLocale() == 'sv')
                                            <span class="px-3">{{number_format($sek_rate * 19.95)}} € / Mo</span>
                                            @elseif(app()->getLocale() == 'no')
                                            <span class="px-3">{{number_format($nok_rate * 19.95)}} € / Mo</span>
                                            @else
                                            <span class="px-3">€ 19.95 / Mo</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bottom_benefit">
                                <span>@lang('membership_benefit') <a href="{{route('terms')}}" style="color: #1c75bc;font-weight: 600;">@lang('here')</a></span>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- //end .cart -->

<script src="https://parsleyjs.org/dist/parsley.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
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

// Create a Stripe client.  
const stripe = Stripe(
    pk_test_51Ol8uxLBmktPUwsVqDMj5QMCJMEYRxd91NADJQjSxCkX0GFKYe5osqxWI5m37qiVqJP5n8fx632ltsbQYoPD1tTi007oTuLGft', {
        locale: 'en'
    });

const elements = stripe.elements(); // Create an instance of Elements.
const card = elements.create('card', {
    style: style
}); // Create an instance of the card Element.

card.mount('#card-element'); // Add an instance of the card Element into the `card-element` <div>.

card.on('change', function(event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
});

// Handle form submission.
var form = document.getElementById('payment-form');

form.addEventListener('submit', function(event) {
    event.preventDefault();
    stripe.createToken(card).then(function(result) {
        if (result.error) {
            // Inform the user if there was an error.
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
        } else {
            // Send the token to your server.
            // document.getElementById('form-loader').style.display = 'flex';
            $('#status').fadeOut();
            $('#status').css("display", "block");
            $('#preloader').css("display", "block");
            stripeTokenHandler(result.token);
        }
    });
});


// Submit the form with the token ID.

function stripeTokenHandler(token) {

    // Insert the token ID into the form so it gets submitted to the server
    var form = document.getElementById('payment-form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);


    // Submit the form

    form.submit();

}
</script>
@endsection