@extends('layouts.admin')
@section('content')
@can('accreditation_sponsor_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.accreditation-sponsors.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.accreditationSponsor.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.list') }} {{ trans('cruds.accreditationSponsor.title_singular') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-AccreditationSponsor">
                <thead>
                    <tr>
<th></th>
                        <th>
                            {{trans('cruds.instructor.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.accreditationSponsor.fields.name_en') }}
                        </th>
                        <th>
                            {{ trans('cruds.accreditationSponsor.fields.name_ar') }}
                        </th>
                        <th>
                            {{ trans('cruds.accreditationSponsor.fields.logo') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accreditationSponsors as $key => $accreditationSponsor)
                    <tr data-entry-id="{{ $accreditationSponsor->id }}">
<td></td>
                        <td>
                            {{ $accreditationSponsor->id ?? '' }}
                        </td>
                        <td>
                            {{ $accreditationSponsor->name_en ?? '' }}
                        </td>
                        <td>
                            {{ $accreditationSponsor->name_ar ?? '' }}
                        </td>
                        <td>
                            @if($accreditationSponsor->logo)
                            <a href="{{ $accreditationSponsor->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                <img src="{{ $accreditationSponsor->logo->getUrl('thumb') }}">
                            </a>
                            @endif
                        </td>
                        <td>
                            @can('accreditation_sponsor_show')
                            {{-- <a class="btn btn-xs btn-primary" href="{{ route('admin.accreditation-sponsors.show', $accreditationSponsor->id) }}">--}}
                            {{-- {{ trans('global.view') }}--}}
                            {{-- </a>--}}
                            <a href="{{ route('admin.accreditation-sponsors.show', $accreditationSponsor->id) }}" type="button" class="btn btn-icon btn-icon rounded-circle btn-primary waves-effect waves-float waves-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 11">
                                    <path id="eye-light" d="M10.111,37.5A3.111,3.111,0,1,1,7,34.357,3.127,3.127,0,0,1,10.111,37.5ZM7,35.143a2.357,2.357,0,0,0,0,4.714,2.357,2.357,0,0,0,0-4.714Zm4.681-1.164A9.514,9.514,0,0,1,13.94,37.2a.788.788,0,0,1,0,.6,9.957,9.957,0,0,1-2.258,3.219A6.806,6.806,0,0,1,7,43a6.8,6.8,0,0,1-4.681-1.979A10,10,0,0,1,.06,37.8a.792.792,0,0,1,0-.6,9.549,9.549,0,0,1,2.26-3.219A6.808,6.808,0,0,1,7,32a6.81,6.81,0,0,1,4.681,1.979ZM.778,37.5a9,9,0,0,0,2.071,2.946A6.043,6.043,0,0,0,7,42.214a6.043,6.043,0,0,0,4.152-1.768A8.976,8.976,0,0,0,13.223,37.5a8.548,8.548,0,0,0-2.071-2.946A6.042,6.042,0,0,0,7,32.786a6.042,6.042,0,0,0-4.152,1.768A8.569,8.569,0,0,0,.778,37.5Z" transform="translate(0 -32)" fill="#fff" />
                                </svg>
                            </a>
                            @endcan

                            @can('accreditation_sponsor_edit')
                            {{-- <a class="btn btn-xs btn-info" href="{{ route('admin.accreditation-sponsors.edit', $accreditationSponsor->id) }}">--}}
                            {{-- {{ trans('global.edit') }}--}}
                            {{-- </a>--}}
                            <a href="{{ route('admin.accreditation-sponsors.edit', $accreditationSponsor->id) }}" type="button" class="btn btn-icon btn-icon rounded-circle btn-warning waves-effect waves-float waves-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye-2 me-50">
                                    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                </svg>
                            </a>
                            @endcan

                            @can('accreditation_sponsor_delete')
                            {{-- <form action="{{ route('admin.accreditation-sponsors.destroy', $accreditationSponsor->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">--}}
                            {{-- <input type="hidden" name="_method" value="DELETE">--}}
                            {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                            {{-- <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">--}}
                            {{-- <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash me-50">--}}
                            {{-- <polyline points="3 6 5 6 21 6"></polyline>--}}
                            {{-- <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>--}}
                            {{-- </svg>--}}
                            {{-- </form>--}}

                            <form action="{{ route('admin.accreditation-sponsors.destroy', $accreditationSponsor->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-icon btn-icon rounded-circle btn-danger waves-effect waves-float waves-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash me-50">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    </svg>
                                </button>
                            </form>

                            @endcan

                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection