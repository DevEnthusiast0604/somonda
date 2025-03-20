@extends('layouts.frontend')
@section('content')
@include('layouts.user_layout')
<section class="single-banner dashboard-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-content">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="profile mb-5">
    <div class="container">
        <div class="login-area">
            <div class="row">
                    <form action="{{ route('usersUpdate', Auth::user()->id) }}" method="post" class="row">
                        @csrf
                        @method('PATCH')
                        <div class="heading">
                            <h4>@lang('Hi'), {{Auth::user()->username }}</h4>
                        </div>
                        <div class="form-group">
                            <label class="form-label">@lang('Username')</label>
                            <input name="username" type="text" class="form-control" placeholder="@lang('Username')"
                                value="{{auth()->user()->username}}">
                        </div>

                        <div class="form-group"><label class="form-label">@lang('Email')</label><input name="email"
                                type="email" class="form-control" placeholder="@lang('Email')"
                                value="{{auth()->user()->email}}">
                        </div>

                        <div class="form-group"><label class="form-label">@lang('Phone Number')</label>
                            <input name="phone" type="text" class="form-control phone"
                                placeholder="@lang('Phone Number')" value="{{auth()->user()->phone}}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">@lang('Profile Image')</label>
                            <input type="file" name="image" class="form-control" id="inputGroupFile01"
                                aria-describedby="inputGroupFileAddon01">
                        </div>
                        <div class="d-flex justify-content-between">
                            <button  type="submit" class="btn btn-primary">Update Profile</button>
                            <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#change_password">
                                <i class="ft-lock"></i>
                                @lang('Password')
                            </a>
                        </div>
 
                    </form>
            </div>
        </div>
    </div>
</section>
<div class="modal fade " id="change_password" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content round">
            <div class="modal-header">
                <h5 class="modal-title text-bold-700" id="offer_add">@lang('Change Password')</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('ChangePassword') }}" enctype="multipart/form-data" class="px-3">
                    @csrf
                    <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">@lang('Password')</label>
                            <input id="password" type="password" class="form-control round"
                                placeholder="@lang('Password')" name="password" autocomplete="new-password" required>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <div class="form-group">
                            <label for="password-confirm">@lang('Confirm Password')</label>
                            <input id="password-confirm" type="password" class="form-control round"
                                name="password_confirmation" placeholder="@lang('Confirm Password')" required
                                autocomplete="new-password">
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <button type="submit" class="btn btn-danger mb-1 pull-right round"><i
                                class="fas fa-lock-open"></i>
                            @lang('Update Password') </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

@endsection