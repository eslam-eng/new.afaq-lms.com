@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        #draggable {
            width: 150px;
            height: 150px;
            padding: 0.5em;
        }

        .connectedSortable {
            max-height: 650px;
            overflow-y: scroll;
        }

        .connectedSortable::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            background-color: #F5F5F5;
        }

        .connectedSortable::-webkit-scrollbar {
            width: 10px;
            background-color: #F5F5F5;
        }

        .connectedSortable::-webkit-scrollbar-thumb {
            background-color: #343A40;
            border: 2px solid #555555;
        }
    </style>
@endsection
@section('content')
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-center">
                    <h2 class="text-center p-2 shadow-lg">{{ trans('cruds.specialty.fields.sort') }}
                    </h2>
                </div>

                <div class="row">
                    <div class="col-md-5  mx-5 shadow-lg">
                        <h3 class="text-center pb-3 pt-3">{{ trans('cruds.specialty.fields.all_specialty') }}</h3>
                        <ul class="list-group shadow-lg connectedSortable h-100" id="padding-provider-drop">
                            @if (!empty($panddingprovider) && $panddingprovider->count())
                                @foreach ($panddingprovider as $key => $value)

                                    <li class="list-group-item my-1" specialty-id="{{ $value->id }}">
                                        <span class="badge badge-info">{{$key+1}} </span>  {{ $value->s_name }}
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="col-md-5  mx-5 shadow-lg complete-provider">
                        <h3 class="text-center pb-3 pt-3">{{ trans('cruds.specialty.fields.show_in_homepage') }}</h3>
                        <ul class="list-group  connectedSortable h-100" id="complete-provider-drop">
                            @if (!empty($completeprovider) && $completeprovider->count())
                                @foreach ($completeprovider as $ke => $value)
                                    <li class="list-group-item my-1" specialty-id="{{ $value->id }}">
                                        <span class="badge badge-info">{{$ke+1}}</span> {{ $value->s_name }}
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- <script src="https://code.jquery.com/jquery-3.4.1.js"></script> --}}
@section('scripts')
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $("#padding-provider-drop, #complete-provider-drop").sortable({
                connectWith: ".connectedSortable",
                opacity: 0.5,
                dropOnEmpty: true,
                dropOnEmpty: true,
                // connectWith: '.sortable',
                tolerance: "pointer",
                revert: true,
                cursor: "move",
            });
            $(".connectedSortable").on("sortupdate", function(event, ui) {
                var pending = [];
                var show_in_homePage = [];
                $("#padding-provider-drop li").each(function(index) {
                    if ($(this).attr('specialty-id')) {
                        pending[index] = $(this).attr('specialty-id');
                    }
                });
                $("#complete-provider-drop li").each(function(index) {
                    show_in_homePage[index] = $(this).attr('specialty-id');
                });
                $.ajax({
                    url: "{{ route('admin.specialties.sort') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        pending: pending,
                        show_in_homePage: show_in_homePage
                    },
                    success: function(data) {
                        console.log('success');
                    }
                });

            });
        });
    </script>
@endsection
@endsection
