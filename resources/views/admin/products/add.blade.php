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
                                    <h4 class="card-title"><i class="ft-tag"></i> Add Product 
                                    </h4>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 text-right">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                                    class="fa fa-home"></i> Home</a></li>
                                        <li class="breadcrumb-item"><a href="{{route('admin.products')}}"><i
                                                    class="ft-shopping-cart"></i> Products</a> </li>
                                        <li class="breadcrumb-item active"> Add Product </li>
                                    </ol>
                                </div>
                                <!-- /.breadcrumb -->
                            </div>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body table-responsive pt-0">
                            <form method="post" class="form" action="{{ route('admin.prodStore') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-body px-3">
                                    <div class="row mb-3">
                                        <div class="col-md-8 text-center">
                                            <div class="form-group">
                                                <h4 class="card-title my-2">Product Status</h4>
                                                <div class="input-group justify-content-center">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="online" name="status" 
                                                        class="custom-control-input" value="1">
                                                        <label class="custom-control-label text-success"
                                                            for="online">Online (Show on shop)</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="offline" value="0" checked
                                                        name="status" class="custom-control-input">
                                                        <label class="custom-control-label text-danger"
                                                            for="offline">Offline (Inactive on Shop)</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Product Cover image</label>
                                                <div class="input-group ">
                                                    <div class="custom-file">
                                                        <input type="file" name="image" class="custom-file-input" id="imgInp"
                                                            aria-describedby="inputGroupFileAddon01">
                                                        <label class="custom-file-label" for="imgInp"> Choose Image
                                                        </label>
                                                    </div>
                                                </div>
                                                <img width="200" src="#" id="blah" alt="" />
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
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Product Name</label>
                                                <input type="text" class="form-control round" 
                                                    name="name" placeholder="Product Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Category</label>
                                                <select name="category_id" id="category" required
                                                    class="round category-select form-control">
                                                    <option value="">@lang('Choose Category')</option>
                                                    @foreach($categories as $row)
                                                    <option value="{{$row->id}}">
                                                        {{$row->name}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">SKU</label>
                                                <input type="text" class="form-control round" name="sku"
                                                     placeholder="SKU">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Stock</label>
                                                <input type="number" class="form-control round" name="stock">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Weight</label>
                                                <input type="number" step="0.01" class="form-control round"
                                                  name="weight">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Height</label>
                                                <input type="number" step="0.01" class="form-control round"
                                                  name="height">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Width</label>
                                                <input type="number" step="0.01" class="form-control round"
                                                     name="width">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Depth</label>
                                                <input type="number" step="0.01" class="form-control round"
                                                   name="depth">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>wholesale Price (kr)</label>
                                                <input type="number" step="0.01" class="form-control round"
                                                    required name="wholesalePrice">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>retail Price (kr)</label>
                                                <input type="number" step="0.01" class="form-control round"
                                                   required name="retailPrice">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Tax Rate (%)</label>
                                                <input type="number" step="0.01" class="form-control round"
                                                   name="taxRate">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Condition</label>
                                                <input type="text" class="form-control round" placeholder="NEW"
                                                    name="condition">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>NO Wholesale Price (Kr)</label>
                                                <input type="number" step="any" class="form-control round"
                                                 required name="no_wholesalePrice">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>NO Retail Price (Kr)</label>
                                                <input type="number" step="any" class="form-control round"
                                                    required name="no_retailPrice">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>SE Wholesale Price (Kr)</label>
                                                <input type="number" step="any" class="form-control round"
                                                   required name="se_wholesalePrice">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>SE Retail Price (Kr)</label>
                                                <input type="number" step="any" class="form-control round"
                                                    required name="se_retailPrice">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>FI Wholesale Price (kr)</label>
                                                <input type="number" step="any" class="form-control round"
                                                required name="fi_wholesalePrice">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>FI Retail Price (kr)</label>
                                                <input type="number" step="any" class="form-control round"
                                                required name="fi_retailPrice" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Description</label>
                                                <textarea class="form-control description" rows="8" name="description"
                                                    placeholder="Enter Description"> </textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-between">
                                        <button class="btn btn-primary round px-4" type="submit"> <i
                                                class="ft-clipboard"></i>
                                            Add Product
                                        </button>
                                        <a href="{{route('admin.products')}}"
                                            class="btn btn-secondary text-light round px-4"> <i class="fa fa-undo"></i>
                                            Back
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