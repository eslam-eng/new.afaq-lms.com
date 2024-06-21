@extends('layouts.admin')
@section('content')

    <div class="card">


        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover  datatable-Course">{{--datatable--}}
                    <thead>
                    <tr>
                        <th></th>
                        <th style="width: 10px;">
                            {{trans('cruds.instructor.fields.id') }}
                        </th>

                        <th>
                            {{ trans('cruds.course.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.slider.fields.order') }}
                        </th>


                    </tr>
                    </thead>
                    <tbody  id="tablecontents">
                    @foreach($courses as $key => $course)
                        <tr class="row1" data-entry-id="{{ $course->id }}">
                            <td></td>
                            <td>
                                {{ $course->id ?? '' }}
                            </td>

                            <td>

                                {{app()->getLocale()=='en' ? Str::limit($course->name_en, 50) : Str::limit($course->name_ar, 50)}}
                            </td>
                            <td>
                                {{ $course->order ?? '' }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



@endsection
@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $("#tablecontents").sortable({
                items: "tr",
                cursor: 'move',
                opacity: 0.6,
                update: function (e) {
                    updatePostOrder();
                }
            });

            function updatePostOrder() {
                var order = [];
                var token = $('meta[name="csrf-token"]').attr('content');
                $('tr.row1').each(function (index, element) {
                    order.push({
                        id: $(this).attr('data-entry-id'),
                        order: index + 1
                    });
                });

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ url('/admin/sorting/courses') }}",
                    data: {
                        order: order,
                        _token: token
                    },
                    success: function (response) {
                        if (response.status == "success") {
                            console.log(response);
                        } else {
                            console.log(response);
                        }
                    }
                });
            }
        });
    </script>

@endsection
