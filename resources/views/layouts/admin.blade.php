<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <META http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="_lang" content="{{ app()->getLocale() }}">

    <title>{{ trans('panel.site_title') }} | {{ request()->segment(2) }}</title>

    <link rel="apple-touch-icon" href="/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('nazil/imgs/logo.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/vendors.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/charts/apexcharts.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/app-assets/vendors/css/extensions/tether-theme-arrows.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/extensions/tether.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <!-- END: Vendor CSS-->
    @if (app()->getLocale() == 'ar')
        @php($css = 'css-rtl')
    @else
        @php($css = 'css')
    @endif

    <link rel="stylesheet" type="text/css"
        href="{{ asset('/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/' . $css . '/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/' . $css . '/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/' . $css . '/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/' . $css . '/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/' . $css . '/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/' . $css . '/themes/semi-dark-layout.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/app-assets/' . $css . '/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/app-assets/' . $css . '/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/app-assets/' . $css . '/pages/dashboard-analytics.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/' . $css . '/pages/card-analytics.css') }}">
    <!-- END: Page CSS-->

    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/' . $css . '/plugins/forms/wizard.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/' . $css . '/plugins/forms/wizard.min.css') }}">

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/assets/css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/css/intlTelInput.css" rel="stylesheet"
        media="screen">
    <!-- END: Custom CSS-->
    @yield('styles')
    <style>
        .navbar-header {
            padding-right: 2px !important;
            padding-left: 2px !important;
        }

        table>th {
            text-align: center;
        }

        .parent-data {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            width: 100%;
        }

        .chart-info.d-flex.justify-content-between.mb-1 {
            width: 50%;
        }

        .chart-info {
            width: 46%;
            display: flex !important;
        }

        div#DataTables_Table_0_length {
            width: max-content;
            display: inline-block;
            margin: 0 30px;
        }

        div#DataTables_Table_0_length select {
            margin: 0 5px;
        }

        .dt-buttons.btn-group {
            display: inline-block;
        }

        .rtl div#DataTables_Table_0_filter {
            /* margin: 0px; */
        }

        div#DataTables_Table_0_filter {
            width: max-content;
            display: inline-block;
            /* margin: 0px 0px 0px 180px; */
            /* text-align: end !important; */
            margin: 0 0 10px 0;
            width: 100%;
        }

        div#DataTables_Table_0_filter label{
            margin: 0 !important;
        }

        table.dataTable tbody td.select-checkbox:before {
            top: auto;
        }

        table.dataTable tbody td.select-checkbox:after {
            top: auto;
        }

        .btn.btn-icon{
            margin: 5px;
        }

        div.dataTables_wrapper div.dataTables_filter input{
            background: #f8f8f8;
            border-radius: 40px;
            height: 30px;
            margin: 10px 10px 0;
            font-size: 14px;
            letter-spacing: 1px;
        }

        table.dataTable thead .sorting:after, table.dataTable thead .sorting_asc:after, table.dataTable thead .sorting_desc:after{
            font-size: 1rem;
            top: 2rem;
            right: 10px
        }

        table.dataTable thead .sorting:before, table.dataTable thead .sorting_asc:before, table.dataTable thead .sorting_desc:before{
            font-size: 1rem;
            right: 10px;
        }

        form i.verify_{
            position: relative;
            padding: 0;
            width: 35px;
            height: 35px;
            /* border-radius: 50%; */
            box-shadow: 0 1px 1.5px 1px rgba(0,0,0,.12);
        }

        i.verify_::after{
            content: "\f058";
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: #00CFE8;
            content: "\f058";
            z-index: 9;
            font-family: 'Font Awesome\ 5 Free';
            font-style: normal;
            align-items: center;
            display: flex;
            justify-content: center;
            font-size: 15px;
        }
        .table .courses_admin_buttons{
            width: 35px;
            height: 35px;
            padding: 10px 0;
            margin: 0 5px;
        }
    </style>

    @if (App::getLocale() == 'ar')
        <style>
            .pagination .page-item.next .page-link:after {
                content: '\e843';
                font-family: 'feather';
            }

            .pagination .page-item.previous .page-link:before {
                content: '\e844';
                font-family: 'feather';
            }
        </style>
    @endif

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body
    class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static {{ app()->getLocale() == 'en' ? 'ltr' : 'rtl' }} "
    data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    @include('partials.nav')
    @include('partials.menu')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">

                <main class="c-main">


                    <div class="container-fluid">
                        @if (session('message'))
                            <div class="row mb-2">
                                <div class="col-lg-12">
                                    <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                                </div>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="row mb-2">
                                <div class="col-lg-12">
                                    <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                                </div>
                            </div>
                        @endif

                        @if ($errors->count() > 0)
                            <div class="alert alert-danger">
                                <ul class="list-unstyled">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>


                </main>

                @yield('content')

                <form id="logoutform" action="{{ route('logout', ['locale', app()->getLocale()]) }}" method="POST"
                    style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>



    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('/app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('/app-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
    <script src="{{ asset('/app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('/app-assets/vendors/js/extensions/tether.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('/app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('/app-assets/js/core/app.js') }}"></script>
    <script src="{{ asset('/app-assets/js/scripts/components.js') }}"></script>

    <!-- END: Theme JS-->
    <!-- BEGIN: intl tel JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"></script>
    <!-- END: intl tel JS-->
    <!-- BEGIN: Page JS-->
    <script src="{{ asset('/app-assets/js/scripts/pages/dashboard-analytics.js') }}"></script>

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('/app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('/app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('/app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('/app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('/app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('/app-assets/js/scripts/datatables/datatable.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>

   <script src="https://cdn.tiny.cloud/1/xdtvumic5spz8s20xfmw404uqqibaqka8var52dipy3hxwag/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea.ckeditor',
            plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            image_title: true,
            automatic_uploads: true,
            file_picker_types: 'image',
            file_picker_callback: function (cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.onchange = function () {
                    var file = this.files[0];
                    var reader = new FileReader();
                    reader.onload = function () {
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);
                        cb(blobInfo.blobUri(), { title: file.name });
                    };
                    reader.readAsDataURL(file);
                };

                input.click();
            },
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
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

    @yield('scripts')
    @stack('footer-scripts')

    <script>
        $(".select2").select2();

        $('.select-all').click(function() {
            let $select2 = $(this).parent().siblings('.select2')
            $select2.find('option').prop('selected', 'selected')
            $select2.trigger('change')
        })
        $('.deselect-all').click(function() {
            let $select2 = $(this).parent().siblings('.select2')
            $select2.find('option').prop('selected', '')
            $select2.trigger('change')
        })

        //
        var forms = $(document).find('form');
        if (forms.length) {
            forms.each(function(index, form) {
                form.onsubmit = function() {
                    $(this).find('*[type="submit"]').prop('disabled', true);
                };
            });
        }
    </script>
</body>
<!-- END: Body-->

</html>
