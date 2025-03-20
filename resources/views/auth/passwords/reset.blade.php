@extends('layouts.frontend')
@section('content')
<style>
.eye {
    position: absolute;
    top: 59.5%;
    right: 7%;
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
 

<section class="login">
    <div class="container">
        <div class="login-area">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-12">
                <div class="login_content login_content_2">
                    <form method="POST" action="{{ route('password.update') }}">
                        <div class="heading">
                            <h2>@lang('Reset Password')</h2>
                        </div>
                        <div class="row m-0">
                            @csrf

                            <div class="col-md-12 bg-white px-4  ">
                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ $email ?? old('email') }}" required autocomplete="email"
                                            autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required placeholder="New Password" autocomplete="new-password">
                                            <i class="ft-eye eye" id="eye" style="z-index: 9999; top: 30%"></i>

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input type="password" class="form-control" id="confirm_password"
                                            placeholder="Confirm Password" name="password_confirmation" required
                                            autocomplete="new-password">
                                            <i class="ft-eye eye" id="confirm_eye" style="z-index: 9999; top: 30%"></i>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-lg-12 col-md-12">
                                        <input type="submit" value="@lang('Complete')" />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
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