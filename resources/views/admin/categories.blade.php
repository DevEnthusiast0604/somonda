@extends('layouts.admin_layout')
@section('content')
<style>
.badge {
    cursor: pointer;
}

.card-img {
    background-size: cover !important;
    width: 100%;
    height: 250px;
}

.status {
    position: absolute;
    top: 33px;
    z-index: 9;
    border-radius: 0 0 0.8em;
    font-weight: 600;
}
</style>
<div class="main-content">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
                                    <h4 class="card-title"><i class="ft-grid"></i> @lang('Categories') ({{$count}})
                                    </h4>
                                </div>

                                <div class="col-lg-6 col-sm-8 col-md-6 col-xs-12 text-right">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                                    class="fa fa-home"></i> @lang('Home')</a></li>
                                        <li class="breadcrumb-item active"> @lang('Category')</li>
                                    </ol>
                                </div>
                                <!-- /.breadcrumb -->
                            </div>
                            <div class="col-md-5 mb-2">
                                <form method="get" id="search_form" action="{{route('admin.categorySearch')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mx-2 mb-1 d-flex">
                                        <input type="number" name="id" min="1" class="form-control round" placeholder="Category ID">
                                        <input type="text" name="name" class="form-control mx-2 round" placeholder="Name">
                                        <button class="btn btn-info round col-md-4" type="submit">
                                            <i class="ft-search"></i> Search Category
                                        </button>
                                    </div>
                                     
                                </form>
                            </div>
                            <div class="col-md-3 text-right">
                                <a class="btn btn-outline-primary mx-3 px-3 round primary mb-0"
                                    href="{{route('admin.categorySync')}}"> <i class="ft-refresh-cw"></i>
                                    Synchronize Categories </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0 mx-2">
                        <div class="card-content">
                            <div class="row table-responsive-lg mx-3">
                                <table class="table table-hover">
                                    <thead>
                                        <th>ID</th>
                                        <th><i class="ft-image"></i> @lang('Image')</th>
                                        <th width="200"><i class="ft-tag"></i> Name </th>
                                        <th><i class="ft-link"></i> URL</th>
                                        <th><i class="ft-arrow-up"></i> Parent Category</th>
                                        <th><i class="ft-clock"></i> Added Date</th>
                                        <th><i class="ft-clock"></i> Updated Date</th>
                                        <th><i class="ft-cpu"></i> Iso Code</th>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $row)
                                        <tr>
                                            <td>{{$row->id}}</td>
                                            <td>
                                                <a href="{{$row->urlImage}}" class="image-link">
                                                    <img src="{{$row->urlImage}}" class="round" width="80" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <span class="long_title">{{$row->name}}</span>
                                            </td>
                                            <td> <span class="long_title">{{$row->url}}</span>
                                            </td>
                                            <td>
                                                {{$row->parentCategory}}
                                            </td>
                                            <td>
                                                {{date('m-d-Y h:i', strtotime($row->dateAdd))}}
                                            </td>
                                            <td>
                                                {{date('m-d-Y h:i', strtotime($row->dateUpd))}}
                                            </td>
                                            <td>
                                                {{$row->isoCode}}
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


@endsection