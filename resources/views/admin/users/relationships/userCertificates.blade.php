<div class="card">
    <div class="card-header">
        {{ trans('global.list') }} {{ trans('cruds.certificat.title_singular') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Certificat">
                <thead>
                    <tr>
                        <th></th>
                        <th>
                            {{ trans('cruds.certificat.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.certificat.fields.name_en') }}
                        </th>
                        <th>
                            {{ trans('cruds.certificat.fields.name_ar') }}
                        </th>

                        <th>
                            {{ trans('cruds.certificat.fields.image') }}
                        </th>
                        <th>
                            اسم الكورس
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($certificates as $key => $certificat)
                        <tr data-entry-id="{{ $certificat->id }}">
                            <td></td>
                            <td>
                                {{ $certificat->id ?? '' }}
                            </td>
                            <td>
                                {{ $certificat->certificate->name_en ?? '' }}
                            </td>
                            <td>
                                {{ $certificat->certificate->name_ar ?? '' }}
                            </td>
                            <td>
                                @if ($certificat->certificate->image)
                                    <a href="{{ $certificat->certificate->image->getUrl() }}" target="_blank"
                                        style="display: inline-block">
                                        <img src="{{ $certificat->certificate->image->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ app()->getLocale() == 'en' ? $certificat->course->name_en : $certificat->course->name_ar }}
                            </td>
                            <td>
                                @can('certificat_show')
                                    <a href="{{ route('admin.certificats.show', $certificat->id) }}" type="button"
                                        class="btn btn-icon btn-icon rounded-circle btn-primary waves-effect waves-float waves-light">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 14 11">
                                            <path id="eye-light"
                                                d="M10.111,37.5A3.111,3.111,0,1,1,7,34.357,3.127,3.127,0,0,1,10.111,37.5ZM7,35.143a2.357,2.357,0,0,0,0,4.714,2.357,2.357,0,0,0,0-4.714Zm4.681-1.164A9.514,9.514,0,0,1,13.94,37.2a.788.788,0,0,1,0,.6,9.957,9.957,0,0,1-2.258,3.219A6.806,6.806,0,0,1,7,43a6.8,6.8,0,0,1-4.681-1.979A10,10,0,0,1,.06,37.8a.792.792,0,0,1,0-.6,9.549,9.549,0,0,1,2.26-3.219A6.808,6.808,0,0,1,7,32a6.81,6.81,0,0,1,4.681,1.979ZM.778,37.5a9,9,0,0,0,2.071,2.946A6.043,6.043,0,0,0,7,42.214a6.043,6.043,0,0,0,4.152-1.768A8.976,8.976,0,0,0,13.223,37.5a8.548,8.548,0,0,0-2.071-2.946A6.042,6.042,0,0,0,7,32.786a6.042,6.042,0,0,0-4.152,1.768A8.569,8.569,0,0,0,.778,37.5Z"
                                                transform="translate(0 -32)" fill="#fff" />
                                        </svg>
                                    </a>
                                @endcan

                                <a target="_blank" class="btn btn-icon btn-icon btn-primary waves-effect waves-float waves-light"
                                    href="{{ route('view.certificate', [
                                        'exam_id' => $certificat->exam_id,
                                        'course_id' => $certificat->course_id,
                                        'certificate_id' => $certificat->certificate_id,
                                        'user_id' => $certificat->user_id,
                                    ]) }}">
                                    View Certificate</a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
