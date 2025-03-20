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
                                    <h4 class="card-title"><i class="icon-user-follow"></i> @lang('Create a new user') </h4>
                                </div>
                                <div class="col-lg-6 col-sm-8 col-md-6 col-xs-12 text-right">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                                    class="fa fa-home"></i> @lang('Home')</a></li>
                                        <li class="breadcrumb-item active"> @lang('Add User')</li>
                                    </ol>
                                </div>
                                <!-- /.breadcrumb -->
                            </div>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body table-responsive pt-0">
                        <form method="post" class="form" action="{{ route('admin.userstore') }}" enctype="multipart/form-data"  >
                                @csrf
                                <div class="form-body px-3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="type">@lang('User Type')</label>
                                                <select name="type" class="form-control round" id="type">
                                                    <option value>@lang('Choose User Type')</option>
                                                    <option value="1">@lang('Admin')</option>
                                                    <option value="2" selected>@lang('Customer')</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" id="username" class="form-control round" name="username" value="{{old('username')}}" placeholder="@lang('Username')"
                                                    required autofocus>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="email">@lang('Email')</label>
                                                <input id="email" id="email" type="text" class="form-control round" name="email" value="{{old('email')}}" placeholder="@lang('Email')"
                                                    required autofocus>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">@lang('Phone Number')</label>
                                                <div class="input-group">
                                                    <input type="text" name="phone" placeholder="@lang('Phone Number')" class="form-control round">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">@lang('Password')</label>
                                                <input id="password" type="password" class="form-control round" placeholder="@lang('Password')" 
                                                    name="password" autocomplete="new-password" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="password-confirm">@lang('Confirm Password')</label>
                                                <input id="password-confirm" type="password" class="form-control round"
                                                    name="password_confirmation" placeholder="@lang('Confirm Password')" required
                                                    autocomplete="new-password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">@lang('Image')</label>
                                                <div class="input-group ">
                                                    <div class="custom-file">
                                                        <input type="file" name="image" class="custom-file-input" id="imgInp"
                                                            aria-describedby="inputGroupFileAddon01">
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
                                        <button class="btn btn-primary mx-3 round px-4" type="submit"> <i class="fa fa-check-square-o"></i>
                                            @lang('Save')
                                        </button>
                                        <a class="btn btn-secondary mx-3 round px-4" href="{{route('admin.customers')}}"> <i class="fa fa-undo"></i>
                                            @lang('Save')
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
 
@endsection