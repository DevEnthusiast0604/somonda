@extends('layouts.frontend')
@section('content')
	<section class="add-to-cart"><!-- start .section-tab -->
		<div class="container">
			<div class="add-to-cart-area">
				<ul class="nav">
					<li><a href="#">Products /</a></li>
					<li><a href="{{route('products', $data->category->url)}}">{{$data->category->name}} /</a></li>
					<li><a href="#">{{$data->name}}</a></li>
				</ul>
				<div class="heading">
					<p>{{$data->category->name}}</p>
					<h3>{{$data->name}}</h3>
				</div>
				<div class="row">
					<div class="col-xl-5">
						<div class="tab-area">
							<ul class="nav-tabs border-0" id="productTab" role="tablist">
								@if($data->images)
									@if($data->custom == 1)
										@foreach(unserialize($data->images) as $key=>$image)
										<li class="nav-item" role="presentation">
											<button class="nav-link border-0 @if($key == 0) active @endif" id="product-tab{{$key}}" data-bs-toggle="tab" data-bs-target="#product-tab-pane{{$key}}" type="button" role="tab" aria-controls="product-tab-pane{{$key}}" aria-selected="true">
												<figure class="ms-auto">
													<img src="{{asset('uploads/products')}}/{{$image}}" alt="">
												</figure>
											</button>
										</li>
										@endforeach
									@else
										@foreach(unserialize($data->images) as $key=>$image)
										<li class="nav-item" role="presentation">
											<button class="nav-link border-0 @if($key == 0) active @endif" id="product-tab{{$key}}" data-bs-toggle="tab" data-bs-target="#product-tab-pane{{$key}}" type="button" role="tab" aria-controls="product-tab-pane{{$key}}" aria-selected="true">
												<figure class="ms-auto">
													<img src="{{$image}}" alt="">
												</figure>
											</button>
										</li>
										@endforeach
									@endif
								@else
								<li class="nav-item" role="presentation">
									<button class="nav-link border-0 active" id="product-tab" data-bs-toggle="tab" data-bs-target="#product-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
										<figure class="ms-auto">
											@if($data->custom == 1)
											<img src="{{asset('uploads/products')}}/{{$data->image}}" alt="">
											@else
											<img src="{{$data->image}}" alt="">
											@endif
										</figure>
									</button>
								</li>
								@endif
							</ul>
							<div class="tab-content" id="productTabContent">
								@if($data->images)
									@if($data->custom == 1)
										@foreach(unserialize($data->images) as $key=>$image)
										<div class="tab-pane fade @if($key == 0)show active @endif" id="product-tab-pane{{$key}}" role="tabpanel" aria-labelledby="product-tab{{$key}}" tabindex="0">
											<figure>
												<img src="{{asset('uploads/products')}}/{{$image}}" alt="">
											</figure>
										</div>
										@endforeach
									@else
										@foreach(unserialize($data->images) as $key=>$image)
										<div class="tab-pane fade @if($key == 0)show active @endif" id="product-tab-pane{{$key}}" role="tabpanel" aria-labelledby="product-tab{{$key}}" tabindex="0">
											<figure>
												<img src="{{$image}}" alt="">
											</figure>
										</div>
										@endforeach
									@endif
								@else
								<div class="tab-pane fade show active" id="product-tab-pane" role="tabpanel" aria-labelledby="product-tab" tabindex="0">
									<figure class="ms-auto">
										@if($data->custom == 1)
										<img src="{{asset('uploads/products')}}/{{$data->image}}" alt="">
										@else
										<img src="{{$data->image}}" alt="">
										@endif
									</figure>
								</div>
								@endif
							</div>
						</div>
					</div>
					<div class="col-xl-4">
						<div class="add-to-cart-box bg-white">
							<div class="top d-flex">
								<ul class="nav">
									<li><figure><img src="{{asset('assets/images/star.png')}}" alt=""></figure></li>
									<li><figure><img src="{{asset('assets/images/star.png')}}" alt=""></figure></li>
									<li><figure><img src="{{asset('assets/images/star.png')}}" alt=""></figure></li>
									<li><figure><img src="{{asset('assets/images/star.png')}}" alt=""></figure></li>
									<li><figure><img src="{{asset('assets/images/star2.png')}}" alt=""></figure></li>
								</ul>
								<span>1785 reviews</span>
							</div>

							<form>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="flexRadioDefault" value="1"  id="flexRadioDefault1" checked>
									<label class="form-check-label d-block" for="flexRadioDefault1">
										<div class="add-to-cart-content">
											<h5>Member price</h5>
											<span>{{$data->wholesalePrice}} kr</span>
											<p>
											PlusDeal prices only apply to members. The price for membership is 179 kr/mo and continues automatically until terminated. Can be terminated at the end of a membership period. The first 7 days are free - read more about the benefits.
											</p>

											<ul class="nav">
												<li>
													<figure class="mx-auto">
														<img src="{{asset('assets/images/Truck.png')}}" alt="">
													</figure>
													1-3 days Delivery
												</li>
												<li>
													<figure class="mx-auto">
														<img src="{{asset('assets/images/Package.png')}}" alt="">
													</figure>
													Free delivery
												</li>
												<li>
													<figure class="mx-auto">
														<img src="{{asset('assets/images/Percent.png')}}" alt="">
													</figure>
													Discounts
												</li>
											</ul>
										</div>
									</label>
								</div>

								<div class="form-check">
									<input class="form-check-input" type="radio" name="flexRadioDefault" value="0" id="flexRadioDefault2">
									<label class="form-check-label d-block" for="flexRadioDefault2">
										<div class="add-to-cart-content">
											<h5>Normal price</h5>
											<span class="mb-0">{{$data->retailPrice}} kr</span>
										</div>
									</label>
								</div>
							</form>

							<div class="add">
								<div class="row">
									<form class="d-flex justify-content-between" action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
									@csrf
									<input type="hidden" value="{{ $data->id }}" name="id">
									<input type="hidden" id="membership" value="1" name="membership">
 									<input type="hidden" value="{{$data->width}} × {{$data->height}} × {{$data->depth}}" name="size">
									<div class="col-sm-5 qtySelector d-flex">
											<button class="decreaseQty bg-white p-0">-</button>
											<input class="qtyValue text-center" name="quantity" type="text" value="1">
											<button class="increaseQty bg-white p-0">+</button>
									</div>
									<div class="col-sm-7">
										<div class="add-btn ms-auto">
											<button class="text-white" href="#" type="submit" style="padding: 0 24px!important">Add to basket</button>
										</div>
									</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 about_content">
						<div class="right-content">
							<h5>About this item</h5>
							 {!! substr(strip_tags($data->description),0, 800) !!}...
						</div>
					</div>
				</div>
			</div>
		</div>
	</section><!-- //end .section-tab -->

	<div class="section-tab"><!-- start .section-tab -->
		<div class="container">
			<div class="tab-area mx-auto">
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item" role="presentation">
						<button class="nav-link border-0 active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Product Description</button>
					</li>

					<li class="nav-item" role="presentation">
						<button class="nav-link border-0" id="details-tab" data-bs-toggle="tab" data-bs-target="#details-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Product details</button>
					</li>

					<li class="nav-item" role="presentation">
						<button class="nav-link border-0" id="materials-tab" data-bs-toggle="tab" data-bs-target="#materials-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Ingredients</button>
					</li>
				</ul>

				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="description-tab-pane" role="tabpanel" aria-labelledby="description-tab" tabindex="0">
						<div class="row">
							<div class="col-sm-6 d-block d-sm-none">
								<figure class="ms-auto">
									@if($data->custom == 1)
									<img src="{{asset('uploads/products')}}/{{$data->image}}" alt="">
									@else
									<img src="{{$data->image}}" alt="">
									@endif
 								</figure>
							</div>

							<div class="col-sm-6">
								{!! $data->description !!}
							</div>

							<div class="col-sm-6 d-none d-sm-block">
								<figure class="ms-auto">
									@if($data->custom == 1)
									<img src="{{asset('uploads/products')}}/{{$data->image}}" alt="">
									@else
									<img src="{{$data->image}}" alt="">
									@endif
								</figure>
							</div>
						</div>
						
					</div>
					<div class="tab-pane fade" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab" tabindex="0">
						<p><strong>Stock: </strong>{{$data->stock}}</p>
						<p><strong>Category: </strong>{{$data->category->name}}</p>
						<p><strong>Size: </strong>{{$data->width}} × {{$data->height}} × {{$data->depth}}, {{$data->weight}} Kg </p>
						<p><strong>Condition: </strong>{{$data->condition}}</p>
 
					</div>
					<div class="tab-pane fade" id="materials-tab-pane" role="tabpanel" aria-labelledby="materials-tab" tabindex="0">
						
					</div>
					 
				</div>
			</div>
		</div>
	</div><!-- //end .section-tab -->

	<section class="recommend"><!-- start .recommend -->
		<div class="container">
			<div class="recommend-area">
				<div class="heading">
					<h2 class="text-center">Recommended for you</h2>
					<!-- <p class="text-center">{{$new_products_count}} new products</p> -->
				</div>

				<div class="row">
					<div class="col-xl-12">
						<div class="row">
							@foreach($new_products as $row)
							<div class="col-md-3">
								<div class="product-item bg-white">
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
											<p class="text-center">{{$row->name}}</p>
										</a>
										<a href="{{route('products', $row->category->url)}}">
											<span class="text-center">{{$row->category->name}}</span>
										</a>
									</div>
									<div class="product-item-footer">
										<ul class="nav">
											<li class="text-center"><span>Normal price</span><span class="price">{{$row->retailPrice}} kr</span></li>
											<li class="text-center border-0"><span class="midl">Member price</span><span class="price blue">{{$row->wholesalePrice}} kr</span></li>
										</ul>
									</div>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				 
				</div>	
			</div>
		</div>
	</section><!-- //end .recommend -->

	<!-- start .customer -->
	@include('components.customer')
	<!-- //end .customer -->
	
	<!-- .subscribe -->
	@include('components.subscribe')
	<!-- //end .subscribe -->

@endsection