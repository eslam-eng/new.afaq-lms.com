@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.certificat.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.certificats.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                        {{trans('cruds.instructor.fields.id') }}
                        </th>
                        <td>
                            {{ $certificat->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.certificat.fields.name_en') }}
                        </th>
                        <td>
                            {{ $certificat->name_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.certificat.fields.name_ar') }}
                        </th>
                        <td>
                            {{ $certificat->name_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.certificat.fields.image') }}
                        </th>
                        <td>
                            @if($certificat->image)
                                <a href="{{ $certificat->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $certificat->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.certificat.fields.templete') }}
                        </th>
                        <td>
                            {!! $certificat->templete !!}
                        </td>
                    </tr>
                    {{-- <tr>
                        <th>
                            {{ trans('cruds.certificat.fields.content') }}
                        </th>
                        <td>
                            {!! $certificat->content !!}
                        </td>
                    </tr> --}}
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.certificats.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection
