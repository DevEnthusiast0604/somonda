@extends('layouts.admin_layout')
@section('content')
<style>
    span.select2-selection{
        border-radius: 1.8em!important;
        height: 36px!important;
    }
    #select2-category-container{
        padding: 3px 1em;
    }
</style>
<div class="main-content">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h4 class="card-title"><i class="ft-tag"></i> Update Product ({{$data->name}})
                                    </h4>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 text-right">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                                    class="fa fa-home"></i> @lang('Home')</a></li>
                                        <li class="breadcrumb-item"><a href="{{route('admin.products')}}"><i
                                                    class="ft-shopping-cart"></i> Products</a> </li>
                                        <li class="breadcrumb-item active"> Product ID: {{$data->id}} </li>
                                    </ol>
                                </div>
                                <!-- /.breadcrumb -->
                            </div>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body table-responsive pt-0">
                            <form method="post" class="form" action="{{ route('admin.prodUpdate', $data->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="form-body px-3">
                                    <div class="row mb-3">
                                        <div class="col-md-6 text-center">
                                            @if($data->image)
                                            @if($data->custom == 1)
                                            <a href="{{asset('uploads/products')}}/{{$data->image}}" class="image-link">
                                                <img src="{{asset('uploads/products')}}/{{$data->image}}" class="round" height="200"
                                                    alt="{{$data->name}}">
                                            </a>
                                            @else
                                            <a href="{{$data->image}}" class="image-link">
                                                <img src="{{$data->image}}" class="round" height="200"
                                                    alt="{{$data->name}}">
                                            </a>
                                            @endif
                                            @else
                                            <img src="{{asset('assets/images/no_image.jpg')}}" class="round" width="90%"
                                                alt="">
                                            @endif
                                        </div>
                                        <div class="col-md-6 text-center">
                                            <div class="form-group">
                                                <h4 class="card-title my-2">Product Status</h4>
                                                <div class="input-group justify-content-center">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="online" name="status" @if($data->status
                                                        == 1) checked @endif
                                                        class="custom-control-input" value="1">
                                                        <label class="custom-control-label text-success"
                                                            for="online">Online (Show on shop)</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="offline" value="0" @if($data->status ==
                                                        0) checked @endif
                                                        name="status" class="custom-control-input">
                                                        <label class="custom-control-label text-danger"
                                                            for="offline">Offline (Inactive on Shop)</label>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($data->custom == 1)
                                            <div class="form-group">
                                                <label for="">Product Cover image</label>
                                                <div class="input-group ">
                                                    <div class="custom-file">
                                                        <input type="file" name="image" class="custom-file-input"
                                                            id="imgInp" aria-describedby="inputGroupFileAddon01">
                                                        <label class="custom-file-label" for="imgInp"> Choose Image
                                                        </label>
                                                    </div>
                                                </div>
                                                <img width="200" src="#" id="blah" alt="" />
                                            </div>
                                            @endif

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

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Product Name</label>
                                                <input type="text" class="form-control round" value="{{$data->name}}"
                                                    name="name" required placeholder="Product Name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">@lang('Category')</label>
                                                <select name="category_id" id="category" @if($data->custom !=1) disabled @endif
                                                    class="form-control round category-select">
                                                    <option value="">@lang('Choose Category')</option>
                                                    @foreach($categories as $row)
                                                    <option value="{{$row->id}}" @if($data->category_id == $row->id)
                                                        selected @endif>
                                                        {{$row->name}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">SKU</label>
                                                <input type="text" name="sku" class="form-control round" value="{{$data->sku}}"
                                                @if($data->custom !=1) disabled @endif placeholder="SKU">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Stock</label>
                                                <input type="number" name="stock" class="form-control round"  @if($data->custom !=1) disabled @endif
                                                    value="{{$data->stock}}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Weight</label>
                                                <input type="number" step="0.01" class="form-control round"
                                                    value="{{$data->weight}}" name="weight">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Height</label>
                                                <input type="number" step="0.01" class="form-control round"
                                                    value="{{$data->height}}" name="height">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Width</label>
                                                <input type="number" step="0.01" class="form-control round"
                                                    value="{{$data->width}}" name="width">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Depth</label>
                                                <input type="number" step="0.01" class="form-control round"
                                                    value="{{$data->depth}}" name="depth">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Wholesale Price (kr)</label>
                                                <input type="number" step="0.01" class="form-control round"
                                                    value="{{$data->wholesalePrice}}" required name="wholesalePrice" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Retail Price (kr)</label>
                                                <input type="number" step="0.01" class="form-control round"
                                                    value="{{$data->retailPrice}}" required name="retailPrice" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Tax Rate (%)</label>
                                                <input type="number" step="0.01" class="form-control round"
                                                    value="{{$data->taxRate}}" name="taxRate">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>condition</label>
                                                <input type="text" class="form-control round"
                                                    value="{{$data->condition}}" name="condition">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>NO Wholesale Price (Kr)</label>
                                                <input type="number" step="any" class="form-control round"
                                                    value="{{$data->no_wholesalePrice}}" required name="no_wholesalePrice" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>NO Retail Price (Kr)</label>
                                                <input type="number" step="any" class="form-control round"
                                                    value="{{$data->no_retailPrice}}" required name="no_retailPrice" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>SE Wholesale Price (Kr)</label>
                                                <input type="number" step="any" class="form-control round"
                                                    value="{{$data->se_wholesalePrice}}" required name="se_wholesalePrice" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>SE Retail Price (Kr)</label>
                                                <input type="number" step="any" class="form-control round"
                                                    value="{{$data->se_retailPrice}}" required name="se_retailPrice" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>FI Wholesale Price (kr)</label>
                                                <input type="number" step="any" class="form-control round"
                                                    value="{{$data->fi_wholesalePrice}}" required name="fi_wholesalePrice" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>FI Retail Price (kr)</label>
                                                <input type="number" step="any" class="form-control round"
                                                    value="{{$data->fi_retailPrice}}" required name="fi_retailPrice" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Description</label>
                                                <textarea class="form-control description" rows="8" name="description"
                                                    placeholder="Product Description">{!! $data->description !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-between">
                                        <button class="btn btn-primary round px-4" type="submit"> <i
                                                class="ft-clipboard"></i>
                                            @lang('Update')
                                        </button>
                                        <a href="{{route('admin.products')}}"
                                            class="btn btn-secondary text-light round px-4"> <i class="fa fa-undo"></i>
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
@endsection