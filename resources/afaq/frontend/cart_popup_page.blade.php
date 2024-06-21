@if(auth()->check())
                <div class="view-page">
                    <!-- <a href="{{url(app()->getLocale().'/carts')}}">
                        <div class="on-view cart-img">
                            <img src="{{asset('/nazil/imgs/shopping-cart (4).png')}}" alt="">
                            <span class="cart-notifcation">{{ isset($cart) ? $cart->items_count : 0}}</span>
                        </div> -->

                        @if(isset($cart) && isset($cart->items))

                        <div class="cart-option-details_popup">
                            <div class="all-carts-reserved">
                                @foreach($cart->items as $item)
                                @if($item->course)
                                <div class="carts-reserved-details">
                                    <div class="d-flex justify-content-start reserved-details-cart">
                                        <div class="img-cart-reserved">
                                            <a href="{{url('/'.app()->getLocale().'/one-courses/'.$item->course->id)}}">
                                                <img src="{{ isset($item->course->image->url) ? $item->course->image->url : asset('/nazil/imgs/Customer-Service-Jobs-640x480-1-500x479.jpg') }}" alt="{{isset($item->course->image_title_en) ? $item->course->image_title_en : '' }}">
                                            </a>
                                        </div>
                                        <div class="data-cart-reserved">
                                            <div class="cart-details">
                                                <span>{{ app()->getLocale() == 'en' ? ($item->category->name_en ?? '') : ($item->category->name_ar ?? '') }}</span>
                                                <a href="{{url('/'.app()->getLocale().'/one-courses/'.$item->course->id)}}">
                                                    <h2>{{ app()->getLocale() == 'en' ? ($item->course->name_en ?? '') : ($item->course->name_ar ?? '') }}</h2>
                                                </a>
                                                <div class="count-cours-cart">
                                                    <span class="new-price-cart">{{$item->course_price . __('lms.SR') }}</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                                @endif
                                @endforeach
                            </div>

                            <div class="totoal-coust-details">
                                <a class="col-6" style="border: none;height: 35px;background: #00B1DA ;
                                        border-radius: 30px;margin: 0 10px;padding: 5px;color: white;"
                                        href="{{url(app()->getLocale().'/carts')}}">
                                    {{__('lms.subscribe_now')}}</a>
                                <div class="totoal-coust-numbers">
                                    <span style=" color: #000000;">{{__('frontend.total')}}</span>
                                    <span style=" color: #000000;">{{ isset($cart->final_total) ? $cart->final_total . ' '.  __('lms.currency') : '' }}</span>
                                </div>


                            </div>
                        </div>
                        @endif
                    <!-- </a> -->
                </div>
                @endif
