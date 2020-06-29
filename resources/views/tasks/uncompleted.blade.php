
@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/datatables-net/media/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/libs/datatables-net/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/libs/datatables-net/datatables.min.css')}}">
    <script src="{{ asset('libs/jquery/jquery.validate.js')}}"></script>
    <style>
        .btn-danger-outline, .btn-danger-outline:hover, .btn-danger-outline:focus{
            border: none;
            background: none;
            cursor: pointer;
            margin-top: -1px;
        }
        .la-edit{
            float: right;
        }
        .form-check {
            display: inline-block;
        }
        .form-check-label {
            padding-right: 1.25rem;
            padding-left: 0;
            margin-left: 15px;
        }
    </style>
@stop

@section('content')

    <div class="column page">

        <div class="header">
            <section class="title">
                <h3>قائمة المهام</h3>

                <div class="controls">
                    <nav class="breadcrumb default">
                        <a class="breadcrumb-item breadcrumb-icon" href="{{url('/')}}">
                            <span class="la la-home icon"></span>
                        </a>
                        <span class="breadcrumb-item active" href="#">أرشيف المهام</span>
                    </nav>
                </div>
            </section>
        </div>

        <div class="content">
            <div class="body content-nav">
                <div class="nav-body">
                    <div class="nav-body-wrapper">

                        <div class="container-fluid">
                            <a href="javascript:void(0)" class="btn btn-info ml-3" id="create-new-task">إضافة مهمة</a>
                            <br><br>
                            <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th class="no_sort">رقم المهمة</th>
                                    <th class="no_sort">اسم المهمة</th>
                                    <th class="no_sort">تاريخ بداية المهمة</th>
                                    <th class="no_sort">تاريخ نهاية المهمة</th>
                                    <th class="no_sort">الحالة</th>
                                    <th class="no_sort">العمليات</th>
                                </tr>
                                </thead>
                            </table>
                        </div>

                        @include('tasks.include.addEdit')

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script src="{{ asset('libs/datatables-net/media/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('libs/datatables-net/media/js/dataTables.bootstrap4.min.js')}}"></script>

    <script>
        var SITEURL = '{{\Illuminate\Support\Facades\URL::to('')}}';
        var currentDate = '{{\Illuminate\Support\Carbon::today()->format("Y-m-d")}}';


        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('#datatable');
            var datatable = table.DataTable({

                "initComplete": function () {
                    $('.dataTables_length select', '#datatable_wrapper').select2({
                        minimumResultsForSearch: Infinity
                    });
                    $('.dataTables_scrollBody', '#datatable_wrapper').jScrollPane();
                },
                "language": {
                    "sProcessing":   "جارٍ التحميل...",
                    "sLengthMenu":   "أظهر _MENU_ مدخلات",
                    "sZeroRecords":  "لم يعثر على أية سجلات",
                    "sInfo":         "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                    "sInfoEmpty":    "يعرض 0 إلى 0 من أصل 0 سجل",
                    "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                    "sInfoPostFix":  "",
                    "sSearch":       "ابحث:",
                    "sUrl":          "",
                    "oPaginate": {
                        "sFirst": "الأول",
                        "sPrevious": "السابق",
                        "sNext": "التالي",
                        "sLast": "الأخير"
                    }
                },
                "order": false,
                "columnDefs": [ {
                    "targets"  : 'no_sort',
                    "orderable": false
                }],

                "scrollY": 300,
                "scrollCollapse": true,
                colReorder: false,
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: SITEURL + "/uncompleted",
                    type: 'GET'
                },
                /* get tasks ajax */
                columns: [
                    {data: 'id', name: 'id'},
                    { data: 'name', name: 'name'},
                    { data: 'start_date', name: 'start_date' },
                    {
                        data: null,
                        render: function (data) {
                            if (data.end_date <= currentDate && data.status != 'completed') {
                                return '<span class="badge badge-pink">  انتهى وقت المهمة  </span> '
                            }else if(data.end_date <= currentDate && data.status == 'completed') {
                                return '<span class="badge badge-success">  تم انجاز المهمة في الوقت المطلوب  </span> '
                            }
                            else {
                                return data.end_date
                            }



                        },
                    },
                    {
                        data: null,
                        render: function (data) {
                            if (data.status == 'pending' && data.end_date > currentDate) {
                                return '<span class="badge badge-crusta">' +data.status+  '</span> '
                            }
                            else  if (data.status == 'inprogress' && data.end_date > currentDate) {
                                return '<span class="badge badge-info">  ' +data.status+  ' </span> '
                            }
                            else  if (data.status == 'completed') {
                                return '<span class="badge badge-success">  ' +data.status+  ' </span> '
                            }
                            else  if (data.end_date <= currentDate && data.status != 'completed') {
                                return '<span class="badge badge-danger">  CANCELD  </span> '
                            }

                        },
                    },
                    { data: 'action', name: 'action' },
//
                ],
            });

            table.on('draw.dt', function () {
                $('.dataTables_scrollBody', '#datatable_wrapper').jScrollPane().data().jsp.destroy();
                $('.dataTables_scrollBody', '#datatable_wrapper').jScrollPane();
            });
        });
    </script>
    @include('tasks.include.taskoperations')
@stop
