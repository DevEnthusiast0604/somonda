@extends('layouts.admin_layout')
@section('content')
<div class="main-content">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
                                    <h4 class="card-title"><i class="icon-power"></i>  @lang('Maintenance')
                                    </h4> 
                                </div>

                                <div class="col-lg-6 col-sm-8 col-md-6 col-xs-12 text-right">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                                    class="fa fa-home"></i> @lang('Home')</a></li>
                                        <li class="breadcrumb-item active"> @lang('Maintenance')</li>
                                    </ol>
                                </div>
                                <!-- /.breadcrumb -->
                            </div>
                          
                        </div>
                    </div>
                    <div class="card-body pt-0 mx-2">
                        <div class="card-content table-responsive">
                            <div class="row mx-3">
                                <div class="col-md-3">
                                    @if(is_maintenance()->maintenance == 1)
                                    <form method="post" action="{{route('admin.maintenanceUpdate')}}">
                                        @csrf
                                        <input type="hidden" name="status" value="0">
                                         
                                        <button type="submit" class="btn btn-primary round px-3 py-2"><i class="icon-power"></i> @lang('Maintenance') @lang('OFF')</button>
                                    </form>
                                    @else
                                    <form method="post" action="{{route('admin.maintenanceUpdate')}}">
                                        @csrf
                                        <input type="hidden" name="status" value="1">
                                        <div class="form-group">
                                            <label>@lang('Maintenance Period')</label>
                                            <input type="date" class="form-control round" min="{{date('Y-m-d')}}" value="{{date('Y-m-d')}}" name="period" required >
                                        </div>
                                        <button type="submit" class="btn btn-primary round px-3 py-2"><i class="icon-power"></i> @lang('Maintenance') @lang('ON')</button>
                                    </form>
                                    @endif
    
                                </div>
                                <div class="col-md-6"></div>
                                <div class="col-md-3 text-right">
                                    <img src="{{asset('assets/images/maintenance.webp')}}" width="100%" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection