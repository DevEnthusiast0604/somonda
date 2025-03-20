<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Somonda | {{$product['name']}} </title>
    <link rel="icon" type="image/png" href="{{asset('assets/images/plusdeal_logo.png')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{asset('landing-assets/css/slick.css')}}" />
    <link rel="stylesheet" href="{{asset('landing-assets/css/landing.css')}}">
    <link rel="stylesheet" href="{{asset('landing-assets/css/responsive.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/fonts/feather/style.min.css')}}">
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
</head>

<body>
    <noscript>
        <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=2419370404933990&ev=PageView&noscript=1"/>
    </noscript>
    <noscript>
        <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=1632919927189675&ev=PageView&noscript=1"/>
    </noscript>
    <noscript>
        <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=613698397065206&ev=PageView&noscript=1"/>
    </noscript>
    @if (\Session::has('success'))
    <input type="hidden" id="cart_active" value="@lang(\Session::get('cart'))">
    @endif
    @if(isset($success))
    <input type="hidden" id="cart_active" value="{{$success}}">
    @endif
    <div id="preloader">
        <div id="status"><img src="{{asset('assets/images/preloader.gif')}}" alt="preloader"></div>
    </div>
    @include('components.landing_aside')
    <div id="wrapper">
        <!-- start #wrapper -->
        <div class="top_bar_header">
            <div class="top_excellent">
                <h3>@lang('Excellent')</h3>
                <div class="img">
                    <img data-src="{{asset('landing-assets/image/star_multiple.png')}}" class="lazy">
                </div>
            </div>
            <div class="bottom_bar">
                +10.000 @lang('happy_customers')
            </div>
        </div>
        <header>
            <div class="header-area clearfix">
                <!-- start .header-area -->
                <nav class="navbar navbar-expand-lg p-0">
                    <div class="container">
                        <div class="logo">
                            <a class="navbar-brand py-0" href="{{url('/')}}">
                                <figure>
                                    <img src="{{asset('assets/images/plusdeal_logo.png')}}" alt="Logo">
                                </figure>
                            </a>
                        </div>
                        <div class="header-right d-flex">
                            <div class="header-menu bg-white">
                                <form class="d-none d-lg-flex" role="search">
                                    <input class="form-control border-0" type="search" placeholder="Search..."
                                        aria-label="Search">
                                    <button class="btn" type="submit">Search</button>
                                </form>
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <div class="membership-btn">
                                        <a href="#"><span>@lang('membership')</span></a>
                                    </div>
                                    <form class="d-flex d-lg-none" role="search">
                                        <input class="form-control border-0" type="search" placeholder="Search..."
                                            aria-label="Search">
                                        <button class="btn" type="submit">Search</button>
                                    </form>
                                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#" >Perfumes | Cosmetics</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Health | Beauty</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Toys | Fancy Dress</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Computers | Electronics</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="user-area d-flex ms-auto">
                                <div class="membership-btn">
                                    <a href="{{route('compare')}}"><span>@lang('membership')</span></a>
                                </div>
                                <ul class="nav">
                                    @if(Auth::check())
                                    <li class="user login_icon_hide">
                                        <a href="{{route('dashboard')}}">
                                            Account
                                        </a>
                                    </li>
                                    <form id="logout-form" action="{{ route('logout',app()->getLocale()) }}"
                                        method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    @else
                                    <li class="user login_icon_hide"><a href="{{route('login')}}">Login</a></li>
                                    @endif
                                    <li class="shopping-cart"><a href="#">@lang('your_basket') <p class="cart_number">
                                                {{ Cart::getTotalQuantity()}}</p></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </div><!-- //end .header-area -->
        </header>

        <!-- main product section -->
        <section>
            <div class="container">
                <div class="covered_product_main row">
                    <div class="left_part_products col-md-6">
                        <div class="inner_left_part">
                            <div class="covered_product_slider">
                                @if($data->images)
                                    @foreach(unserialize($data->images) as $key=>$image)
                                        @if($data->custom == 1)
                                        <div class="image_inner">
                                            @if($key == 0)
                                                <img src="{{asset('uploads/products')}}/{{$image}}">
                                            @else
                                                <img data-src="{{asset('uploads/products')}}/{{$image}}" class="lazy">
                                            @endif
                                        </div>
                                        @else
                                        <div class="image_inner">
                                            @if($key == 0)
                                                <img src="{{$image}}">
                                            @else
                                                <img data-src="{{$image}}" class="lazy">
                                            @endif
                                        </div>
                                        @endif
                                    @endforeach
                                @else
                                    @if($data->custom == 1)
                                    <div class="image_inner">
                                        <img src="{{asset('uploads/products')}}/{{$data->image}}">
                                    </div>
                                    @else
                                    <div class="image_inner">
                                        <img src="{{$data->image}}">
                                    </div>
                                    @endif
                                @endif
                            </div>
                            <div class="top_product__thumb">
                                <div class="product__thumb">
                                    @if($data->images)
                                    @foreach(unserialize($data->images) as $key=>$image)
                                    @if($data->custom == 1)
                                    <div class="image_inner">
                                        <img data-src="{{asset('uploads/products')}}/{{$image}}" class="lazy">
                                    </div>
                                    @else
                                    <div class="image_inner">
                                        <img data-src="{{$image}}" class="lazy">
                                    </div>
                                    @endif
                                    @endforeach
                                    @else
                                    @if($data->custom == 1)
                                    <div class="image_inner">
                                        <img data-src="{{asset('uploads/products')}}/{{$data->image}}" class="lazy">
                                    </div>
                                    @else
                                    <div class="image_inner">
                                        <img data-src="{{$data->image}}" class="lazy">
                                    </div>
                                    @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="right_part_products col-md-6">
                        <h2>{{$product['name']}}</h2>
                        <div class="review_star">
                            <img data-src="{{asset('landing-assets/image/star.png')}}" class="lazy">
                            <div class="review_txt">102 @lang('reviews')</div>
                        </div>
                        <div class="price_product">
                            @if(app()->getLocale() == 'sv')
                            <div class="main_price"> {{$data->se_wholesalePrice}} kr</div>
                            <div class="compare_at_price">{{$data->se_retailPrice}} kr</div>
                            @elseif(app()->getLocale() == 'no')
                            <div class="main_price">{{$data->no_wholesalePrice}} kr</div>
                            <div class="compare_at_price">{{$data->no_retailPrice}} kr</div>
                            @else
                            <div class="main_price">{{$data->wholesalePrice}} kr</div>
                            <div class="compare_at_price">{{$data->retailPrice}} kr</div>
                            @endif

                            <div class="save_label label_sales"><img class="lazy"
                                    data-src="{{asset('landing-assets/image/discount.png')}}"><span>@lang('save')
                                    {{number_format(($data->retailPrice - $data->wholesalePrice)*100/$data->retailPrice)}}%</span>
                            </div>
                        </div>

                        <div class="buy_now_button">
                            <form class="d-flex" action="{{ route('cart.store') }}" id="add_cart_form" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ $data->id }}" name="id">
                                <input type="hidden" id="membership" value="1" name="membership">
                                <input type="hidden" value="{{$data->width}} × {{$data->height}} × {{$data->depth}}"
                                    name="size">
                                <input type="hidden" value="1" name="quantity">
                                <button class="inner_btn" type="submit">
                                    <img data-src="{{asset('landing-assets/image/bag.png')}}" class="lazy"><span class="text_buy">
                                        @lang('buy_now')</span>
                                </button>
                            </form>
                        </div>

                        <div class="satification_listing">
                            <div class="first_column common_column">
                                <div class="image_inner"><img data-src="{{asset('landing-assets/image/checkmark.png')}}" class="lazy">
                                </div>
                                <div class="text">@lang('benefit_three')</div>
                            </div>
                            <div class="second_column common_column">
                                <div class="image_inner"><img data-src="{{asset('landing-assets/image/checkmark.png')}}" class="lazy">
                                </div>
                                <div class="text">@lang('benefit_two')</div>
                            </div>
                            <div class="third_column common_column">
                                <div class="image_inner"><img data-src="{{asset('landing-assets/image/truck.png')}}" class="lazy"></div>
                                <div class="text">@lang('in_stock_delivery')</div>
                            </div>
                        </div>

                        <div class="description_img">
                            <h4 class="mb-3"><b>@lang('description')</b></h4>
                            {!! $product['description'] !!}
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- customer reviews -->
        <section class="reviews">
            <div class="customer_reviews_top container  customer-alireview">
                <div class="productreview-layout-list justify-between">
                    <div class="productreview-layout-list__left">
                        <div class="alireview-fixed-summary">
                            <div class="alireview-title">
                                <div class="alireview-form-title"> @lang('customer_reviews') </div>
                            </div>
                            <div class="alireview-powered"></div>
                            <div class="alireview-header-summary     vertical  ">
                                <div class="alireview-summary ">
                                    <div class="alireview-number-total-review"><span>5.0</span></div>
                                    <div class="alireview-total-review">
                                        <div class="alireview-total-text">
                                            @lang('based_on') <span>57 @lang('reviews')</span></div>
                                    </div>
                                </div>
                                <div class="alr-summary alr-rating-bar notranslate">
                                    <div class="alr-wrap-count">
                                        <ul class="alr-count-reviews">
                                            <li star="5">
                                                <div class="alr-sum-wrap"><span class="alr-sum-point">5</span>
                                                    <span class="alr-star"><svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg></span>
                                                </div>
                                                <div class="alr-progress-bar-wrap">
                                                    <div class="alr-progress-bar">
                                                        <div style="max-width: 98.245614035088%"></div>
                                                    </div>
                                                </div><span class="alr-count">56</span>
                                            </li>
                                            <li star="4">
                                                <div class="alr-sum-wrap"><span class="alr-sum-point">4</span><span
                                                        class="alr-star"><svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg></span></div>
                                                <div class="alr-progress-bar-wrap">
                                                    <div class="alr-progress-bar">
                                                        <div style="max-width: 1.7543859649123%"></div>
                                                    </div>
                                                </div><span class="alr-count">1</span>
                                            </li>
                                            <li star="3">
                                                <div class="alr-sum-wrap"><span class="alr-sum-point">3</span><span
                                                        class="alr-star"><svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg></span></div>
                                                <div class="alr-progress-bar-wrap">
                                                    <div class="alr-progress-bar">
                                                        <div style="max-width: 0%"></div>
                                                    </div>
                                                </div><span class="alr-count">0</span>
                                            </li>
                                            <li star="2">
                                                <div class="alr-sum-wrap"><span class="alr-sum-point">2</span><span
                                                        class="alr-star"><svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg></span></div>
                                                <div class="alr-progress-bar-wrap">
                                                    <div class="alr-progress-bar">
                                                        <div style="max-width: 0%"></div>
                                                    </div>
                                                </div><span class="alr-count">0</span>
                                            </li>
                                            <li star="1">
                                                <div class="alr-sum-wrap"><span class="alr-sum-point">1</span><span
                                                        class="alr-star"><svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg></span></div>
                                                <div class="alr-progress-bar-wrap">
                                                    <div class="alr-progress-bar">
                                                        <div style="max-width: 0%"></div>
                                                    </div>
                                                </div><span class="alr-count">0</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="productreview-layout-list__right">
                        <div class="alireview-result">
                            <div class="list-alireview">
                                <div class="alireview-row no-prod-img over-text-done">
                                    <div class="alireview-row-wrap" data-comment-id="830">
                                        <div class="alireview-desc-content ">
                                            <div class="alireview-header clearfix">
                                                <div class="alireview-status">
                                                    <span class="wrapper-rating">
                                                        <svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg><svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg><svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg><svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg><svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg></span><input type="hidden" class="alr-rating done"
                                                        data-filled="alr-icon-star" data-empty="alr-icon-star"
                                                        data-fractions="3" data-readonly="" value="5"></div>
                                            </div>
                                            <div class="alireview-author-content has-time">
                                                <div class="alireview-author__avatar ali-verify-buyer"
                                                    data-verified="Verified buyer"><img
                                                        class="alireview-avatar owl-lazy arv-lozad lazy"
                                                        data-src="https://cdn.alireviews.io/images/avatar/abstract/avatar175.jpg"></div>
                                                <div class="author__content">
                                                    <div class="author__title">
                                                        <span class="alireview-author">
                                                            Camilla
                                                        </span>
                                                        <div class="arl-verify" data-verified="Verified buyer">
                                                            <img data-src="{{asset('assets/images/check.png')}}"
                                                                class="check_icon lazy" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="author__time">
                                                        <time class="alireview-date">
                                                            Mar 15, 2023
                                                        </time>
                                                        <div class="national_flag">
                                                            <img data-src="{{asset('assets/images/flags')}}/{{app()->getLocale()}}.png" class="lazy"
                                                                alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alireview-post">
                                                <p class="">@lang('review_one')</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="alireview-row no-prod-img over-text-done">
                                    <div class="alireview-row-wrap" data-comment-id="830">
                                        <div class="alireview-desc-content ">
                                            <div class="alireview-header clearfix">
                                                <div class="alireview-status"><span class="wrapper-rating"><svg
                                                            clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg><svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg><svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg><svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg><svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg></span><input type="hidden" class="alr-rating done"
                                                        data-filled="alr-icon-star" data-empty="alr-icon-star"
                                                        data-fractions="3" data-readonly="" value="5"></div>
                                            </div>
                                            <div class="alireview-author-content has-time">
                                                <div class="alireview-author__avatar ali-verify-buyer"
                                                    data-verified="Verified buyer"><img
                                                        class="alireview-avatar owl-lazy arv-lozad lazy"
                                                        data-src="https://cdn.alireviews.io/images/avatar/abstract/avatar108.jpg"></div>
                                                <div class="author__content">
                                                    <div class="author__title">
                                                        <span class="alireview-author">
                                                            Jannick
                                                        </span>
                                                        <div class="arl-verify" data-verified="Verified buyer">
                                                            <img data-src="{{asset('assets/images/check.png')}}"
                                                                class="check_icon lazy" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="author__time">
                                                        <time class="alireview-date">
                                                            Mar 15, 2023
                                                        </time>
                                                        <div class="national_flag">
                                                            <img data-src="{{asset('assets/images/flags')}}/{{app()->getLocale()}}.png" class="lazy"
                                                                alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alireview-post">
                                                <p class="">@lang('review_two')</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="alireview-row no-prod-img over-text-done">
                                    <div class="alireview-row-wrap" data-comment-id="830">
                                        <div class="alireview-desc-content ">
                                            <div class="alireview-header clearfix">
                                                <div class="alireview-status">
                                                    <span class="wrapper-rating">
                                                        <svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg><svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg><svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg><svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg><svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg></span><input type="hidden" class="alr-rating done"
                                                        data-filled="alr-icon-star" data-empty="alr-icon-star"
                                                        data-fractions="3" data-readonly="" value="5"></div>
                                            </div>
                                            <div class="alireview-author-content has-time">
                                                <div class="alireview-author__avatar ali-verify-buyer"
                                                    data-verified="Verified buyer"><img 
                                                        class="alireview-avatar owl-lazy arv-lozad lazy"
                                                        data-src="https://cdn.alireviews.io/images/avatar/abstract/avatar60.jpg"></div>
                                                <div class="author__content">
                                                    <div class="author__title">
                                                        <span class="alireview-author">
                                                            Victor
                                                        </span>
                                                        <div class="arl-verify" data-verified="Verified buyer">
                                                            <img data-src="{{asset('assets/images/check.png')}}"
                                                                class="check_icon lazy" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="author__time">
                                                        <time class="alireview-date">
                                                            Mar 14, 2023
                                                        </time>
                                                        <div class="national_flag">
                                                            <img data-src="{{asset('assets/images/flags')}}/{{app()->getLocale()}}.png"
                                                                alt="flag" class="lazy">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alireview-post">
                                                <p class="">@lang('review_three')</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="alireview-row no-prod-img over-text-done">
                                    <div class="alireview-row-wrap" data-comment-id="830">
                                        <div class="alireview-desc-content ">
                                            <div class="alireview-header clearfix">
                                                <div class="alireview-status">
                                                    <span class="wrapper-rating">
                                                        <svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg><svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg><svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg><svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg><svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg></span><input type="hidden" class="alr-rating done"
                                                        data-filled="alr-icon-star" data-empty="alr-icon-star"
                                                        data-fractions="3" data-readonly="" value="5"></div>
                                            </div>
                                            <div class="alireview-author-content has-time">
                                                <div class="alireview-author__avatar ali-verify-buyer"
                                                    data-verified="Verified buyer"><img
                                                        class="alireview-avatar owl-lazy arv-lozad lazy"
                                                        data-src="https://cdn.alireviews.io/images/avatar/abstract/avatar23.jpg"></div>
                                                <div class="author__content">
                                                    <div class="author__title">
                                                        <span class="alireview-author">
                                                            Israa
                                                        </span>
                                                        <div class="arl-verify" data-verified="Verified buyer">
                                                            <img data-src="{{asset('assets/images/check.png')}}"
                                                                class="check_icon lazy" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="author__time">
                                                        <time class="alireview-date">
                                                            Mar 12, 2023
                                                        </time>
                                                        <div class="national_flag">
                                                            <img data-src="{{asset('assets/images/flags')}}/{{app()->getLocale()}}.png" class="lazy"
                                                                alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alireview-post">
                                                <p class="">@lang('review_four')</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="alireview-row no-prod-img over-text-done">
                                    <div class="alireview-row-wrap" data-comment-id="830">
                                        <div class="alireview-desc-content ">
                                            <div class="alireview-header clearfix">
                                                <div class="alireview-status">
                                                    <span class="wrapper-rating">
                                                        <svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg><svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg><svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg><svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg><svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg></span><input type="hidden" class="alr-rating done"
                                                        data-filled="alr-icon-star" data-empty="alr-icon-star"
                                                        data-fractions="3" data-readonly="" value="5"></div>
                                            </div>
                                            <div class="alireview-author-content has-time">
                                                <div class="alireview-author__avatar ali-verify-buyer"
                                                    data-verified="Verified buyer"><img
                                                        class="alireview-avatar owl-lazy arv-lozad lazy"
                                                        data-src="https://cdn.alireviews.io/images/avatar/abstract/avatar140.jpg"></div>
                                                <div class="author__content">
                                                    <div class="author__title">
                                                        <span class="alireview-author">
                                                            Klara L
                                                        </span>
                                                        <div class="arl-verify" data-verified="Verified buyer">
                                                            <img data-src="{{asset('assets/images/check.png')}}"
                                                                class="check_icon lazy" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="author__time">
                                                        <time class="alireview-date">
                                                            Mar 12, 2023
                                                        </time>
                                                        <div class="national_flag">
                                                            <img data-src="{{asset('assets/images/flags')}}/{{app()->getLocale()}}.png"
                                                                alt="" class="lazy">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alireview-post">
                                                <p class="">@lang('review_five')</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="alireview-row no-prod-img over-text-done">
                                    <div class="alireview-row-wrap" data-comment-id="830">
                                        <div class="alireview-desc-content ">
                                            <div class="alireview-header clearfix">
                                                <div class="alireview-status">
                                                    <span class="wrapper-rating">
                                                        <svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg><svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg><svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg><svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg><svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg></span><input type="hidden" class="alr-rating done"
                                                        data-filled="alr-icon-star" data-empty="alr-icon-star"
                                                        data-fractions="3" data-readonly="" value="5"></div>
                                            </div>
                                            <div class="alireview-author-content has-time">
                                                <div class="alireview-author__avatar ali-verify-buyer"
                                                    data-verified="Verified buyer"><img
                                                        class="alireview-avatar owl-lazy arv-lozad lazy"
                                                        data-src="https://cdn.alireviews.io/images/avatar/abstract/avatar50.jpg"></div>
                                                <div class="author__content">
                                                    <div class="author__title">
                                                        <span class="alireview-author">
                                                            Tina Persson
                                                        </span>
                                                        <div class="arl-verify" data-verified="Verified buyer">
                                                            <img data-src="{{asset('assets/images/check.png')}}"
                                                                class="check_icon lazy" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="author__time">
                                                        <time class="alireview-date">
                                                            Mar 10, 2023
                                                        </time>
                                                        <div class="national_flag">
                                                            <img data-src="{{asset('assets/images/flags')}}/{{app()->getLocale()}}.png"
                                                                alt="" class="lazy">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alireview-post">
                                                <p class="">@lang('review_six')</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="alireview-row no-prod-img over-text-done">
                                    <div class="alireview-row-wrap" data-comment-id="830">
                                        <div class="alireview-desc-content ">
                                            <div class="alireview-header clearfix">
                                                <div class="alireview-status">
                                                    <span class="wrapper-rating">
                                                        <svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg><svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg><svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg><svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg><svg clip-rule="evenodd" fill-rule="evenodd"
                                                            stroke-linejoin="round" stroke-miterlimit="2"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                                                fill-rule="nonzero" />
                                                        </svg></span><input type="hidden" class="alr-rating done"
                                                        data-filled="alr-icon-star" data-empty="alr-icon-star"
                                                        data-fractions="3" data-readonly="" value="5"></div>
                                            </div>
                                            <div class="alireview-author-content has-time">
                                                <div class="alireview-author__avatar ali-verify-buyer"
                                                    data-verified="Verified buyer"><img
                                                        class="alireview-avatar owl-lazy arv-lozad lazy"
                                                        data-src="https://cdn.alireviews.io/images/avatar/abstract/avatar150.jpg"></div>
                                                <div class="author__content">
                                                    <div class="author__title">
                                                        <span class="alireview-author">
                                                            Esben
                                                        </span>
                                                        <div class="arl-verify" data-verified="Verified buyer">
                                                            <img data-src="{{asset('assets/images/check.png')}}"
                                                                class="check_icon lazy" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="author__time">
                                                        <time class="alireview-date">
                                                            Feb 27, 2023
                                                        </time>
                                                        <div class="national_flag">
                                                            <img data-src="{{asset('assets/images/flags')}}/{{app()->getLocale()}}.png"
                                                                alt="" class="lazy">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alireview-post">
                                                <p class="">@lang('review_seven')</p>
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

        <!-- accordion -->
        <div class="accordion product_accordion_part container" id="accordionExample">
            <div class="accordion-item details">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button summary" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        @lang('delivery')

                        <div class="plus_icon"><img data-src="{{asset('landing-assets/image/plus_svg.png')}}" class="lazy"></div>
                        <div class="minus_icon"><img data-src="{{asset('landing-assets/image/minus_svg.png')}}" class="lazy"></div>
                    </button>
                </h2>

                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion_content accordion-body">
                        @lang('delivery_faq')
                    </div>
                </div>
            </div>
            <div class="accordion-item details">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button summary" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        @lang('touch_with')

                        <div class="plus_icon"><img data-src="{{asset('landing-assets/image/plus_svg.png')}}" class="lazy"></div>
                        <div class="minus_icon"><img data-src="{{asset('landing-assets/image/minus_svg.png')}}" class="lazy"></div>
                    </button>
                </h2>

                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#accordionExample">
                    <div class="accordion_content accordion-body">
                        @lang('touch_faq')
                    </div>
                </div>
            </div>
        </div>
        <div class="term_section container">
            <p class="terms">@lang('terms')</p>
        </div>
        <footer>
            <div class="container">
                <div class="footer-area">
                    <!-- .footer-area -->
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="row">
                                <div class="col-sm-6 col-lg-4">
                                    <div class="special-link">
                                        <h4 class="text-white">Categories</h4>
                                        <ul>
                                            <li><a href="{{route('products','makeup')}}">Make-Up</a></li>
                                            <li><a href="{{route('products','body-care')}}">Body Care</a></li>
                                            <li><a href="{{route('products','face-care')}}">Face Care</a></li>
                                            <li><a href="{{route('products','babies-and-children')}}">Babies and
                                                    Children </a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-4">
                                    <div class="special-link">
                                        <h4 class="text-white">Products</h4>
                                        <ul>
                                            <li><a href="/#new_products">New Products</a></li>
                                            <li><a href="/#popular_products">Popular Products</a></li>
                                            <li><a href="/#popular_products">Special Offers</a></li>
                                            <li><a href="/#popular_products">Event Products</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-4">
                                    <div class="special-link">
                                        <h4 class="text-white">Company</h4>
                                        <ul>
                                            <!-- <li><a href="#">About Us</a></li> -->
                                            <li><a href="{{route('faq')}}">FAQs</a></li>
                                            <li><a href="{{route('terms')}}">Terms and Conditions</a></li>
                                            <li><a href="{{route('privacy')}}">Privacy Policy</a></li>
                                            <li><a href="{{route('contact')}}">Contact Us</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="footer-right">
                                <h5 class="text-white">Follow us</h5>
                                <ul class="nav">
                                    <li>
                                        <a href="#">
                                            <figure>
                                                <img data-src="{{asset('assets/images/social-icon-1.png')}}" class="lazy" alt="">
                                            </figure>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <figure>
                                                <img data-src="{{asset('assets/images/social-icon-2.png')}}" class="lazy" alt="">
                                            </figure>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <figure>
                                                <img data-src="{{asset('assets/images/social-icon-3.png')}}" class="lazy" alt="">
                                            </figure>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <figure>
                                                <img data-src="{{asset('assets/images/social-icon-4.png')}}" class="lazy" alt="">
                                            </figure>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <figure>
                                                <img data-src="{{asset('assets/images/social-icon-5.png')}}" class="lazy" alt="">
                                            </figure>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <figure>
                                                <img data-src="{{asset('assets/images/social-icon-6.png')}}" class="lazy" alt="">
                                            </figure>
                                        </a>
                                    </li>
                                </ul>
                                <div class="company text-white">
                                    CC EUROPE LTD <br>Numéro d'organisation: 14009110
                                </div>
                                <address class="text-white">
                                    128 City Road <br/>LONDON, United Kingdom <br/>  EC1V 2NX
                                </address>

                                <div class="email">
                                    <a class="text-white" href="mailto:support@Somonda.com">support@Somonda.com</a>
                                </div>
                                <!-- 
                                <div class="contact-btn bg-white">
                                    <a href="{{route('contact')}}">contact us</a>
                                </div> -->
                            </div>
                        </div>
                    </div>

                    <div class="copyright">
                        <p class="text-white">&copy; {{date('Y')}} Somonda. All Rights Reserved</p>
                    </div>
                </div><!-- //end .footer-area -->
            </div>
        </footer>
    </div><!-- //end #wrapper -->

    <div class="sticky_product_bar">
        <div class="container">
            <div class="product_sticky_bar">
                <div class="left_part">
                    <div class="image_product">
                        @if($data->custom == 1)
                        <img data-src="{{asset('uploads/products')}}/{{$data->image}}" class="lazy">
                        @else
                        <img data-src="{{$data->image}}" class="lazy">
                        @endif
                    </div>
                    <div class="covered_title_p">
                        <div class="product_title">{{$product['name']}}</div>
                        <div class="product_price">
                            @if(app()->getLocale() == 'sv')
                            <div class="main">{{$data->se_wholesalePrice}} Kr</div>
                            <div class="compare">{{$data->se_retailPrice}} Kr</div>
                            @elseif(app()->getLocale() == 'no')
                            <div class="main">{{$data->no_wholesalePrice}} Kr</div>
                            <div class="compare">{{$data->no_retailPrice}} Kr</div>
                            @else
                            <div class="main">kr {{$data->wholesalePrice}}</div>
                            <div class="compare">kr {{$data->retailPrice}}</div>
                            @endif

                            <div class="sticky_save_label label_sales"><img
                                    data-src="{{asset('landing-assets/image/discount.png')}}" class="lazy"><span>@lang('save')
                                    {{number_format(($data->retailPrice - $data->wholesalePrice)*100/$data->retailPrice)}}%</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="right_part">
                    <div class="buy_now_button_sticky">
                        <form class="d-flex" action="{{ route('cart.store') }}" id="add_cart_form" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $data->id }}" name="id">
                            <input type="hidden" id="membership" value="1" name="membership">
                            <input type="hidden" value="{{$data->width}} × {{$data->height}} × {{$data->depth}}"
                                name="size">
                            <input type="hidden" value="1" name="quantity">
                            <button class="inner_btn_inn" type="submit">
                                <img data-src="{{asset('landing-assets/image/bag.png')}}" class="lazy"><span
                                    class="text_buy">@lang('buy_now')
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.plugins.min.js"></script>
    <script src="{{asset('landing-assets/js/slick.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('landing-assets/js/landing.js')}}"></script>
</body>
</html>