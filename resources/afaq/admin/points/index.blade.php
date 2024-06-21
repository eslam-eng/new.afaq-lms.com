@extends('layouts.admin')
@section('content')
    <style>
        a.btn.btn-add-remove {
            padding: 0;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            margin: 0 5px;
        }

        a.btn.btn-add-remove i {
            font-style: normal;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 25px;
            position: relative;
            top: 5px;
        }

        a.btn.btn-add-remove.jus-add {
            background-color: #22AB78 !important;
            color: #fff !important;
        }

        a.btn.btn-add-remove.jus-remov {
            background-color: #EE453E !important;
            color: #fff !important;
        }

        .add-section-fixed,
        .mins-section-fixed {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: #bdbcbc45;
            z-index: 9999;
            display: none;
        }

        .add-section-fixed.active,
        .mins-section-fixed.active {
            display: block;
        }

        .card-page {
            margin: 7rem auto;
            background: #fff;
            max-width: 800px;
            pointer-events: auto;
            background-clip: padding-box;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0px 8px 16px #939393;
        }

        .top-content {
            padding: 1rem 1rem;
            background: #87BD31;
        }

        .close-icon {
            font-size: 20px;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
        }

        .top-content span {
            color: #fff;
            font-size: 18px;
        }

        .full-input {
            width: 46%;
            margin: 0 5px;
        }

        .next-content {
            padding: 1rem;
        }

        .full-input label {
            display: block;
            padding: 10px 0;
            font-size: 16px;
            color: #8B8B8B;
        }

        .full-input span,
        .full-input input {
            width: 100%;
            background-color: #F2F5F9;
            border: 0;
            border-radius: 20px;
            font-size: 1em;
            padding: 0.375rem 1rem;
            display: block;
        }

        .last-content {
            padding: 1rem;
        }

        button.add-mony {
            background-color: #87BD31;
            border-color: #87BD31;
            border-radius: 100px;
            color: #fff !important;
            border: unset;
            padding: 5px 20px;
        }

        button.canecl-payemt {
            background-color: #F2F5F9 !important;
            border-color: #F2F5F9 !important;
            color: #6c757d !important;
            margin: 0 5px !important;
            border: unset;
            padding: 5px 20px;
            border-radius: 100px;
        }
    </style>
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.pointData.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-PointData">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.pointData.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.pointData.fields.user') }}
                            </th>
                            <th>
                                {{ trans('cruds.pointData.fields.points') }}
                            </th>
                            <th>
                                {{ trans('cruds.pointData.fields.invite_code') }}
                            </th>
                            <th>
                                {{ trans('cruds.pointData.fields.use_code') }}
                            </th>
                            <th>
                                {{ trans('cruds.pointData.fields.used_code') }}
                            </th>
                            <th>
                                {{ trans('cruds.pointData.fields.currency') }}
                            </th>
                            <th>
                                {{ trans('cruds.pointData.fields.status') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pointDatas as $key => $pointData)
                            <tr data-entry-id="{{ $pointData->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $pointData->id ?? '' }}
                                </td>
                                <td>
                                    {{ $pointData->user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $pointData->points ?? '' }}
                                </td>
                                <td>
                                    {{ $pointData->invite_code ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Point::USE_CODE_SELECT[$pointData->use_code] ?? '' }}
                                </td>
                                <td>
                                    {{ $pointData->used_code ?? '' }}
                                </td>
                                <td>
                                    {{ $pointData->currency ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Point::STATUS_SELECT[$pointData->status] ?? '' }}
                                </td>
                                <td>
                                    <a class="btn btn-add-remove jus-add" title="{{ trans('cruds.wallet.fields.plus') }}"
                                        onclick='data_balance_point("{{ $pointData->id }}","{{ $pointData->user->name }}")'>

                                        <i class="plus">+</i>
                                    </a>

                                    <a class="btn btn-add-remove jus-remov"
                                        title="{{ trans('cruds.wallet.fields.minus') }}"
                                        onclick='sub_data_balance_point("{{ $pointData->id }}","{{ $pointData->user->name }}","{{ $pointData->points }}")'>
                                        <i class="mins">-</i>
                                    </a>

                                    {{--                                @can('point_data_delete') --}}
                                    {{--                                    <form action="{{ route('admin.points.destroy', $pointData->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;"> --}}
                                    {{--                                        <input type="hidden" name="_method" value="DELETE"> --}}
                                    {{--                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
                                    {{--                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}"> --}}
                                    {{--                                    </form> --}}
                                    {{--                                @endcan --}}

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="add-section-fixed">
        <div class="card-page">
            <input type="hidden" name="point_id" id="point_id">
            <div class="d-flex justify-content-between top-content">
                <span>{{ trans('cruds.wallet.fields.plus') }}</span>
                <div class="close-icon">x</div>
            </div>
            <div class="next-content d-flex  ">
                <div class="full-name full-input">
                    <label for="">{{ trans('cruds.wallet.fields.user_name') }} </label>
                    <span id="user_name"> </span>
                </div>
                <div class="full-mony full-input">
                    <label for="">{{ trans('cruds.pointData.fields.points') }}</label>
                    <input type="number" name="extra_balance" id="extra_balance">
                </div>
            </div>
            <div class="last-content ">
                <button class="add-mony"
                    type="submit"onclick="extra_balance_point()">{{ trans('cruds.wallet.fields.plus') }}</button>
                <button class="canecl-payemt" type="reset">{{ trans('cruds.wallet.fields.reset') }}</button>
            </div>
        </div>
    </div>
    <div class="mins-section-fixed">
        <div class="card-page">
            <input type="hidden" name="points" id="points">
            <div class="d-flex justify-content-between top-content">
                <span>{{ trans('cruds.wallet.fields.minus') }}</span>
                <div class="close-icon">x</div>
            </div>
            <div class="next-content d-flex  ">
                <div class="full-name full-input">
                    <label for="">{{ trans('cruds.wallet.fields.user_name') }}</label>
                    <span id="user_data"> </span>
                </div>
                <div class="full-mony full-input">
                    <label for="">{{ trans('cruds.pointData.fields.points') }}</label>
                    <input type="number" name="sub_balance" id="sub_balance" min="0">
                </div>
            </div>
            <div class="last-content ">
                {{--                <input type="hidden" name="points" id="points"> --}}
                <button class="add-mony" type="submit"onclick="sub_balance_point()">
                    {{ trans('cruds.wallet.fields.minus') }}</button>
                <button class="canecl-payemt" type="reset">{{ trans('cruds.wallet.fields.reset') }}</button>
            </div>


        </div>
    @endsection
    @section('scripts')
        @parent
        <script>
            $(function() {
                let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
                @can('point_data_delete')
                    let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                    let deleteButton = {
                        text: deleteButtonTrans,
                        url: "{{ route('admin.points.massDestroy') }}",
                        className: 'btn-danger',
                        action: function(e, dt, node, config) {
                            var ids = $.map(dt.rows({
                                selected: true
                            }).nodes(), function(entry) {
                                return $(entry).data('entry-id')
                            });

                            if (ids.length === 0) {
                                alert('{{ trans('global.datatables.zero_selected') }}')

                                return
                            }

                            if (confirm('{{ trans('global.areYouSure') }}')) {
                                $.ajax({
                                        headers: {
                                            'x-csrf-token': _token
                                        },
                                        method: 'POST',
                                        url: config.url,
                                        data: {
                                            ids: ids,
                                            _method: 'DELETE'
                                        }
                                    })
                                    .done(function() {
                                        location.reload()
                                    })
                            }
                        }
                    }
                    dtButtons.push(deleteButton)
                @endcan


                $(".btn-add-remove.jus-add").click(function() {
                    $(".add-section-fixed").addClass("active")
                })
                $(".btn-add-remove.jus-remov").click(function() {
                    $(".mins-section-fixed").addClass("active")
                })
                $(".close-icon").click(function() {
                    $(".mins-section-fixed").removeClass("active")
                    $(".add-section-fixed").removeClass("active")
                })
                $(".canecl-payemt").click(function() {
                    $(".mins-section-fixed").removeClass("active")
                    $(".add-section-fixed").removeClass("active")
                })
            })
        </script>
        <script>
            function data_balance_point(id, user_name) {
                $("#user_name").html(user_name);
                $("#point_id").val(id);

            }

            function extra_balance_point() {


                var extra_balance = $("#extra_balance").val();
                var point_id = $("#point_id").val();
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/admin/AddPointBalance',
                    data: {
                        'extra_balance': extra_balance,
                        'point_id': point_id

                    },

                    success: function(data) {

                        location.reload()
                    }
                });
            }

            function sub_data_balance_point(id, user_name, points) {
                $("#user_data").html(user_name);
                $("#point_id").val(id);
                $("#points").val(points);

            }

            function sub_balance_point() {

                var sub_balance = $("#sub_balance").val();
                var point_id = $("#point_id").val();
                var points = $("#points").val();

                // alert(points);
                if (sub_balance > 0 && sub_balance < points) {
                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: '/admin/SubPointBalance',
                        data: {
                            'point_id': point_id,
                            'points': points,
                            'sub_balance': sub_balance

                        },

                        success: function(data) {
                            location.reload()
                        }
                    });

                } else
                    alert('You Must Enter valid value ')
                location.reload()
            }
        </script>
    @endsection
