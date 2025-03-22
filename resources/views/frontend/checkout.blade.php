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
                            <img src="{{asset('assets/images/plusdeal_logo.png')}}" alt="Logo">
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
                                            <span class="text-end">{{ getseTotal() }} €</span>
                                            @elseif(app()->getLocale() == 'no')
                                            <span class="text-end">{{ getnoTotal() }} €</span>
                                            @else
                                            <span class="text-end">{{ Cart::getTotal() }} €</span>
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
                                                            <span class="px-3">{{$row->attributes->se_price}} €</span>
                                                            @elseif(app()->getLocale() == 'no')
                                                            <span class="px-3">{{$row->attributes->no_price}} €</span>
                                                            @else
                                                            <span class="px-3">{{$row->price}} €</span>
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
                                                            <span class="text-end">{{ getseTotal() }} €</span>
                                                            @elseif(app()->getLocale() == 'no')
                                                            <span class="text-end">{{ getnoTotal() }} €</span>
                                                            @else
                                                            <span class="text-end">{{ Cart::getTotal() }} €</span>
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="delivery_wrapper d-flex align-items-center justify-content-between my-3">
                                                        <p>@lang('delivery')</p>
                                                        <p>
                                                            @if(app()->getLocale() == 'sv' || app()->getLocale() == 'no')
                                                            <span class="text-end">0 €</span>
                                                            @else
                                                            <span class="text-end">0 €</span>
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
                                                            <span class="text-end">{{ getseTotal() }} €</span>
                                                            @elseif(app()->getLocale() == 'no')
                                                            <span class="text-end">{{getnoTotal()}} €</span>
                                                            @else
                                                            <span class="text-end">{{ Cart::getTotal() }} €</span>
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
                                    <li class="breadcrumb-item">@lang('information')</li>
                                    <li class="breadcrumb-item active" aria-current="page">@lang('delivery')</li>
                                    <li class="breadcrumb-item active" aria-current="page">@lang('payment')</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="form_wrapper">
                            <form class="row" id="checkout_form" action="{{ route('process.checkout') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-lg-12">
                                    <label class="form-label">@lang('contact_information')</label>
                                    <input type="email" name="email" class="form-control mb-3" autocomplete="off"
                                    value="{{session()->get('email')}}" placeholder="@lang('email')"  required />
                                </div>
                                <div class="col-lg-12 d-flex">
                                    <input type="checkbox" class="form-check-input email_check" name="check_email"
                                        id="check_email" />
                                    <label class="form-check-label" for="invalidCheck" id="check_email_label">
                                        @lang('send_notification')
                                    </label>
                                </div>

                                <div class="col-lg-12 mt-5">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label class="form-label">@lang('delivery_address')</label>
                                            <select class="form-control" name="country">
                                                <option value="SE" @if(app()->getLocale() == 'sv') selected @endif>Sweden</option>
                                                <option value="GE" @if(app()->getLocale() == 'ge') selected @endif>German</option>
                                                <option value="NL" @if(app()->getLocale() == 'nl') selected @endif>Netherlands</option>
                                                <option value="FI" @if(app()->getLocale() == 'fi') selected @endif>Finland</option>
                                                <option value="FR" @if(app()->getLocale() == 'fr') selected @endif>French</option>
                                                <option value="DK" @if(app()->getLocale() == 'da') selected @endif>Denmark</option>
                                                <option value="IT" @if(app()->getLocale() == 'it') selected @endif>Italy</option>
                                                <option value="PT" @if(app()->getLocale() == 'pt') selected @endif>Portugal</option>
                                                <option value="NO" @if(app()->getLocale() == 'no') selected @endif>Norway</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" name="first_name" value="{{session()->get('first_name')}}" placeholder="@lang('first_name')" required class="form-control my-3" />
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" name="last_name" value="{{session()->get('last_name')}}" placeholder="@lang('last_name')" required class="form-control my-3" />
                                        </div>
                                        <div class="col-lg-12 position-relative">
                                            <input type="text" id="address" name="address" value="{{session()->get('address')}}" placeholder="@lang('address')" required
                                                class="form-control">
                                            <i class="fa fa-search" id="search_icon_address" aria-hidden="true"></i>
                                        </div>
                                        <!-- <div class="col-lg-12">
                                            <input type="text" placeholder="Apartment, floor, etc. (optional)"
                                                class="form-control mt-3">
                                        </div> -->
                                        <div class="col-lg-6">
                                            <input type="text" name="zipcode" value="{{session()->get('zipcode')}}" placeholder="@lang('postal_code')" required class="form-control my-3" />
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" name="city" value="{{session()->get('city')}}" placeholder="@lang('city')" required class="form-control my-3" />
                                        </div>
                                        <div class="col-lg-12">
                                            <input type="tel" name="phone" value="{{session()->get('phone')}}" placeholder="@lang('telephone')" class="form-control mb-3" />
                                        </div>
                                        <div class="col-lg-12 d-flex">
                                            <input type="checkbox" class="form-check-input save_inform" name="save_inform"  
                                                id="check_email" />
                                            <label class="form-check-label" for="invalidCheck" id="save_inform_label">
                                                @lang('save_information')
                                            </label>
                                        </div>
                                        <div class="col-lg-12 text-end">
                                            <button id="proceed_btn" type="submit" @if(Cart::getTotal() == 0) disabled @endif>@lang('proceed_delivery')</button>
                                        </div>
                                    </div>

                                </div>

                            </form>
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
                                    <p>{{$row->attributes->se_price}} €</p>
                                    @elseif(app()->getLocale() == 'no')
                                    <p>{{$row->attributes->no_price}} €</p>
                                    @else
                                    <p>{{$row->price}} €</p>
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
                                        {{ getseTotal() }} €
                                        @elseif(app()->getLocale() == 'no')
                                        {{ getnoTotal() }} €
                                        @else
                                        {{ Cart::getTotal() }} €
                                        @endif
                                    </p>
                                </div>
                                <div class="delivery_wrapper d-flex align-items-center justify-content-between my-3">
                                    <p>@lang('delivery')</p>
                                    <p>
                                        @if(app()->getLocale() == 'sv' || app()->getLocale() == 'no')
                                        <span class="text-end">0 €</span>
                                        @else
                                        <span class="text-end">0 €</span>
                                        @endif</p>
                                    </div>
                                <div class="total_wrapper d-flex align-items-center justify-content-between my-3">
                                    <div class="total_text">
                                        <p>@lang('total')</p>
                                        <p style="font-size: 12px;">@lang('including_free_delivery')</p>
                                    </div>
                                    <p>
                                    @if(app()->getLocale() == 'sv')
                                    <span class="text-end">{{ getseTotal() }} €</span>
                                    @elseif(app()->getLocale() == 'no')
                                    <span class="text-end">{{ getnoTotal() }} €</span>
                                    @else
                                    <span class="text-end">{{ Cart::getTotal() }} €</span>
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