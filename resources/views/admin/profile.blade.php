@extends('layouts.admin_layout')
@section('content')
<div class="main-content">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-9">
                        <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
                            <h4 class="card-title"><i class="fa fa-address-book-o"></i> @lang('Profile')
                            </h4>
                        </div>

                        <div class="col-lg-6 col-sm-8 col-md-6 col-xs-12 text-right">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                            class="fa fa-home"></i> @lang('Home')</a></li>
                            <li class="breadcrumb-item"><a><i
                            class="icon-settings"></i> @lang('Settings')</a></li>
                                <li class="breadcrumb-item active">@lang('Profile')</li>
                            </ol>
                        </div>
                        <!-- /.breadcrumb -->
                    </div>
                </div>
            </div>
            <div class="card-body mx-2 pt-0">
                <div class="card-content">
                    <form class="form" method="post" action="{{ route('usersUpdate', Auth::user()->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="col-md-12 register_panel2 bg-white">
                            <div class="row text-center" style="justify-content: center">
                                @if($data->image)
                                <img src="{{asset('uploads/avatar/')}}/{{$data->image}}" class="text-center m-3"
                                    height="100" style="border-radius:0.4em" alt="">
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control mb-2 round" value="{{ $data->username}}"
                                        name="username" placeholder="Userame" id="username" required autofocus>
                                </div>
                                <div class="col-md-4">
                                    <label for="">@lang('Email')</label>
                                    <input id="email" type="text" class="form-control round mb-2" value="{{$data->email}}"
                                        name="email" placeholder="Email" required autofocus>
                                </div>
                                <div class="col-md-4">
                                    <label for="">@lang('Phone Number')</label>
                                    <input type="text" name="phone" value="{{$data->phone}}"
                                        class="form-control round">
                                </div>
                                <div class="col-md-4">
                                    <label for="">@lang('Profile Image')</label>
                                    <div class="form-group col-md-12">
                                        <div class="input-group ">
                                            <div class="custom-file">
                                                <input type="file" name="image" class="custom-file-input"
                                                    id="imgInp">
                                                <label class="custom-file-label">@lang('Choose Picture')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <img width="100" src="#"  id="blah" alt="" />
                                </div>
                            </div>
                            <script>
                                function readURL1(input) {
                                    if (input.files && input.files[0]) {
                                        var reader = new FileReader();

                                        reader.onload = function(e) {
                                            $('#blah').attr('src', e.target.result);
                                        }

                                        reader.readAsDataURL(input.files[0]);
                                    }
                                }

                                $("#imgInp").change(function() {
                                    readURL1(this);
                                });
                            </script>

                            <div class="col-md-12 mt-2">

                                <button class="btn btn-primary px-3 round" type="submit">
                                    <i class="fa fa-check-square-o"></i>
                                    @lang('Update')
                                </button>

                                <a class="btn btn-danger mx-3 round px-4" href data-toggle="modal"
                                    data-target="#change_password"> <i class="icon-lock"></i>
                                    @lang('Change Password')
                                        </a>

                                <a class="btn btn-outline-dark pull-right round px-3 " href="{{route('admin.dashboard')}}"><i class="fa fa-home"></i> @lang('Dashboard')</a>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade " id="change_password" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content round">
            <div class="modal-header">
                <h5 class="modal-title text-bold-700" id="offer_add">@lang('Change Password')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('ChangePassword') }}" enctype="multipart/form-data" class="px-3">
                    @csrf
                    <input type="hidden" name="user_id" value="{{$data->id}}">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">@lang('Password')</label>
                            <input id="password" type="password" class="form-control round" placeholder="@lang('Password')"
                                name="password" autocomplete="new-password" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="password-confirm">@lang('Confirm Password')</label>
                            <input id="password-confirm" type="password" class="form-control round"
                                name="password_confirmation" placeholder="@lang('Confirm Password')" required
                                autocomplete="new-password">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-danger mb-1 pull-right round"><i class="icon-lock-open"></i>
                    @lang('Update Password')  </button>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection
