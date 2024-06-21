
@extends('frontend.personalInfos.index')
<link href="{{ asset('frontend/css/profile-wallet-style.css') }}" rel="stylesheet">

@section('myprofile')
    <section class="wallet-page">
        <div class="wallet-points d-flex align-items-center">
            <div class="title-wallet active act-wallet-section">
                <span>{{ __('afaq.thewallet') }}</span>
            </div>
            <span class="fk-wdth"></span>
            <div class="title-wallet act-points-sections">
                <span>{{ __('afaq.thepoints') }}</span>
            </div>
        </div>
        <div class="wallet-section active">
            <div class="wallet-card d-flex justify-content-between">
                <div class="cost-side">
                    <div class="card-wallet balance-card">
                        <div class="smart-wallet">
                            <div class="wallet-img">
                                <img src="{{ asset('/afaq/imgs/wallet-regularsna.png') }}" alt="">
                            </div>
                            <span>{{ __('lms.my_balance') }}</span>
                            <strong>{{ $wallet->balance ?? 0 }} {{ $wallet->currency ?? 'SAR' }}</strong>
                        </div>
                    </div>
                </div>
                <div class="details-side">
                    <div class="card-wallet details-card">
                        <div class="d-flex justify-content-between details-wallet-data">
                            <div class="wallet-work">
                                <strong>What’s Wallet Work</strong>
                                <p>Charge credit to save on taxes & Earn
                                    <em>SNA</em> points You can exchange it for credit
                                </p>
                            </div>
                            <div class="the-wallet-img">
                                <img src="{{ asset('/afaq/imgs/wallet.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="afaq-qs">
                        <div class="d-flex justify-content-between align-items-center">
                            {{-- <div class="Introduction-What-learn">
                                <div class="icons">
                                    <span class="small-icon">
                                        <i class="fa-solid fa-circle"></i>
                                    </span>
                                    <span class="big-icon">
                                        <i class="fa-solid fa-circle"></i>
                                    </span>
                                </div>
                                <strong>{{__('lms.wallet')}} </strong>
                            </div>
                            {{-- <span class="view-all">View All</span> --}}
                            <div class=" myprofile-title wallet-">
                                <h3> Wallet FAQs</h3>
                              </div>
                        </div>
                        @if ($wallet_faq)
                            @foreach ($wallet_faq->faqQuestions as $k => $q)
                                <div class="all-qs-afaq {{ $k == 0 ? 'active' : '' }}">
                                    <div class="card-wallet qs-name d-flex justify-content-between">
                                        <strong>{{ $q->question ?? '' }}</strong>
                                        <span class="down"><i class="fa-solid fa-chevron-down"></i></span>
                                        <span class="up"><i class="fa-solid fa-chevron-up"></i></span>
                                    </div>
                                    <div class="answer-details">
                                        {!! $q->answer ?? '' !!}
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="points-section ">
            <div class="wallet-card d-flex justify-content-between">
                <div class="cost-side">
                    <div class="card-wallet balance-card">
                        <div class="on-webscreen">
                            <div class="balance-details">
                                <div class="balance-count">
                                    <div class="img-points">
                                        <div class="the-wallet-img points-img">
                                            <img src="{{ asset('/afaq/imgs/Group 42266sna.png') }}" alt="">
                                        </div>
                                    </div>
                                    <span class="fk-w"></span>
                                    <div class="my-balance-count">
                                        <span>{{ __('lms.my_balance') }}</span>
                                        <strong>{{ $points->points }}</strong>
                                    </div>
                                </div>
                                <div class="share-points">
                                    <div class="InviteFriends">
                                        <i class="fa-solid fa-share-nodes"></i>
                                        <span>Invite Friends</span>
                                    </div>
                                    <div class="InviteFriends-popup">
                                        <span class="fk-popup"></span>
                                        <div class="card-share">
                                            <span class="close-window">
                                                <i class="fa-solid fa-circle-xmark"></i>
                                            </span>
                                            <div class="share-pointss">
                                                <div id="share_course_popup">
                                                    <div class="share_to_social_media">
                                                        {{ __('global.share_to_social_media') }}

                                                        <div class="social-icons">
                                                            <!-- Twitter -->
                                                            <a style="color: #55acee !important;" href="https://twitter.com/intent/tweet?text=sna-academy&url={{ url()->current() }}"
                                                                role="button">
                                                                <i class="fab fa-twitter fa-lg"></i>
                                                            </a>
                                                            <!-- Facebook -->
                                                            <a style="color: #3b5998 !important;"
                                                                href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}&quote=sna-academy"
                                                                role="button">
                                                                <i class="fab fa-facebook-f fa-lg"></i>
                                                            </a>
                                                            <!-- Whatsapp -->
                                                            <a style="color: #25d366 !important;" href="https://wa.me/?text=sna-academy%5Cn%20{{ url()->current() }}"
                                                                role="button">
                                                                <i class="fab fa-whatsapp fa-lg"></i>
                                                            </a>
                                                            <!-- Linkedin -->
                                                            <a style="color: #0e76a8 !important;" href="https://www.linkedin.com/sharing/share-offsite/?url={{ url()->current() }}"
                                                                role="button">
                                                                <i class="fab fa-linkedin fa-lg"></i>
                                                            </a>
                                                            <!-- Gmail -->
                                                            <a style="color: #bb001b !important;"
                                                                href="https://mail.google.com/mail/u/0/?view=cm&to&su=Awesome+Blog!&body=https%3A%2F%2F{{ url()->current() }}%0A&bcc&cc&fs=1&tf=1"
                                                                role="button">
                                                                <i class="fa-brands fa-google"></i>
                                                            </a>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="replace-points d-flex justify-content-between">
                                <div class="replace-allpoints">
                                    <span class="point-numb">
                                        {{ $points->points }}
                                        <em>Points</em>
                                    </span>
                                    <div class="img-reblace">
                                        <img src="{{ asset('/afaq/imgs/arrow-up-arrow-down-solidsna.png') }}" alt="">
                                    </div>
                                    <span class="point-numb">
                                        {{ $points->points / config('app.point_to_money') }}
                                        <em>SAR</em>
                                    </span>
                                </div>
                                <form action="{{ route('admin.invite-friend',['locale' => app()->getLocale()]) }}" method="POST">
                                <div class="Coupon-Code Coupon-box d-flex align-items-center">
                                    <div class="the-Coupon-box">
                                        <span class="input-img">
                                            <img src="{{ asset('/afaq/imgs/ticket.png') }}" alt="">
                                        </span>
                                        <input type="text" name="code" id="code" placeholder="Coupon Code">
                                    </div>
                                    <button type="submit">{{ __('lms.apply') }}</button>
                                </form>
                                </div>
                            </div>
                            <div class="Redeem-Points d-flex justify-content-between">
                                @if($points->points && $points->points >= config('app.minimum_point_to_money'))
                                    <form action="{{ route('admin.redeem-point',['locale' => app()->getLocale()]) }}" method="POST">
                                        <button type="submit">Redeem Points</button>
                                    </form>
                                @endif
                                <div class="code-invite">
                                    <span>Copy Invite Code</span>
                                    <div class="code-numb">
                                        <em id="p3">{{ $points->invite_code }}</em>
                                        <span onclick="copyToClipboard('#p3')"><i class="fa-regular fa-copy"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="on-smallscreen">
                            <div class="img-points-smc">
                                <div class="img-points">
                                    <div class="the-wallet-img points-img">
                                        <img src="{{ asset('/afaq/imgs/Group 42266sna.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="blanc-points-smc">
                                <div class="my-balance-count">
                                    <span>My Points</span>
                                    <strong>{{ $points->points }} Points</strong>
                                </div>
                            </div>
                            <div class="transfel-smc">
                                <div class="replace-allpoints">
                                    <span class="point-numb">
                                        {{ $points->points }}
                                        <em>Points</em>
                                    </span>
                                    <div class="img-reblace">
                                        <img src="http://sna.test/afaq/imgs/arrow-up-arrow-down-solidsna.png"
                                            alt="">
                                    </div>
                                    <span class="point-numb">
                                        {{ $points->points / config('app.point_to_money') }}
                                        <em>SAR</em>
                                    </span>
                                </div>
                            </div>
                            <div class="btn-transfel-smc">
                                @if($points->points && $points->points >= config('app.minimum_point_to_money'))
                                    <form action="{{ route('admin.redeem-point',['locale' => app()->getLocale()]) }}" method="POST">
                                        <button type="submit">Redeem Points</button>
                                    </form>
                                @endif
                            </div>
                            <div class="share-smc">
                                <div class="share-points">
                                    <div class="InviteFriends">
                                        <i class="fa-solid fa-share-nodes"></i>
                                        <span>Invite Friends</span>
                                    </div>
                                    <div class="InviteFriends-popup">
                                        <span class="fk-popup"></span>
                                        <div class="card-share">
                                            <span class="close-window">
                                                <i class="fa-solid fa-circle-xmark"></i>
                                            </span>
                                            <div class="share-pointss">
                                                <div id="share_course_popup">
                                                    <div class="share_to_social_media">
                                                        {{ __('global.share_to_social_media') }}

                                                        <div class="social-icons">
                                                            <!-- Twitter -->
                                                            <a style="color: #55acee !important;" href="https://twitter.com/intent/tweet?text=sna-academy&url={{ url()->current() }}"
                                                                role="button">
                                                                <i class="fab fa-twitter fa-lg"></i>
                                                            </a>
                                                            <!-- Facebook -->
                                                            <a style="color: #3b5998 !important;"
                                                                href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}&quote=sna-academy"
                                                                role="button">
                                                                <i class="fab fa-facebook-f fa-lg"></i>
                                                            </a>
                                                            <!-- Whatsapp -->
                                                            <a style="color: #25d366 !important;" href="https://wa.me/?text=sna-academy%5Cn%20{{ url()->current() }}"
                                                                role="button">
                                                                <i class="fab fa-whatsapp fa-lg"></i>
                                                            </a>
                                                            <!-- Linkedin -->
                                                            <a style="color: #0e76a8 !important;" href="https://www.linkedin.com/sharing/share-offsite/?url={{ url()->current() }}"
                                                                role="button">
                                                                <i class="fab fa-linkedin fa-lg"></i>
                                                            </a>
                                                            <!-- Gmail -->
                                                            <a style="color: #bb001b !important;"
                                                                href="https://mail.google.com/mail/u/0/?view=cm&to&su=Awesome+Blog!&body=https%3A%2F%2F{{ url()->current() }}%0A&bcc&cc&fs=1&tf=1"
                                                                role="button">
                                                                <i class="fa-brands fa-google"></i>
                                                            </a>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex code-invitaion-smc">
                                <div class="copy-inv-code copy-cd-smc">
                                    <div class="code-invite ">
                                        <label>Copy Invite Code</label>
                                        <div class="code-numb">
                                            <em id="p3">{{ $points->invite_code }}</em>
                                            <span onclick="copyToClipboard('#p3')"><i class="fa-regular fa-copy"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('admin.invite-friend',['locale' => app()->getLocale()]) }}" method="POST">
                                    <div class="Coupon-Code Coupon-box d-flex align-items-center">
                                        <div class="the-Coupon-box">
                                            <span class="input-img">
                                                <img src="{{ asset('/afaq/imgs/ticket.png') }}" alt="">
                                            </span>
                                            <input type="text" name="code" id="code" placeholder="Coupon Code">
                                        </div>
                                        <button type="submit">{{ __('lms.apply') }}</button>
                                    </form>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="details-side">
                    <div class="card-wallet details-card">
                        <div class="d-flex justify-content-between details-wallet-data">
                            <div class="wallet-work">
                                <strong>What’s Points Work</strong>
                                <p>Charge credit to save on taxes & Earn
                                    <em>SNA</em> points You can exchange it for credit
                                </p>
                            </div>
                            <div class="the-wallet-img points-img">
                                <img src="{{ asset('/afaq/imgs/Group 42266sna.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="afaq-qs">
                        <div class="d-flex justify-content-between align-items-center">
                            {{-- <div class="Introduction-What-learn">
                                <div class="icons">
                                    <span class="small-icon">
                                        <i class="fa-solid fa-circle"></i>
                                    </span>
                                    <span class="big-icon">
                                        <i class="fa-solid fa-circle"></i>
                                    </span>
                                </div>
                                <strong> Wallet FAQs </strong>
                            </div> --}}
                            <div class=" myprofile-title wallet-">
                                <h3> Points FAQs</h3>
                              </div>
                            {{-- <span class="view-all">View All</span> --}}
                        </div>
                        @if ($points_faq)
                            @foreach ($points_faq->faqQuestions as $k => $q)
                                <div class="all-qs-afaq {{ $k == 0 ? 'active' : '' }}">
                                    <div class="card-wallet qs-name d-flex justify-content-between">
                                        <strong>{{ $q->question ?? '' }}</strong>
                                        <span class="down"><i class="fa-solid fa-chevron-down"></i></span>
                                        <span class="up"><i class="fa-solid fa-chevron-up"></i></span>
                                    </div>
                                    <div class="answer-details">
                                        {!! $q->answer ?? '' !!}
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
