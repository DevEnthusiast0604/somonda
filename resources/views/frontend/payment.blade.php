@extends('layouts.frontend')
@section('content')
<section class="cart"><!-- start .cart -->
    <div class="container">
        <div class="cart-area py-5">
            <div class="row">
                <div class="col-lg-7">
                    <div class="cart-form">
                        <h4>@lang('payment_information')</h4>
                        @if(Session::get('error'))
                            <div class="px-4 py-2 mb-3 bg-danger rounded">
                                <p class="text-light">{{Session::get('error')}}</p>
                            </div>
                        @endif
                        <form action="{{ route('checkout.process') }}" id="payment-form" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="card-paymnet-form my-3">
                                    <div id="card-element"></div>
                                </div>
                                <div id="card-form-error" class="text-danger"></div>
                             </div>
                            @if(session()->get('landing') != 1)
                            <div class="form-check clearfix mt-3">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault_term" required>
                                <label class="form-check-label" for="flexCheckDefault_term">
                                    @lang('terms')
                                </label>
                            </div>
                            @endif
                            <button type="submit" id="submit-button" @if(Cart::getTotal() == 0) disabled @endif>@lang('complete')</button>
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
                                            <span class="px-3">{{$row->attributes->se_price}} kr</span>
                                            @elseif(app()->getLocale() == 'no')
                                            <span class="px-3">{{$row->attributes->se_price}} kr</span>
                                            @else
                                            <span class="px-3">{{$row->price}} kr</span>
                                            @endif
                                            <span>Quantity: {{$row->quantity}}</span>
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
                                <span class="text-end">0 kr</span>
                                @else
                                <span class="text-end">0 kr</span>
                                @endif
                            </div>
                            <div class="bottom">
                                <span>@lang('total')</span>  
                                @if(app()->getLocale() == 'sv')
                                <span class="text-end">{{ getseTotal() }} kr</span>
                                @elseif(app()->getLocale() == 'no')
                                <span class="text-end">{{ getnoTotal() }} kr</span>
                                @else
                                <span class="text-end">{{ Cart::getTotal()}} kr</span>
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
                                            <h5>On your bill, charges may appear as</h5>
                                            <ul>
                                                <li> somonda.com 4402895813060</li>
                                                <li> trial*somonda.com 4402895813060</li>
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

<script src="https://js.stripe.com/v3/"></script>
<script>
    // Create a Stripe instance
    var stripe = Stripe("{{ env('STRIPE_KEY') }}");

    // Create an instance of Elements
    var elements = stripe.elements();

    // Create a card Element and mount it to the card element placeholder
    var card = elements.create('card');
    card.mount('#card-element');

    // Handle real-time validation errors on the card Element
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
        document.getElementById('submit-button').disabled = true;

        // Create a payment method using the card Element
        stripe.createPaymentMethod({
            type: 'card',
            card: card,
        }).then(function (result) {
            if (result.error) {
                // Display error message to the user
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;

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
@endsection