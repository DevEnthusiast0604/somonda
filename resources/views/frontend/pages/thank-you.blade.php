<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset('assets/images/plusdeal_logo.png')}}">
    <title>deal | Thank You</title>
	<link href='https://fonts.googleapis.com/css?family=Lato:300,400|Montserrat:700' rel='stylesheet' type='text/css'>
	<style>
		@import url(//cdnjs.cloudflare.com/ajax/libs/normalize/3.0.1/normalize.min.css);
		@import url(//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css);
	</style>
	<link rel="stylesheet" href="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/default_thank_you.css">
	<script src="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/jquery-1.9.1.min.js"></script>
	<script src="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/html5shiv.js"></script>
	<script>
			!function (w, d, t) {
			w.TiktokAnalyticsObject=t;var ttq=w[t]=w[t]||[];ttq.methods=["page","track","identify","instances","debug","on","off","once","ready","alias","group","enableCookie","disableCookie"],ttq.setAndDefer=function(t,e){t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}};for(var i=0;i<ttq.methods.length;i++)ttq.setAndDefer(ttq,ttq.methods[i]);ttq.instance=function(t){for(var e=ttq._i[t]||[],n=0;n<ttq.methods.length;n++)ttq.setAndDefer(e,ttq.methods[n]);return e},ttq.load=function(e,n){var i="https://analytics.tiktok.com/i18n/pixel/events.js";ttq._i=ttq._i||{},ttq._i[e]=[],ttq._i[e]._u=i,ttq._t=ttq._t||{},ttq._t[e]=+new Date,ttq._o=ttq._o||{},ttq._o[e]=n||{};var o=document.createElement("script");o.type="text/javascript",o.async=!0,o.src=i+"?sdkid="+e+"&lib="+t;var a=document.getElementsByTagName("script")[0];a.parentNode.insertBefore(o,a)};

			ttq.load('CFIJ7MJC77U7HEMA0R8G');
			ttq.page();
			ttq.track('CompletePayment');

			}(window, document, 'ttq');
	</script>
	<!-- End TikTok Pixel -->
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
				fbq('track', 'Purchase');
			</script>
			<noscript>
			<img height="1" width="1" style="display:none" 
				src="https://www.facebook.com/tr?id=1804480500032151&ev=Purchase&noscript=1"/>
			</noscript>
<!-- End Facebook Pixel Code -->


    <style>
        .site-footer{
            padding: 5em 0 25px;
        }
        p{
            line-height: 28px;
        }
    </style>
	<script>
		const sclParameters = {
		amount: 'amount',
		adv_order_id: 'adv_order_id',
		adv_user_id: 'adv_user_id',
		adv_param1: 'adv_param1',
		adv_param2: 'adv_param2',
		adv_param3: 'adv_param3',
		adv_param4: 'adv_param4',
		adv_param5: 'adv_param5',
		idfa: 'idfa',
		gaid: 'gaid',
		};
		function sclConversionPixelFn(sclParameters) {const cookieValue = document.cookie.split('; ').find((row) => row.startsWith('click_id='))?.split('=')[1];let trackingUrl = 'https://nordictraffic.scaletrk.com/track/goal-by-click-id?click_id={click_id}&goal_id=1';trackingUrl = trackingUrl.replace('{click_id}', cookieValue);if (sclParameters && Object.keys(sclParameters)?.length > 0) {const url = new URL(trackingUrl);Object.entries(sclParameters).forEach(([key, value]) => {url.searchParams.set(key, value.toString());});trackingUrl = url.href;}const imgEl = document.createElement('img');imgEl.src = trackingUrl;imgEl.width = 1;imgEl.height = 1;document.body.insertAdjacentElement('beforeend', imgEl);}sclConversionPixelFn(sclParameters);
	</script>

	 
</head>
<body>
	<noscript>
		<img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=2419370404933990&ev=PageView&noscript=1"/>
	</noscript>
	<noscript>
		<img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=613698397065206&ev=PageView&noscript=1"/>
	</noscript>
	<noscript>
		<img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=1632919927189675&ev=Purchase&noscript=1"/>
	</noscript>

	<header class="site-header" id="header">
		<h1 class="site-header__title" data-lead-id="site-header-title">@lang('thank_you')</h1>
	</header>

	<div class="main-content">
		<i class="fa fa-check main-content__checkmark" id="checkmark"></i>
		<!-- <p class="main-content__body" data-lead-id="main-content-body">@lang('thank_you_description')</p> -->
	</div>

	<footer class="site-footer" id="footer">
		<p class="site-footer__fineprint" id="fineprint">Copyright ©{{date('Y')}} PlusDeal | All Rights Reserved</p>
	</footer>
</body>
</html>