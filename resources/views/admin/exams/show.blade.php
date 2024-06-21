@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.exam.title_singular') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.exams.index') }}">
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
                            {{ $exam->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.exam.fields.exam_title') }}
                        </th>
                        <td>
                            @foreach($exam->create_exam_exam_title as $setup)
                                {{app()->getLocale()=='en' ?  $setup->name_en ?? '' :  $setup->name_ar ?? ''}} //

                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.exam.fields.title_en') }}
                        </th>
                        <td>
                            {{ $exam->title_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.exam.fields.title_ar') }}
                        </th>
                        <td>
                            {{ $exam->title_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.exam.fields.description_en') }}
                        </th>
                        <td>
                            {{ $exam->description_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.exam.fields.description_ar') }}
                        </th>
                        <td>
                            {{ $exam->description_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.exam.fields.tips_guidelines') }}
                        </th>
                        <td>
                            {!! $exam->tips_guidelines !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.exam.fields.number_question') }}
                        </th>
                        <td>
                            {{$exam->number_question}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.exam.fields.success_percentage') }}
                        </th>
                        <td>
                            {{ $exam->success_percentage }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.exam.fields.certificate') }}
                        </th>
                        <td>
                            {{app()->getLocale()=='en' ?  $exam->certificate->name_en ?? '' :  $exam->certificate->name_ar ?? ''}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.exam.fields.price') }}
                        </th>
                        <td>
                            {{ $exam->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.exam.fields.start_at') }}
                        </th>
                        <td>
                            {{ $exam->start_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.exam.fields.end_at') }}
                        </th>
                        <td>
                            {{ $exam->end_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.exam.fields.image') }}
                        </th>
                        <td>
                            @if($exam->image)
                                <a href="{{ $exam->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $exam->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.exam.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Exam::STATUS_RADIO[$exam->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.exams.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
