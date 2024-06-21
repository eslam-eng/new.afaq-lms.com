<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="_token" content="{{ csrf_token() }}">

    <title>{{ trans('panel.site_title') }}</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link href="{{ asset('afaq/assests/css/admin-style.css') }}?v={{time()}}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/@coreui/coreui@3.2/dist/css/coreui.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.min.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css"> -->
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/materialize-stepper@2.1.4/materialize-stepper.css" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    @yield('styles')
</head>

<body class="c-app {{app()->getLocale() == 'ar' ? 'rtl' : 'ltr'}}" style="text-align:start">
    @include('partials.menu')
    <div class="c-wrapper">
        <header class="c-header c-header-fixed px-3">
            <button class="c-header-toggler btn-brger c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
                <i class="fas fa-fw fa-bars"></i>
            </button>

            <a class="c-header-brand d-lg-none" href="#">{{ trans('panel.site_title') }}</a>

            <button class="c-header-toggler btn-brger- c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
                <i class="fas fa-fw fa-bars"></i>
            </button>

            <ul class="c-header-nav ml-auto">
                <li class="c-header-nav-item dropdown d-md-down-none">
                    <a href="{{single_login_to_moodle(null , '/admin/search.php')}}">
                        Moodle
                    </a>
                </li>

                @if(count(config('panel.available_languages', [])) > 1)
                <li class="c-header-nav-item dropdown d-md-down-none">
                    <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        {{ strtoupper(app()->getLocale()) }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        @foreach(config('panel.available_languages') as $langLocale => $langName)
                        <a class="dropdown-item" href="{{ url()->current() }}?change_language={{ $langLocale }}">{{ strtoupper($langLocale) }} ({{ $langName }})</a>
                        @endforeach
                    </div>
                </li>
                @endif

                <ul class="c-header-nav ml-auto">
                    <li class="c-header-nav-item dropdown notifications-menu user-name">Welcome, {{ Auth::user()->name }}</li>
                    <li class="c-header-nav-item dropdown notifications-menu">
                        <a href="#" class="c-header-nav-link" data-toggle="dropdown">
                            <i class="far fa-bell"></i>
                            @php($alertsCount = \Auth::user()->userUserAlerts()->where('read', false)->count())
                            @if($alertsCount > 0)
                            <span class="badge badge-warning navbar-badge">
                                {{ $alertsCount }}
                            </span>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            @if(count($alerts = \Auth::user()->userUserAlerts()->withPivot('read')->limit(10)->orderBy('created_at', 'ASC')->get()->reverse()) > 0)
                            @foreach($alerts as $alert)
                            <div class="dropdown-item">
                                <a href="{{ $alert->alert_link ? $alert->alert_link : "#" }}" target="_blank" rel="noopener noreferrer">
                                    @if($alert->pivot->read === 0) <strong> @endif
                                        {{ $alert->alert_text }}
                                        @if($alert->pivot->read === 0) </strong> @endif
                                </a>
                            </div>
                            @endforeach
                            @else
                            <div class="text-center">
                                {{ trans('global.no_alerts') }}
                            </div>
                            @endif
                        </div>
                    </li>
                </ul>

            </ul>
        </header>

        <div class="c-body">
            <main class="c-main">


                <div class="container-fluid">
                    @if(session('message'))
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                        </div>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                        </div>
                    </div>
                    @endif

                    @if($errors->count() > 0)
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @yield('content')

                </div>


            </main>
            <form id="logoutform" action="{{ route('logout' , ['locale', app()->getLocale()]) }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </div>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> -->
    <!-- Materializecss compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
    <!-- jQueryValidation Plugin -->
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js"></script>
    <script src="https://unpkg.com/@coreui/coreui@3.2/dist/js/coreui.min.js"></script>

    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script src="https://cdn.tiny.cloud/1/xdtvumic5spz8s20xfmw404uqqibaqka8var52dipy3hxwag/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>    <script>
        tinymce.init({
            selector: 'textarea.ckeditor',
            plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            autosave_interval: "30s",
            autosave_prefix: "{path}{query}-{id}-",
            autosave_restore_when_empty: false,
            autosave_retention: "2m",
            image_advtab: true,
            importcss_append: true,
            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            height: 700,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: "mceNonEditable",
            toolbar_mode: 'sliding',
            contextmenu: "link image imagetools table",
            valid_elements: '*[*]',
            extended_valid_elements: "style,link[href|rel]",
            custom_elements: "style,link,~link"
        });
    </script>

    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        $(function() {
            let copyButtonTrans = "{{ trans('global.datatables.copy') }}"
            let csvButtonTrans = "{{ trans('global.datatables.csv') }}"
            let excelButtonTrans = "{{ trans('global.datatables.excel') }}"
            let pdfButtonTrans = "{{ trans('global.datatables.pdf') }}"
            let printButtonTrans = "{{ trans('global.datatables.print') }}"
            let colvisButtonTrans = "{{ trans('global.datatables.colvis') }}"
            let selectAllButtonTrans = "{{ trans('global.select_all') }}"
            let selectNoneButtonTrans = "{{ trans('global.deselect_all') }}"

            let languages = {
                'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json'
            };

            $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, {
                className: 'btn'
            })
            $.extend(true, $.fn.dataTable.defaults, {
                language: {
                    url: languages['{{ app()->getLocale() }}']
                },
                columnDefs: [{
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0
                }, {
                    orderable: false,
                    searchable: false,
                    targets: -1
                }],
                select: {
                    style: 'multi+shift',
                    selector: 'td:first-child'
                },
                order: [],
                scrollX: true,
                pageLength: 100,
                dom: 'lBfrtip<"actions">',
                buttons: [{
                        extend: 'selectAll',
                        className: 'btn-primary',
                        text: selectAllButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        },
                        action: function(e, dt) {
                            e.preventDefault()
                            dt.rows().deselect();
                            dt.rows({
                                search: 'applied'
                            }).select();
                        }
                    },
                    {
                        extend: 'selectNone',
                        className: 'btn-primary',
                        text: selectNoneButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'copy',
                        className: 'btn-default',
                        text: copyButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'csv',
                        className: 'btn-default',
                        text: csvButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excel',
                        className: 'btn-default',
                        text: excelButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdf',
                        className: 'btn-default',
                        text: pdfButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn-default',
                        text: printButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'colvis',
                        className: 'btn-default',
                        text: colvisButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                ]
            });

            $.fn.dataTable.ext.classes.sPageButton = '';
        });
    </script>
    <script>
        $(document).ready(function() {
                    $(".notifications-menu").on('click', function() {
                        if (!$(this).hasClass('open')) {
                            $('.notifications-menu .label-warning').hide();
                            $.get('/admin/user-alerts/read');
                        }
                    });


                    // function hideStage(stage) {
                    //     $('#stage' + stage).removeClass('active');
                    //     $('#stage-' + stage + '-step').addClass('done');
                    // }

                    // function showStage(stage) {
                    //     $('#stage' + stage).addClass('active');
                    //     $('#stage-' + stage + '-step').addClass('active');
                    // }

                    // $(document).ready(function() {

                    // })
                    $(document).ready(function() {
                        $('.stepper').activateStepper();
                    })

                    function validateStepOne() {
                        // Extract the checked checkboxes from the first step
                        if ($('.step').first().find('input[type="checkbox"]:checked').length)
                            return true;
                        return false;
                    }

                    function validateStepThree() {
                        var validation = true;
                        if ($('.step:nth-child(3) input[type="text"]').val().indexOf('materialize') === -1)
                            validation = false;
                        if ($('.step:nth-child(3) input[type="checkbox"]:checked').length === 0)
                            validation = false;
                        return validation;

                    }

                    function nextStepThreeHandler() {
                        if (validateStepThree())
                            $('.stepper').nextStep();
                        else {
                            $('.stepper ').destroyFeedback();
                            $('.stepper').getStep($('.stepper').getActiveStep()).addClass('wrong');
                        }
                    }




                    /* Materializecss Stepper - By Kinark 2016
                    // https://github.com/Kinark/Materialize-stepper
                    // JS v2.1.3
                    */

                    var validation = $.isFunction($.fn.valid) ? 1 : 0;

                    $.fn.isValid = function() {
                        if (validation) {
                            return this.valid();
                        } else {
                            return true;
                        }
                    };

                    if (validation) {
                        $.validator.setDefaults({
                            errorClass: 'invalid',
                            validClass: "valid",
                            errorPlacement: function(error, element) {
                                if (element.is(':radio') || element.is(':checkbox')) {
                                    error.insertBefore($(element).parent());
                                } else {
                                    error.insertAfter(element); // default error placement.
                                    // element.closest('label').data('error', error);
                                    // element.next().attr('data-error', error);
                                }
                            },
                            success: function(element) {
                                if (!$(element).closest('li').find('label.invalid:not(:empty)').length) {
                                    $(element).closest('li').removeClass('wrong');
                                }
                            }
                        });

                        // When parallel stepper is defined we need to consider invisible and
                        // hidden fields
                        if ($('.stepper.parallel').length) $.validator.setDefaults({
                            ignore: ''
                        });
                    }

                    $.fn.getActiveStep = function() {
                        var active = this.find('.step.active');
                        return $(this.children('.step:visible')).index($(active)) + 1;
                    };

                    $.fn.activateStep = function(callback) {
                        if ($(this).hasClass('step')) return;
                        var stepper = $(this).closest('ul.stepper');
                        stepper.find('>li').removeAttr("data-last");
                        if (window.innerWidth < 993 || !stepper.hasClass('horizontal')) {
                            $(this).addClass("step").stop().slideDown(400, function() {
                                $(this).css({
                                    'height': 'auto',
                                    'margin-bottom': '',
                                    'display': 'inherit'
                                });
                                if (callback) callback();
                                stepper.find('>li.step').last().attr('data-last', 'true');
                            });
                        } else {
                            $(this).addClass("step").stop().css({
                                'width': '0%',
                                'display': 'inherit'
                            }).animate({
                                width: '100%'
                            }, 400, function() {
                                $(this).css({
                                    'height': 'auto',
                                    'margin-bottom': '',
                                    'display': 'inherit'
                                });
                                if (callback) callback();
                                stepper.find('>li.step').last().attr('data-last', 'true');
                            });
                        }
                    };

                    $.fn.deactivateStep = function(callback) {
                        if (!$(this).hasClass('step')) return;
                        var stepper = $(this).closest('ul.stepper');
                        stepper.find('>li').removeAttr("data-last");
                        if (window.innerWidth < 993 || !stepper.hasClass('horizontal')) {
                            $(this).stop().css({
                                'transition': 'none',
                                '-webkit-transition': 'margin-bottom none'
                            }).slideUp(400, function() {
                                $(this).removeClass("step").css({
                                    'height': 'auto',
                                    'margin-bottom': '',
                                    'transition': 'margin-bottom .4s',
                                    '-webkit-transition': 'margin-bottom .4s'
                                });
                                if (callback) callback();
                                stepper.find('>li').removeAttr("data-last");
                                stepper.find('>li.step').last().attr('data-last', 'true');
                            });
                        } else {
                            $(this).stop().animate({
                                width: '0%'
                            }, 400, function() {
                                $(this).removeClass("step").hide().css({
                                    'height': 'auto',
                                    'margin-bottom': '',
                                    'display': 'none',
                                    'width': ''
                                });
                                if (callback) callback();
                                stepper.find('>li.step').last().attr('data-last', 'true');
                            });
                        }
                    };

                    $.fn.showError = function(error) {
                        if (validation) {
                            var name = this.attr('name');
                            var form = this.closest('form');
                            var obj = {};
                            obj[name] = error;
                            form.validate().showErrors(obj);
                            this.closest('li').addClass('wrong');
                        } else {
                            this.removeClass('valid').addClass('invalid');
                            this.next().attr('data-error', error);
                        }
                    };

                    $.fn.activateFeedback = function() {
                        var active = this.find('.step.active:not(.feedbacking)').addClass('feedbacking').find('.step-content');
                        active.prepend('<div class="wait-feedback"> <div class="preloader-wrapper active"> <div class="spinner-layer spinner-blue"> <div class="circle-clipper left"> <div class="circle"></div></div><div class="gap-patch"> <div class="circle"></div></div><div class="circle-clipper right"> <div class="circle"></div></div></div><div class="spinner-layer spinner-red"> <div class="circle-clipper left"> <div class="circle"></div></div><div class="gap-patch"> <div class="circle"></div></div><div class="circle-clipper right"> <div class="circle"></div></div></div><div class="spinner-layer spinner-yellow"> <div class="circle-clipper left"> <div class="circle"></div></div><div class="gap-patch"> <div class="circle"></div></div><div class="circle-clipper right"> <div class="circle"></div></div></div><div class="spinner-layer spinner-green"> <div class="circle-clipper left"> <div class="circle"></div></div><div class="gap-patch"> <div class="circle"></div></div><div class="circle-clipper right"> <div class="circle"></div></div></div></div></div>');
                    };

                    $.fn.destroyFeedback = function() {
                        var active = this.find('.step.active.feedbacking');
                        if (active) {
                            active.removeClass('feedbacking');
                            active.find('.wait-feedback').remove();
                        }
                        return true;
                    };

                    $.fn.resetStepper = function(step) {
                        if (!step) step = 1;
                        var form = $(this).closest('form');
                        $(form)[0].reset();
                        Materialize.updateTextFields();
                        return $(this).openStep(step);
                    };

                    $.fn.submitStepper = function(step) {
                        var form = this.closest('form');
                        if (form.isValid()) {
                            form.submit();
                        }
                    };

                    $.fn.nextStep = function(callback, activefb, e) {
                        var stepper = this;
                        var settings = $(stepper).data('settings');
                        var form = this.closest('form');
                        var active = this.find('.step.active');
                        var next = $(this.children('.step:visible')).index($(active)) + 2;
                        var feedback = active.find('.next-step').length > 1 ? (e ? $(e.target).data("feedback") : undefined) : active.find('.next-step').data("feedback");
                        // If the stepper is parallel, we want to validate the input of the current active step. Not all elements.
                        if ((settings.parallel && $(active).validateStep()) || (!settings.parallel && form.isValid())) {
                            if (feedback && activefb) {
                                if (settings.showFeedbackLoader) stepper.activateFeedback();
                                return window[feedback].call();
                            }
                            active.removeClass('wrong').addClass('done');
                            this.openStep(next, callback);
                            return this.trigger('nextstep');
                        } else {
                            return active.removeClass('done').addClass('wrong');
                        }
                    };

                    $.fn.prevStep = function(callback) {
                        var active = this.find('.step.active');
                        if (active.hasClass('feedbacking')) return;
                        var prev = $(this.children('.step:visible')).index($(active));
                        active.removeClass('wrong');
                        this.openStep(prev, callback);
                        return this.trigger('prevstep');
                    };

                    $.fn.openStep = function(step, callback) {
                        var settings = $(this).closest('ul.stepper').data('settings');
                        var $this = this;
                        var step_num = step - 1;
                        step = this.find('.step:visible:eq(' + step_num + ')');
                        if (step.hasClass('active')) return;
                        var active = this.find('.step.active');
                        var next;
                        var prev_active = next = $(this.children('.step:visible')).index($(active));
                        var order = step_num > prev_active ? 1 : 0;
                        if (active.hasClass('feedbacking')) $this.destroyFeedback();
                        active.closeAction(order);
                        step.openAction(order, function() {
                            if (settings.autoFocusInput) step.find('input:enabled:visible:first').focus();
                            $this.trigger('stepchange').trigger('step' + (step_num + 1));
                            if (step.data('event')) $this.trigger(step.data('event'));
                            if (callback) callback();
                        });
                    };

                    $.fn.closeAction = function(order, callback) {
                        var closable = this.removeClass('active').find('.step-content');
                        if (window.innerWidth < 993 || !this.closest('ul').hasClass('horizontal')) {
                            closable.stop().slideUp(300, "easeOutQuad", callback);
                        } else {
                            if (order == 1) {
                                closable.animate({
                                    left: '-100%'
                                }, function() {
                                    closable.css({
                                        display: 'none',
                                        left: '0%'
                                    }, callback);
                                });
                            } else {
                                closable.animate({
                                    left: '100%'
                                }, function() {
                                    closable.css({
                                        display: 'none',
                                        left: '0%'
                                    }, callback);
                                });
                            }
                        }
                    };

                    $.fn.openAction = function(order, callback) {
                        var openable = this.removeClass('done').addClass('active').find('.step-content');
                        if (window.innerWidth < 993 || !this.closest('ul').hasClass('horizontal')) {
                            openable.slideDown(300, "easeOutQuad", callback);
                        } else {
                            if (order == 1) {
                                openable.css({
                                    left: '100%',
                                    display: 'block'
                                }).animate({
                                    left: '0%'
                                }, callback);
                            } else {
                                openable.css({
                                    left: '-100%',
                                    display: 'block'
                                }).animate({
                                    left: '0%'
                                }, callback);
                            }
                        }
                    };

                    $.fn.activateStepper = function(options) {
                        var settings = $.extend({
                            linearStepsNavigation: true,
                            autoFocusInput: true,
                            showFeedbackLoader: true,
                            autoFormCreation: true,
                            parallel: false // By default we don't assume the stepper is parallel
                        }, options);
                        $(document).on('click', function(e) {
                            if (!$(e.target).parents(".stepper").length) {
                                $('.stepper.focused').removeClass('focused');
                            }
                        });

                        $(this).each(function() {
                            var $stepper = $(this);
                            if (!$stepper.parents("form").length && settings.autoFormCreation) {
                                var method = $stepper.data('method');
                                var action = $stepper.data('action');
                                var method = (method ? method : "GET");
                                action = (action ? action : "?");
                                $stepper.wrap('<form action="' + action + '" method="' + method + '"></form>');
                            }

                            $stepper.data('settings', {
                                linearStepsNavigation: settings.linearStepsNavigation,
                                autoFocusInput: settings.autoFocusInput,
                                showFeedbackLoader: settings.showFeedbackLoader,
                                parallel: $stepper.hasClass('parallel')
                            });
                            $stepper.find('li.step.active').openAction(1);
                            $stepper.find('>li').removeAttr("data-last");
                            $stepper.find('>li.step').last().attr('data-last', 'true');

                            $stepper.on("click", '.step:not(.active)', function() {
                                var object = $($stepper.children('.step:visible')).index($(this));
                                if ($stepper.data('settings').parallel && validation) { // Invoke parallel stepper behaviour
                                    $(this).addClass('temp-active');
                                    $stepper.validatePreviousSteps()
                                    $stepper.openStep(object + 1);
                                    $(this).removeClass('temp-active');
                                } else if (!$stepper.hasClass('linear')) {
                                    $stepper.openStep(object + 1);
                                } else if (settings.linearStepsNavigation) {
                                    var active = $stepper.find('.step.active');
                                    if ($($stepper.children('.step:visible')).index($(active)) + 1 == object) {
                                        $stepper.nextStep(undefined, true, undefined);
                                    } else if ($($stepper.children('.step:visible')).index($(active)) - 1 == object) {
                                        $stepper.prevStep(undefined);
                                    }
                                }
                            }).on("click", '.next-step', function(e) {
                                e.preventDefault();
                                $stepper.nextStep(undefined, true, e);
                            }).on("click", '.previous-step', function(e) {
                                e.preventDefault();
                                $stepper.prevStep(undefined);
                            }).on("click", "button:submit:not(.next-step, .previous-step)", function(e) {
                                e.preventDefault();
                                feedback = e ? $(e.target).data("feedback") : undefined;
                                var form = $stepper.closest('form');
                                if (form.isValid()) {
                                    if (feedback) {
                                        stepper.activateFeedback();
                                        return window[feedback].call();
                                    }
                                    form.submit();
                                }
                            }).on("click", function() {
                                $('.stepper.focused').removeClass('focused');
                                $(this).addClass('focused');
                            });
                        });
                    };

                    /**
                     * Return the step element on given index.
                     *
                     * @param step, index of the step to be returned
                     * @returns {*}, the step requested
                     */
                    $.fn.getStep = function(step) {
                        var settings = $(this).closest('ul.stepper').data('settings');
                        var $this = this;
                        var step_num = step - 1;
                        step = this.find('.step:visible:eq(' + step_num + ')');
                        return step;
                    };

                    /**
                     * Run validation over all previous steps from the steps this
                     * function is called on.
                     */
                    $.fn.validatePreviousSteps = function() {
                        var active = $(this).find('.step.temp-active');
                        var index = $(this.children('.step')).index($(active));
                        // We assume that the validator is set to ignore nothing.
                        $(this.children('.step')).each(function(i) {
                            if (i >= index) {
                                $(this).removeClass('wrong done');
                            } else {
                                $(this).validateStep();
                            }
                        });
                    };

                    /**
                     * Validate the step that this function is called on.
                     */
                    $.fn.validateStep = function() {
                        var stepper = this.closest('ul.stepper');
                        var form = this.closest('form');
                        var step = $(this);
                        // Retrieve the custom validator for that step if exists.
                        var validator = step.find('.next-step').data("validator");
                        if (this.validateStepInput()) { // If initial base validation succeeded go on
                            if (validator) { // If a custom validator is given also call that validator
                                if (window[validator].call()) {
                                    step.removeClass('wrong').addClass('done');
                                    return true;
                                } else {
                                    step.removeClass('done').addClass('wrong');
                                    return false;
                                }
                            }
                            step.removeClass('wrong').addClass('done');
                            return true;
                        } else {
                            step.removeClass('done').addClass('wrong');
                            return false;
                        }
                    };

                    /**
                     * Uses the validation variable set by the stepper constructor
                     * to run standard validation on the current step.
                     * @returns {boolean}
                     */
                    $.fn.validateStepInput = function() {
                        var valid = true;
                        if (validation) {
                            // Find all input fields dat need validation in current step.
                            $(this).find('input.validate').each(function() {
                                if (!$(this).valid()) {
                                    valid = false;
                                    return false;
                                }
                            });
                        }
                        return valid;
                    };
    </script>

    @yield('scripts')
</body>

</html>
