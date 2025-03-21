@extends('layouts.frontend')
@section('content')
<section class="login">
    <!-- start .login -->
    <div class="container">
        <div class="login-area">
            <div class="row">
                <div class="col-md-8">
                    <form class="bg-white mx-auto" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="heading">
                            <div class="logo mx-auto">
                                <a href="index.html">
                                    <figure class="mx-auto">
                                        <img src="assets/images/plusdeal_logo.png" alt="">
                                    </figure>
                                </a>
                            </div>

                            <h4 class="text-center">@lang('Welcome back!')</h4>
                        </div>
                        @if (\Session::has('success'))
                        <div class="alert alert-fill alert-success alert-dismissible fade show" role="alert">
                             <strong>Success</strong> {{ \Session::get('success')}}   
                             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @elseif (\Session::has('error'))
                        <div class="alert alert-fill alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error</strong> {{ \Session::get('error')}}  
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                    
                        <div class="form-group">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" 
                                placeholder="@lang('Email')">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <input type="password" class="form-control" name="password" placeholder="@lang('Password') *">
                        </div>

                        <div class="info">
                            <a href="{{url('password/reset')}}">@lang('Forgot Password') *</a>
                        </div>

                        <button type="submit" class="text-white mx-auto login_btn">@lang('Sign In')</button>

                        <div class="text-center">
                            <span>@lang('Not an existing user?') <a href="{{route('membership')}}">@lang('Register now')</a></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section><!-- //end .login -->
@endsection