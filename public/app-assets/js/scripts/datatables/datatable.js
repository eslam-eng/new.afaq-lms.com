/*=========================================================================================
    File Name: datatables-basic.js
    Description: Basic Datatable
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(document).ready(function () {

    /****************************************
    *       js of zero configuration        *
    ****************************************/

    $('.zero-configuration').DataTable();

    /********************************************
     *        js of Order by the grouping        *
     ********************************************/

    var groupingTable = $('.row-grouping').DataTable({
        "columnDefs": [{
            "visible": false,
            "targets": 2
        }],
        "order": [
            [2, 'asc']
        ],
        "displayLength": 10,
        "drawCallback": function (settings) {
            var api = this.api();
            var rows = api.rows({
                page: 'current'
            }).nodes();
            var last = null;

            api.column(2, {
                page: 'current'
            }).data().each(function (group, i) {
                if (last !== group) {
                    $(rows).eq(i).before(
                        '<tr class="group"><td colspan="5">' + group + '</td></tr>'
                    );

                    last = group;
                }
            });
        }
    });

    $('.row-grouping tbody').on('click', 'tr.group', function () {
        var currentOrder = groupingTable.order()[0];
        if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
            groupingTable.order([2, 'desc']).draw();
        }
        else {
            groupingTable.order([2, 'asc']).draw();
        }
    });

    /*************************************
    *       js of complex headers        *
    *************************************/

    $('.complex-headers').DataTable();


    /*****************************
    *       js of Add Row        *
    ******************************/

    var t = $('.add-rows').DataTable();
    var counter = 2;

    $('#addRow').on('click', function () {
        t.row.add([
            counter + '.1',
            counter + '.2',
            counter + '.3',
            counter + '.4',
            counter + '.5'
        ]).draw(false);

        counter++;
    });


    /**************************************************************
    * js of Tab for COLUMN SELECTORS WITH EXPORT AND PRINT OPTIONS *
    ***************************************************************/
    var copyButtonTrans = "{{ trans('global.datatables.copy') }}"
    var csvButtonTrans = "{{ trans('global.datatables.csv') }}"
    var pdfButtonTrans = "{{ trans('global.datatables.pdf') }}"
    var printButtonTrans = "{{ trans('global.datatables.print') }}"
    var colvisButtonTrans = "{{ trans('global.datatables.colvis') }}"
    var selectAllButtonTrans = "{{ trans('global.datatables.select_all') }}"
    var selectNoneButtonTrans = "{{ trans('global.datatables.deselect_all') }}"
    var lang = $('meta[name="_lang"]').attr('content');
    var arabic = {
        "sProcessing": "جارٍ التحميل...",
        "sLengthMenu": "أظهر _MENU_ مدخلات",
        "sZeroRecords": "لم يعثر على أية سجلات",
        "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
        "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
        "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
        "sInfoPostFix": "",
        "sSearch": "بحث:",
        "sUrl": "",
        "oPaginate": {
            "sFirst": "الأول",
            "sPrevious": "السابق",
            "sNext": "التالي",
            "sLast": "الأخير"
        },
        "buttons": {
            "selectAll": 'تحديد الكل',
            "selectNone": 'الغاء الكل',
            "copy": 'نسخ',
            "pdfHtml5": 'PDF',
            "print" : 'طباعة',
            "csv":'CSV',
            "colvis": 'تغيير الاعمدة',
        }
    }
    var english = {}
    $('.datatable').DataTable({
        language: lang == 'ar' ? arabic : english,
        columnDefs: [{
            orderable: false,
            className: 'select-checkbox',
            targets: 0
        }],
        select: {
            style: 'multi',
            selector: 'td:first-child'
        },
        order: [
            [1, 'desc']
        ],
        dom: 'Blfrtip',
        buttons: [
            {
                extend: 'selectAll',
                exportOptions: {
                    columns: ':visible'
                },
                action: function (e, dt) {
                    e.preventDefault()
                    dt.rows().deselect();
                    dt.rows({
                        search: 'applied'
                    }).select();
                }
            },
            {
                extend: 'selectNone',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            // {
            //     text: 'JSON',
            //     action: function (e, dt, button, config) {
            //         var data = dt.buttons.exportData();

            //         $.fn.dataTable.fileSave(
            //             new Blob([JSON.stringify(data)]),
            //             'Export.json'
            //         );
            //     }
            // },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'csv',
                charset: 'utf8',
                bom: true,
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'colvis',
                exportOptions: {
                    columns: ':visible'
                }
            }


        ]
    });

    /**************************************************
    *       js of scroll horizontal & vertical        *
    **************************************************/

    $('.scroll-horizontal-vertical').DataTable({
        "scrollY": 200,
        "scrollX": true
    });




});
