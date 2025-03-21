@extends('layouts.frontend')
@section('content')
<!-- start .banner -->
<section class="banner">
    <div class="container">
        <div class="banner-area">
            <div class="banner-info">
                <h1>@lang('Le luxe à prix réduit')</h1>
                <p>@lang('Become a Plus member and gain access to our products at a discounted price. Try first 7 days for free (hereafter €19.95 per month)')</p>
                <div class="shop-now-btn text-center">
                    <a href="#popular_products"><span>@lang('SHOP NOW')</span></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- //end .banner -->

<!-- start .intro -->
<section class="intro">
    <div class="container">
        <div class="intro-area mx-auto">
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="intro-item mx-auto">
                        <figure class="mx-auto">
                            <img src="assets/images/icon-1.png" alt="">
                        </figure>
                        <h4 class="text-center">@lang('Save up to 80%')</h4>
                        <p class="text-center">@lang('On more than 1.000 well known brands')</p>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <div class="intro-item mx-auto">
                        <figure class="mx-auto">
                            <img src="assets/images/icon-2.png" alt="">
                        </figure>
                        <h4 class="text-center">@lang('Fast delivery')</h4>
                        <p class="text-center">@lang('Get fast and free delivery all over the world')</p>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <div class="intro-item mx-auto">
                        <figure class="mx-auto">
                            <img src="assets/images/icon-3.png" alt="">
                        </figure>
                        <h4 class="text-center">@lang('Secure payment')</h4>
                        <p class="text-center">@lang('We use SSL and ensure that you are secure when you shop on our site')</p>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <div class="intro-item mx-auto">
                        <figure class="mx-auto">
                            <img src="assets/images/icon-4.png" alt="">
                        </figure>
                        <h4 class="text-center">@lang('24/7 Customer Support')</h4>
                        <p class="text-center">@lang("Do you have any questions or issues? Then don't hesitate to contact us")</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- //end .intro -->

<!-- start .bestseller -->
<section class="bestseller" id="popular_products">
    <div class="container">
        <div class="bestseller-area">
            <div class="heading">
                <h2 class="text-center">@lang('Bestsellers') <span>@lang('for you')</span></h2>
                <!-- <p class="text-center">5798 new products</p> -->
            </div>
            <div class="row">
                @foreach($bestseller1 as $row)
                <div class="col-sm-6 col-lg-3">
                    <div class="product-item lg bg-white">
                        <figure class="mx-auto">
                            <a href="{{route('products.details', $row->url)}}">
                                @if($row->custom == 1)
                                <img src="{{asset('uploads/products')}}/{{$row->image}}" alt="">
                                @else
                                <img src="{{$row->image}}" alt="">
                                @endif
                            </a>
                        </figure>
                        <div class="product-item-content">
                            <h5 class="text-center">{{$row->condition}}</h5>
                            <a href="{{route('products.details', $row->url)}}">
                                <p class="text-center">
                                    {{$row->name}}
                                </p>
                            </a>
                            <a href="{{route('products', $row->url)}}">
                                <span class="text-center">
                                    {{$row->name}}
                                </span>
                            </a>
                        </div>
                        <div class="product-item-footer">
                            <ul class="nav">
                                <li class="text-center"><span>Normal Price</span><span class="price"> kr
                                        {{$row->retailPrice}}</span>
                                </li>
                                <li class="text-center border-0"><span class="midl">Membership Price</span><span
                                        class="price blue">kr {{$row->wholesalePrice}}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        @foreach($bestseller2 as $row)
                        <div class="col-sm-2">
                            <div class="product-item bg-white">
                                <figure class="mx-auto">
                                    <a href="{{route('products.details', $row->url)}}">
                                    @if($row->custom == 1)
                                    <img src="{{asset('uploads/products')}}/{{$row->image}}" alt="">
                                    @else
                                    <img src="{{$row->image}}" alt="">
                                    @endif
                                    </a>
                                </figure>
                                <div class="product-item-content">
                                    <h5 class="text-center">{{$row->condition}}</h5>
                                    <a href="{{route('products.details', $row->url)}}">
                                        <p class="text-center">{{$row->name}}</p>
                                    </a>
                                    <a href="{{route('products', $row->url)}}">
                                        <span class="text-center">{{$row->name}}</span>
                                    </a>
                                </div>
                                <div class="product-item-footer">
                                    <ul class="nav">
                                        <li class="text-center"><span>Normalpris</span><span class="price">kr
                                                {{$row->retailPrice}}</span>
                                        </li>
                                        <li class="text-center border-0"><span class="midl">Medlemspris</span><span
                                                class="price blue">kr {{$row->wholesalePrice}}</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- //end .bestseller -->

