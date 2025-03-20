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
                                    <h4 class="card-title"><i class="ft-activity"></i> Sales history
                                        <span>({{$count}})</span>
                                    </h4>
                                </div>

                                <div class="col-lg-6 col-sm-8 col-md-6 col-xs-12 text-right">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> @lang('Home')</a>
                                        </li>
                                        <li class="breadcrumb-item active"> Sales history</li>
                                    </ol>
                                </div>
                                <!-- /.breadcrumb -->
                            </div>
                        </div>
                        <div class="row px-3">
                            <div class="col-md-12">
                                <form method="get" id="search_form" action="{{route('admin.sales.search')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mx-2 mb-1 d-flex">
                                        <input type="text" name="product_id" class="form-control round" placeholder="Product ID">
                                        <input type="text" name="email" class="form-control mx-2 round" placeholder="Customer Email">
                                        <input type="text" name="country" class="form-control mx-2 round" placeholder="Country ex: SE">
                                        <input type="date" name="date" class="form-control round" placeholder="Sales Date">
                                    </div>
                                    <div class="mx-2 text-right">
                                        <button class="btn btn-info round" type="submit">
                                            <i class="ft-search"></i> Search 
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
                                            <th class="text-center"><i class="ft-image"></i></th>
                                            <th width="300"><i class="ft-shopping-cart"></i> @lang('Product')</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th><i class="icon-user"></i> Customer</th>
                                            <th><i class="ft-clock"></i> Sales Date</th>
                                            <th width="100px"><i class="ft-sliders"></i> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $row)
                                        @if($row->product)
                                        <tr>
                                            <td>{{ ($data ->currentpage()-1) * $data ->perpage() + $loop->index + 1 }}</td>
                                            <td>
                                                @if($row->product->image)
                                                    @if($row->product->custom == 1)
                                                    <a href="{{asset('uploads/products')}}/{{$row->product->image}}" class="image-link">
                                                        <img src="{{asset('uploads/products')}}/{{$row->product->image}}" class="round" width="80" alt="">
                                                    </a>
                                                    @else
                                                    <a href="{{$row->product->image}}" class="image-link">
                                                        <img src="{{$row->product->image}}" class="round" width="80" alt="">
                                                    </a>
                                                    @endif
                                                @else
                                                <img src="{{asset('assets/images/no_image.jpg')}}" class="round" width="80"
                                                    alt="No Image">
                                                @endif
                                            </td>
                                            <td>
                                                {{$row->product->name}}
                                                @if($row->product->custom == 1)
                                                <br><span class="badge badge-info">Custom Product : {{$row->product_id}}</span>
                                                @else
                                                <br><span class="badge badge-danger">Bigbuy Product: {{$row->product_id}}</span>
                                                @endif
                                            </td>
                                            <td>{{$row->quantity}}</td>
                                            <td>{{$row->price}}</td>
                                            <td>
                                               <span>{{$row->firstName}} {{$row->lastName}}</span> <br>
                                               <span>{{$row->email}}</span>
                                            </td>
                                            <td>{{date('M d, Y h:i a', strtotime($row->created_at))}}</td>
                                            <td>
                                                <a data-toggle="modal"  data-target="#order{{$row->id}}"> 
                                                    <i class="icon-social-dropbox text-info"></i> 
                                                </a>
                                                <button style="background:none;border:none"
                                                    onclick="saleDelete({{$row->id}})" class="text-danger"><i
                                                        class="icon-trash text-danger"> </i> </button>
                                            </td>
                                        </tr>
                                       
                                           <!-- Edit Modal -->
                                        <div class="modal fade" id="order{{$row->id}}" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
                                                <div class="modal-content semi-round">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-bold-700" id="exampleModalLongTitle"><i
                                                                class="icon-social-dropbox"></i> Order Info</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body cart-form">
                                                        <form class="form" method="post" action="{{ route('admin.order', $row->id) }}"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            @method('patch')
                                                            <div class="row px-2">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <input type="text" @if($row->order) disabled @endif class="form-control round"
                                                                            name="firstName" value="{{$row->firstName}}"
                                                                            placeholder="First Name" required autofocus>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <input type="text" @if($row->order) disabled @endif class="form-control round"
                                                                            name="lastName" value="{{$row->lastName}}"
                                                                            placeholder="Last Name" required autofocus>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <input type="text" @if($row->order) disabled @endif class="form-control round"
                                                                            name="email" value="{{$row->email}}"
                                                                            placeholder="Email" required autofocus>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <input type="text" @if($row->order) disabled @endif class="form-control round"
                                                                            name="phone" value="{{$row->phone}}"
                                                                            placeholder="Phone" required autofocus>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <input type="text" @if($row->order) disabled @endif class="form-control round"
                                                                            name="town" value="{{$row->town}}"
                                                                            placeholder="Town" required autofocus>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <input type="text" @if($row->order) disabled @endif class="form-control round"
                                                                            name="address" value="{{$row->address}}"
                                                                            placeholder="Address" required autofocus>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <select name="country" @if($row->order) disabled @endif class="form-control round" id="">
                                                                            <option value="SE" @if($row->country == 'SE') selected @endif>Sweden</option>
                                                                            <option value="FR" @if($row->country == 'FR') selected @endif>French</option>
                                                                            <option value="DK" @if($row->country == 'DK') selected @endif>Denmark</option>
                                                                            <option value="IT" @if($row->country == 'IT') selected @endif>Italy</option>
                                                                            <option value="PT" @if($row->country == 'PT') selected @endif>Portugal</option>
                                                                            <option value="FI" @if($row->country == 'FI') selected @endif>Finland</option>
                                                                            <option value="NL" @if($row->country == 'NL') selected @endif>Netherlands</option>
                                                                            <option value="GE" @if($row->country == 'GE') selected @endif>German</option>
                                                                            <option value="NO" @if($row->country == 'NO') selected @endif>Norway</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <input type="text" @if($row->order) disabled @endif class="form-control round"
                                                                            name="postcode" value="{{$row->postcode}}"
                                                                            placeholder="Postcode" required autofocus>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 text-right mt-2">
                                                                    @if($row->product->custom != 1)
                                                                    @if($row->order)
                                                                    <span class="badge badge-success"><i class="icon-basket-loaded"></i> Already ordered successfully!</span>
                                                                    @else
                                                                    <button class="btn btn-primary round" type="submit"> <i
                                                                            class="ft-shopping-cart"></i>
                                                                        Order Now </button> 
                                                                    @endif
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Edit modal -->
                                        @endif
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
function saleDelete(id) {

    var token = $("meta[name='csrf-token']").attr("content");

    swal({
            title: "Are you sure?",
            text: "But you will still be able to retrieve this sales record.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dd3819",
            confirmButtonText: "Yes, Delete this sales!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm) {
            if (isConfirm) {
                console.log(id);
                $.ajax({
                    url: "{{route('admin.salesDestroy')}}",
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
                swal("Cancelled", "This sale history is safe :)", "error");
            }
        });
    }

     
</script>
@endsection