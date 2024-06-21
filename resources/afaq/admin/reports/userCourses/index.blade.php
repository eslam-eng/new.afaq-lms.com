@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.user.title') }}
        </div>
        <form action="{{ route('admin.users.export') }}" class="row filter-from mx-1">
            <div class="col-lg-3 col-md-12">
                <div class="form-group">
                    <label class="required">{{ trans('frontend.register.Field of your specialist study') }}</label>
                    <select onchange="get_sub_specialists()"
                        class="form-control {{ $errors->has('specialty_id') ? 'is-invalid' : '' }} select2" name="specialty_id[]"
                        id="specialty_id" required>
                        <option value disabled {{ old('specialty_id', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}</option>
                        @foreach ($specialties as $key => $label)
                            <option value="{{ $label->id }}"
                                {{ old('specialty_id', '') === (string) $key ? 'selected' : '' }}>{{ $label->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback"></div>

                    @if ($errors->has('specialty_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('specialty_id') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-3 col-md-12" id="sub">
                <div class="form-group">
                    <label class="required">{{ trans('frontend.register.Field of your sub specialist study') }}</label>
                    <div id="subs"></div>
                    <div class="invalid-feedback"></div>

                    @if ($errors->has('sub_specialty_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('sub_specialty_id') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-2">
                <label for="users-list-verified">{{ __('afaq.Country') }}</label>
                <fieldset class="form-group">
                    <select class="form-control select2" id="users-list-verified" name="country_id[]">
                        <option value="">All</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}">
                                {{ $country->title }}</option>
                        @endforeach
                    </select>
                </fieldset>
            </div>
            <div class="col-12 col-sm-6 col-lg-2">
                <label for="" class="mt-3"></label>
                <button type="button" onclick="$('.filter-from').submit()" class="btn btn-primary">Export</button>
            </div>
        </form>
        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable-User">
                    <thead>
                        <tr>
                            <th></th>
                            <th>
                                {{ trans('cruds.user.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.email') }}
                            </th>

                            <th>
                                {{ trans('cruds.blogscomment.fields.phone_helper') }}
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
                                {{ trans('cruds.user.fields.nationality') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.country') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.created_at') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.Action') }}
                            </th>
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
    <script type="text/javascript">
        $(function() {
            var locale = "{{ app()->getLocale() }}";
            var table = $('.datatable-User').DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                columnDefs: [{
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0
                }],
                select: {
                    style: 'multi',
                    selector: 'td:first-child'
                },
                order: [
                    [1, 'desc']
                ],
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'selectAll',
                        exportOptions: {
                            columns: ':visible'
                        },
                        action: function(e, dt) {
                            e.preventDefault()
                            dt.rows().deselect();
                            dt.rows({
                                search: 'applied'
                            }).select();
                        }
                    },
                    {
                        extend: 'selectNone',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [0, ':visible']
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    // {
                    //     text: 'JSON',
                    //     action: function (e, dt, button, config) {
                    //         var data = dt.buttons.exportData();

                    //         $.fn.dataTable.fileSave(
                    //             new Blob([JSON.stringify(data)]),
                    //             'Export.json'
                    //         );
                    //     }
                    // },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'csv',
                        charset: 'utf8',
                        bom: true,
                        exportOptions: {
                            modifier: {
                                page: 'all',
                                search: 'none'
                            }
                        },
                    },
                    {
                        extend: 'colvis',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            modifier: {
                                order: 'index', // 'current', 'applied','index', 'original'
                                page: 'all', // 'all', 'current'
                                search: 'none' // 'none', 'applied', 'removed'
                            },
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        }
                    }

                ],
                ajax: {
                    url: "{{ request()->fullUrl() }}",
                    type: 'GET',
                    data: {
                        // Parameters
                        columnsDef: [
                            //
                        ],
                    },
                },
                columns: [{
                        data: 'id',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'created_at',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'full_name_en',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'email',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'phone',
                        orderable: true,
                        searchable: true
                    },



                ],

                columnDefs: [{
                        targets: 0,
                        title: '{{ trans('cruds.user.fields.id') }}',
                        render: function(data, type, full, meta) {
                            return full.id;
                        },
                    },
                    {
                        targets: 2,
                        title: '{{ trans('cruds.user.fields.name') }}',
                        render: function(data, type, full, meta) {
                            return locale == 'en' ? full.full_name_en : full.full_name_ar;
                        },
                    },

                    {
                        targets: 3,
                        title: '{{ trans('cruds.user.fields.email') }}',
                        render: function(data, type, full, meta) {
                            return full.email;
                        },
                    },
                    {
                        targets: 4,
                        title: '{{ trans('cruds.user.fields.phone') }}',
                        render: function(data, type, full, meta) {
                            return full.phone;
                        },
                    },
                    {
                        targets: 5,
                        title: '{{ trans('frontend.register.occupational_classification_number') }}',
                        render: function(data, type, full, meta) {
                            return full.occupational_classification_number;
                        },
                    },
                    {
                        targets: 6,
                        title: '{{ trans('frontend.register.occupational_classification_number') }}',
                        render: function(data, type, full, meta) {
                            return full.specialty ? (locale == 'en' ? full.specialty.name_en : full
                                .specialty.name_ar) : '';
                        },
                    },
                    {
                        targets: 7,
                        title: '{{ trans('frontend.register.occupational_classification_number') }}',
                        render: function(data, type, full, meta) {
                            return full.sub_specialty ? (locale == 'en' ? full.sub_specialty
                                .name_en : full.sub_specialty
                                .name_ar) : '';
                        },
                    },
                    {
                        targets: 8,
                        title: '{{ trans('frontend.register.nationality') }}',
                        render: function(data, type, full, meta) {
                            console.log(full);
                            return full.country_and_nationality ? full.country_and_nationality
                                .country_enNationality : '';
                        },
                    },
                    {
                        targets: 9,
                        title: '{{ trans('cruds.user.fields.country') }}',
                        render: function(data, type, full, meta) {
                            console.log(full);
                            return full.city ?? '';
                        },
                    },
                    {
                        targets: 10,
                        title: '{{ trans('cruds.user.fields.created_at') }}',
                        render: function(data, type, full, meta) {
                            return full.created_at;
                        },
                    },

                    {
                        targets: 11,
                        title: '{{ trans('global.actions') }}',
                        orderable: false,
                        render: function(data, type, full, meta) {
                            var show_url =
                                "{{ route('admin.user-courses.show', ['id:id']) }}";

                            show_url = show_url.replace('id:id', full.id);

                            var value = '';
                            @can('user_show')
                                value += ` <a href="${show_url}" type="button" class="btn btn-icon btn-icon rounded-circle btn-primary waves-effect waves-float waves-light">
                                {{ trans('cruds.courseInvoice.fields.courses') }}
                            </a>`;
                            @endcan

                            return value;
                        },
                    }
                ],
            });

        });
    </script>
    <script>
           function get_sub_specialists() {
            var id = $('#specialty_id').val();
            if (id) {
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/{{app()->getLocale()}}/get_specialty/' + id,
                    success: function(data) {
                        var subuser = `
                <select class="form-control {{ $errors->has('specialty_id') ? 'is-invalid' : '' }}" name="sub_specialty_id[]" id="sub_specialty_id" required>
                `;
                    subuser += `<option value=""> All </option>`

                        for (let index = 0; index < data.length; index++) {
                            const element = data[index];
                            subuser += `<option value="` + element.id + `">` + element.name + `</option>`
                        }

                        subuser += `</select>`;

                        $('#subs').html(subuser);

                    }
                });
            }

        }
    </script>
@endsection
