@extends('layouts.app')
@section('content')
<style>
.eye {
    position: absolute;
    top: 59.5%;
    right: 8%;
    cursor: pointer;
    color: #2e2c2c;
}

.invalid-feedback {
    text-align: left !important;
    margin-top: -0.75em !important;
    margin-bottom: 0.75em !important;
    padding: 0 1em !important;
}

#password, #confirm_password{
    position: relative;
}
</style>

<section class="banner_02">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb"><a href="{{url('/')}}">@lang('Home')</a>><span>@lang('Sign Up')</span></div>
            </div>
        </div>
    </div>
</section>


<section class="login_page_2">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 col-md-12">
                <div class="login_content login_content_2">
                    <h2>@lang('Sign Up')</h2>                 
                    <p class="bold">@lang('Enter Account Details')</p>
                    <form action="{{route('register')}}" method="post" class="row">
                        @csrf
                        <div class="col-lg-6 col-md-6 text-left">
                            <label for="account_type">@lang('Account Type')</label>
                            <select name="type" class="form-control" id="account_type" required>
                                <option value="2">@lang('Organizer')</option>
                                <option value="3">@lang('User')</option>
                            </select>
                        </div>
                        <div class="col-lg-6 col-md-6 text-left">
                            <label for="">@lang('Email')</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required
                                    placeholder="@lang('Email')" value="{{old('email')}}" autocomplete="email" />
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <input type="text" name="first_name" class="form-control" required
                                    placeholder="@lang('First Name')" value="{{old('first_name')}}" />
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <input type="text" name="last_name" class="form-control" required
                                    placeholder="@lang('Last Name')" value="{{old('last_name')}}" />
                        </div>
                      
 
                        <div class="col-lg-6 col-md-6">
                            <input id="password" type="password"class="form-control @error('password') is-invalid @enderror"
                                placeholder="@lang('Password')" name="password" required autocomplete="true" />
                            <i class="ft-eye eye" id="eye" style="z-index: 9999; top: 30%"></i>
                            @error('password')
                            <span class="invalid-feedback" role="alert">    
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <input type="password" class="form-control" id="confirm_password"
                                    placeholder="@lang('Confirm Password')" name="password_confirmation" required>
                            <i class="ft-eye eye" id="confirm_eye" style="z-index: 9999; top: 30%"></i>
                        </div>
                        <div class="col-lg-7 col-md-7">
                            <p><i class="twi-shield-alt"></i>@lang('secure_text')</p>
                            <div class="radio_btn">
                                <input type="checkbox" id="remember" name="term" value="term" required>
                                <label for="remember">@lang('I read and agree')
                                    <a href="{{route('terms')}}" target="_blank">@lang('Terms and Conditions').</a>
                                </label>
                            </div>
                            <h6>@lang('Already User')? <a class="mx-2" href="{{route('login')}}">@lang('Sign In')</a></h6>
                        </div>
                        <div class="col-lg-5 col-md-5">
                            <input type="submit" value="@lang('Sign Up')" />
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
    eyeIcon.addEventListener("click", function(e){
        const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
        passwordField.setAttribute("type", type);
        $(this).toggleClass("ft-eye ft-eye-off");

    })

    const confirm_passwordField = document.querySelector("#confirm_password");
    const confirm_eyeIcon= document.querySelector("#confirm_eye");
    confirm_eyeIcon.addEventListener("click", function(e){
        const type = confirm_passwordField.getAttribute("type") === "password" ? "text" : "password";
        confirm_passwordField.setAttribute("type", type);
        $(this).toggleClass("ft-eye ft-eye-off");

    })
</script>
@endsection