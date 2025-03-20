<section class="mailchimp_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h3>@lang('subscribe_title')</h3>
                <p>@lang('subscribe_description')</p>
                <div class="mailchimp_form_2">
                    <form action="{{route('user.subscribe')}}" method="post">
                        @csrf
                        <input type="email" name="email" placeholder="@lang('Email')" required>
                        <button type="submit"><i class="magro-share-1"></i>@lang('Subcribe')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>