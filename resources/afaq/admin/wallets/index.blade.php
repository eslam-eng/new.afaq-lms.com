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
    @can('wallet_create')
        <div style="margin-bottom: 10px;" class="row">
            {{--            <div class="col-lg-12"> --}}
            {{--                <a class="btn btn-success" href="{{ route('admin.wallets.create') }}"> --}}
            {{--                    {{ trans('global.add') }} {{ trans('cruds.wallet.title_singular') }} --}}
            {{--                </a> --}}
            {{--            </div> --}}
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.wallet.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Wallet">
                    <thead>
                        <tr>
                            <th width="10">n

                            </th>
                            <th>
                                {{ trans('cruds.wallet.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.wallet.fields.user') }}
                            </th>
                            <th>
                                {{ trans('cruds.wallet.fields.email') }}
                            </th>
                            <th>
                                {{ trans('cruds.wallet.fields.currency') }}
                            </th>
                            <th>
                                {{ trans('cruds.wallet.fields.balance') }}
                            </th>
                            <th>
                                {{ trans('cruds.wallet.fields.phone') }}
                            </th>
                            <th>
                                {{ trans('cruds.wallet.fields.status') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($wallets as $key => $wallet)
                            @if ($wallet->user)
                                <tr data-entry-id="{{ $wallet->id }}">
                                    <td>

                                    </td>
                                    <td>
                                        {{ $wallet->id ?? '' }}
                                    </td>
                                    <td>
                                        {{ $wallet->user->name ?? '' }}
                                    </td>
                                    <td>
                                        {{ $wallet->user->email ?? '' }}
                                    </td>
                                    <td>
                                        {{ app()->getLocale() == 'en' ? ($wallet->currency = 'SAR') : ($wallet->currency = 'ر س') }}
                                    </td>
                                    <td>
                                        {{ $wallet->balance ?? '' }}
                                    </td>
                                    <td>
                                        {{ $wallet->user->phone ?? '' }}
                                    </td>
                                    <td>
                                        {{ App\Models\Wallet::STATUS_SELECT[$wallet->status] ?? '' }}
                                    </td>
                                    <td>

                                        <a class="btn btn-add-remove jus-add"
                                            title="{{ trans('cruds.wallet.fields.plus') }}"
                                            onclick='data_balance_wallet("{{ $wallet->id }}","{{ $wallet->user->name }}")'>

                                            <i class="plus">+</i>
                                        </a>

                                        <a class="btn btn-add-remove jus-remov"
                                            title="{{ trans('cruds.wallet.fields.minus') }}"
                                            onclick='sub_data_balance_wallet("{{ $wallet->id }}","{{ $wallet->user->name }}" , "{{ $wallet->balance }}")'>
                                            <i class="mins">-</i>
                                        </a>

                                    </td>

                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="add-section-fixed">
        <div class="card-page">
            <input type="hidden" name="wallet_id" id="wallet_id">
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
                    <label for="">{{ trans('cruds.wallet.fields.balance_sar') }}</label>
                    <input type="number" name="extra_balance" id="extra_balance" min="0"
                        oninput="validity.valid||(value='');">
                </div>
            </div>
            <div class="last-content ">
                <button class="add-mony"
                    type="submit"onclick="extra_balance_wallet()">{{ trans('cruds.wallet.fields.plus') }}</button>
                <button class="canecl-payemt" type="reset">{{ trans('cruds.wallet.fields.reset') }}</button>
            </div>
        </div>
    </div>
    <div class="mins-section-fixed">
        <div class="card-page">
            <input type="hidden" name="balance" id="balance">
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
                    <label for="">{{ trans('cruds.wallet.fields.balance_sar') }}</label>
                    <input type="number" name="sub_balance" id="sub_balance" min="0"
                        oninput="validity.valid||(value='');">
                </div>
            </div>
            <div class="last-content ">

                <button class="add-mony" type="submit"onclick="sub_balance_wallet()">
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
                @can('wallet_delete')
                    let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                    let deleteButton = {
                        text: deleteButtonTrans,
                        url: "{{ route('admin.wallets.massDestroy') }}",
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

                // $.extend(true, $.fn.dataTable.defaults, {
                //   orderCellsTop: true,
                //   order: [[ 1, 'desc' ]],
                //   pageLength: 100,
                // });
                // let table = $('.datatable-Wallet:not(.ajaxTable)').DataTable({ buttons: dtButtons })
                // $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                //     $($.fn.dataTable.tables(true)).DataTable()
                //         .columns.adjust();
                // });
                $(document).on('click', ".btn-add-remove.jus-add", function() {
                    $(".add-section-fixed").addClass("active")
                })
                $(document).on('click', ".btn-add-remove.jus-remov", function() {
                    $(".mins-section-fixed").addClass("active")
                })
                $(document).on('click', ".close-icon", function() {
                    $(".mins-section-fixed").removeClass("active")
                    $(".add-section-fixed").removeClass("active")
                })
                $(document).on('click', ".canecl-payemt", function() {
                    $(".mins-section-fixed").removeClass("active")
                    $(".add-section-fixed").removeClass("active")
                })


            })
        </script>
        <script>
            function data_balance_wallet(id, user_name) {
                $("#user_name").html(user_name);
                $("#wallet_id").val(id);

            }

            function extra_balance_wallet() {


                var extra_balance = $("#extra_balance").val();
                var wallet_id = $("#wallet_id").val();
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/admin/AddWalletBalance',
                    data: {
                        'extra_balance': extra_balance,
                        'wallet_id': wallet_id

                    },

                    success: function(data) {

                        location.reload()
                    }
                });
            }

            function sub_data_balance_wallet(id, user_name, balance) {
                $("#user_data").html(user_name);
                $("#wallet_id").val(id);
                $("#balance").val(balance);
            }

            function sub_balance_wallet() {
                var sub_balance = parseFloat($("#sub_balance").val());
                var balance = parseFloat($("#balance").val());
                var wallet_id = $("#wallet_id").val();


                if (sub_balance > 0 && sub_balance <= balance) {
                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: '/admin/SubWalletBalance',
                        data: {
                            'sub_balance': sub_balance,
                            'wallet_id': wallet_id,
                            'balance': balance
                        },

                        success: function(data) {
                            location.reload()
                        }
                    });

                } else {
                    alert('You Must Enter valid value ')
                }


            }
        </script>
    @endsection
