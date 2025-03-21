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
                            <div class="col-md-12">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h4 class="card-title"><i class="ft-tag"></i> Products <span>(Total {{$count}} / Active {{$active_products}} products)</span>
                                    </h4>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 text-right">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> @lang('Home')</a>
                                        </li>
                                        <li class="breadcrumb-item active"> Products</li>
                                    </ol>
                                </div>
                                <!-- /.breadcrumb -->
                            </div>
                        </div>
                        <div class="row px-4">
                            <div class="col-md-6 mb-2">
                                <form method="get" id="search_form" action="{{route('admin.prodSearch')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mx-2 mb-1 d-flex">
                                        <input type="number" name="id" min="1" class="form-control round" placeholder="Product ID">
                                        <input type="text" name="name" class="form-control mx-2 round" placeholder="Name">
                                        <input type="text" name="sku" min="1" class="form-control round" placeholder="SKU">
                                    </div>
                                    <div class="mx-2 text-right">
                                        <button class="btn btn-info round " type="submit">
                                            <i class="ft-search"></i> Search Product
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-3 mb-2">
                                <form method="get" class="add_form" action="{{route('admin.prodAdd')}}" enctype="multipart/form-data" >
                                    @csrf
                                    <div class="mx-2 mb-1">
                                        <input type="number" name="product" min="1" required class="form-control round" placeholder="Product ID">
                                    </div>
                                    <div class="mx-2 text-right">
                                        <button class="btn btn-primary round" type="submit">
                                            <i class="ft-plus"></i> Add Product from Bigbuy
                                        </button>
                                    </div>
                                </form>
                              
                            </div>
                            <div class="col-md-3 mb-2 add_form text-center">
                                <a class="btn btn-primary round mt-3" href="{{route('admin.prodAdd.manual')}}">
                                    <i class="ft-plus"></i> Add Product manually
                                </a>
                                <!-- <form method="get" id="download_form" action="{{route('admin.prodDownload')}}" enctype="multipart/form-data" >
                                    @csrf
                                    <div class="mx-2 mb-1">
                                        <input type="number" name="page" min="1" required class="form-control round" placeholder="Page Number">
                                    </div>
                                    <div class="mx-2 text-right">
                                        <button class="btn btn-outline-danger round " type="submit">
                                            <i class="ft-download"></i> Download Products
                                        </button>
                                    </div>
                                </form> -->
                            </div>
                        </div>
                    </div>
                    <div class="card-body mx-2 pt-0">
                        <div class="card-content">
                            <div class="row table-responsive-lg mx-3">
                                <table class="table ">
                                    <thead>
                                        <th>ID</th>
                                        <th><i class="ft-image"></i> @lang('Image')</th>
                                        <th width="200"><i class="ft-tag"></i> @lang('Product') </th>
                                        <th><i class="ft-grid"></i> Category</th>
                                        <th><i class="icon-list"></i> SKU</th>
                                        <th><i class="icon-handbag"></i> Price</th>
                                        <th><i class="ft-box"></i> Stock</th>
                                        <th class="text-center"><i class="ft-sliders"></i> @lang('Action')</th>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $row)
                                        <tr class="@if($row->status == 1) active_bg @endif">
                                            <td>
                                                {{ $row->id}} 
                                                @if($row->custom == 1)
                                                <br><span class="badge badge-info">Custom Product</span>
                                                @else
                                                <br><span class="badge badge-danger">Bigbuy Product</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($row->image)
                                                    @if($row->custom == 1)
                                                    <a href="{{asset('uploads/products')}}/{{$row->image}}" class="image-link">
                                                        <img src="{{asset('uploads/products')}}/{{$row->image}}" class="round" width="80" alt="">
                                                    </a>
                                                    @else
                                                    <a href="{{$row->image}}" class="image-link">
                                                        <img src="{{$row->image}}" class="round" width="80" alt="">
                                                    </a>
                                                    @endif
                                                @else
                                                <img src="{{asset('assets/images/no_image.jpg')}}" class="round" width="80"
                                                    alt="No Image">
                                                @endif
                                            </td>
                                            <td>
                                                <span class="long_title">{{$row->name}}</span>
                                            </td>
                                            <td>
                                                @if($row->category)
                                                <span> @lang($row->category->name)</span>
                                                @endif
                                               
                                            </td>
                                            <td>{{$row->sku}}</td>
                                            <td>
                                                kr {{$row->wholesalePrice}} / kr {{$row->retailPrice}} 
                                            </td>
                                 
                                            <td>
                                                 {{$row->stock}}
                                            </td>

                                            <td class="text-center">
                                                @if($row->custom == 1)
                                                <a class="text-info"
                                                    href="{{route('admin.prodEdit.details', $row->id)}}"> <i class="ft-plus-circle"></i>
                                                </a>
                                                @else
                                                <a class="text-warning"
                                                    href="{{route('admin.prodSync', $row->id)}}"> <i class="ft-refresh-cw"></i>
                                                </a>
                                                @endif
                                                <a href="{{route('admin.prodEdit', $row->id)}}" class="pr-1 pl-2"><i
                                                        class="fa fa-edit"></i> </a>
                                                <button style="background:none;border:none"
                                                    onclick="prodDelete({{$row->id}})" class="text-danger"><i
                                                        class="fa fa-trash text-danger"> </i> </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row mx-3">
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
var token = $("meta[name='csrf-token']").attr("content");
 
function prodDelete(id) {

    var token = $("meta[name='csrf-token']").attr("content");

    swal({
            title: "Are you sure?",
            text: "But you will still be able to retrieve this product.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dd3819",
            confirmButtonText: "Yes, Delete this product!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm) {
            if (isConfirm) {

                console.log(id);
                $.ajax({
                    url: "{{route('admin.prodDestroy')}}",
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
                swal("Cancelled", "Product is safe :)", "error");
            }
        });
}
</script>
@endsection