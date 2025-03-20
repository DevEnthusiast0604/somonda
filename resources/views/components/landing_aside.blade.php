<aside id="side_cart_bar">
    <div class="top_option d-flex align-items-center justify-content-between">
        <h2>@lang('your_basket') </h2>
        <button id="close_btn"><i class="ft-x" aria-hidden="true"></i></button>
    </div>
    <div class="cart_menu_wrapper">
        <div class="cart_heading p-2">
            @if(Cart::getTotal() == 0)
                <p class="text-center">@lang('basket_empty')</p>
            @else
            <p class="text-center">@lang('congrats_free_shipping') 😍</p>
            <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar" style="width: 100%"></div>
            </div>
            @endif
        </div>
        <div class="product_warpper">
            @foreach (cart_list() as $row)
            <div class="card my-3 border-0">
                <div class="d-flex">
                    <div class="card-img_wrapper">
                        @if(product_type($row->id) == 1)
                        <img data-src="{{asset('uploads/products')}}/{{$row->attributes->image}}" class="img-fluid rounded-start lazy"  alt="">
                        @else
                        <img data-src="{{$row->attributes->image}}" class="img-fluid rounded-start lazy" alt="">
                        @endif
                    </div>
                    <div class="card-info_wrapper">
                    <div class="card-body">
                        <h5 class="card-title d-flex justify-content-between">{{$row->name}} 
                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $row->id }}" name="id">
                                <button class="ms-auto remove-btn" id="cart-product-remove">
                                    <i class="ft-trash-2 text-danger" aria-hidden="true"></i>
                                </button>
                            </form>
                         </h5>
                        <div class="card-option_wrapper d-flex align-items-center justify-content-between mr-5">
                            <div id="cart_input_wrapper" class="qtySelector qtySelector_cart d-flex">
                                <button class="decreaseQty">-</button>
                                <input type="text" value="{{$row->quantity}}" min="0" class="qtyValue" />
                                <input type="hidden" class="product_id" value="{{ $row->id}}" >
                                <button  class="increaseQty">+</button>
                            </div>
                            <div class="product_price">
                                <p class="text-secondary pr-2">
                                    <del>
                                        @if(app()->getLocale() == 'sv')
                                        <span class="text-end">{{ $row->attributes->se_normal_price }} kr</span>
                                        @elseif(app()->getLocale() == 'no')
                                        <span class="text-end">{{ $row->attributes->no_normal_price }} kr</span>
                                        @else
                                        <span class="text-end">{{ $row->attributes->normal_price }} kr</span>
                                        @endif
                                    </del> 
                                    @if(app()->getLocale() == 'sv')
                                    <span class="text-end">{{  $row->attributes->se_price }} kr</span>
                                    @elseif(app()->getLocale() == 'no')
                                    <span class="text-end">{{ $row->attributes->no_price }} kr</span>
                                    @else
                                    <span class="text-end">{{ $row->price }} kr</span>
                                    @endif
                                </p>
                                <p class="text-success pr-2"> @lang('save')
                                    @if(app()->getLocale() == 'sv')
                                    <span class="text-end">{{ $row->quantity * ($row->attributes->se_normal_price - $row->attributes->se_price) }} kr</span>
                                    @elseif(app()->getLocale() == 'no')
                                    <span class="text-end">{{ $row->quantity * ($row->attributes->no_normal_price - $row->attributes->no_price) }} kr</span>
                                    @else
                                    <span class="text-end">{{($row->attributes->normal_price - $row->price) * $row->quantity}} kr</span>
                                    @endif    
                                </p>

                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="payment_wrapper">
        <div class="promo_wrapper d-flex">
            <input type="text" class="form-control" placeholder="@lang('promotion_code')" />
            <button id="cart_add_btn">@lang('add')</button>
        </div>
        <div class="check_btn_wrapper row">
           
            <div class="col-12 my-3">
                @if(Cart::getTotal() == 0)
                <a href="{{url('/')}}" class="btn go_to_payment">@lang('add_product')
                </a>
                @else
                <a href="{{route('checkout')}}" class="btn go_to_payment">@lang('go_to_payment') 
                @if(app()->getLocale() == 'sv')
                 {{ getseTotal() }} kr
                @elseif(app()->getLocale() == 'no')
                {{ getnoTotal() }} kr
                @else
                  {{ Cart::getTotal() }} kr
                @endif
                </a>
                @endif
            </div>
            <div class="col-12 d-flex justify-content-center">
                <img data-src="{{asset('assets/images/visa_master.png')}}" class="lazy" width="150" alt="Payment Image">
            </div>
        </div>
    </div>

</aside>