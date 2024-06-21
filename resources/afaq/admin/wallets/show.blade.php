@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.wallet.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.wallets.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.wallet.fields.id') }}
                        </th>
                        <td>
                            {{ $wallet->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wallet.fields.user') }}
                        </th>
                        <td>
                            {{ $wallet->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wallet.fields.email') }}
                        </th>
                        <td>
                            {{ $wallet->email->email ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wallet.fields.currency') }}
                        </th>
                        <td>
                            {{ $wallet->currency }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wallet.fields.balance') }}
                        </th>
                        <td>
                            {{ $wallet->balance }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wallet.fields.phone') }}
                        </th>
                        <td>
                            {{ $wallet->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wallet.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Wallet::STATUS_SELECT[$wallet->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.wallets.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection