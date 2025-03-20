<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="icon" type="image/png" href="{{asset('assets/images/plusdeal_logo.png')}}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;300;400;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/OwlCarousel/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/OwlCarousel/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <link rel="stylesheet" href="{{asset('new-style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/toastr.css')}}">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/popup.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/fonts/feather/style.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/preloader.css')}}">
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
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
</head>

<body @if(Request::is('login')) class="login-page" @endif>
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
     
    <!-- preloader start -->
    <div id="preloader">
        <div id="status"><img src="{{asset('assets/images/preloader.gif')}}" alt="preloader"></div>
    </div>
    @include('components.aside')
    <div id="wrapper">
        <!-- start #wrapper -->
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
                        @if(!Request::is('products/view/*'))
                        <button class="navbar-toggler p-0" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        @endif
                        <div class="header-right d-flex">
                            <div class="header-menu bg-white">
                                <form class="d-none d-lg-flex" role="search">
                                    <input class="form-control border-0" type="search" placeholder="Search..."
                                        aria-label="Search">
                                    <button class="btn" type="submit">Search</button>
                                </form>

                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <!-- <div class="membership-btn">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#popup"><span>Membership</span></a>
                                    </div> -->

                                    <form class="d-flex d-lg-none" role="search">
                                        <input class="form-control border-0" type="search" placeholder="Search..."
                                            aria-label="Search">
                                        <button class="btn" type="submit">Search</button>
                                    </form>

                                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">Beauty</a>
                                            <ul class="dropdown-menu">
                                                <div class="dropdown-menu-container">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-7 col-lg-8">
                                                                <div class="row">
                                                                    <div class="col-sm-6 col-lg-3">
                                                                        <div class="special-item">
                                                                            <h4>Hair care</h4>
                                                                            <figure>
                                                                                <img src="https://cdnbigbuy.com/images/category/2520_small.jpg"
                                                                                    alt="">
                                                                            </figure>
                                                                            <ul>
                                                                                @foreach(get_subcategories(5419,2) as
                                                                                $row)
                                                                                <li><a
                                                                                        href="{{route('products',$row->url)}}">{{$row->name}}</a>
                                                                                </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-6 col-lg-3">
                                                                        <div class="special-item">
                                                                            <h4>Make-up</h4>
                                                                            <figure>
                                                                                <img src="https://cdnbigbuy.com/images/category/2555_small.jpg"
                                                                                    alt="">
                                                                            </figure>
                                                                            <ul>
                                                                                @foreach(get_subcategories(11702,2) as
                                                                                $row)
                                                                                <li><a
                                                                                        href="{{route('products',$row->url)}}">{{$row->name}}</a>
                                                                                </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6 col-lg-3">
                                                                        <div class="special-item">
                                                                            <h4>Perfumes and Fragrances</h4>
                                                                            <figure>
                                                                                <img src="https://cdnbigbuy.com/images/category/2508_small.jpg"
                                                                                    alt="">
                                                                            </figure>
                                                                            <ul>
                                                                                @foreach(get_subcategories(14091,2) as
                                                                                $row)
                                                                                <li><a
                                                                                        href="{{route('products',$row->url)}}">{{$row->name}}</a>
                                                                                </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6 col-lg-3">
                                                                        <div class="special-item">
                                                                            <h4>Skincare</h4>
                                                                            <figure>
                                                                                <img src="https://cdnbigbuy.com/images/4005900993830_S05111493_P00.jpg"
                                                                                    alt="">
                                                                            </figure>
                                                                            <ul>
                                                                                @foreach(get_subcategories(5324,2) as
                                                                                $row)
                                                                                <li><a
                                                                                        href="{{route('products',$row->url)}}">{{$row->name}}</a>
                                                                                </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
  
                                                                <div class="subcribe-form">
                                                                    <h3>Subscribe with us</h3>
                                                                    <form>
                                                                        <input type="email" class="form-control"
                                                                            placeholder="Enter your email Address">
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5 col-lg-4">
                                                                <div class="vertical-cell h-100">
                                                                    <div class="product-item-title">
                                                                        <h4>Special offer</h4>
                                                                    </div>

                                                                    <div class="row">
                                                                        @foreach(get_special_products() as $row)
                                                                        <div class="col-sm-6 col-md-12 col-xl-6">
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
                                                                                    <h5 class="text-center">
                                                                                        {{$row->condition}}</h5>
                                                                                    <a
                                                                                        href="{{route('products.details', $row->url)}}">
                                                                                        <p class="text-center">
                                                                                            {{$row->name}}</p>
                                                                                    </a>
                                                                                    <a
                                                                                        href="{{route('products', $row->url)}}">
                                                                                        <span
                                                                                            class="text-center">{{$row->name}}</span>
                                                                                    </a>
                                                                                </div>
                                                                                <div class="product-item-footer">
                                                                                    <ul class="nav">
                                                                                        <li class="text-center">
                                                                                            <span>Normalpris</span><span
                                                                                                class="price">kr
                                                                                                {{$row->retailPrice}}</span>
                                                                                        </li>
                                                                                        <li
                                                                                            class="text-center border-0">
                                                                                            <span
                                                                                                class="midl">Medlemspris</span><span
                                                                                                class="price blue">kr
                                                                                                {{$row->wholesalePrice}}</span>
                                                                                        </li>
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
                                                </div>
                                            </ul>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">Home and cooking</a>
                                            <ul class="dropdown-menu">
                                                <div class="dropdown-menu-container">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-7 col-lg-8">
                                                                <div class="row">
                                                                    <div class="col-sm-6 col-lg-3">
                                                                        <div class="special-item">
                                                                            <h4>Home Decor</h4>
                                                                            <figure>
                                                                                <img src="https://cdnbigbuy.com/images/8424002051549_S3043144_P30.jpg"
                                                                                    alt="">
                                                                            </figure>
                                                                            <ul>
                                                                                @foreach(get_subcategories(5684,2) as
                                                                                $row)
                                                                                <li><a
                                                                                        href="{{route('products',$row->url)}}">{{$row->name}}</a>
                                                                                </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-6 col-lg-3">
                                                                        <div class="special-item">
                                                                            <h4>Kitchenware</h4>
                                                                            <figure>
                                                                                <img src="https://cdnbigbuy.com/images/8430852626196_00_WBG0.jpg"
                                                                                    alt="">
                                                                            </figure>
                                                                            <ul>
                                                                                @foreach(get_subcategories(12229,2) as
                                                                                $row)
                                                                                <li><a
                                                                                        href="{{route('products',$row->url)}}">{{$row->name}}</a>
                                                                                </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-6 col-lg-3">
                                                                        <div class="special-item">
                                                                            <h4>Small Electrical appliances</h4>
                                                                            <figure>
                                                                                <img src="https://cdnbigbuy.com/images/8414234746702_S0449645_P00.jpg"
                                                                                    alt="">
                                                                            </figure>
                                                                            <ul>
                                                                                @foreach(get_subcategories(13869,2) as
                                                                                $row)
                                                                                <li><a
                                                                                        href="{{route('products',$row->url)}}">{{$row->name}}</a>
                                                                                </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6 col-lg-3">
                                                                        <div class="special-item">
                                                                            <h4>Storage and organisation</h4>
                                                                            <figure>
                                                                                <img src="https://cdnbigbuy.com/images/8436589220553_R00.jpg"
                                                                                    alt="">
                                                                            </figure>
                                                                            <ul>
                                                                                @foreach(get_subcategories(1310,2) as
                                                                                $row)
                                                                                <li><a
                                                                                        href="{{route('products',$row->url)}}">{{$row->name}}</a>
                                                                                </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="subcribe-form">
                                                                    <h3>Subscribe with us</h3>
                                                                    <form>
                                                                        <input type="email" class="form-control"
                                                                            placeholder="Enter your email Address">
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5 col-lg-4">
                                                                <div class="vertical-cell h-100">
                                                                    <div class="product-item-title">
                                                                        <h4>Special offer</h4>
                                                                    </div>
                                                                    <div class="row">
                                                                        @foreach(get_special_products() as $row)
                                                                        <div class="col-sm-6 col-md-12 col-xl-6">
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
                                                                                    <h5 class="text-center">
                                                                                        {{$row->condition}}</h5>
                                                                                    <a
                                                                                        href="{{route('products.details', $row->url)}}">
                                                                                        <p class="text-center">
                                                                                            {{$row->name}}</p>
                                                                                    </a>
                                                                                    <a
                                                                                        href="{{route('products', $row->url)}}">
                                                                                        <span
                                                                                            class="text-center">{{$row->name}}</span>
                                                                                    </a>
                                                                                </div>
                                                                                <div class="product-item-footer">
                                                                                    <ul class="nav">
                                                                                        <li class="text-center">
                                                                                            <span>Normalpris</span><span
                                                                                                class="price">kr
                                                                                                {{$row->retailPrice}}</span>
                                                                                        </li>
                                                                                        <li
                                                                                            class="text-center border-0">
                                                                                            <span
                                                                                                class="midl">Medlemspris</span><span
                                                                                                class="price blue">kr
                                                                                                {{$row->wholesalePrice}}</span>
                                                                                        </li>
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
                                                </div>
                                            </ul>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">Health and personal care</a>
                                            <ul class="dropdown-menu">
                                                <div class="dropdown-menu-container">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-7 col-lg-8">
                                                                <div class="row">
                                                                    <div class="col-sm-6 col-lg-3">
                                                                        <div class="special-item">
                                                                            <h4>Diet and nutrition</h4>
                                                                            <figure>
                                                                                <img src="https://cdnbigbuy.com/images/8437022569826_S6460357_P01.jpg"
                                                                                    alt="">
                                                                            </figure>
                                                                            <ul>
                                                                                @foreach(get_subcategories(6451,3) as
                                                                                $row)
                                                                                <li><a
                                                                                        href="{{route('products',$row->url)}}">{{$row->name}}</a>
                                                                                </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-6 col-lg-3">
                                                                        <div class="special-item">
                                                                            <h4>Healthcare</h4>
                                                                            <figure>
                                                                                <img src="https://cdnbigbuy.com/images/8425091200313_S05109565_P00.jpg"
                                                                                    alt="">
                                                                            </figure>
                                                                            <ul>
                                                                                @foreach(get_subcategories(19734,3) as
                                                                                $row)
                                                                                <li><a
                                                                                        href="{{route('products',$row->url)}}">{{$row->name}}</a>
                                                                                </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-6 col-lg-3">
                                                                        <div class="special-item">
                                                                            <h4>Oral care</h4>
                                                                            <figure>
                                                                                <img src="https://cdnbigbuy.com/images/4210201396888_S7141021_P00.jpg"
                                                                                    alt="">
                                                                            </figure>
                                                                            <ul>
                                                                                @foreach(get_subcategories(5224,2) as
                                                                                $row)
                                                                                <li><a
                                                                                        href="{{route('products',$row->url)}}">{{$row->name}}</a>
                                                                                </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6 col-lg-3">
                                                                        <div class="special-item">
                                                                            <h4>Vitamins, minerals and supplements</h4>
                                                                            <figure>
                                                                                <img src="https://cdnbigbuy.com/images/8414192312094_S6482150_P00.jpg"
                                                                                    alt="">
                                                                            </figure>
                                                                            <ul>
                                                                                @foreach(get_subcategories(19736,2) as
                                                                                $row)
                                                                                <li><a
                                                                                        href="{{route('products',$row->url)}}">{{$row->name}}</a>
                                                                                </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="subcribe-form">
                                                                    <h3>Subscribe with us</h3>
                                                                    <form>
                                                                        <input type="email" class="form-control"
                                                                            placeholder="Enter your email Address">
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5 col-lg-4">
                                                                <div class="vertical-cell h-100">
                                                                    <div class="product-item-title">
                                                                        <h4>Special offer</h4>
                                                                    </div>
                                                                    <div class="row">
                                                                        @foreach(get_special_products() as $row)
                                                                        <div class="col-sm-6 col-md-12 col-xl-6">
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
                                                                                    <h5 class="text-center">
                                                                                        {{$row->condition}}</h5>
                                                                                    <a
                                                                                        href="{{route('products.details', $row->url)}}">
                                                                                        <p class="text-center">
                                                                                            {{$row->name}}</p>
                                                                                    </a>
                                                                                    <a
                                                                                        href="{{route('products', $row->url)}}">
                                                                                        <span
                                                                                            class="text-center">{{$row->name}}</span>
                                                                                    </a>
                                                                                </div>
                                                                                <div class="product-item-footer">
                                                                                    <ul class="nav">
                                                                                        <li class="text-center">
                                                                                            <span>Normalpris</span><span
                                                                                                class="price">kr
                                                                                                {{$row->retailPrice}}</span>
                                                                                        </li>
                                                                                        <li
                                                                                            class="text-center border-0">
                                                                                            <span
                                                                                                class="midl">Medlemspris</span><span
                                                                                                class="price blue">kr
                                                                                                {{$row->wholesalePrice}}</span>
                                                                                        </li>
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
                                                </div>
                                            </ul>
                                        </li>
                                        <!-- <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">make-up</a>
                                            <ul class="dropdown-menu">
                                                <div class="dropdown-menu-container">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-7 col-lg-8">
                                                                <div class="row">
                                                                    <div class="col-sm-6 col-lg-3">
                                                                        <div class="special-item">
                                                                            <h4>Features</h4>
                                                                            <figure>
                                                                                <img src="{{asset('assets/images/unsplash_jbjmimlaC-U.png')}}"
                                                                                    alt="">
                                                                            </figure>
                                                                            <ul>
                                                                                <li><a href="{{route('products','makeup')}}">Make-Up</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-6 col-lg-3">
                                                                        <div class="special-item">
                                                                            <h4>Popular</h4>
                                                                            <figure>
                                                                                <img src="{{asset('assets/images/unsplash_Fyd9rSbpdVM.png')}}"
                                                                                    alt="">
                                                                            </figure>
                                                                            <ul>
                                                                                <li><a href="{{route('products','make-up-removers')}}">Make-up removers</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-6 col-lg-3">
                                                                        <div class="special-item">
                                                                            <h4>Famous</h4>
                                                                            <figure>
                                                                                <img src="{{asset('assets/images/unsplash_6LBBOwkPzyQ.png')}}"
                                                                                    alt="">
                                                                            </figure>
                                                                            <ul>
                                                                                <li><a href="{{route('products','make-up-and-correctors')}}">Make-up and correctors</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6 col-lg-3">
                                                                       
                                                                    </div>
                                                                </div>

                                                                <div class="subcribe-form">
                                                                    <h3>Subscribe with us</h3>
                                                                    <form>
                                                                        <input type="email" class="form-control"
                                                                            placeholder="Enter your email Address">
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5 col-lg-4">
                                                                <div class="vertical-cell h-100">
                                                                    <div class="product-item-title">
                                                                        <h4>Special offer</h4>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-sm-6 col-md-12 col-xl-6">
                                                                            <div class="product-item">
                                                                                <figure class="mx-auto">
                                                                                    <img src="{{asset('assets/images/unsplash_X1sIr53DhzA.png')}}"
                                                                                        alt="">
                                                                                </figure>
                                                                                <div class="product-item-content">
                                                                                    <h5 class="text-center">Nivea</h5>
                                                                                    <p class="text-center">Bonding Oil
                                                                                        No.7</p>
                                                                                    <span
                                                                                        class="text-center">Shampoo</span>
                                                                                </div>
                                                                                <div class="product-item-footer">
                                                                                    <ul class="nav">
                                                                                        <li class="text-center">
                                                                                            <span>Normalpris</span><span
                                                                                                class="price">175,00</span>
                                                                                        </li>
                                                                                        <li
                                                                                            class="text-center border-0">
                                                                                            <span
                                                                                                class="midl">Medlemspris</span><span
                                                                                                class="price blue">NOK
                                                                                                125,00</span>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-6 col-md-12 col-xl-6">
                                                                            <div class="product-item">
                                                                                <figure class="mx-auto">
                                                                                    <img src="{{asset('assets/images/unsplash_X1sIr53DhzA2.png')}}"
                                                                                        alt="">
                                                                                </figure>
                                                                                <div class="product-item-content">
                                                                                    <h5 class="text-center">Nivea</h5>
                                                                                    <p class="text-center">Bonding Oil
                                                                                        No.7</p>
                                                                                    <span
                                                                                        class="text-center">Shampoo</span>
                                                                                </div>
                                                                                <div class="product-item-footer">
                                                                                    <ul class="nav">
                                                                                        <li class="text-center">
                                                                                            <span>Normalpris</span><span
                                                                                                class="price">175,00</span>
                                                                                        </li>
                                                                                        <li
                                                                                            class="text-center border-0">
                                                                                            <span
                                                                                                class="midl">Medlemspris</span><span
                                                                                                class="price  blue">NOK
                                                                                                125,00</span>
                                                                                        </li>
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
                                            </ul>
                                        </li> -->
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">Pet products</a>
                                            <ul class="dropdown-menu">
                                                <div class="dropdown-menu-container">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-7 col-lg-8">
                                                                <div class="row">
                                                                    <div class="col-sm-6 col-lg-3">
                                                                        <div class="special-item">
                                                                            <h4>Cats</h4>
                                                                            <figure>
                                                                                <img src="https://www.bigbuy.eu/2380692-home/4018653907863_S7161395_P00.jpg"
                                                                                    alt="">
                                                                            </figure>
                                                                            <ul>
                                                                                @foreach(get_subcategories(19718,2) as
                                                                                $row)
                                                                                <li><a
                                                                                        href="{{route('products',$row->url)}}">{{$row->name}}</a>
                                                                                </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-6 col-lg-3">
                                                                        <div class="special-item">
                                                                            <h4>Dogs</h4>
                                                                            <figure>
                                                                                <img src="https://cdnbigbuy.com/images/0729849107656_S7139282_P01.jpg"
                                                                                    alt="">
                                                                            </figure>
                                                                            <ul>
                                                                                @foreach(get_subcategories(19720,2) as
                                                                                $row)
                                                                                <li><a
                                                                                        href="{{route('products',$row->url)}}">{{$row->name}}</a>
                                                                                </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-6 col-lg-3">
                                                                        <div class="special-item">
                                                                            <h4>Horses</h4>
                                                                            <figure>
                                                                                <img src="https://cdnbigbuy.com/images/8414580005409_00_WBG2.jpg"
                                                                                    alt="">
                                                                            </figure>
                                                                            <ul>
                                                                                @foreach(get_subcategories(19717,2) as
                                                                                $row)
                                                                                <li><a
                                                                                        href="{{route('products',$row->url)}}">{{$row->name}}</a>
                                                                                </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6 col-lg-3">
                                                                        <div class="special-item">
                                                                            <h4>Small animals</h4>
                                                                            <figure>
                                                                                <img src="https://cdnbigbuy.com/images/4011905630014_S7138865_P00.jpg"
                                                                                    alt="">
                                                                            </figure>
                                                                            <ul>
                                                                                @foreach(get_subcategories(19716,2) as
                                                                                $row)
                                                                                <li><a
                                                                                        href="{{route('products',$row->url)}}">{{$row->name}}</a>
                                                                                </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="subcribe-form">
                                                                    <h3>Subscribe with us</h3>
                                                                    <form>
                                                                        <input type="email" class="form-control"
                                                                            placeholder="Enter your email Address">
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5 col-lg-4">
                                                                <div class="vertical-cell h-100">
                                                                    <div class="product-item-title">
                                                                        <h4>Special offer</h4>
                                                                    </div>
                                                                    <div class="row">
                                                                        @foreach(get_special_products() as $row)
                                                                        <div class="col-sm-6 col-md-12 col-xl-6">
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
                                                                                    <h5 class="text-center">
                                                                                        {{$row->condition}}</h5>
                                                                                    <a
                                                                                        href="{{route('products.details', $row->url)}}">
                                                                                        <p class="text-center">
                                                                                            {{$row->name}}</p>
                                                                                    </a>
                                                                                    <a
                                                                                        href="{{route('products', $row->url)}}">
                                                                                        <span
                                                                                            class="text-center">{{$row->name}}</span>
                                                                                    </a>
                                                                                </div>
                                                                                <div class="product-item-footer">
                                                                                    <ul class="nav">
                                                                                        <li class="text-center">
                                                                                            <span>Normalpris</span><span
                                                                                                class="price">kr
                                                                                                {{$row->retailPrice}}</span>
                                                                                        </li>
                                                                                        <li
                                                                                            class="text-center border-0">
                                                                                            <span
                                                                                                class="midl">Medlemspris</span><span
                                                                                                class="price blue">kr
                                                                                                {{$row->wholesalePrice}}</span>
                                                                                        </li>
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
                                                </div>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="user-area d-flex ms-auto" style="@if(Request::is('products/view/*')) padding-right: 10px @endif">
                                <div class="membership-btn">
                                    <a href="{{route('compare')}}"><span>Membership</span></a>
                                </div>

                                <ul class="nav">
                                    @if(!Request::is('products/view/*'))
                                    @if(Auth::check())
                                    <li class="user">
                                        <a href="{{route('dashboard')}}" >
                                            Account
                                        </a>
                                    </li>
                                    <form id="logout-form" action="{{ route('logout',app()->getLocale()) }}"
                                        method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    @else
                                    <li class="user"><a href="{{route('login')}}">Login</a></li>
                                    @endif
                                    @endif
                                    <li class="shopping-cart"><a href="#">Basket <p
                                                class="cart_number">{{ Cart::getTotalQuantity()}}</p></a></li>
                                    <!-- <li class="shopping-cart"><a href="{{ route('cart.list') }}">Basket <p
                                                class="cart_number">{{ Cart::getTotalQuantity()}}</p></a></li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </div><!-- //end .header-area -->
        </header>
        @yield('content')
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
                                                <img src="{{asset('assets/images/social-icon-1.png')}}" alt="">
                                            </figure>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <figure>
                                                <img src="{{asset('assets/images/social-icon-2.png')}}" alt="">
                                            </figure>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <figure>
                                                <img src="{{asset('assets/images/social-icon-3.png')}}" alt="">
                                            </figure>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <figure>
                                                <img src="{{asset('assets/images/social-icon-4.png')}}" alt="">
                                            </figure>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <figure>
                                                <img src="{{asset('assets/images/social-icon-5.png')}}" alt="">
                                            </figure>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <figure>
                                                <img src="{{asset('assets/images/social-icon-6.png')}}" alt="">
                                            </figure>
                                        </a>
                                    </li>
                                </ul>
                                <div class="company text-white">
                                    CC EUROPE LTD <br>Numéro d'organisation: 15652312
                                </div>
                                <address class="text-white">
                                    128 City Road <br/>LONDON <br/> United Kingdom <br/> EC1V 2NX
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

   
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            if ($.cookie('pop') == null) {
                $('#popup').modal('show');
                // $.cookie('pop', '7');
            }

            var cart_active = $('#cart_active').val();
            if (cart_active != null) {
                $("#side_cart_bar").addClass("active");
            }
        });
    </script>
    <script src="
    https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js
    "></script>
    <script src="{{asset('assets/js/popup.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/toastr.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/js/toastr.min.js')}}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="{{asset('assets/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/OwlCarousel/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>
   
</body>

</html>