@extends('layouts.admin_layout')
@section('content')
<div class="main-content">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
                                    <h4 class="card-title"><i class="icon-user-following"></i> @lang('Edit User') </h4>
                                </div>
                                <div class="col-lg-6 col-sm-8 col-md-6 col-xs-12 text-right">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                                    class="fa fa-home"></i> @lang('Home')</a></li>
                                        <li class="breadcrumb-item active"> @lang('Edit User')</li>
                                    </ol>
                                </div>
                                <!-- /.breadcrumb -->
                            </div>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body table-responsive pt-0">
                            <form method="post" class="form" action="{{ route('usersUpdate', $data->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="form-body px-3">
                                    <div class="row">
                                        @if($data->image)
                                        <div class="col-md-12 text-center">
                                            <img src="{{asset('/uploads/avatar')}}/{{$data->image}}" height="120"
                                                class="mb-3 round text-right" alt="">
                                        </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" id="username" class="form-control round"
                                                    value="{{$data->username}}" name="username"
                                                   placeholder="Username" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="email">@lang('Email')</label>
                                                <input id="email" id="email" type="text" class="form-control round"
                                                    value="{{$data->email}}" name="email" 
                                                    placeholder="@lang('Email')" required >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">@lang('Phone Number')</label>
                                                <div class="input-group">

                                                    <input type="text" name="phone"
                                                        value="{{$data->phone}}" placeholder="@lang('Phone Number')"
                                                        class="form-control round">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        
                                    <div class="row">
                                         
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">@lang('Image')</label>
                                                <div class="input-group ">
                                                    <div class="custom-file">
                                                        <input type="file" name="image" class="custom-file-input"
                                                            id="imgInp" aria-describedby="inputGroupFileAddon01">
                                                        <label class="custom-file-label" for="imgInp"> @lang('Profile Picture')
                                                        </label>
                                                    </div>
                                                </div>
                                                <img width="100" src="#" id="blah" alt="" />
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
                                    </div>


                                    <div class="col-md-12">
                                        <button class="btn btn-primary mx-3 round px-4" type="submit"> <i
                                                class="fa fa-check-square-o"></i>
                                            @lang('Update')
                                        </button>
                                        <a class="btn btn-danger mx-3 round px-4" href data-toggle="modal"
                                            data-target="#change_password"> <i class="icon-lock"></i>
                                            @lang('Change Password')
                                        </a>
                                        <a class="btn btn-secondary pull-right mx-3 round px-4"
                                            href="{{route('admin.customers')}}"> <i class="fa fa-undo"></i>
                                            @lang('Back')
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade " id="change_password" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
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
                        @lang('Update Password') </button>
                </form>
            </div>

        </div>
    </div>
</div>  
@endsection