<!-- start .product -->
<section class="pt-5 pb-3" id="new_products">
    <div class="container">
        <div class="product-area">
            <div class="heading">
                <h2 class="text-center">@lang('New products')</h2>
                <p class="text-center">{{$new_products_count}} @lang('new products')</p>
            </div>

            <div class="owl-carousel owl-theme">
                @foreach($new_products as $row)
                <div class="product-item">
                    <figure class="mx-auto">
                        <a href="{{route('products.details', $row->url)}}">
                            @if($row->custom == 1)
                            <img src="{{asset('uploads/products')}}/{{$row->image}}" alt="">
                            @else
                            <img src="{{$row->image}}" alt="">
                            @endif
                        </a>
                    </figure>
                    <div class="product-item-content">
                        <h5 class="text-center">{{$row->condition}}</h5>
                        <a href="{{route('products.details', $row->url)}}">
                            <p class="text-center">{{$row->name}}</p>
                        </a>
                        <a href="{{route('products', $row->url)}}">
                            <span class="text-center">{{$row->name}}</span>
                        </a>
                    </div>
                    <div class="product-item-footer">
                        <ul class="nav">
                            <li class="text-center"><span>Normalpris</span><span class="price">kr
                                    {{$row->retailPrice}}</span>
                            </li>
                            <li class="text-center border-0"><span class="midl">Medlemspris</span><span
                                    class="price blue">kr {{$row->wholesalePrice}}</span></li>
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="footer d-flex justify-content-center">
                <div class="get-in-touch-btn text-center">
                    <a href="{{route('products.all')}}" class="text-white py-1"><span>@lang('View all new products')</span></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- //end .product -->
<!-- start .customer -->
@include('components.customer')
<!-- //end .customer -->

<!-- start .faq -->
@include('components.faq')
<!-- //end .faq -->

<!-- .subscribe -->
@include('components.subscribe')
<!-- //end .subscribe -->
    <div class="modal modal-center fade" id="popup" tabindex="-1" role="dialog" aria-modal="true" >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius: 10px">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="popcontent" style="padding-top: 30px; padding-bottom: 30px">
                                <center>
                                    <img src="{{asset('assets/images/plusdeal_logo.png')}}" width="100">
                                </center>
                                <br>
                                <h2 style="text-align: center; font-size: 16px; margin-top: 15px">
                                @lang("PlusDeal' prices are for both members and non-members.")
                                @lang('Membership costs')  
                                    <span style="text-decoration: underline">
                                        <span style="color: #377E62;">€19.95</span>/@lang('month').
                                    </span>
                                </h2> <br>
                                <p style="text-align: center; font-size: 15px; width: 80%; margin: auto;">
                                    @lang('If the membership is not terminated within the first 7 days,') 
                                    @lang('the membership automatically continues at €19.95/month,') 
                                    @lang('but it can always be terminated at the end of a month!')<br><br>
                                    <b>@lang('The first 7 days are free!')</b><br><br>
                                    @lang('Read more') <a href="{{route('terms')}}"
                                        style="color: #2e2e2e; text-decoration: underline">@lang('here')</a>
                                </p>

                                <div style="width: 70%; margin: auto;">
                                    <a href="#" style="color: #fff; font-size: 17px; text-decoration: none;"
                                        class="setAgreeCookie">
                                        <div data-bs-dismiss="modal"
                                            style="background: #377E62; box-shadow: 0px 4px 4px rgb(0 0 0 / 10%); border-radius: 10px; margin-top: 15px;  padding: 10px 0px; font-size: 14px; text-transform: uppercase; text-align: center; color: #fff">
                                            @lang('Understood')</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection