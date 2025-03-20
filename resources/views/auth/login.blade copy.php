@extends('layouts.app')
@section('content')
<style>
.eye{
	position: absolute;
	top: 59.5%;
	right: 7%;
	cursor: pointer;
	color: #2e2c2c;
}   
.invalid-feedback{
    text-align: left!important;
    margin-top: -0.75em!important;
    margin-bottom: 0.75em!important;
    padding: 0 1em!important;
}
 
</style>
<section class="banner_02">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb"><a href="{{url('/')}}">@lang('home')</a>><span>@lang('Sign In')</span></div>
            </div>
        </div>
    </div>
</section>

<section class="login_page_2">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-12">
                <div class="login_content login_content_2">
                    <h2>@lang('Welcome Back')</h2>
                    <p class="bold">@lang('Please enter login details')</p>
                    <form method="POST" action="{{ route('login', app()->getLocale()) }}" class="row">
                        @csrf
                        <div class="col-lg-12 col-md-12">
                            <input type="email" class="form-control  @error('email') is-invalid @enderror" value="{{old('email')}}"
                                    placeholder="@lang('Email')" name="email" required />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror 
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <input type="password" class="form-control" id="password" required
                                    name="password" value="{{old('password')}}" placeholder="@lang('Password')" />
                            <i class="ft-eye eye" id="eye" style="z-index: 9999; top: 30%"></i>
                        </div>
                        
                        <div class="col-lg-12 col-md-12">
                            <h6 class="mt-2 mb-0"> 
                                <a href="{{url('password/reset')}}" lass="form-forgot">@lang('Forgot Password')</a>
                            </h6>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <input type="submit" value="@lang('Sign In')" />
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <h6 class="mt-3">@lang('You have no account')? <a href="{{route('register')}}">@lang('Sign Up')</a></h6>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    const passwordField = document.querySelector("#password");
    const eyeIcon= document.querySelector("#eye");
    eye.addEventListener("click", function(){
        this.classList.toggle("ft-eye-off");
        const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
        passwordField.setAttribute("type", type);
    })
</script>
@endsection