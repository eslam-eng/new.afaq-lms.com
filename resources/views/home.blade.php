@extends('layouts.admin')
@section('content')
<!-- Dashboard Analytics Start -->
<section id="dashboard-analytics">
    <div class="row match-height">
        <div class="col-lg-8 col-md-12 col-sm-12">
            <div class="col-lg-12 col-md-12 col-sm-12 row">
                <div class="col-lg-12 card bg-analytics text-white">
                    <div class="card-content">
                        <div class="card-body text-center">
                            <img src="../../../app-assets/images/elements/decore-left.png" class="img-left" alt=" card-img-left">
                            <img src="../../../app-assets/images/elements/decore-right.png" class="img-right" alt=" card-img-right">
                            <div class="avatar avatar-xl bg-primary shadow mt-0">
                                <div class="avatar-content">
                                    <i class="feather icon-briefcase white font-large-1"></i>
                                </div>
                            </div>
                            <div class="text-center">
                                <h1 class="mb-2 text-white">{{ __('global.welcome' , ['name' => auth()->user()->name])}}</h1>
                                <p class="m-auto w-75">{{__('global.welcone_msg')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 row">
                <div class="col-lg-3 col-md-3 col-12">
                    <div class="card">
                        <div class="card-header d-flex flex-column pb-0">
                            <div class="avatar bg-rgba-warning p-50 m-0">
                                <div class="avatar-content">
                                    <i class="feather icon-book text-warning font-medium-5"></i>
                                </div>
                            </div>
                            <h2 class="text-bold-700 mt-1 mb-25">{{ $data['courses'] ?? 0 }}</h2>
                            <p class="mb-2" style="font-size: 16px;">{{__('global.courses')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-12">
                    <div class="card">
                        <div class="card-header d-flex flex-column  pb-0">
                            <div class="avatar bg-rgba-primary p-50 m-0">
                                <div class="avatar-content">
                                    <i class="feather icon-clipboard text-primary font-medium-5"></i>

                                </div>
                            </div>
                            <h2 class="text-bold-700 mt-1 mb-25">{{ $data['exams'] ?? 0 }}</h2>
                            <p class="mb-2" style="font-size: 16px;">{{__('global.exams')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-12">
                    <div class="card">
                        <div class="card-header d-flex flex-column  pb-0">
                            <div class="avatar bg-rgba-danger p-50 m-0">
                                <div class="avatar-content">
                                    <i class="feather icon-award text-danger font-medium-5"></i>

                                </div>
                            </div>
                            <h2 class="text-bold-700 mt-1 mb-25">{{ $data['certificates'] ?? 0 }}</h2>
                            <p class="mb-2" style="font-size: 16px;">{{__('global.certificates')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-12">
                    <div class="card">
                        <div class="card-header d-flex flex-column  pb-0">
                            <div class="avatar bg-rgba-success p-50 m-0">
                                <div class="avatar-content">
                                    <i class="feather icon-user text-success font-medium-5"></i>

                                </div>
                            </div>
                            <h2 class="text-bold-700 mt-1 mb-25">{{ $data['instructors'] ?? 0 }}</h2>
                            <p class="mb-2" style="font-size: 16px;">{{__('global.instructors')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-12">
                    <div class="card">
                        <div class="card-header d-flex flex-column  pb-0">
                            <div class="avatar bg-rgba-info p-50 m-0">
                                <div class="avatar-content">
                                    <i class="feather icon-users text-info font-medium-5"></i>

                                </div>
                            </div>
                            <h2 class="text-bold-700 mt-1 mb-25">{{ $data['students'] ?? 0 }}</h2>
                            <p class="mb-2" style="font-size: 16px;">{{__('global.students')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-12">
                    <div class="card">
                        <div class="card-header d-flex flex-column  pb-0">
                            <div class="avatar bg-rgba-success p-50 m-0">
                                <div class="avatar-content">
                                    <i class="feather icon-alert-triangle text-success font-medium-5"></i>

                                </div>
                            </div>
                            <h2 class="text-bold-700 mt-1 mb-25">{{ $data['orders'] ?? 0 }}</h2>
                            <p class="mb-2" style="font-size: 16px;">{{__('global.orders')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-12">
                    <div class="card">
                        <div class="card-header d-flex flex-column  pb-0">
                            <div class="avatar bg-rgba-warning p-50 m-0">
                                <div class="avatar-content">
                                    <i class="feather icon-user-check text-warning font-medium-5"></i>

                                </div>
                            </div>
                            <h2 class="text-bold-700 mt-1 mb-25">{{ $data['members'] ?? 0 }}</h2>
                            <p class="mb-2" style="font-size: 16px;">{{__('global.members')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-12">
                    <div class="card">
                        <div class="card-header d-flex flex-column pb-0">
                            <div class="avatar bg-rgba-primary p-50 m-0">
                                <div class="avatar-content">
                                    <i class="feather icon-layers text-primary font-medium-5"></i>

                                </div>
                            </div>
                            <h2 class="text-bold-700 mt-1 mb-25">{{ $data['specialites'] ?? 0 }}</h2>
                            <p class="mb-2" style="font-size: 16px;">{{__('global.specialites')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between pb-0">
                    <h4>{{__('global.courses')}}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div id="product-order-chart" class="mb-3"></div>
                        <div class="parent-data">
                            <div class="chart-info d-block justify-content-between mb-1">
                                <div class="series-info d-flex align-items-center">
                                    <i class="fa fa-circle-o text-bold-700 text-warning"></i>
                                    <span class="text-bold-600 ml-50">{{__('global.not_published')}}</span>
                                </div>
                                <div class="product-result">
                                    <span>{{$course_statistics['0'] ?? 0}}</span>
                                </div>
                            </div>
                            <div class="chart-info d-block justify-content-between mb-1">
                                <div class="series-info d-flex align-items-center">
                                    <i class="fa fa-circle-o text-bold-700 text-primary"></i>
                                    <span class="text-bold-600 ml-50">{{__('global.published')}}</span>
                                </div>
                                <div class="product-result">
                                    <span>{{$course_statistics['1'] ?? 0}}</span>
                                </div>
                            </div>
                            <div class="chart-info d-block justify-content-between mb-75">
                                <div class="series-info d-flex align-items-center">
                                    <i class="fa fa-circle-o text-bold-700 text-danger"></i>
                                    <span class="text-bold-600 ml-50">{{__('global.finished')}}</span>
                                </div>
                                <div class="product-result">
                                    <span>{{$course_statistics['2'] ?? 0}}</span>
                                </div>
                            </div>
                            <div class="chart-info d-block justify-content-between mb-75">
                                <div class="series-info d-flex align-items-center">
                                    <i class="fa fa-circle-o text-bold-700" style="color: #1edec5;"></i>
                                    <span class="text-bold-600 ml-50">{{__('global.offered')}}</span>
                                </div>
                                <div class="product-result">
                                    <span>{{$course_statistics['3'] ?? 0}}</span>
                                </div>
                            </div>
                            <div class="chart-info d-block justify-content-between mb-75">
                                <div class="series-info d-flex align-items-center">
                                    <i class="fa fa-circle-o text-bold-700" style="color: #b9c3cd;"></i>
                                    <span class="text-bold-600 ml-50">{{__('global.hidden')}}</span>
                                </div>
                                <div class="product-result">
                                    <span>{{$course_statistics['4'] ?? 0}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">{{ trans('cruds.reservation.fields.Course_Operation') }}</h4>
                </div>
                <div class="card-content">
                    <div class="table-responsive mt-1">
                        <table class="table table-hover-animation mb-0 text-center">
                            <thead>
                                <tr>
                                    <th> {{ trans('cruds.reservation.fields.payments_number') }}</th>
                                    <th> {{ trans('cruds.reservation.fields.course') }}</th>
                                    <th> {{ trans('cruds.reservation.fields.course_image') }}</th>
                                    <th> {{ trans('cruds.reservation.fields.instructor') }}</th>{{--Images--}}
                                    <th> {{ trans('cruds.reservation.fields.user') }}</th>
                                    <th> {{ trans('cruds.reservation.fields.final_price') }} </th>
                                    <th> {{ trans('cruds.reservation.fields.payment_provider') }}</th>
                                    <th>
                                        {{ trans('cruds.reservation.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.course.fields.start_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.course.fields.end_date') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                {{--{{dd($payments_details)}}--}}
                                @foreach($payments_details as $payment)
                                <tr>
                                    <td><a href="{{ route('admin.reservations.show', $payment->payment_id) }}">{{$payment->payment_number}} </a></td>
                                    <td>
                                        {{app()->getLocale()=='en' ? substr($payment->course_name_en,0,20).'...' ?? '' : '...'.substr($payment->course_name_ar,0,20) ?? ''}}
                                    </td>
                                    <td>
                                        @if($payment->course_image_url)
                                        <img class="media-object rounded-circle" src="{{$payment->course_image_url}}" alt="Avatar" height="50" width="50">
                                        @endif
                                    </td>
                                    {{--Instructor image---}}
                                    <td>
                                        <ul class="list-unstyled users-list m-0  d-flex align-items-center">
                                            @if(isset($payment->course->course_instructor))
                                            @foreach($payment->course->course_instructor as $instructor_data)
                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="{{$instructor_data->name}}" class="avatar pull-up">
                                                @if(isset($instructor_data->image->url))
                                                <img class="media-object rounded-circle" src="{{$instructor_data->image->url}}" alt="Avatar" height="30" width="30">
                                                @endif
                                            </li>
                                            @endforeach
                                            @endif
                                        </ul>
                                    </td>
                                    <td>{{app()->getLocale()=='en' ? substr($payment->user_name_en,0,20).'...' ?? '' : '...'.substr($payment->user_name_ar,0,20) ?? ''}}</td>
                                    <td>{{$payment->final_price}}</td>
                                    <td>{{ $payment->payments ? $payment->payments->provider : ''}}</td>
                                    @if(isset($payment->payments->provider) && $payment->payments->provider == 'Bank')
                                        @if($payment->payments->approved)
                                        <td><i class="fa fa-circle font-small-3 text-success mr-50"></i> {{ trans('cruds.reservation.fields.paid') }}</td>
                                        @else
                                        <td><i class="fa fa-circle font-small-3 text-warning mr-50"></i> {{ trans('cruds.reservation.fields.pending') }}</td>
                                        @endif
                                    @else
                                        @if(isset($payment->payments->status))
                                        <td><i class="fa fa-circle font-small-3 text-success mr-50"></i> {{ trans('cruds.reservation.fields.paid') }}</td>
                                        @else
                                        <td><i class="fa fa-circle font-small-3 text-warning mr-50"></i> {{ trans('cruds.reservation.fields.pending') }}</td>
                                        @endif
                                    @endif
                                    <td>{{$payment->course ? $payment->course->start_date : ''}}</td>
                                    <td>{{$payment->course ? $payment->course->end_date : ''}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Dashboard Analytics end -->
@endsection

@section('scripts')
@parent
<script>
    $(document).ready(function() {

        var $primary = '#7367F0';
        var $danger = '#EA5455';
        var $warning = '#FF9F43';
        var $info = '#0DCCE1';
        var $primary_light = '#8F80F9';
        var $warning_light = '#FFC085';
        var $danger_light = '#f29292';
        var $info_light = '#1edec5';
        var $strok_color = '#b9c3cd';
        var $label_color = '#e7eef7';
        var $white = '#fff';

        var orderChartoptions = {
            chart: {
                height: 325,
                type: 'radialBar',
            },
            colors: [$warning, $primary, $danger, $info, $strok_color],
            fill: {
                type: 'gradient',
                gradient: {
                    // enabled: true,
                    shade: 'dark',
                    type: 'vertical',
                    shadeIntensity: 0.5,
                    gradientToColors: [$warning_light, $primary_light, $danger_light, $info_light],
                    inverseColors: false,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 100]
                },
            },
            stroke: {
                lineCap: 'round'
            },
            plotOptions: {
                radialBar: {
                    size: 150,
                    hollow: {
                        size: '20%'
                    },
                    track: {
                        strokeWidth: '100%',
                        margin: 15,
                    },
                    dataLabels: {
                        name: {
                            fontSize: '18px',
                        },
                        value: {
                            fontSize: '16px',
                        },
                        total: {
                            show: true,
                            label: "{{__('global.total')}}",

                            formatter: function(w) {
                                // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                                return "{{array_sum($course_statistics)}}"
                            }
                        }
                    }
                }
            },
            series: ["{{$course_statistics['0'] ?? 0}}", "{{$course_statistics['1'] ?? 0}}", "{{$course_statistics['2'] ?? 0}}",
                "{{$course_statistics['3'] ?? 0}}", "{{$course_statistics['4'] ?? 0}}"
            ],
            labels: ["{{__('global.not_published')}}", "{{__('global.published')}}", "{{__('global.finished')}}", "{{__('global.offered')}}", "{{__('global.hidden')}}"],

        }

        var orderChart = new ApexCharts(
            document.querySelector("#product-order-chart"),
            orderChartoptions
        );

        orderChart.render();
    })
</script>
@endsection
