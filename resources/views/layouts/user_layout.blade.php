<section class="user_layout py-4">
    <div class="container">
        <div class="row user_navbar">
            <div class="col-lg-2"><a href="{{route('user.profile')}}"
                    class="@if(Request::is('user/profile')) active @endif"><i class="ft-user"></i> Profile</a></div>
            <div class="col-lg-2"><a href="{{route('user.products')}}"
                    class="@if(Request::is('user/products')) active @endif"><i class="ft-shopping-cart"></i> My
                    Products</a></div>
            <div class="col-lg-2"><a href="{{route('user.membership')}}"
                    class="@if(Request::is('user/membership')) active @endif"><i class="ft-pocket"></i>  Membership</a></div>
            <div class="col-lg-2"> <a href="{{ route('logout',app()->getLocale()) }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                       <i class="ft-power"></i> Logout
                </a></div>
        </div>
        <hr>
    </div>
</section>