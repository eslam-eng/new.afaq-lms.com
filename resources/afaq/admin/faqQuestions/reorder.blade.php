@extends('layouts.admin')
@section('content')
    <form method="get" id="filter" action="{{ url()->full() }}">
        <div class="row">
            <div class="col-12 col-sm-6 col-lg-2">
                <label for="users-list-role">{{ trans('cruds.faqQuestion.fields.category') }}</label>
                <fieldset class="form-group">
                    <select class="form-control" id="users-list-role" name="category_id">
                        <option value="">{{ trans('cruds.courseInvoice.fields.all') }}</option>
                        @foreach($faq_cats as $faq_cat)
                            <option {{$faq_cat->id == request('category_id') ? 'selected' : ''}} value="{{$faq_cat->id}}">{{app()->getLocale() == 'en' ? $faq_cat->category_en : $faq_cat->category_ar}}</option>
                        @endforeach
                    </select>
                </fieldset>
            </div>
            <div class="col-12 col-sm-6 col-lg-2">
                <button class="btn btn-xs btn-primary text-right mt-2" type="submit">
                    {{ trans('cruds.courseInvoice.fields.filter') }}
                </button>
            </div>
        </div>
    </form>
<div class="card-body">
    <div class="table-responsive">
        <table class=" table table-bordered table-striped table-hover  datatable-Slider">{{--datatable--}}
            <thead>

                <tr >
                    <th></th>
                    <th style="width: 10px;">
                        {{ trans('cruds.slider.fields.id') }}
                    </th>

                    <th>
                        {{ trans('cruds.slider.fields.title_ar') }}
                    </th>

                    <th>
                        {{ trans('cruds.faqQuestion.fields.category') }}
                    </th>


                </tr>
            </thead>
            <tbody id="tablecontents">
                @foreach($faqQuestions as $faqQuestion)
                <tr class="row1"  data-entry-id="{{ $faqQuestion->id }}">
                    <td></td>
                    <td class="row1">
                        {{-- <img src="/nazil/imgs/arrows-move.svg" alt="">--}}
                        {{ $faqQuestion->id ?? '' }}

                    </td>

                    <td>{{ $faqQuestion->question }}</td>
                    <td>
                        {{ $faqQuestion->category->category ?? '' }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
<script type="text/javascript">
    $(function() {
        $("#tablecontents").sortable({
            items: "tr",
            cursor: 'move',
            opacity: 0.6,
            update: function(e) {
                updatePostOrder();
            }
        });

        function updatePostOrder() {
            var order = [];
            var token = $('meta[name="csrf-token"]').attr('content');
            $('tr.row1').each(function(index, element) {
                order.push({
                    id: $(this).attr('data-entry-id'),
                    order: index + 1
                });
            });

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ url('/admin/sorting/faq_questions') }}",
                data: {
                    order: order,
                    _token: token
                },
                success: function(response) {
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
