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
                                    <h4 class="card-title"><i class="ft-tag"></i> Add images and translations to Product
                                    </h4>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 text-right">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                                    class="fa fa-home"></i> Home</a></li>
                                        <li class="breadcrumb-item"><a href="{{route('admin.products')}}"><i
                                                    class="ft-shopping-cart"></i> Products</a> </li>
                                        <li class="breadcrumb-item active"> {{$product->name}} </li>
                                    </ol>
                                </div>
                                <!-- /.breadcrumb -->
                            </div>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body table-responsive pt-0">
                            <form method="post" class="form" action="{{ route('admin.prodUpdate.details', $product->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="form-body px-3">
                                    <div class="row mb-3">
                                        <div class="col-md-6 text-center">
                                            @if($product->image)
                                            <a href="{{asset('uploads/products')}}/{{$product->image}}" class="image-link">
                                                <img src="{{asset('uploads/products')}}/{{$product->image}}" class="round" height="200"
                                                    alt="{{$product->name}}">
                                            </a>
                                            @else
                                            <img src="{{asset('assets/images/no_image.jpg')}}" class="round" width="90%"
                                                alt="">
                                            @endif
                                        </div>
                                        <div class="col-md-6 text-center">
                                            
                                            <div class="form-group">
                                                <label for="">Product images</label>
                                                <div class="input-group ">
                                                    <div class="custom-file">
                                                        <input type="file" name="images[]" class="custom-file-input"
                                                            id="imgInp" aria-describedby="inputGroupFileAddon01" multiple>
                                                        <label class="custom-file-label" for="imgInp"> Choose Images
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Product Name (Swedish)</label>
                                                <input type="text" class="form-control round" value="{{$productdetail->sv_name}}"
                                                    name="sv_name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Product Descrption (Swedish)</label>
                                                <textarea class="form-control description" rows="8" name="sv_description"
                                                    placeholder="Product Description">{!! $productdetail->sv_description !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Product Name (French)</label>
                                                <input type="text" class="form-control round" value="{{$productdetail->fr_name}}"
                                                    name="fr_name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Product Descrption (French)</label>
                                                <textarea class="form-control description" rows="8" name="fr_description"
                                                    placeholder="Product Description">{!! $productdetail->fr_description !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Product Name (Danish)</label>
                                                <input type="text" class="form-control round" value="{{$productdetail->da_name}}"
                                                    name="da_name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Product Descrption (Danish)</label>
                                                <textarea class="form-control description" rows="8" name="da_description"
                                                    placeholder="Product Description">{!! $productdetail->da_description !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <h1></h1>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Product Name (Italic)</label>
                                                <input type="text" class="form-control round" value="{{$productdetail->it_name}}"
                                                    name="it_name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Product Descrption (Italic)</label>
                                                <textarea class="form-control description" rows="8" name="it_description"
                                                    placeholder="Product Description">{!! $productdetail->it_description !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Product Name (Portuguese)</label>
                                                <input type="text" class="form-control round" value="{{$productdetail->pt_name}}"
                                                    name="pt_name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Product Descrption (Portuguese)</label>
                                                <textarea class="form-control description" rows="8" name="pt_description"
                                                    placeholder="Product Description">{!! $productdetail->pt_description !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Product Name (Dutch)</label>
                                                <input type="text" class="form-control round" value="{{$productdetail->nl_name}}"
                                                    name="nl_name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Product Descrption (Dutch)</label>
                                                <textarea class="form-control description" rows="8" name="nl_description"
                                                    placeholder="Product Description">{!! $productdetail->nl_description !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Product Name (German)</label>
                                                <input type="text" class="form-control round" value="{{$productdetail->ge_name}}"
                                                    name="ge_name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Product Descrption (German)</label>
                                                <textarea class="form-control description" rows="8" name="ge_description"
                                                    placeholder="Product Description">{!! $productdetail->ge_description !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Product Name (Finnish)</label>
                                                <input type="text" class="form-control round" value="{{$productdetail->fi_name}}"
                                                    name="fi_name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Product Descrption (Finnish)</label>
                                                <textarea class="form-control description" rows="8" name="fi_description"
                                                    placeholder="Product Description">{!! $productdetail->fi_description !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Product Name (Norwegian)</label>
                                                <input type="text" class="form-control round" value="{{$productdetail->no_name}}"
                                                    name="no_name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Product Descrption (Norwegian)</label>
                                                <textarea class="form-control description" rows="8" name="no_description"
                                                    placeholder="Product Description">{!! $productdetail->no_description !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
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