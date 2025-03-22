@extends('layouts.frontend')
@section('content')
<section class="cart mb-5">
    <!-- start .cart -->
    <div class="container">
        <div class="heading">
            <h1 class="heading-style text-center">@lang('your_basket')</h1>
        </div>
        <div>
            @if ($message = Session::get('success'))
                <div class="px-4 py-2 mb-3 custom-alert rounded">
                    <p class="text-green-800">@lang($message)</p>
                </div>
            @endif
        </div>
        <div class="cart-area">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card mb-3">
                        <div class="backgeound-card p-3">
                            <div class="row">
                                <div class="col-md-6 col-4">
                                    <p class="design-heading">@lang('product')</p> 
                                </div>
                                <div class="col-md-3 col-4">
                                    <p class="design-heading">@lang('number')</p> 
                                </div>
                                <div class="col-md-3 col-4 text-center">
                                    <p class="design-heading">@lang('total')</p> 
                                </div>
                            </div>
                        </div>
                        <div class="container p-3">
                            @foreach ($cartItems as $row)
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="row d-flex product-wrap">
                                        <div class="col-4">
                                            <figure>
                                                @if(product_type($row->id) == 1)
                                                <img src="{{asset('uploads/products')}}/{{$row->attributes->image}}"   alt="">
                                                @else
                                                <img src="{{$row->attributes->image}}" class="rounded"  alt="">
                                                @endif
                                            </figure>
                                            
                                         </div>
                                        <div class="col-8">
                                            <div class="element--hide-on-small">
                                                <span class="visually-hidden">@lang('membership_price')</span>
                                                <span>
                                                @if(app()->getLocale() == 'sv')
                                                    {{$row->attributes->se_price}} €
                                                @elseif(app()->getLocale() == 'no')
                                                    {{$row->attributes->no_price}} €
                                                @else
                                                    € {{$row->price}}
                                                @endif
                                                </span>
                                                <span class="visually-hidden">@lang('normal_price')</span>
                                                <span class="light-text">
                                                    <del>
                                                        @if(app()->getLocale() == 'sv')
                                                        <span class="text-end">{{ $row->attributes->se_normal_price }} €</span>
                                                        @elseif(app()->getLocale() == 'no')
                                                        <span class="text-end">{{ $row->attributes->se_normal_price }} €</span>
                                                        @else
                                                        <span class="text-end">kr {{ $row->attributes->normal_price }}</span>
                                                        @endif
                                                    </del>
                                                </span>
                                            </div>
                                            <a href="#" class="cart-item__title">
                                                <span class="text-animation--underline-thin">{{$row->name}}</span>
                                            </a><br>
                                           
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6 pt-3">
                                    <div class="d-flex">
                                        <div class="d-flex qtySelector qtySelector_cart">
                                            <button class="decreaseQty">-</button>
                                            <input type="text" value="{{$row->quantity}}" min="0" class="qtyValue">
                                            <button class="increaseQty">+</button>
                                        </div>
                                        <a href="#" class="cart-item__title style-an mx-2">
                                            <form action="{{ route('cart.remove') }}" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{ $row->id }}" name="id">
                                                <button class="ms-auto remove-btn">
                                                    <i class="ft-trash-2 text-danger" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6 text-center pt-3">
                                    <div class="element--hide-on-small">
                                        <span class="visually-hidden">@lang('membership_price')</span>
                                        <h4>
                                            @if(app()->getLocale() == 'sv')
                                            <span class="text-end">{{  $row->quantity * $row->attributes->se_price }} €</span>
                                            @elseif(app()->getLocale() == 'no')
                                            <span class="text-end">{{ $row->quantity * $row->attributes->no_price }} €</span>
                                            @else
                                            <span class="text-end"> kr {{ $row->price * $row->quantity }}</span>
                                            @endif
                                        </h4>
                                        <span class="visually-hidden">@lang('normal_price')</span>
                                        <span class="light-text">
                                            <del>
                                                @if(app()->getLocale() == 'sv')
                                                <span class="text-end">{{  $row->quantity * $row->attributes->se_normal_price  }} €</span>
                                                @elseif(app()->getLocale() == 'no')
                                                <span class="text-end">{{ $row->quantity * $row->attributes->no_normal_price }} €</span>
                                                @else
                                                <span class="text-end">€ {{ $row->attributes->normal_price * $row->quantity }}</span>
                                                @endif
                                            </del>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                     </div>
                </div>
                <div class="col-lg-4">
                    <div class="card p-3 py-4">
                        <span class="mb-1">
                            @lang('You are eligible for free shipping!')
                        </span>
                        <hr class="m-0 hr-class">
                    </div>
                    
                    <div class="buy-product-box bg-white mt-3">
                        <div class="total">
                            <p>
                                <span>@lang('total')</span>
                                @if(app()->getLocale() == 'sv')
                                <span class="text-end">{{ getseTotal() }} €</span>
                                @elseif(app()->getLocale() == 'no')
                                    <span class="text-end">{{ getnoTotal() }} €</span>
                                @else
                                <span class="text-end">€ {{ number_format((Cart::getTotal()), 2) }}</span>
                                @endif
                            </p>
                        </div>

                        <div class="buy-btn">
                            @if(Cart::getTotal() == 0)
                            <a class="text-center" href="{{url('/')}}"><i class="ft-shopping-cart"></i><span style="padding-left: 0.4em"> @lang('add_product')</span></a>
                            @else
                            <a class="text-center" href="{{route('checkout')}}">@lang('checkout')</a>
                            @endif
                        </div>

                        <ul>
                            <li>@lang('benefit_one')</li>
                            <li>@lang('benefit_two')</li>
                            <li>@lang('benefit_three')</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- //end .cart -->
@endsection