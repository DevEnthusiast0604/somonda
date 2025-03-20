@extends('layouts.frontend')
@section('content')
<section class="cart"><!-- start .cart -->
    <div class="container">
        <div class="cart-area py-5">
            <div class="row">
                <div class="col-lg-7">
                    <div class="cart-form">
                        <h4>@lang('3d_secure')</h4>
                        <p>@lang('3d_secure_note')</p>
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
                                            <span class="px-3">{{$row->attributes->no_price}} kr</span>
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
                url: "/checkout/process/success",
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
@endsection