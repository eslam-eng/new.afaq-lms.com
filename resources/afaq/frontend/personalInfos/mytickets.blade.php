@extends('frontend.personalInfos.index')
@section('title' ,__('lms.my_tickets'))
@section('myprofile')
    <link rel="stylesheet" href="https://www.gov.br/ds/assets/govbr-ds-dev-core/dist/core.min.css">
    <link rel="stylesheet" href="https://cdngovbr-ds.estaleiro.serpro.gov.br/design-system/fonts/rawline/css/rawline.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link href="{{ asset('afaq/assests/css/upload-img.style.css') }}" rel="stylesheet">

{{--    <form class="ticket-page">--}}
        <div class="ticket-title">
            <div class="Introduction-What-learn">
                <div class="icons">
                    <span class="small-icon">
                        <i class="fa-solid fa-circle"></i>
                    </span>
                    <span class="big-icon">
                        <i class="fa-solid fa-circle"></i>
                    </span>
                </div>
                <strong>{{__('lms.my_tickets')}}  </strong>
            </div>
            <div class="ticket-btn creat-ticket">
                <span>{{__('lms.ticket')}} <i class="fa-solid fa-plus"></i></span>
            </div>
        </div>
        <div class="tabel-tickes">
            <table>
                <tr class="head-tick">
                    <th class="title-tick">{{__('lms.ticket_title')}}</th>
                    <th class="Status-tick">{{__('lms.ticket_status')}}</th>
                    <th class="Date-tick">{{__('lms.ticket_date')}}</th>
                </tr>
{{--                {{dd($tickets)}}--}}
                @foreach($tickets as $ticket)
                <tr class="body-tick the-problem-ticket the-opended-ticket" data-id="{{$ticket->id}}" >


                    <td class="bdy-name-ticket">{{$ticket->title}}</td>

                    @if($ticket->statues == '1' )
                        <td class="bdy-Status-tick"><span class="on-ststus solved-tick">{{__('lms.ticket_solved')}}</span></td>

                    @elseif($ticket->statues == '0' )
                        <td class="bdy-Status-tick"><span class="on-ststus open-tick">{{__('lms.ticket_opened')}}</span></td>
                    @endif
                    <td class="bdy-Date-tick">{{$ticket->created_at}}</td>
                </tr>
                @endforeach

            </table>
        </div>
            <!-- Responsive ticket -->
        <div class="small-table-ticket">
            @foreach($tickets as $ticket)
            <table class="body-tick the-problem-ticket the-solved-ticket" data-id="{{$ticket->id}}">

                <tr >
                  <th class="title-tick">{{__('lms.ticket_title')}}</th>
                  <td>{{$ticket->title}}</td>
                </tr>
                <tr>
                  <th class="Status-tick">{{__('lms.ticket_status')}}</th>
                    @if($ticket->statues == '1' )
                        <td><span class="on-ststus solved-tick">{{__('lms.ticket_solved')}}</span></td>
                    @elseif($ticket->statues == '0')
                  <td><span class="on-ststus open-tick">{{__('lms.ticket_opened')}}</span></td>
                    @endif
                </tr>
                <tr>
                  <th class="Date-tick">{{__('lms.ticket_date')}}</th>
                  <td>{{$ticket->created_at}}</td>
                </tr>
              </table>
            @endforeach

