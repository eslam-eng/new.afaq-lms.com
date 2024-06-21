@extends('layouts.admin')
@section('content')
    <style>
        .card-body nav {
            margin-top: 3rem;
            margin-bottom: 1rem;
            display: flex;
            width: 100%;
            justify-content: end;
        }

        .card-body nav div a {
            border: none !important;
            font-weight: 900;
            padding: 5px !important;
        }
    </style>
    @can('user_create')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
            integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.users.create', ['type' => request()->segment(2)]) }}">
                    {{ trans('global.add') }} {{ trans('cruds.user.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('global.list') }} {{ trans('cruds.user.title_singular') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable-User">
                    <thead>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.date') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.email') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.verified') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.roles') }}
                            </th>

                            <th>
                                {{ trans('cruds.user.fields.personal_photo') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.phone') }}
                            </th>
                            <th>
                                {{ trans('frontend.register.nationality') }}
                            </th>
                            <th>
                                Action
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

        var table = $('.datatable-User').DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
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
                        targets: 1,
                        title: '{{ trans('cruds.user.fields.date') }}',
                        render: function(data, type, full, meta) {
                            return full.created_at;
                        },
                    },
                    {
                        targets: 2,
                        title: '{{ trans('cruds.user.fields.name') }}',
                        render: function(data, type, full, meta) {
                            return full.full_name_en;
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
                        title: '{{ trans('cruds.user.fields.verified') }}',
                        render: function(data, type, full, meta) {
                            return full.verified;
                        },
                    },
                    {
                        targets: 5,
                        title: '{{ trans('cruds.user.fields.roles') }}',
                        render: function(data, type, full, meta) {
                                return '';
                        },
                    },
                    {
                        targets: 6,
                        title: '{{ trans('cruds.user.fields.personal_photo') }}',
                        render: function(data, type, full, meta) {
                            return full.personal_photo;
                        },
                    },
                    {
                        targets: 7,
                        title: '{{ trans('cruds.user.fields.phone') }}',
                        render: function(data, type, full, meta) {
                            return full.phone;
                        },
                    },
                    {
                        targets: 8,
                        title: '{{ trans('frontend.register.nationality') }}',
                        render: function(data, type, full, meta) {
                                console.log(full);
                                return full.country_and_nationality ?full.country_and_nationality.country_enNationality : '';
                        },
                    },
                 {
                    targets: 9,
                    title: '{{ trans('global.actions') }}',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        var show_url =
                            "{{ route('admin.users.show', ['id:id', 'type' => request()->segment(2)]) }}";

                            show_url = show_url.replace('id:id', full.id);

                        var update_url =
                            "{{ route('admin.users.edit', ['id:id', 'type' => request()->segment(2)]) }}";
                        update_url = update_url.replace('id:id', full.id);
                        var delete_url =
                            "{{ route('admin.users.destroy', ['id:id', 'type' => request()->segment(2)]) }}";
                        delete_url = delete_url.replace('id:id', full.id);

                        var value = '';
                        @can('user_show')
                            value += ` <a href="${show_url}"
                                            type="button"
                                            class="btn btn-icon btn-icon rounded-circle btn-primary waves-effect waves-float waves-light">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 14 11">
                                                <path id="eye-light"
                                                    d="M10.111,37.5A3.111,3.111,0,1,1,7,34.357,3.127,3.127,0,0,1,10.111,37.5ZM7,35.143a2.357,2.357,0,0,0,0,4.714,2.357,2.357,0,0,0,0-4.714Zm4.681-1.164A9.514,9.514,0,0,1,13.94,37.2a.788.788,0,0,1,0,.6,9.957,9.957,0,0,1-2.258,3.219A6.806,6.806,0,0,1,7,43a6.8,6.8,0,0,1-4.681-1.979A10,10,0,0,1,.06,37.8a.792.792,0,0,1,0-.6,9.549,9.549,0,0,1,2.26-3.219A6.808,6.808,0,0,1,7,32a6.81,6.81,0,0,1,4.681,1.979ZM.778,37.5a9,9,0,0,0,2.071,2.946A6.043,6.043,0,0,0,7,42.214a6.043,6.043,0,0,0,4.152-1.768A8.976,8.976,0,0,0,13.223,37.5a8.548,8.548,0,0,0-2.071-2.946A6.042,6.042,0,0,0,7,32.786a6.042,6.042,0,0,0-4.152,1.768A8.569,8.569,0,0,0,.778,37.5Z"
                                                    transform="translate(0 -32)" fill="#fff" />
                                            </svg>
                                        </a>`;
                        @endcan

                        @can('user_edit')
                            value += `<a href="${update_url}"
                                            type="button"
                                            class="btn btn-icon btn-icon rounded-circle btn-warning waves-effect waves-float waves-light">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-eye-2 me-50">
                                                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                            </svg>
                                        </a>`;
                        @endcan
                        @can('user_delete')
                            value += `<form
                                        action="${delete_url}"
                                        method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                        style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit"
                                            class="btn btn-icon btn-icon rounded-circle btn-danger waves-effect waves-float waves-light">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-trash me-50">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path
                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                </path>
                                            </svg>
                                        </button>
                                    </form>`;
                        @endcan

                        @can('user_verify')
                            if (full.verified == 0 || full.email_verified_at == null){
                                value += ` <form  action="{{ route('admin.users.verify') }}" method="POST"
                                            onclick="return confirm('{{ trans('global.areYouSure') }}');"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="id" value="${ full.id }">
                                            <input type="submit" class="btn btn-xs btn-info verify_1" value="verify">
                                        </form>`;
                                    }
                        @endcan
                        return value;
                    },
                }
            ],
        });

    });
</script>
@endsection
