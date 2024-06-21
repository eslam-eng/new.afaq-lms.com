@can('job_application_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.job-applications.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.jobApplication.title_singular') }}
        </a>
    </div>
</div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('global.list') }} {{ trans('cruds.jobApplication.title_singular') }} 
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-jobJobApplications">
                <thead>
                    <tr>
                        <th></th>
                        <th>
                            {{trans('cruds.instructor.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.jobApplication.fields.job') }}
                        </th>
                        <th>
                            {{ trans('cruds.jobApplication.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.jobApplication.fields.first_name') }}
                        </th>

                        <th>
                            {{ trans('cruds.jobApplication.fields.highest_degree') }}
                        </th>
                        <th>
                            {{ trans('cruds.jobApplication.fields.gender') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobApplications as $key => $jobApplication)
                    <tr data-entry-id="{{ $jobApplication->id }}">
                        <td></td>
                        <td>
                            {{ $jobApplication->id ?? '' }}
                        </td>
                        <td>
                            {{ $jobApplication->job->title ?? '' }}
                        </td>
                        <td>
                            {{ App\Models\JobApplication::TITLE_SELECT[$jobApplication->title] ?? '' }}
                        </td>
                        <td>
                            {{ $jobApplication->first_name ?? '' }}
                        </td>

                        <td>
                            {{ App\Models\JobApplication::HIGHEST_DEGREE_RADIO[$jobApplication->highest_degree] ?? '' }}
                        </td>
                        <td>
                            {{ App\Models\JobApplication::GENDER_RADIO[$jobApplication->gender] ?? '' }}
                        </td>
                        <td>
                            @can('job_application_show')
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.job-applications.show', $jobApplication->id) }}">
                                {{ trans('global.view') }}
                            </a>
                            @endcan

                            @can('job_application_edit')
                            <a class="btn btn-xs btn-info" href="{{ route('admin.job-applications.edit', $jobApplication->id) }}">
                                {{ trans('global.edit') }}
                            </a>
                            @endcan

                            @can('job_application_delete')
                            <form action="{{ route('admin.job-applications.destroy', $jobApplication->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
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