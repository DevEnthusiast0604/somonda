@extends('layouts.frontend')
@section('content')
@include('layouts.user_layout')
<section class="single-banner dashboard-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-content">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active" aria-current="page">Products ({{$count}})</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="my_products mt-2 mb-5">
    <div class="container">
        <div class="row px-4 mt-3 table-responsive">
            <table class="table table-striped" >
                <thead>
                    <tr>
                        <th>@lang('No')</th>
                        <th class="text-center"><i class="ft-image"></i></th>
                        <th><i class="ft-shopping-cart"></i> @lang('Product')</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th><i class="ft-clock"></i> Sales Date</th>
                        <th width="100px"><i class="ft-sliders"></i> </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $row)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>
                            @if($row->product->image)
                            <a href="{{$row->product->image}}" class="image-link">
                                <img src="{{$row->product->image}}" class="round" width="80" alt="">
                            </a>
                            @else
                            <img src="{{asset('assets/images/no_image.jpg')}}" class="round" width="80" alt="No Image">
                            @endif
                        </td>
                        <td>
                            {{$row->product->name}}
                        </td>
                        <td>{{$row->quantity}}</td>
                        <td>{{$row->price}} kr</td>
                         
                        <td>{{date('M d, Y h:i a', strtotime($row->created_at))}}</td>
                        <td width="200">
                            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#order{{$row->id}}">
                                <i class="ft-info"> </i> Shipping Details
                            </a>
                      
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="order{{$row->id}}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
                            <div class="modal-content semi-round">
                                <div class="modal-header">
                                    <h5 class="modal-title text-bold-700" id="exampleModalLongTitle"><i
                                            class="icon-social-dropbox"></i> Shipping Details</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body cart-form">
                                    <div class="row px-2">
                                        <div class="col-md-6">
                                            <div class="form-group mt-2">
                                                <input type="text"  disabled  
                                                class="form-control round"
                                                name="firstName" value="{{$row->firstName}}"
                                                placeholder="First Name" required autofocus>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <div class="form-group">
                                                <input type="text" disabled  
                                                class="form-control round"
                                                name="lastName" value="{{$row->lastName}}"
                                                placeholder="Last Name" required autofocus>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <div class="form-group">
                                                <input type="text"  disabled 
                                                class="form-control round"
                                                name="email" value="{{$row->email}}"
                                                placeholder="Email" required autofocus>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <div class="form-group">
                                                <input type="text"  disabled 
                                                class="form-control round"
                                                name="phone" value="{{$row->phone}}"
                                                placeholder="Phone" required autofocus>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <div class="form-group">
                                                <input type="text"   disabled 
                                                class="form-control round"
                                                name="town" value="{{$row->town}}"
                                                placeholder="Town" required autofocus>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <div class="form-group">
                                                <input type="text"  disabled 
                                                class="form-control round"
                                                name="address" value="{{$row->address}}"
                                                placeholder="Address" required autofocus>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <div class="form-group">
                                                <select name="country"disabled
                                                    class="form-control round" id="">
                                                    <option value="SE" @if($row->country == 'SE') selected
                                                        @endif>Sweden</option>
                                                    <option value="FR" @if($row->country == 'FR') selected
                                                        @endif>French</option>
                                                    <option value="DK" @if($row->country == 'DK') selected
                                                        @endif>Denmark</option>
                                                    <option value="IT" @if($row->country == 'IT') selected
                                                        @endif>Italy</option>
                                                    <option value="PT" @if($row->country == 'PT') selected
                                                        @endif>Portugal</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <div class="form-group">
                                                <input type="text" disabled 
                                                class="form-control round"
                                                name="postcode" value="{{$row->postcode}}"
                                                placeholder="Postcode" required autofocus>
                                            </div>
                                        </div>
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Edit modal -->
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>


@endsection