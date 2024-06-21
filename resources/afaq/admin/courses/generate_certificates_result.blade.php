@extends('layouts.admin')

@section('styles')
    <style>
        /*#DataTables_Table_0_paginate{
            display: none;
        }*/

        /*.pagination-wrapper {
            display: flex;
            @if (App::getLocale() == 'ar')
            justify-content: flex-end;
            @else
            justify-content: flex-start;
            @endif
        }*/
    </style>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable-Course">
                    <thead>
                        <tr>
                            <th></th>
                            <th>{{ trans('cruds.user.fields.id') }}</th>
                            <th>{{ trans('cruds.user.fields.date') }}</th>
                            <th>{{ trans('cruds.user.fields.name') }}</th>
                            <th>{{ trans('cruds.user.fields.email') }}</th>
                            <th>{{ trans('cruds.user.fields.completion_percentage') }}</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>

                {{--
                <table class=" table table-bordered table-striped table-hover datatable-Course">
                    <thead>
                        <tr>
                            <th></th>
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
                                {{ trans('cruds.user.fields.completion_percentage') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all as $key => $user_course)
                            @php $user = $user_course->user; @endphp
                            @if ($user)
                                <tr data-entry-id="{{ $user->id }}">
                                    <td></td>
                                    <td>
                                        {{ $user->id ?? '' }}
                                    </td>
                                    <td>
                                        {{ $user->created_at ?? '' }}
                                    </td>
                                    <td>
                                        {{ $user->name ?? '' }}
                                    </td>
                                    <td>
                                        {{ $user->email ?? '' }}
                                    </td>
                                    <td>
                                        {{ $user_course->completion_percentage ?? 0 }}
                                    </td>
                                    <td>
                                        @php $item = \App\Models\UserCertificate::where(['user_id' => $user->id , 'course_id' => $user_course->course_id])->first(); @endphp
                                        @if (!$item)
                                            <a class="btn btn-xs btn-primary p-1 m-1"
                                                href='/admin/generate_certificates/{{ $user_course->course_id }}/index?user_id={{ $user->id }}&recipient_email={{$recipientEmail}}'>
                                                اصدار الشهادات
                                            </a>
                                        @else
                                            @if ($item && !$item->has_img)
                                                <img src="{{ $item->certificate_img }}" style='width:100px'>
                                            @else
                                                تم اصدار الشهاده
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>

                <div class="pagination-wrapper">
                    {{ $all->links('pagination::bootstrap-4') }}
                </div>
                --}}
            </div>
        </div>
    </div>


@section('scripts')
<script>
    $(document).ready(function() {
        var copyButtonTrans = "{{ trans('global.datatables.copy') }}"
        var csvButtonTrans = "{{ trans('global.datatables.csv') }}"
        var pdfButtonTrans = "{{ trans('global.datatables.pdf') }}"
        var printButtonTrans = "{{ trans('global.datatables.print') }}"
        var colvisButtonTrans = "{{ trans('global.datatables.colvis') }}"
        var selectAllButtonTrans = "{{ trans('global.datatables.select_all') }}"
        var selectNoneButtonTrans = "{{ trans('global.datatables.deselect_all') }}"
        var lang = $('meta[name="_lang"]').attr('content');
        var arabic = {
            "sProcessing": "جارٍ التحميل...",
            "sLengthMenu": "أظهر _MENU_ مدخلات",
            "sZeroRecords": "لم يعثر على أية سجلات",
            "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
            "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
            "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
            "sInfoPostFix": "",
            "sSearch": "بحث:",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "الأول",
                "sPrevious": "السابق",
                "sNext": "التالي",
                "sLast": "الأخير"
            },
            "buttons": {
                "selectAll": 'تحديد الكل',
                "selectNone": 'الغاء الكل',
                "copy": 'نسخ',
                "pdfHtml5": 'PDF',
                "print" : 'طباعة',
                "csv":'CSV',
                "colvis": 'تغيير الاعمدة',
            }
        }
        var english = {}

        $('.datatable-Course').DataTable({
            lengthMenu: [10, 25, 50, 100],
            pageLength: "{{request('records_count') ?? 10}}",
            language: lang == 'ar' ? arabic : english,
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
            dom: 'Blfrtip',
            serverSide: true,
            ajax: {
                url: '/admin/generate_certificates/{{ $course_id }}/index',
                data: function (d) {
                    d.recipient_email = "{{request()->recipient_email}}"
                }
            },
            columns: [
                { data: 'id', orderable: false, className: 'select-checkbox', targets: 0 },
                { data: 'user_id', name: 'user_id' },
                { data: 'user_created_at', name: 'user_created_at' },
                { data: 'user_name', name: 'user_name' },
                { data: 'user_email', name: 'user_email' },
                { data: 'completion_percentage', name: 'completion_percentage' },
                { 
                    data: 'action',
                    name: 'action',
                    render: function (data, type, row) {
                        return data;
                    }
                }
            ],
            rowCallback: function (row, data) {
                $(row).attr('data-entry-id', data.user_id);
            },
            buttons: [
                {
                    extend: 'selectAll',
                    exportOptions: {
                        columns: ':visible'
                    },
                    action: function (e, dt) {
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
                        columns: ':visible'
                    }
                },
                {
                    extend: 'colvis',
                    exportOptions: {
                        columns: ':visible'
                    }
                }
            ]
        });
    });
</script>
@endsection

@endsection
