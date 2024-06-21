@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.ticketCategory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ticket-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.ticketCategory.fields.id') }}
                        </th>
                        <td>
                            {{ $ticketCategory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticketCategory.fields.title') }}
                        </th>
                        <td>
                            {{app()->getLocale()=='en' ? $ticketCategory->title_en ?? '' : $ticketCategory->title_ar ?? ''}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticketCategory.fields.status') }}
                        </th>
{{--                        <td>--}}
{{--                            {{ App\Models\TicketCategory::STATUS_SELECT[$ticketCategory->status] ?? '' }}--}}
{{--                        </td>--}}
                        @if($ticketCategory->statues = 1)
                            <td>
                                {{ trans('cruds.ticket.fields.Show')  }}
                            </td>
                        @else
                            <td>
                                {{ trans('cruds.ticket.fields.Hide')  }}
                            </td>
                        @endif
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.blog.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\TicketCategory::TYPE_SELECT[$ticketCategory->type] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ticket-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
