<section class="faq">
    <div class="container">
        <div class="faq-area">
            <div class="heading">
                <h2 class="text-center"><span>FAQ</span>
                    <!-- We try answer all your questions -->
                </h2>
            </div>

            <div class="row">
                <div class="col-lg-3">
                    <div class="search-area">
                        <!--<p>We have more than 20.000 products and 1.000 brands to choose from. Search and find your favorite product</p> -->
                        <form class="d-flex bg-white" role="search">
                            <input class="form-control border-0" type="search" placeholder="Search..."
                                aria-label="Search">
                            <button class="btn" type="submit">@lang('Search')</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true"
                                    aria-controls="collapseOne">@lang('Is delivery alway free?')</button>
                            </h2>

                            <div id="collapseOne" class="accordion-collapse collapse show"
                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>
                                        @lang("Delivery is free for all paying members. If you're not a paying maybe then you will be charges 3.95€ for shipping.")
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                    aria-expanded="false" aria-controls="collapseTwo">@lang('What is your cancellation policy?')</button>
                            </h2>

                            <div id="collapseTwo" class="accordion-collapse collapse"
                                aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>
                                        @lang("You can cancel you membership at any point. But you can't get a refund for your already paid membership.")
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                    aria-expanded="false" aria-controls="collapseThree">@lang('How long is the delivery time?')</button>
                            </h2>

                            <div id="collapseThree" class="accordion-collapse collapse"
                                aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>@lang("We always do our best to deliver your package within 3-5 days. If you haven't received your order - please contact customer support.")</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="get-in-touch bg-white">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="d-flex">
                            <figure>
                                <img src="assets/images/smile.png" alt="">
                            </figure>

                            <div class="info">
                                <h5>@lang('Still have question?')</h5>
                                <p>@lang('Can’t find the answer your’re looking for? Please chat to our friendly team.')
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="get-in-touch-btn ms-auto">
                            <a class="text-white" href="{{route('contact')}}">@lang('get in touch')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>