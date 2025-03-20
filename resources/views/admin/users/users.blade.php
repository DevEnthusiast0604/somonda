@extends('layouts.admin_layout')
@section('content')
<style>
    .long_title{
        white-space: break-spaces;
    }
    th{
        white-space: nowrap;
    }
    td{
        vertical-align: middle!important;
    }
    #download_form{
        border: 1px dashed red;
        padding-top: 1em;
        border-radius: 0.8em;
    }
    .add_form{
        border: 2px solid #259b85;
        padding-top: 1em;
        border-radius: 0.8em;
    }
    #search_form{
        border: 2px inset #1cbcd8;
        padding-top: 1em;
        border-radius: 0.8em;
    }
    .active_bg{
        background-color: #5bbf9a2e;
        border: 2px dashed #5bbf9a;
    }
</style>
<div class="main-content">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row col-md-12">
                            <div class="col-md-9">
                                <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
                                    <h4 class="card-title"><i class="icon-users"></i> Customers
                                        <span>({{$count}})</span>
                                    </h4>
                                </div>

                                <div class="col-lg-6 col-sm-8 col-md-6 col-xs-12 text-right">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> @lang('Home')</a>
                                        </li>
                                        <li class="breadcrumb-item active"> Customers</li>
                                    </ol>
                                </div>
                                <!-- /.breadcrumb -->
                            </div>
                            <div class="col-md-3 text-right">
                                <a class="btn px-2 btn-outline-info round" href="{{route('admin.addUser')}}"><i class="icon-user-follow"></i> Add Customer</a>
                            </div>
                        </div>
                        <div class="row px-3">
                            <div class="col-md-12">
                                <form method="get" id="search_form" action="{{route('admin.user.search')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mx-2 mb-1 d-flex">
                                        <input type="text" name="name" class="form-control round" placeholder="Customer Name">
                                        <input type="text" name="email" class="form-control mx-2 round" placeholder="Email">
                                        <!-- <input type="text" name="membership" class="form-control round" placeholder="Membership"> -->
                                   
                                        <button class="btn btn-info text-light round form-control" type="submit">
                                            <i class="ft-search"></i> Search User
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                     <div class="card-body pt-0">
                        <div class="card-content">
                            <div class="col-md-12 table-responsive px-3">
                                <table class="table table-hover" id="data-table">
                                    <thead>
                                        <tr>
                                            <th>@lang('No')</th>
                                            <th><i class="icon-user"></i> Username</th>
                                            <th><i class="ft-mail"></i> @lang('Email')</th>
                                            <th><i class="ft-pocket"></i> @lang('Membership')</th>
                                            <th width="100px"><i class="ft-sliders"></i> @lang('Action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $row)
                                        <tr>
                                            <td>{{ ($data ->currentpage()-1) * $data ->perpage() + $loop->index + 1 }}</td>
                                            <td>{{$row->username}}</td>
                                            <td>{{$row->email}}</td>
                                            <td>
                                                @if(check_membership($row->id) == 1) 
                                                <a class="btn btn-danger btn-sm text-light" href="{{route('admin.user.membership', $row->id)}}" class="pr-1 pl-2"><i class="ft-x-square"></i> Cancel Membership</a>
                                                @else
                                                <span><i class="ft-user-x"> </i> Unsubscribed Member</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{route('admin.editUser', $row->id)}}" class="pr-1 pl-2"><i
                                                        class="fa fa-edit"></i> </a>
                                                <button style="background:none;border:none"
                                                    onclick="userDelete({{$row->id}})" class="text-danger"><i
                                                        class="fa fa-trash text-danger"> </i> </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12 mx-3">
                                {!! $data->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 
<script>
function userDelete(id) {

    var token = $("meta[name='csrf-token']").attr("content");

    swal({
            title: "Are you sure?",
            text: "But you will still be able to retrieve this user.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dd3819",
            confirmButtonText: "Yes, Delete this User!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm) {
            if (isConfirm) {
                console.log(id);
                $.ajax({
                    url: "{{route('admin.usersDestroy')}}",
                    type: 'DELETE',
                    data: {
                        "id": id,
                        "_token": token,
                    },
                    success: function(data) {
                        swal({
                            title: "Success!",
                            text: data.message,
                            type: "success"
                        }, function() {
                            location.reload()
                        });
                    },
                })

            } else {
                swal("Cancelled", "This User is safe :)", "error");
            }
        });
    }

     
</script>
@endsection