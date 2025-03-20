@extends('layouts.frontend')
@section('content')
<style>
.invalid-feedback{
    text-align: left!important;
    margin-top: -0.75em!important;
    margin-bottom: 0.75em!important;
    padding: 0 1em!important;
}
</style>
 
<section class="login">
    <div class="container">
        <div class="login-area">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-12">
                    <div class="login_content login_content_2">
                        <p></p>
                        <form method="POST" action="{{ route('password.email') }}" class="row">
                            @csrf
                            <div class="heading">
                            <h4>@lang('Reset Password')</h4>

                            </div>
                            <div class="col-lg-12 col-md-12 text-left">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control mb-3  @error('email') is-invalid @enderror" value="{{old('email')}}"
                                        placeholder="@lang('Email')" name="email"  required/>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
                            </div>
                            <div class="col-lg-12 col-md-12">
                                @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-lg-12 col-md-12 mt-3">
                                <button type="submit"  class="text-white">@lang('Reset Password')</button>
                            </div>
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
 
@endsection