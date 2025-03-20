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
                            <li class="active"><a href="#">All</a></li>
                            @foreach($categories as $row)
                            <li><a href="{{route('products', $row->url)}}">{{$row->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="filter-dropdown">
                        <div class="heading">
                            <h4>More Filter</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="filter-dropdown">
                        <div class="dropdown">
                            <a class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Add
                                Filter<span></span></a>
                            <div class="dropdown-menu">
                                <h5>Subcategories</h5>
                                @foreach($subcategories as $row)
                                <div class="filter-label clearfix">
                                    <form>
                                        <div class="checkbox-group">
                                            <label>
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </form>
                                    <span>{{$row->name}}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-md-3 offset-md-1">
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
                    <div class="col-md-3">
                        <div class="product-item pt-0">
                            <figure>
                                <a href="{{route('products.details', $row->url)}}">
                                    <img src="{{$row->image}}" alt="">
                                </a>
                            </figure>

                            <div class="product-item-title">
                                <h4>
                                    <a href="{{route('products.details', $row->url)}}">
                                    {{$row->name}}
                                    </a>
                                </h4>
                            </div>

                            <ul>
                                <li>
                                    <span>Normalpris: {{$row->retailPrice}} kr</span>
                                    <span class="text-end text-red right">-{{number_format(($row->retailPrice - $row->wholesalePrice)*100/$row->retailPrice)}}%</span>
                                </li>
                                <li>
                                    <span class="text-bold">Medlemspris:</span>
                                    <span class="text-end text-bold right">{{$row->wholesalePrice}} kr</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @endforeach    
                </div>
            </div>
        </div>
    </div>
</section><!-- //end .product-list -->
@endsection