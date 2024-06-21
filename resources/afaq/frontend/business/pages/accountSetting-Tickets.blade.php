@extends('frontend.business.layout.main')
@section('header-scripts')
<link rel="stylesheet" href="{{ asset('afaq/business/css/account-setting-style.css') }}">
<link rel="stylesheet" href="{{ asset('afaq/business/css/upload-img.style.css') }}">
<link rel="stylesheet" href="https://www.gov.br/ds/assets/govbr-ds-dev-core/dist/core.min.css">
<link rel="stylesheet" href="https://cdngovbr-ds.estaleiro.serpro.gov.br/design-system/fonts/rawline/css/rawline.css">

@endsection
@section('content')

<!-- ********** end header ************** -->
<section class="account-setting-page  ">
    <div class="account-setting-mainPage ">
        <div class="bunner-acc-setting container ">
            <div class="back-bunner">
                <span style="display: none">
                    <input type="file" id="background" class="input-file-text" />
                    <i class="fa-regular fa-pen-to-square"></i>
                </span>
                <img src="{{asset('afaq/business/imgs/v875-katie-45.png')}}" alt="" />

            </div>
            <div class="profile-pic">

                <form id="business_photo" action="{{ url(app()->getLocale() . '/update_personal_photo') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="input-file">
                        <img id="file_upload" class="upload-img" alt="your image" src="{{ asset(auth()->user()->personal_photo->url ?? '/default.png') }}">
                        <div class="input-file-upload">
                            <span class="sm-upload-label">{{__('global.edit')}}</span>
                            <input id="personal_photo" type="file" name="personal_photo" onchange="readURL(this);" /> {{-- onchange="readURL(this);" --}}

                        </div>
                    </div>
                </form>
            </div>
        </div>
        @if ($errors->any())
        {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
        @endif
        <div class="acc-setting-tabs container">
            <div class="names-acc-setting">
                <div class="name-mail">
                    <span>
                        {{ app()->getLocale() == 'en' ? auth()->user()->full_name_en ?? '' : auth()->user()->full_name_ar ?? '' }}
                    </span>
                    <em>
                        {{ auth()->user()->email ?? '' }}

                    </em>
                </div>
                <div class="tabs-title">
                    <a href="{{ url(app()->getLocale() . '/business-personal-infos') }}">
                        <div class="afaq-acc-name  my-acc">
                            <em class="show"> <img src="{{asset('afaq/business/imgs/fff-1.svg')}}" alt=""> </em>
                            <em class="hide"> <img src="{{asset('afaq/business/imgs/fff.svg')}}" alt=""> </em>
                            <span class="w-15-"></span>
                            <span>{{ __('lms.my_account') }}</span>
                        </div>
                    </a>

                    <a href="{{ url(app()->getLocale() . '/business_packages') }}">
                        <div class="afaq-acc-name Packages">
                            <em class="show"> <img src="{{asset('afaq/business/imgs/apps (-1.svg')}}" alt=""> </em>
                            <em class="hide"> <img src="{{asset('afaq/business/imgs/apps (1).svg')}}" alt=""> </em>
                            <span class="w-15-"></span>
                            <span>{{ __('lms.my_packages') }}</span>
                        </div>
                    </a>


                    <a href="  {{ url(app()->getLocale() . '/business_invoices') }}">
                        <div class="afaq-acc-name Invoices">
                            <em class="show"> <img src="{{asset('afaq/business/imgs/saxs-1.svg')}}" alt=""> </em>
                            <em class="hide"> <img src="{{asset('afaq/business/imgs/saxs.svg')}}" alt=""> </em>
                            <span class="w-15-"></span>
                            <span>{{ __('lms.my_invoices') }}</span>
                        </div>
                    </a>
                    <a href="#">
                        <div class="afaq-acc-name active Tickets">
                            <em class="show"> <img src="{{asset('afaq/business/imgs/Union 87.svg')}}" alt=""> </em>
                            <em class="hide"> <img src="{{asset('afaq/business/imgs/Union 86.svg')}}" alt=""> </em>
                            <span class="w-15-"></span>
                            <span>{{ __('lms.myTicket') }}</span>
                        </div>
                    </a>
                    <div class="afaq-acc-name logout on-logout on-web">

                        <em class="logout"> <img src="{{asset('afaq/business/imgs/exit.svg')}}" alt=""> </em>
                        <span class="w-15-"></span>
                        <span id="logou">{{ __('lms.Logout') }}</span>
                        <form id="logoutform" action="{{ route('logout', ['locale' => app()->getLocale()]) }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>

            <div class="details-acc-setting">
                <span><i class="fa-solid fa-triangle-exclamation"></i>{{__('afaq.package_expire_at')}}
                </span>


                <div class="Tickets-form show acc-detials-form">
                    <div class="add-tickets">
                        <span>{{__('lms.my_tickets')}}
                            <i class="fa-solid fa-plus"></i></span>
                    </div>
                    <div class="table-tickets">
                        <table style="width:100%">
                            <tr class="head-tick">
                                <th>{{__('lms.ticket_title')}}</th>
                                <th>{{__('lms.ticket_status')}}</th>
                                <th>{{__('lms.ticket_date')}}</th>
                            </tr>

                            @foreach($tickets as $ticket)

                            <tr class="body-tick" id="ha" data-id="{{$ticket->id}}">

                                <td class="tick-title">{{$ticket->title ?? ''}}</td>
                                @if($ticket->statues == '1' )
                                <td class="tick-stuts Solved">{{__('lms.ticket_solved')}}</td>
                                @elseif($ticket->statues == '0')
                                <td class="tick-stuts Opened">{{__('lms.ticket_opened')}}</td>
                                @endif


                                <td class="tick-date">{{$ticket->created_at}}</td>
                            </tr>
                            @endforeach
                            {{-- <tr class="body-tick">--}}
                            {{-- <td class="tick-title">I Have Problem</td>--}}
                            {{-- <td class="tick-stuts Solved">Solved</td>--}}
                            {{-- <td class="tick-date">2023-02-06 15:13:54</td>--}}
                            {{-- </tr>--}}
                        </table>
                    </div>
                    <!-- ************ creat tickets******************* -->
                    <div class="ticket-creat">
                        <div class="fk-layer-ticket"></div>
                        <div class="creat-ticket-form">
                            <div class="close-ticket">
                                <i class="fa-solid fa-circle-xmark"></i>
                            </div>
                            <form method="post" action="{{ url(app()->getLocale() . '/create_tickets') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                                <input type="hidden" name="type" value="Business">

                                <div class="ticket-description-title dd">
                                    <span class="ticket-title">
                                        {{__('lms.ticket')}}
                                    </span>
                                    <div class="upload-ticket-img">
                                        <!-- <div class="upload-img-sec">
                                                <div class="br-upload">
                                                    <label class="upload-label"
                                                           for="multiple-files"><span></span></label>
                                                    <input class="upload-input" id="image" type="file"
                                                           accept=".gif, .jpg, .png" multiple="multiple"
                                                           name="image"/>


                                                    <div class="upload-list"></div>
                                                </div>
                                                <p class="text-base mt-1"></p>
                                            </div> -->
                                        <div class="fileContainer sprite">
                                            <span>{{__('lms.upload_img')}}</span>
                                            <input type="file" id="image"
                                                   accept=".gif, .jpg, .png" multiple="multiple"
                                                   name="image" value="Choose File">
                                        </div>
                                    </div>
                                </div>
                                <div class="sm-form-tik">
                                    <div class="ticket-details">
                                        <div class="sm-label">
                                            <label for="title">{{__('lms.ticket_title')}}</label>
                                            <input type="text" name="title" id="title" required>
                                        </div>
                                        <div class="sm-label">
                                            <label for="ticket_category_id">{{__('lms.ticket_category')}}</label>
                                            <select name="ticket_category_id" id="ticket_category_id" required>
                                                <option value="" selected disabled></option>
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">
                                                    {{ app()->getLocale() == 'en' ? $category->title_en : $category->title_ar }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="sm-label sm-textarea ">
                                            <label for="description">{{__('lms.ticket_description')}} </label>
                                            <textarea name="description" id="description" cols="10" rows="4" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="action-btn">
                                    <button class="Create-last creat-reblay" type="submit"> {{__('lms.ticket_create')}}</button>
                                    <span class="Cancel-last">{{__('lms.ticket_cancel')}} </span>

                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- **************** end ticket-creat -->
                    <!-- **************** start ticket-opened -->
                    @foreach($tickets as $tick)
                    <div class="ticket-opened ticket-opened-{{$tick->id}}">


                        <div class="fk-layer-ticket"></div>

                        <div class="creat-ticket-form ">
                            <div class="close-ticket">
                                <i class="fa-solid fa-circle-xmark"></i>
                            </div>
                            <form action="">
                                <div class="ticket-description-title">
                                    <span class="ticket-title">
                                        Ticket Description
                                    </span>
                                    <div class="upload-ticket-img">
                                        <div class="upload-img-sec">
                                            {{-- <div class="br-upload">--}}
                                            {{-- <label class="upload-label"--}}
                                            {{-- for="multiple-files"><span></span></label>--}}
                                            {{-- <input class="upload-input" id="image" type="file"--}}
                                            {{-- accept=".gif, .jpg, .png" multiple="multiple"--}}
                                            {{-- name="image"/>--}}
                                            {{-- <div class="upload-list"></div>--}}
                                            {{-- </div>--}}
                                            <p class="text-base mt-1"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="problem-dec ">
                                    <div class="sm-problem-details">
                                        <div class="problem-title">
                                            <strong>{{$tick->title}}</strong>
                                            <em>{{$tick->created_at}}</em>
                                        </div>
                                        <div class="problem-result">
                                            @if($tick->statues && $tick->statues != "0")
                                            <span class="sloved-buge">{{__('lms.ticket_solved')}}</span>
                                            @else
                                            <span class="Opened-buge">{{__('lms.ticket_opened')}}</span>

                                            @endif
                                        </div>
                                    </div>
                                    <div class="problem-p">
                                        <p>{{$tick->description}}</p>
                                    </div>
                                </div>

                                <div class="problem-replies">
                                    <div class="ticket-description-title">
                                        <span class="ticket-title">
                                            {{__('lms.replies')}}
                                        </span>
                                        {{-- <div class="upload-ticket-img">--}}
                                        {{-- <div class="upload-img-sec">--}}
                                        {{-- <div class="br-upload">--}}
                                        {{-- <label class="upload-label"--}}
                                        {{-- for="multiple-files"><span></span></label>--}}
                                        {{-- <input class="upload-input" id="image" type="file"--}}
                                        {{-- accept=".gif, .jpg, .png" multiple="multiple"--}}
                                        {{-- name="image"/>--}}
                                        {{-- <div class="upload-list"></div>--}}
                                        {{-- </div>--}}
                                        {{-- <p class="text-base mt-1"></p>--}}
                                        {{-- </div>--}}
                                        {{-- </div>--}}
                                    </div>

                                    <div class="all-replies-problem">
                                        @forelse ($tick->ticket_comments as $comment)
                                        <div class="problem-card">
                                            <div class="sm-replies-all">
                                                <div class="ticket-img">

                                                    @if($comment->author_name == 'admin')

                                                    <img alt="your image" src="{{ asset(auth()->user()->personal_photo->url ?? '/default.png') }}">

                                                    @else
                                                    <img src="{{ $comment->image }}" alt="">
                                                    @endif
                                                    <span>{{$comment->author_name}}</span>
                                                </div>
                                                <p> {{$comment->comment_text}}</p>
                                            </div>

                                        </div>
                                        @empty
                                        {{-- <div >--}}
                                        {{-- <div >--}}
                                        <p>{{__('lms.no_comments')}}</p>
                                        {{-- </div>--}}
                                        {{-- </div>--}}
                                        {{-- <hr />--}}
                                        @endforelse
                                    </div>

                                </div>

                                <div class="add-replay-btn">
                                    @if($tick->statues && $tick->statues != "0")
                                    <span class="Cancel-last"> {{__('lms.ticket_cancel')}}</span>
                                    @else
                                    <input class="sm-creat-reblay creat-reblay create-ticket-comment" data-ticket-id="{{$tick->id}}" value="{{__('lms.ticket_create')}}">
                                    <span class="Cancel-last"> {{__('lms.ticket_cancel')}}</span>
                                    @endif


                                </div>


                            </form>
                        </div>
                    </div>
                    @endforeach



                    <!-- **************** end ticket-opened -->
                    <!-- **************** start ticket-replay -->
                    <div class="ticket-replay">
                        <div class="fk-layer-ticket"></div>
                        <div class="creat-ticket-form">
                            <div class="close-ticket">
                                <i class="fa-solid fa-circle-xmark"></i>
                            </div>
                            <form class="creat-reblay-popup" action="" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="ticket_id" value="">
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                                <input type="hidden" name="type" value="Business">

                                <div class="ticket-description-title">
                                    <span class="ticket-title">
                                        {{__('lms.ticket')}}
                                    </span>
                                    <div class="upload-ticket-img">
                                        <!-- <div class="upload-img-sec">
                                            <div class="br-upload">
                                                <label class="upload-label" for="multiple-files"><span></span></label>
                                                <input class="upload-input" id="image" type="file" accept=".gif, .jpg, .png" multiple="multiple" name="image" />
                                                <div class="upload-list"></div>
                                            </div>
                                            <p class="text-base mt-1"></p>
                                        </div> -->
                                        <div class="fileContainer sprite">
                                            <span>{{__('lms.upload_img')}}</span>
                                            <input type="file" id="image"
                                                   accept=".gif, .jpg, .png" multiple="multiple"
                                                   name="image" value="Choose File">
                                        </div>
                                    </div>
                                </div>
                                <div class="sm-form-tik">
                                    <div class="ticket-details">
                                        <div class="sm-label sm-textarea ">
                                            <label for="comment_text">{{__('lms.ticket_description')}} </label>
                                            <textarea name="comment_text" id="" cols="10" rows="4"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="action-btn">

                                    <button class="Create-last creat-reblay" type="submit"> {{__('lms.ticket_create')}}</button>
                                    <span class="Cancel-last"> {{__('lms.ticket_cancel')}}</span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- **************** end ticket-replay -->
                    <!-- ************ creat tickets******************* -->
                </div>

            </div>

        </div>
    </div>
</section>

@endsection
@push('scripts')
<script src="https://www.gov.br/ds/assets/govbr-ds-dev-core/dist/core-init.js">
</script>
<script>
    $(document).ready(function() {
        $('#logou').click(function() {
            $("#logoutform").submit();
        });
    })
</script>
<script>
    $(document).on('click', '.create-ticket-comment', function() {
        var id = $(this).attr('data-ticket-id');
        var url = "{{ route('admin.tickets.storeBusinessComment', 'id:id') }}";
        url = url.replace('id:id', id);
        $('.creat-reblay-popup').attr('action', url);
        $("input[name='ticket_id']").val(id);

    })
</script>
<script>
    $(document).ready(function(e) {

        $('#personal_photo').change(function() {
            var formData = new FormData();
            var files = $('#personal_photo')[0].files;
            formData.append('personal_photo', files[0]);
            $.ajax({
                type: 'POST',
                url: "{{ route('update_personal_photo')}}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (response) => {
                    console.log(response);
                    $('#personal_img').attr('src', response);

                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    });
    // $(".rtl .upload-button span").html('تحميل المرفق')
    // $(".lrt .upload-button span").html('Upload Image')

    $("input:file").change(function (){
		var fileName = $(this).val();
		if(fileName.length >0){
    $(this).parent().children('span').html(fileName);
		}
		else{
			$(this).parent().children('span').html("Choose file");

		}
	});
	//file input preview
	function readURL(input) {
		if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
						$('.logoContainer img').attr('src', e.target.result);
				}
				reader.readAsDataURL(input.files[0]);
		}
	}
	$("input:file").change(function(){
			readURL(this);
	});
</script>
@endpush
