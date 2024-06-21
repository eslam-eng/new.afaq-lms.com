@extends('layouts.admin')
@section('content')
    @can("{$type_slug}_create")
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.lookups.create',['type_slug' => $type_slug]) }}">
                    {{ trans('global.add') }} {{ $lookup_type->title }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('global.list') }} {{ $lookup_type->title }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-lookup">
                    <thead>
                        <tr>
                            <th></th>
                            <th>
                                {{ trans('cruds.lookup.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.lookup.fields.name_en') }}
                            </th>
                            <th>
                                {{ trans('cruds.lookup.fields.name_ar') }}
                            </th>
                            <th>
                                {{ trans('cruds.lookup.fields.image') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lookups as $key => $lookup)
                            <tr data-entry-id="{{ $lookup->id }}">
                                <td></td>
                                <td>
                                    {{ $lookup->id ?? '' }}
                                </td>
                                <td>
                                    {{ $lookup->title_en ?? '' }}
                                </td>
                                <td>
                                    {{ $lookup->title_ar ?? '' }}
                                </td>
                                <td>
                                    @if ($lookup->image_url)
                                        <a href="{{ $lookup->image_url }}" target="_blank"
                                            style="display: inline-block">
                                            <img src="{{ $lookup->image_url }}" width="50">
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    @can("{$type_slug}_edit")
                                        <a href="{{ route('admin.lookups.edit',['type_slug'=>$type_slug,'id'=>$lookup->id]) }}" type="button"
                                            class="btn btn-icon btn-icon rounded-circle btn-warning waves-effect waves-float waves-light">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-eye-2 me-50">
                                                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                            </svg>
                                        </a>
                                    @endcan

                                    {{-- @can("{$type_slug}_delete")
                                        <form action="{{ route('admin.lookups.delete',['type_slug'=>$type_slug]) }}" method="POST"
                                            onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="id" value="{{$lookup->id}}">
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
                                        </form>
                                    @endcan --}}

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
