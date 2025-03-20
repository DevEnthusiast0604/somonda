@extends('layouts.frontend')
@section('content')
<section class="login">
    <!-- start .register -->
    <div class="container">
        <div class="login-area">
            <div class="row">
                <div class="col-md-8">
                    <form class="bg-white mx-auto" method="POST" action="">
                        @csrf
                        <div class="heading">
                            <div class="logo mx-auto">
                                <a href="index.html">
                                    <figure class="mx-auto">
                                        <img src="assets/images/plusdeal_logo.png" alt="">
                                    </figure>
                                </a>
                            </div>
                            <h4 class="text-center">Welcome back!</h4>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}"
                                placeholder="Email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" name="username" class="form-control" required
                                    placeholder="@lang('Username or Business Name')" value="{{old('username')}}" />
                        </div>

                        <div class="form-group">
                            <input id="password" type="password"class="form-control @error('password') is-invalid @enderror"
                                placeholder="@lang('Password')" name="password" required autocomplete="true" />
                            @error('password')
                            <span class="invalid-feedback" role="alert">    
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="confirm_password"
                                    placeholder="@lang('Confirm Password')" name="password_confirmation" required>
                        </div>
                    
                        <button type="submit" class="text-white mx-auto">Sign Up</button>
                        <div class="text-center">
                            <span>Already existing user? <a href="{{route('login')}}">Login now</a></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section><!-- //end .login -->
 
@endsection