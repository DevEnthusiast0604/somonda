@extends('layouts.frontend')
@section('content')
<section class="product-list">
    <!-- start .product-list -->
    <div class="container">
        <div class="product-list-area">
            <div class="product-category">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav">
                            <li class="active"><a href="#">All Products</a></li>
                            <li><a href="#">Total {{$count}} products</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 ">
                    <form>
                        <div class="form-input">
                            <input type="text" class="form-control" placeholder="Search for Product">
                        </div>
                    </form>
                </div>
            </div>
            <div class="product-item-wrap">
                <div class="row">
                    @foreach($products as $row)
                    <div class="col-sm-6 col-lg-3">
                        <div class="product-item lg bg-white">
                            <figure class="mx-auto">
                                <a href="{{route('products.details', $row->url)}}">
                                    @if($row->custom == 1)
                                    <img src="{{asset('uploads/products')}}/{{$row->image}}" alt="">
                                    @else
                                    <img src="{{$row->image}}" alt="">
                                    @endif
                                </a>
                            </figure>
                            <div class="product-item-content">
                                <h5 class="text-center">{{$row->condition}}</h5>
                                <a href="{{route('products.details', $row->url)}}">
                                    <p class="text-center">
                                        {{$row->name}}
                                    </p>
                                </a>
                                <a href="{{route('products', $row->category->url)}}">
                                    <span class="text-center">
                                        {{$row->category->name}}
                                    </span>
                                </a>
                            </div>
                            <div class="product-item-footer">
                                <ul class="nav">
                                    <li class="text-center"><span>Normal Price</span><span class="price"> 
                                            {{$row->retailPrice}} kr</span>
                                    </li>
                                    <li class="text-center border-0"><span class="midl">Membership Price</span><span
                                            class="price blue">{{$row->wholesalePrice}} kr</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-12">
                        {{$products->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- //end .product-list -->
@endsection