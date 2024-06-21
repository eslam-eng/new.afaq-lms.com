@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.user.title') }}
            <form action="{{route('admin.export_course_users',['course_user' => request('course_user')])}}" method="GET">
                <button class="btn btn-success" type="submit">Export</button>
            </form>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover  datatable-User">
                    <thead>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.id') }}
                            </th>
                            {{--                        <th> --}}
                            {{--                            {{ trans('cruds.user.fields.date') }} --}}
                            {{--                        </th> --}}
                            <th>
                                {{ trans('cruds.header.fields.name_ar') }}
                            </th>
                            <th>
                                {{ trans('cruds.header.fields.name_en') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.email') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.user_name') }}

                            </th>
                            <th>
                                {{ trans('cruds.blogscomment.fields.phone_helper') }}
                            </th>
                            <th>
                                {{ trans('frontend.register.gender') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.nationality') }}
                            </th>
                            <th>
                                {{ trans('frontend.register.occupational_classification_number') }}
                            </th>

                            <th>
                                {{ trans('frontend.register.Field of your specialist study') }}
                            </th>
                            <th>
                                {{ trans('frontend.register.Field of your sub specialist study') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.verified') }}
                            </th>


                            <th>
                                {{ trans('cruds.user.fields.join_course_date') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.completion_date') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.completion_percentage') }}
                            </th>
                            @foreach ($quizes as $quiz)
                                <th>


                                    {{ trans('cruds.exam.fields.success_percentage') }} {{ __('afaq.For') }}
                                    {{ app()->getLocale() == 'en' ? $quiz->title_en ?? '' : $quiz->title_ar ?? '' }}
                                </th>
                                <th>
                                    {{ trans('lms.repeat_times') }} {{ __('afaq.For') }}
                                    {{ app()->getLocale() == 'en' ? $quiz->title_en ?? '' : $quiz->title_ar ?? '' }}
                                </th>
                            @endforeach


                        </tr>

                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        function change_approve(id) {
            // alert('true')
            if (confirm('{{ trans('global.areYouSure') }}') == true) {

                var approved = 1;
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/admin/ChangeStatusReservation',
                    data: {
                        'approved': approved,
                        'reservation_id': id
                    },
                    success: function(data) {}
                });
            } else {
                event.preventDefault()

            }
        }

        function delete_reseration(id) {

            if (confirm('{{ trans('global.areYouSure') }}') == true) {
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/admin/DeleteReservationInvoices',
                    data: {
                        'reservation_id': id
                    },
                    success: function(data) {
                        window.location.reload()
                    }
                });
            } else {

                event.preventDefault()

            }
        }
    </script>
    <script type="text/javascript">
        $(function() {

            var table = $('.datatable-User').DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,

                ajax: {
                    url: "{{ route('admin.course-users.show', request('course_user')) }}",
                    type: 'GET',
                    data: {
                        // Parameters
                        columnsDef: [
                            //
                        ],
                    },
                },
                columns: [

                    {
                        data: 'id',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'name_ar',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'name_en',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'email',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'user_name',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'phone',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'gender',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'nationality',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'occupational_classification_number',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'specialty',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'sub_specialty',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'verified',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'completion_date',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'completion_percentage',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'created_at',
                        orderable: true,
                        searchable: true
                    },

                ],

                columnDefs: [{
                        targets: 0,
                        render: function(data, type, full, meta) {
                            return full.id;
                        },
                    },
                    {
                        targets: 1,
                        render: function(data, type, full, meta) {
                            return full.name_ar;
                        },
                    },
                    {
                        targets: 2,
                        render: function(data, type, full, meta) {
                            return full.name_en;
                        },
                    },
                    {
                        targets: 3,
                        render: function(data, type, full, meta) {
                            return full.email;
                        },
                    },
                    {
                        targets: 4,
                        render: function(data, type, full, meta) {
                            return full.user_name;
                        },
                    },
                    {
                        targets: 5,
                        render: function(data, type, full, meta) {
                            return full.phone;
                        },
                    },
                    {
                        targets: 6,
                        render: function(data, type, full, meta) {
                            return full.gender;
                        },
                    },
                    {
                        targets: 7,
                        render: function(data, type, full, meta) {
                            return full.nationality;
                        },
                    },
                    {
                        targets: 8,
                        render: function(data, type, full, meta) {
                            return full.occupational_classification_number;
                        },
                    },
                    {
                        targets: 9,
                        render: function(data, type, full, meta) {
                            return full.specialty;
                        },
                    },
                    {
                        targets: 10,
                        render: function(data, type, full, meta) {
                            return full.sub_specialty;
                        },
                    },
                    {
                        targets: 11,
                        render: function(data, type, full, meta) {
                            return full.verified;
                        },
                    },
                    {
                        targets: 12,
                        render: function(data, type, full, meta) {
                            return full.created_at;
                        },
                    },
                    {
                        targets: 13,
                        render: function(data, type, full, meta) {
                            return full.completion_date;
                        },
                    },
                    {
                        targets: 14,
                        render: function(data, type, full, meta) {
                            return full.completion_percentage;
                        },
                    },


                    @foreach ($quizes as $quiz)
                        {
                            targets: 13 + parseInt({{ $loop->index + 1 }}),
                            render: function(data, type, full, meta) {
                                return full.score_percentage_{{ $quiz->id }};
                            },
                        }, {
                            targets: 14 + parseInt({{ $loop->index + 1 }}),
                            render: function(data, type, full, meta) {
                                return full.repeat_times_{{ $quiz->id }};
                            },
                        },
                    @endforeach
                ],
            });

        });
    </script>
@endsection
