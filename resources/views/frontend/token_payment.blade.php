@extends('layouts.frontend')
@section('content')
<section class="cart"><!-- start .cart -->
    <div class="container">
        <div class="cart-area py-5">
            <div class="row">
                <div class="col-lg-7">
                    <div class="cart-form">
                        <h4>@lang('payment_information')</h4>
                        <form action="{{ route('process.payment') }}" id="payment-form" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="card-paymnet-form my-3">
                                    <div id="card-element"></div>
                                </div>
                                <div id="card-form-error" class="text-danger"></div>
                                <input type="hidden" name="pmkey" id="329r2j9id29hj39" />

                            </div>
                            @if(session()->get('landing') != 1)
                            <div class="form-check clearfix mt-3">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault_term" required>
                                <label class="form-check-label" for="flexCheckDefault_term">
                                    @lang('terms')
                                </label>
                            </div>
                            @endif
                            <button type="submit" @if(Cart::getTotal() == 0) disabled @endif>@lang('complete')</button>
                            <div class="row mt-3 text-center">
                                <a class="return" href="{{route('checkout')}}">@lang('return')</a>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center m-auto">
                                    <div class="d-flex justify-content-center my-2">
                                    <img src="{{asset('assets/images/card.png')}}" width="180" alt="">
                                    </div>
                                 
                                    <label>@lang('payment_letter') <br>
                                       <!-- <strong>71-75 SHELTON STREET, COVENT GARDEN
LONDON WC2H 9JQ | Rebel Monkey Marketing Ltd Co no. 14009110</strong> -->
                                        
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-1">
                    <div class="cart-form">
                        <h4>@lang('order_overview')</h4>
                        <div class="cart-view bg-white">
                            <div class="top">
                                @foreach ($cartItems as $row)
                                <div class="item mb-2">
                                    <div class="d-flex">
                                        <figure>
                                            @if(product_type($row->id) == 1)
                                            <img src="{{asset('uploads/products')}}/{{$row->attributes->image}}" class="rounded" width="100" alt="">
                                            @else
                                            <img src="{{$row->attributes->image}}" class="rounded" width="100" alt="">
                                            @endif
                                        </figure>
                                        <div class="px-3">
                                            <h5 class="px-3">{{$row->name}}</h5>
                                            @if(app()->getLocale() == 'sv')
                                            <span class="px-3">{{ $row->attributes->se_price }} €</span>
                                            @elseif(app()->getLocale() == 'no')
                                            <span class="px-3">{{ $row->attributes->se_price }} €</span>
                                            @else
                                            <span class="px-3">€ {{$row->price}}</span>
                                            @endif
                                            <span>@lang('Quantity'): {{$row->quantity}}</span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @if(Cart::getTotal() == 0)
                                <div class="buy-btn">
                                    <a class="text-center" href="{{url('/')}}"><i class="ft-shopping-cart"></i> @lang('add_product')</a>
                                </div>
                                @endif
                                
                            </div>
                      
                            <hr>
                            <div class="bottom">
                                <span>@lang('delivery')</span>  
                                @if(app()->getLocale() == 'sv')
                                <span class="text-end">0 €</span>
                                @elseif(app()->getLocale() == 'no')
                                <span class="text-end">0 €</span>
                                @else
                                <span class="text-end">€ 0</span>
                                @endif
                            </div>
                            <div class="bottom">
                                <span>@lang('total')</span>  
                                @if(app()->getLocale() == 'sv')
                                <span class="text-end">{{ getseTotal() }} €</span>
                                @elseif(app()->getLocale() == 'no')
                                <span class="text-end">{{ getnoTotal() }} €</span>
                                @else
                                <span class="text-end">€ {{ Cart::getTotal()}}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="cart-form">
                        <h4>@lang('Charges identification')</h4>
                        <div class="cart-view bg-white">
                            <div class="top">
                                <div class="item">
                                    <div class="d-flex">
                                        <div class="px-3">
                                            <h5>@lang('On your bill, charges may appear as')</h5>
                                            <ul>
                                                <li> plusdeal.fr 4402895813060</li>
                                                <li> trial*plusdeal.fr 4402895813060</li>
                                            </ul>
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
        const stripe = Stripe(pk_test_51Ol8uxLBmktPUwsVqDMj5QMCJMEYRxd91NADJQjSxCkX0GFKYe5osqxWI5m37qiVqJP5n8fx632ltsbQYoPD1tTi007oTuLGft', { locale: 'en'}); 

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