{{--              <table class="body-tick the-problem-ticket the-opended-ticket">--}}
{{--                <tr>--}}
{{--                  <th class="title-tick">{{__('lms.ticket_title')}}</th>--}}
{{--                  <td>{{__('lms.ticket_problem')}}</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <th class="Status-tick">{{__('lms.ticket_status')}}</th>--}}
{{--                  <td><span class="on-ststus solved-tick">{{__('lms.ticket_solved')}}</span></td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                  <th class="Date-tick">{{__('lms.ticket_date')}}</th>--}}
{{--                  <td>2023-02-06 15:13:54</td>--}}
{{--                </tr>--}}
{{--              </table>--}}

        </div>
    <!-- Create New Ticket  -->
        <div class="new-ticket">
            <form method="post" action="{{ url(app()->getLocale() . '/add_tickets') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="email" value="{{ auth()->user()->email }}">

                <span class="fk-layer"></span>
            <div class="the-card-ticket">
                <span class="close-tickett"><i class="fa-solid fa-xmark"></i></span>
                <strong>{{__('lms.ticket')}}</strong>
                <div class="details-ticket">
                    <div class="title-tec-label label-name">
                        <label for="title">{{__('lms.ticket_title')}}</label>
                        <input type="text" name="title" id="title" >
                    </div>
                    <span style="width: 20px"></span>
                    <div class="title-tec-label label-name">
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
                </div>
                <div class="descriptoion-ticket label-name">
                    <label for="description">{{__('lms.ticket_description')}} </label>
                    <textarea name="description" id="description" cols="10" rows="4"></textarea>
                </div>
                <div class="upload-img-sec">
                    {{-- <form action="/action_page.php">
                         <label for="img">Upload Image</label>
                        <input type="file" id="img" name="img" accept="image/*">
                      </form> --}}
                    <div class="br-upload">
                        <label class="upload-label" for="multiple-files"><span></span></label>
                        <input class="upload-input" id="image" type="file" accept=".gif, .jpg, .png"  multiple="multiple"   name="image"/>
                        <div class="upload-list"></div>
                    </div>
                    <p class="text-base mt-1"></p>
                </div>
                <div class="action-btn">
                    <button class="Create-last" type="submit"> {{__('lms.ticket_create')}}</button>
                    <button class="Cancel-last" type="reset">{{__('lms.ticket_cancel')}} </button>
                </div>
            </div>


    </form>
        </div>


    @foreach($tickets as $tick)

        <div class="open-ticket-card open-ticket-card-{{$tick->id}}">
            <span class="fk-layer"></span>
            <div class="the-card-ticket">
                <span class="close-tickett"><i class="fa-solid fa-xmark"></i></span>
                <strong>{{__('lms.ticket_replies')}}</strong>
                <div class="problem-decriptions">
                    <div class="hav-problem">
                        <div class="problem-name">
                            <span>{{$tick->title}}</span> <!-- {{__('lms.ticket_problem')}}  -->
                            <em>{{$tick->created_at}}</em>
                        </div>
{{--                        {{dd($tick->toArray())}}--}}
                        <div class="problem-status">
                            @if($tick->statues && $tick->statues != "0")
                                <span class="on-ststus solved-tick">{{__('lms.ticket_solved')}}</span>
                            @else
                                <span class="on-ststus open-tick">{{__('lms.ticket_opened')}}</span>

                            @endif
                        </div>

                    </div>
                    <p>{{$tick->description}}</p>
                </div>
                <strong>{{__('lms.replies')}}</strong>
                <div class="problem-decriptions">
                    @forelse ($tick->ticket_comments as $comment)
                    <div class="Replies-details">
                        <div class="details-description">

                            <div class="user-img">
                                <img src="{{ $comment->image }}" alt="">
                            </div>
                            <span class="name-reblies">{{$comment->author_name}}</span>
                        </div>
                        <p class="descriptios-problems">
                            {{$comment->comment_text}}
                        </p>
                    </div>
                    @empty
                        <div class="row">
                            <div class="col">
                                <p>{{__('lms.no_comments')}}</p>
                            </div>
                        </div>
                        <hr />
                    @endforelse
                </div>
                {{-- ********************************** --}}
                <div class="action-btn">
                    @if($tick->statues && $tick->statues != "0")
                        <button class="Cancel-last"> {{__('lms.ticket_cancel')}}</button>
                    @else
                        <button class="Create-last creat-reblay create-ticket-comment" data-ticket-id="{{$tick->id}}"> {{__('lms.ticket_create')}}</button>
                        <button class="Cancel-last"> {{__('lms.ticket_cancel')}}</button>
                    @endif

                </div>
            </div>
        </div>

        </div>
    @endforeach
    <form class="creat-reblay-popup" action=""  method="POST" enctype="multipart/form-data">
        @csrf

        <span class="fk-layer"></span>

        <div class="the-card-ticket">

            <span class="close-tickett"><i class="fa-solid fa-xmark"></i></span>
            <strong>{{__('lms.ticket')}}</strong>

            <div class="descriptoion-ticket label-name">
                <input type="hidden" name="ticket_id" value="">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                <label for="comment_text">{{__('lms.ticket_description')}} </label>
                <textarea name="comment_text" id="" cols="10" rows="4"></textarea>
            </div>
            <div class="upload-img-sec">

                <div class="upload-img-sec">
                    {{-- <form action="/action_page.php">
                         <label for="img">Upload Image</label>
                        <input type="file" id="img" name="img" accept="image/*">
                      </form> --}}
                    <div class="br-upload">
                        <label class="upload-label" for="multiple-files"><span></span></label>
                        <input class="upload-input" id="image" type="file" multiple="multiple"  accept=".gif, .jpg, .png"  name="image"/>
                        <div class="upload-list"></div>
                    </div>
                    <p class="text-base mt-1"></p>
                </div>
                <p class="text-base mt-1"></p>
            </div>
            <div class="action-btn">
                <button class="Create-last creat-reblay" type="submit"> {{__('lms.ticket_create')}}</button>
                <button class="Cancel-last" type="reset"> {{__('lms.ticket_cancel')}}</button>
            </div>
        </div>
    </form>
    <script src="https://www.gov.br/ds/assets/govbr-ds-dev-core/dist/core-init.js"></script>
@endsection



@push('footer-scripts')
    <script>
        $(document).on('click','.create-ticket-comment',function (){
            var id = $(this).attr('data-ticket-id');
            var url = "{{ route('admin.tickets.storeComment', 'id:id') }}";
            url =url.replace('id:id',id);
            $('.creat-reblay-popup').attr('action',url);
            $("input[name='ticket_id']").val(id);

        })

    </script>
@endpush

