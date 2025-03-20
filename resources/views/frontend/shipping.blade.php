@extends('layouts.frontend_checkout')
@section('content')
<!-- start #wrapper -->
<div id="wrapper" class="checkout_page">
    <section id="checkout_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="infor_left_wrapper">
                        <div class="logo">
                            <img src="{{asset('assets/images/Somonda_Logo_Black.png')}}" alt="Logo">
                        </div>
                        <div class="mobile_cart_wrapper mb-3">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <div type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                            aria-expanded="false" aria-controls="flush-collapseOne"
                                            class="d-flex align-items-center justify-content-between accordion-button collapsed">
                                            <p><span style="padding-right: 0.4em"><i class="ft-shopping-cart" aria-hidden="true"></i></span> 
                                                @lang('show_order_summary')
                                            </p>
                                            <p>
                                            @if(app()->getLocale() == 'sv')
                                            <span class="text-end">{{ getseTotal() }} kr</span>
                                            @elseif(app()->getLocale() == 'no')
                                            <span class="text-end">{{ getnoTotal() }} kr</span>
                                            @else
                                            <span class="text-end">{{ Cart::getTotal() }} kr</span>
                                            @endif
                                            </p>
                                        </div>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <div id="payment_table_wrapper" class="mt-3">
                                                @foreach ($cartItems as $row)
                                                <div class="top_info">
                                                    <div class="product_info_wrapper d-flex align-items-center">
                                                        <div class="product_img_wrapper" style="margin-right: 20px;">
                                                            @if(product_type($row->id) == 1)
                                                            <img src="{{asset('uploads/products')}}/{{$row->attributes->image}}" alt="">
                                                            @else
                                                            <img src="{{$row->attributes->image}}" alt="">
                                                            @endif
                                                            <div class="count_product">{{$row->quantity}}</div>
                                                        </div>
                                                        <div class="product_name_wrapper">
                                                            <p>{{$row->name}}</p>
                                                            <!-- <p class="sub--title">140x200 / Darkgrey</p> -->
                                                        </div>
                                                    </div>
                                                    <div class="product_amount">
                                                        <p>
                                                            @if(app()->getLocale() == 'sv')
                                                            <span class="px-3">{{$row->attributes->se_price}} kr</span>
                                                            @elseif(app()->getLocale() == 'no')
                                                            <span class="px-3">{{$row->attributes->no_price}} kr</span>
                                                            @else
                                                            <span class="px-3">{{$row->price}} kr</span>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                                @endforeach
                                                <div class="promo_wrapper my-3">
                                                    <div class="row">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <input type="text" placeholder="@lang('promotion_code')"
                                                                class="form-control">
                                                            <button class="btn btn-secondary disabled"
                                                                id="promo_btn">@lang('use')</button>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="subTotal_wrapper d-flex align-items-center justify-content-between my-3">
                                                        <p>@lang('subtotal')</p>
                                                        <p>
                                                            @if(app()->getLocale() == 'sv')
                                                            <span class="text-end">{{ getseTotal() }} kr</span>
                                                            @elseif(app()->getLocale() == 'no')
                                                            <span class="text-end">{{ getnoTotal() }} kr</span>
                                                            @else
                                                            <span class="text-end">{{ Cart::getTotal() }} kr</span>
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="delivery_wrapper d-flex align-items-center justify-content-between my-3">
                                                        <p>@lang('delivery')</p>
                                                        <p>
                                                            @if(app()->getLocale() == 'sv' || app()->getLocale() == 'no')
                                                            <span class="text-end">0 kr</span>
                                                            @else
                                                            <span class="text-end">0 kr</span>
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="total_wrapper d-flex align-items-center justify-content-between my-3">
                                                        <div class="total_text">
                                                            <p>@lang('total')</p>
                                                            <p style="font-size: 12px;">@lang('including_free_delivery')</p>
                                                        </div>
                                                        <p>
                                                            @if(app()->getLocale() == 'sv')
                                                            <span class="text-end">{{ getseTotal() }} kr</span>
                                                            @elseif(app()->getLocale() == 'no')
                                                            <span class="text-end">{{getnoTotal()}} kr</span>
                                                            @else
                                                            <span class="text-end">{{ Cart::getTotal() }} kr</span>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="breadcrumb justify-content-center mb-5">
                            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                                aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active"><a href="{{route('cart.list')}}">@lang('your_basket')</a></li>
                                    <li class="breadcrumb-item active"><a href="{{route('checkout')}}">@lang('checkout')</a></li>
                                    <li class="breadcrumb-item" aria-current="page">@lang('delivery')</li>
                                    <li class="breadcrumb-item active" aria-current="page">@lang('payment')</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="form_wrapper">
                            <div class="delivery_card card">
                                <div class="col-md-12 delivery_contact">
                                    <h4 class="delivery_title">@lang('contact')</h4>
                                    <span>{{session()->get('email')}}</span>
                                    <a class="delivery_link" href="{{route('checkout')}}">@lang('edit')</a>
                                </div>
                                <hr>
                                <div class="col-md-12 delivery_ship">
                                    <h4 class="delivery_title">@lang('ship_to')</h4>
                                    <span>{{session()->get('address')}}, {{session()->get('zipcode')}}, {{session()->get('city')}}, {{session()->get('country')}} </span>
                                    <a class="delivery_link" href="{{route('checkout')}}">@lang('edit')</a>
                                </div>
                            </div>
                            <div class="col-lg-12 delivery_action">
                                <a href="{{route('checkout')}}"><i class="ft-arrow-left"></i> @lang('back_information')</a>
                                <a id="proceed_btn" href="{{route('payment')}}" @if(Cart::getTotal() == 0) disabled @endif>@lang('proceed_payment')</a>
                            </div>
                             
                        </div>
                        <div class="bottom_links_wrapper">
                            <ul>
                                <li><a href="{{route('faq')}}">@lang('faqs')</a></li>
                                <li><a href="{{route('terms')}}">@lang('terms_and_conditions')</a></li>
                                <li><a href="{{route('privacy')}}">@lang('privacy_policy')</a></li>
                                <li><a href="{{route('contact')}}">@lang('contact_us')</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="infor_right_wrapper">
                        <div id="payment_table_wrapper">
                            @foreach ($cartItems as $row)
                            <div class="top_info">
                                <div class="product_info_wrapper d-flex align-items-center">
                                    <div class="product_img_wrapper" style="margin-right: 20px;">
                                        @if(product_type($row->id) == 1)
                                        <img src="{{asset('uploads/products')}}/{{$row->attributes->image}}" alt="">
                                        @else
                                        <img src="{{$row->attributes->image}}" alt="">
                                        @endif
                                        <div class="count_product">{{$row->quantity}}</div>
                                    </div>
                                    <div class="product_name_wrapper">
                                        <p>{{$row->name}}</p>
                                        <!-- <p class="sub--title">140x200 / Darkgrey</p> -->
                                    </div>
                                </div>
                                <div class="product_amount">
                                    @if(app()->getLocale() == 'sv')
                                    <p>{{$row->attributes->se_price}} kr</p>
                                    @elseif(app()->getLocale() == 'no')
                                    <p>{{$row->attributes->no_price}} kr</p>
                                    @else
                                    <p>{{$row->price}} kr</p>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                            <div class="promo_wrapper my-3">
                                <div class="row">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <input type="text" placeholder="@lang('promotion_code')" class="form-control">
                                        <button class="btn btn-secondary disabled" id="promo_btn">@lang('use')</button>
                                    </div>
                                </div>
                                <div class="subTotal_wrapper d-flex align-items-center justify-content-between my-3">
                                    <p>@lang('subtotal')</p>
                                    <p>
                                        @if(app()->getLocale() == 'sv')
                                        {{ getseTotal() }} kr
                                        @elseif(app()->getLocale() == 'no')
                                        {{ getnoTotal() }} kr
                                        @else
                                         {{ Cart::getTotal() }} kr
                                        @endif
                                    </p>
                                </div>
                                <div class="delivery_wrapper d-flex align-items-center justify-content-between my-3">
                                    <p>@lang('delivery')</p>
                                    <p>
                                        @if(app()->getLocale() == 'sv' || app()->getLocale() == 'no')
                                        <span class="text-end">0 kr</span>
                                        @else
                                        <span class="text-end">0 kr</span>
                                        @endif</p>
                                    </div>
                                <div class="total_wrapper d-flex align-items-center justify-content-between my-3">
                                    <div class="total_text">
                                        <p>@lang('total')</p>
                                        <p style="font-size: 12px;">@lang('including_free_delivery')</p>
                                    </div>
                                    <p>
                                    @if(app()->getLocale() == 'sv')
                                    <span class="text-end">{{ getseTotal() }} kr</span>
                                    @elseif(app()->getLocale() == 'no')
                                    <span class="text-end">{{ getnoTotal() }} kr</span>
                                    @else
                                    <span class="text-end">{{ Cart::getTotal() }} kr</span>
                                    @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div><!-- //end #wrapper -->
@endsection