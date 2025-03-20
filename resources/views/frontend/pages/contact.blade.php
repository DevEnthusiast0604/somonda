@extends('layouts.frontend')
@section('content')
<section class="terms_conditions">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-4 mt-5">
                
                <div class="footer-right">
                    <h3>Get in touch</h3>
                    <div>
                        <p><i class="ft-home"></i> Rebel Monkey Marketing Ltd,  Co no. 14009110</p> 
                        <p><i class="ft-map-pin"></i>   128 City Road <br>   London EC1V 2NX <br> UNITED KINGDOM</p> 
                        <p><i class="ft-mail"></i> <a href="mailto:support@somonda.com"> support@somonda.com</a></p> 
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <form action="{{route('user.contact')}}" method="POST" class="row">
                    @csrf
                    <div class="col-lg-4">
                        <input placeholder="@lang('Name'):" class="form-control round" name="name" type="text">
                    </div>
                    <div class="col-lg-4">
                        <input placeholder="@lang('Email'):" class="form-control round" name="email" type="email">
                    </div>
                    <div class="col-lg-4">
                        <input placeholder="@lang('Subject'):" class="form-control round" name="subject" type="text">
                    </div>
                    <div class="col-lg-12 mt-3">
                        <textarea name="message" class="form-control round" rows="8" placeholder="@lang('Message'):"></textarea>
                    </div>
                    <div class="col-lg-4 mt-3">
                        <input name="submit" value="@lang('Submit')" class="submit_btn"  type="submit" id="submit">
                    </div>
                </form>
                <div>
                    @if ($message = Session::get('success'))
                        <div class="px-4 py-2 my-3 custom-alert rounded">
                            <p class="text-green-800">@lang($message)</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@include('components.subscribe')
@endsection